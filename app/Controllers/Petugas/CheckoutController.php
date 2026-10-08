<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\VisitModel;
use App\Models\VisitStatusHistoryModel;
use App\Services\ActivityLogService;

class CheckoutController extends BaseController
{
    protected VisitModel $visitModel;
    protected VisitStatusHistoryModel $statusHistoryModel;
    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        helper('mask');

        $this->visitModel         = new VisitModel();
        $this->statusHistoryModel = new VisitStatusHistoryModel();
        $this->activityLogService = new ActivityLogService();
    }

    public function scan()
    {
        return view('petugas/checkout/scan', [
            'title' => 'Scan QR Checkout',
        ]);
    }

    public function index($token = null)
    {
        if (empty($token)) {
            return view('petugas/checkout/error', [
                'title'   => 'QR Tidak Valid',
                'message' => 'Token QR tidak valid.',
            ]);
        }

        $visit = $this->visitModel
            ->select('visits.*, guests.name AS guest_name, guests.phone')
            ->select('departments.name AS department_name')
            ->select('employees.name AS employee_name')
            ->select('visit_purposes.name AS purpose_name')
            ->join('guests', 'guests.id = visits.guest_id', 'left')
            ->join('departments', 'departments.id = visits.department_id', 'left')
            ->join('employees', 'employees.id = visits.employee_id', 'left')
            ->join('visit_purposes', 'visit_purposes.id = visits.visit_purpose_id', 'left')
            ->where('visits.qr_token', $token)
            ->first();

        if (! $visit) {
            return view('petugas/checkout/error', [
                'title'   => 'QR Tidak Ditemukan',
                'message' => 'QR tidak ditemukan. Pastikan QR yang Anda scan benar.',
            ]);
        }

        if ($visit['status'] === 'selesai') {
            return view('petugas/checkout/error', [
                'title'   => 'Kunjungan Sudah Selesai',
                'message' => 'Kunjungan ini sudah selesai. QR tidak dapat digunakan lagi.',
            ]);
        }

        if ($visit['status'] === 'ditolak') {
            return view('petugas/checkout/error', [
                'title'   => 'Kunjungan Ditolak',
                'message' => 'Kunjungan ini ditolak. QR tidak dapat digunakan.',
            ]);
        }

        if ($visit['status'] === 'dibatalkan') {
            return view('petugas/checkout/error', [
                'title'   => 'Kunjungan Dibatalkan',
                'message' => 'Kunjungan ini dibatalkan. QR tidak dapat digunakan.',
            ]);
        }

        if ($visit['status'] === 'menunggu') {
            return view('petugas/checkout/error', [
                'title'   => 'Belum Check-in',
                'message' => 'Tamu belum melakukan check-in. Silakan proses check-in terlebih dahulu.',
            ]);
        }

        if ($visit['status'] !== 'masih_berkunjung') {
            return view('petugas/checkout/error', [
                'title'   => 'QR Tidak Valid',
                'message' => 'Status kunjungan tidak valid untuk checkout.',
            ]);
        }

        $duration = null;

        if (! empty($visit['checkin_at'])) {
            $checkin = strtotime($visit['checkin_at']);
            $now     = time();
            $diff    = $now - $checkin;

            $duration = [
                'seconds' => $diff,
                'text'    => $this->formatDuration($diff),
            ];
        }

        return view('petugas/checkout/index', [
            'title'    => 'Checkout Kunjungan',
            'visit'    => $visit,
            'duration' => $duration,
        ]);
    }

    public function process($token = null)
    {
        if (empty($token)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Token QR tidak valid.',
            ]);
        }

        $visit = $this->visitModel
            ->where('qr_token', $token)
            ->first();

        if (! $visit) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'QR tidak ditemukan.',
            ]);
        }

        if ($visit['status'] !== 'masih_berkunjung') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Kunjungan tidak dapat di-checkout. Status: ' . $visit['status'],
            ]);
        }

        $checkoutAt = date('Y-m-d H:i:s');

        $duration = null;

        if (! empty($visit['checkin_at'])) {
            $checkin  = strtotime($visit['checkin_at']);
            $checkout = strtotime($checkoutAt);
            $duration = $checkout - $checkin;
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $builder = $this->visitModel->builder();
            $builder->where('id', $visit['id']);
            $builder->where('status', 'masih_berkunjung');
            $builder->update([
                'status'      => 'selesai',
                'checkout_at' => $checkoutAt,
                'duration'    => $duration,
            ]);

            if ($db->affectedRows() === 0) {
                $db->transRollback();
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Kunjungan sudah diproses oleh pengguna lain. Silakan refresh halaman.',
                ]);
            }

            $statusHistoryId = $this->statusHistoryModel->insert([
                'visit_id'   => $visit['id'],
                'user_id'    => session()->get('user_id'),
                'status'     => 'selesai',
                'created_at' => $checkoutAt,
            ], true);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Transaksi gagal.');
            }

            $this->activityLogService->log(
                'checkout',
                'visits',
                'Checkout via QR. Kode: ' . $visit['visit_code'] . '. Durasi: ' . $this->formatDuration($duration ?? 0),
                null,
                $visit['id'],
                $statusHistoryId
            );

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Checkout berhasil.',
                'data' => [
                    'visit_code'  => $visit['visit_code'],
                    'checkout_at' => date('d M Y, H:i', strtotime($checkoutAt)),
                    'duration'    => $this->formatDuration($duration ?? 0),
                    'status'      => 'Selesai',
                ],
            ]);
        } catch (\Throwable $e) {
            $db->transRollback();

            log_message('error', 'Checkout via QR failed: ' . $e->getMessage());

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Checkout gagal. Silakan coba lagi.',
            ]);
        }
    }

    protected function formatDuration(int $seconds): string
    {
        if ($seconds < 60) {
            return $seconds . ' detik';
        }

        $minutes = floor($seconds / 60);
        $hours   = floor($minutes / 60);
        $days    = floor($hours / 24);

        if ($days > 0) {
            $hours = $hours % 24;
            return $days . ' hari ' . $hours . ' jam';
        }

        if ($hours > 0) {
            $minutes = $minutes % 60;
            return $hours . ' jam ' . $minutes . ' menit';
        }

        return $minutes . ' menit';
    }
}
