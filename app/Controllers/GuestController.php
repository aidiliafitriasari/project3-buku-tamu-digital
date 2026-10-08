<?php

namespace App\Controllers;

use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Models\VisitPurposeModel;
use App\Models\GuestModel;
use App\Models\VisitModel;
use App\Models\VisitStatusHistoryModel;
use App\Models\SettingModel;
use App\Services\VisitCodeService;
use App\Services\QrCodeService;
use App\Services\PhotoService;
use App\Services\SignatureService;
use App\Services\ActivityLogService;
use App\Validation\GuestRules;

class GuestController extends BaseController
{
    protected DepartmentModel $departmentModel;
    protected EmployeeModel $employeeModel;
    protected VisitPurposeModel $visitPurposeModel;
    protected GuestModel $guestModel;
    protected VisitModel $visitModel;
    protected VisitStatusHistoryModel $statusHistoryModel;
    protected SettingModel $settingModel;

    protected VisitCodeService $visitCodeService;
    protected QrCodeService $qrCodeService;
    protected PhotoService $photoService;
    protected SignatureService $signatureService;
    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        $this->departmentModel    = new DepartmentModel();
        $this->employeeModel      = new EmployeeModel();
        $this->visitPurposeModel  = new VisitPurposeModel();
        $this->guestModel         = new GuestModel();
        $this->visitModel         = new VisitModel();
        $this->statusHistoryModel = new VisitStatusHistoryModel();
        $this->settingModel       = new SettingModel();

        $this->visitCodeService   = new VisitCodeService();
        $this->qrCodeService      = new QrCodeService();
        $this->photoService       = new PhotoService();
        $this->signatureService   = new SignatureService();
        $this->activityLogService = new ActivityLogService();
    }

    public function index()
    {
        return view('guest/index', [
            'title' => 'Buku Tamu Digital',
        ]);
    }

    public function register()
    {
        $departments = $this->departmentModel
            ->where('is_active', true)
            ->orderBy('name', 'ASC')
            ->findAll();

        $employees = $this->employeeModel
            ->where('is_active', true)
            ->orderBy('name', 'ASC')
            ->findAll();

        $visitPurposes = $this->visitPurposeModel
            ->where('is_active', true)
            ->orderBy('name', 'ASC')
            ->findAll();

        $settings = $this->settingModel->first();

        return view('guest/register', [
            'title'         => 'Registrasi Kunjungan',
            'departments'   => $departments,
            'employees'     => $employees,
            'visitPurposes' => $visitPurposes,
            'settings'      => $settings,
        ]);
    }

    public function store()
    {
        $settings = $this->settingModel->first();

        $photoRequired     = ! empty($settings['photo_required']);
        $signatureRequired = ! empty($settings['signature_required']);

        $rules = GuestRules::register($photoRequired, $signatureRequired);

        if (! $this->validate($rules)) {
            return $this->jsonError(
                $this->validator->getErrors(),
                'Validasi gagal. Periksa kembali data Anda.'
            );
        }

        $departmentId = (int) $this->request->getPost('department_id');
        $employeeId   = (int) $this->request->getPost('employee_id');

        $employee = $this->employeeModel
            ->where('id', $employeeId)
            ->where('department_id', $departmentId)
            ->where('is_active', true)
            ->first();

        if (! $employee) {
            return $this->jsonError(
                ['employee_id' => 'Pegawai tidak terdaftar di departemen yang dipilih.'],
                'Validasi gagal. Periksa kembali data Anda.'
            );
        }

        $photoFile     = $this->request->getFile('photo');
        $signatureFile = $this->request->getFile('signature');

        $db = \Config\Database::connect();
        $db->transStart();

        $photoPath     = null;
        $signaturePath = null;

        try {

            $guestName = trim((string) $this->request->getPost('name'));

            $guestId = $this->guestModel->insert([
                'name'            => $guestName,
                'phone'           => trim((string) $this->request->getPost('phone')),
                'address'         => trim((string) $this->request->getPost('address')),
                'identity_type'   => $this->request->getPost('identity_type'),
                'identity_number' => trim((string) $this->request->getPost('identity_number')),
            ], true);

            if (! $guestId) {
                throw new \RuntimeException('Gagal menyimpan data tamu.');
            }

            $codeData = $this->visitCodeService->generate();
            $visitCode = $codeData['visit_code'];
            $qrToken   = $codeData['qr_token'];

            if ($photoFile && $photoFile->isValid()) {
                $photoPath = $this->photoService->save($photoFile, $visitCode);
            }

            if ($signatureFile && $signatureFile->isValid()) {
                $signaturePath = $this->signatureService->save($signatureFile, $visitCode);
            }

            $maxAttempts = 3;
            $visitId = null;

            for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {

                if ($attempt <= 2) {
                    $codeData = $this->visitCodeService->generate();
                    $visitCode = $codeData['visit_code'];
                    $qrToken   = $codeData['qr_token'];
                } else {
                    $visitCode = 'BT-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(4)));
                    $qrToken   = bin2hex(random_bytes(16));
                }

                try {
                    $visitId = $this->visitModel->insert([
                        'guest_id'           => $guestId,
                        'visit_code'         => $visitCode,
                        'qr_token'           => $qrToken,
                        'origin_institution' => trim((string) $this->request->getPost('origin_institution')),
                        'department_id'      => (int) $this->request->getPost('department_id'),
                        'employee_id'        => (int) $this->request->getPost('employee_id'),
                        'visit_purpose_id'   => (int) $this->request->getPost('visit_purpose_id'),
                        'group_count'        => (int) $this->request->getPost('group_count'),
                        'data_consent'       => true,
                        'arrival_at'         => date('Y-m-d H:i:s'),
                        'status'             => 'menunggu',
                        'photo'              => $photoPath,
                        'signature'          => $signaturePath,
                    ], true);

                    if ($visitId) {
                        break;
                    }
                } catch (\Throwable $e) {
                    if ($attempt === $maxAttempts) {
                        throw $e;
                    }
                }
            }

            if (! $visitId) {
                throw new \RuntimeException('Gagal menyimpan data kunjungan setelah ' . $maxAttempts . ' percobaan.');
            }

            $statusHistoryId = $this->statusHistoryModel->insert([
                'visit_id'   => $visitId,
                'user_id'    => null,
                'status'     => 'menunggu',
                'created_at' => date('Y-m-d H:i:s'),
            ], true);

            if (! $statusHistoryId) {
                throw new \RuntimeException('Gagal menyimpan status history.');
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Transaksi gagal.');
            }

            $logResult = $this->activityLogService->systemLog(
                'register',
                'visits',
                'Registrasi kunjungan oleh tamu ' . $guestName . '. Kode: ' . $visitCode,
                $visitId,
                $statusHistoryId
            );

            if (! $logResult) {
                log_message('error', 'Activity log failed for visit: ' . $visitCode);
            }

            return $this->response->setJSON([
                'success'  => true,
                'message'  => 'Registrasi berhasil.',
                'redirect' => base_url('pendaftaran/sukses/' . $qrToken),
            ]);
        } catch (\Throwable $e) {
            $db->transRollback();

            if (! empty($photoPath)) {
                $this->photoService->delete($photoPath);
            }

            if (! empty($signaturePath)) {
                $this->signatureService->delete($signaturePath);
            }

            log_message('error', 'Guest registration failed: ' . $e->getMessage());

            $errorMessage = 'Registrasi gagal. Silakan coba lagi.';

            if (ENVIRONMENT === 'development') {
                $errorMessage .= ' ' . $e->getMessage();
            }

            return $this->jsonError([], $errorMessage);
        }
    }

    public function success($token = null)
    {
        if (empty($token)) {
            return redirect()->to('/');
        }

        $visit = $this->visitModel
            ->select('visits.*, guests.name AS guest_name, guests.phone, guests.address, guests.identity_type, guests.identity_number')
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
            return redirect()
                ->to('/')
                ->with('error', 'Data kunjungan tidak ditemukan.');
        }

        $qrDataUri = $this->qrCodeService->generateDataUri($visit['qr_token'], 300);

        return view('guest/success', [
            'title'     => 'Registrasi Berhasil',
            'visit'     => $visit,
            'qrDataUri' => $qrDataUri,
        ]);
    }

    protected function jsonError(array $errors = [], string $message = 'Terjadi kesalahan.')
    {
        return $this->response->setJSON([
            'success' => false,
            'message' => $message,
            'errors'  => $errors,
        ]);
    }
}
