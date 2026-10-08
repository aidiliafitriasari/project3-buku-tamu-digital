<?php

namespace App\Services;

use App\Models\WhatsappSettingModel;
use App\Models\NotificationModel;
use App\Models\VisitModel;
use Config\Services;

class WhatsappService
{
    protected WhatsappSettingModel $settingModel;
    protected NotificationModel $notificationModel;
    protected VisitModel $visitModel;

    protected string $baseUrl = '';
    protected string $apiKey  = '';
    protected bool $enabled   = false;

    public function __construct()
    {
        $this->settingModel      = new WhatsappSettingModel();
        $this->notificationModel = new NotificationModel();
        $this->visitModel        = new VisitModel();

        $settings = $this->settingModel->first();

        if ($settings) {
            $this->baseUrl = rtrim((string) ($settings['api_url'] ?? ''), '/');
            $this->apiKey  = (string) ($settings['api_key'] ?? '');

            $this->enabled = (int) $settings['is_enabled'] === 1
                && $this->baseUrl !== ''
                && $this->apiKey !== '';
        }
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    // ============================================================
    // PUBLIC API
    // ============================================================

    /**
     * Cek status gateway Wakita.
     */
    public function checkGateway(): array
    {
        return $this->request('GET', '/status');
    }

    /**
     * Kirim pesan WhatsApp.
     *
     * @return array{success:bool,message:string,outbox_id:?int,log_mode:bool}
     */
    public function send(string $phone, string $message, string $type, int $visitId = 0): array
    {
        $phone = $this->normalizePhone($phone);

        if ($phone === '') {
            return [
                'success'   => false,
                'message'   => 'Nomor HP tidak valid.',
                'outbox_id' => null,
                'log_mode'  => false,
            ];
        }

        // ===== LOG MODE =====
        if (! $this->enabled) {
            $this->writeLog('LOG MODE', $phone, $message, $type, $visitId);

            return [
                'success'   => true,
                'message'   => 'Log mode aktif — pesan tidak dikirim ke WhatsApp (integrasi nonaktif / kredensial kosong).',
                'outbox_id' => null,
                'log_mode'  => true,
            ];
        }

        // ===== REAL SEND =====
        $result = $this->request('POST', '/send', [
            'number'  => $phone,
            'message' => $message,
        ]);

        $success  = ! empty($result['body']['success']);
        $outboxId = $result['body']['data']['outbox_id'] ?? null;
        $errMsg   = $result['body']['message'] ?? 'Tidak ada respons dari gateway.';

        if ($visitId > 0) {
            $this->saveNotification(
                $visitId,
                $type,
                $phone,
                $success ? 'sent' : 'failed',
                $success ? date('Y-m-d H:i:s') : null
            );
        }

        $this->writeLog(
            $success ? 'SENT' : 'FAILED',
            $phone,
            $message,
            $type,
            $visitId,
            $errMsg
        );

        return [
            'success'   => $success,
            'message'   => $errMsg,
            'outbox_id' => $outboxId,
            'log_mode'  => false,
        ];
    }

    // ============================================================
    // WA-1 : Kirim QR & kode ke Tamu
    // ============================================================

    public function sendToGuest(int $visitId): bool
    {
        $settings = $this->settingModel->first();

        if (! $settings || (int) $settings['guest_enabled'] !== 1) {
            return false;
        }

        $visit = $this->getVisitDetail($visitId);

        if (! $visit || empty($visit['guest_phone'])) {
            return false;
        }

        $template = (string) ($settings['guest_template'] ?? '');
        $message  = $this->replacePlaceholders($template, $visit);

        if (trim($message) === '') {
            return false;
        }

        $result = $this->send($visit['guest_phone'], $message, 'qr_kunjungan', $visitId);

        return (bool) $result['success'];
    }

    // ============================================================
    // WA-2 : Kirim notifikasi ke Pegawai tujuan
    // ============================================================

    public function sendToEmployee(int $visitId): bool
    {
        $settings = $this->settingModel->first();

        if (! $settings || (int) $settings['employee_enabled'] !== 1) {
            return false;
        }

        $visit = $this->getVisitDetail($visitId);

        if (! $visit || empty($visit['employee_phone'])) {
            return false;
        }

        $template = (string) ($settings['employee_template'] ?? '');
        $message  = $this->replacePlaceholders($template, $visit);

        if (trim($message) === '') {
            return false;
        }

        $result = $this->send($visit['employee_phone'], $message, 'notifikasi_tujuan', $visitId);

        return (bool) $result['success'];
    }

    // ============================================================
    // WA-3 : Peringatan kunjungan terlalu lama (anti-spam)
    // ============================================================

    public function sendWarning(int $visitId): bool
    {
        // Anti-spam — sudah pernah kirim peringatan untuk visit ini
        if ($this->hasSentWarning($visitId)) {
            return false;
        }

        $settings = $this->settingModel->first();

        if (! $settings || (int) $settings['employee_enabled'] !== 1) {
            return false;
        }

        $visit = $this->getVisitDetail($visitId);

        if (! $visit || empty($visit['employee_phone'])) {
            return false;
        }

        $template = (string) ($settings['employee_template'] ?? '');
        $base     = $this->replacePlaceholders($template, $visit);

        // Tambahkan info durasi di depan template
        $duration = (int) ($visit['duration_minutes'] ?? 0);
        $message  = "⏰ Peringatan Kunjungan Terlalu Lama\n"
            . "Tamu: {$visit['guest_name']}\n"
            . "Durasi: {$duration} menit (belum checkout)\n\n"
            . $base;

        $result = $this->send($visit['employee_phone'], $message, 'peringatan_kunjungan', $visitId);

        return (bool) $result['success'];
    }

    // ============================================================
    // INTERNAL
    // ============================================================

    protected function request(string $method, string $endpoint, array $data = []): array
    {
        $client = Services::curlrequest();

        $headers = [
            'X-API-Key'    => $this->apiKey,
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ];

        try {
            $response = $client->request($method, $this->baseUrl . $endpoint, [
                'headers'     => $headers,
                'json'        => $method !== 'GET' ? $data : null,
                'timeout'     => 30,
                'http_errors' => false,
            ]);

            return [
                'status' => $response->getStatusCode(),
                'body'   => json_decode($response->getBody(), true),
            ];
        } catch (\Throwable $e) {
            log_message('error', '[WhatsappService] Request failed: ' . $e->getMessage());

            return [
                'status' => 0,
                'body'   => [
                    'success' => false,
                    'message' => $e->getMessage(),
                ],
            ];
        }
    }

    protected function getVisitDetail(int $visitId): ?array
    {
        $visit = $this->visitModel
            ->select([
                'visits.id',
                'visits.visit_code',
                'visits.qr_token',
                'visits.arrival_at',
                'visits.checkin_at',
                'visits.status',
                'visits.origin_institution',
                'visits.group_count',
                'guests.name AS guest_name',
                'guests.phone AS guest_phone',
                'departments.name AS department_name',
                'employees.name AS employee_name',
                'employees.nomor_hp AS employee_phone',
                'visit_purposes.name AS purpose_name',
            ])
            ->join('guests', 'guests.id = visits.guest_id', 'left')
            ->join('departments', 'departments.id = visits.department_id', 'left')
            ->join('employees', 'employees.id = visits.employee_id', 'left')
            ->join('visit_purposes', 'visit_purposes.id = visits.visit_purpose_id', 'left')
            ->where('visits.id', $visitId)
            ->first();

        if (! $visit) {
            return null;
        }

        // Hitung durasi untuk WA-3
        if (! empty($visit['checkin_at'])) {
            $visit['duration_minutes'] = max(
                0,
                (int) floor((time() - strtotime($visit['checkin_at'])) / 60)
            );
        } else {
            $visit['duration_minutes'] = 0;
        }

        return $visit;
    }

    protected function replacePlaceholders(string $template, array $data): string
    {
        $arrivalTime = ! empty($data['arrival_at'])
            ? date('d M Y, H:i', strtotime($data['arrival_at']))
            : '-';

        $checkinTime = ! empty($data['checkin_at'])
            ? date('d M Y, H:i', strtotime($data['checkin_at']))
            : '-';

        $linkQr = ! empty($data['qr_token'])
            ? base_url('pendaftaran/sukses/' . $data['qr_token'])
            : '-';

        $map = [
            '{nama_tamu}'      => $data['guest_name'] ?? '-',
            '{kode_kunjungan}' => $data['visit_code'] ?? '-',
            '{instansi}'       => $data['origin_institution'] ?? '-',
            '{asal_instansi}'  => $data['origin_institution'] ?? '-',
            '{departemen}'     => $data['department_name'] ?? '-',
            '{nama_pegawai}'   => $data['employee_name'] ?? '-',
            '{keperluan}'      => $data['purpose_name'] ?? '-',
            '{rombongan}'      => $data['group_count'] ?? 1,
            '{waktu}'          => $arrivalTime,
            '{waktu_datang}'   => $arrivalTime,
            '{waktu_checkin}'  => $checkinTime,
            '{durasi}'         => ($data['duration_minutes'] ?? 0) . ' menit',
            '{link_qr}'        => $linkQr,
        ];

        return strtr($template, $map);
    }

    protected function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if ($phone === '') {
            return '';
        }

        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        if (! str_starts_with($phone, '62')) {
            $phone = '62' . $phone;
        }

        return $phone;
    }

    protected function hasSentWarning(int $visitId): bool
    {
        return $this->notificationModel
            ->where('visit_id', $visitId)
            ->where('notification_type', 'peringatan_kunjungan')
            ->where('status', 'sent')
            ->countAllResults() > 0;
    }

    protected function saveNotification(
        int $visitId,
        string $type,
        string $phone,
        string $status,
        ?string $sentAt
    ): void {
        try {
            $this->notificationModel->insert([
                'visit_id'          => $visitId,
                'recipient_type'    => str_contains($type, 'tujuan') || str_contains($type, 'peringatan')
                    ? 'pegawai'
                    : 'tamu',
                'recipient_phone'   => $phone,
                'notification_type' => $type,
                'status'            => $status,
                'sent_at'           => $sentAt,
            ]);
        } catch (\Throwable $e) {
            log_message('error', '[WhatsappService] Save notification failed: ' . $e->getMessage());
        }
    }

    protected function writeLog(
        string $status,
        string $phone,
        string $message,
        string $type,
        int $visitId,
        string $note = ''
    ): void {
        $line = sprintf(
            '[%s] [%s] type=%s visit=%d to=%s | %s | %s',
            date('Y-m-d H:i:s'),
            $status,
            $type,
            $visitId,
            $phone,
            str_replace("\n", ' ', $message),
            $note
        );

        log_message('info', '[WhatsappService] ' . $line);
    }
}
