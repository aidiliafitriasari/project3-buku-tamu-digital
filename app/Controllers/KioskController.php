<?php

namespace App\Controllers;

use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Models\VisitPurposeModel;
use App\Models\SettingModel;
use App\Models\VisitModel;
use App\Services\QrCodeService;

class KioskController extends BaseController
{
    protected DepartmentModel $departmentModel;
    protected EmployeeModel $employeeModel;
    protected VisitPurposeModel $visitPurposeModel;
    protected SettingModel $settingModel;
    protected VisitModel $visitModel;
    protected QrCodeService $qrCodeService;

    public function __construct()
    {
        $this->departmentModel   = new DepartmentModel();
        $this->employeeModel     = new EmployeeModel();
        $this->visitPurposeModel = new VisitPurposeModel();
        $this->settingModel      = new SettingModel();
        $this->visitModel        = new VisitModel();
        $this->qrCodeService     = new QrCodeService();
    }

    public function index()
    {
        return view('kiosk/index', [
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

        return view('kiosk/register', [
            'title'         => 'Registrasi Kunjungan',
            'departments'   => $departments,
            'employees'     => $employees,
            'visitPurposes' => $visitPurposes,
            'settings'      => $settings,
        ]);
    }

    public function success($token = null)
    {
        if (empty($token)) {
            return redirect()->to('/kiosk');
        }

        $visit = $this->visitModel
            ->select('visits.*, guests.name AS guest_name')
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
                ->to('/kiosk')
                ->with('error', 'Data kunjungan tidak ditemukan.');
        }

        $qrDataUri = $this->qrCodeService->generateDataUri($visit['qr_token'], 300);

        return view('kiosk/success', [
            'title'     => 'Registrasi Berhasil',
            'visit'     => $visit,
            'qrDataUri' => $qrDataUri,
        ]);
    }
}
