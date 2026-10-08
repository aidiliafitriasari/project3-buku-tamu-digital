<?php

namespace App\Controllers\Petugas;

use App\Controllers\Admin\BaseAjaxController;
use App\Models\VisitModel;
use App\Models\VisitStatusHistoryModel;
use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Services\ActivityLogService;
use App\Validation\VisitRules;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Exceptions\PageNotFoundException;

class VisitController extends BaseAjaxController
{
    protected VisitModel $visitModel;
    protected VisitStatusHistoryModel $statusHistoryModel;
    protected DepartmentModel $departmentModel;
    protected EmployeeModel $employeeModel;
    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        helper('mask');

        $this->visitModel         = new VisitModel();
        $this->statusHistoryModel = new VisitStatusHistoryModel();
        $this->departmentModel    = new DepartmentModel();
        $this->employeeModel      = new EmployeeModel();
        $this->activityLogService = new ActivityLogService();
    }

    protected function getModel()
    {
        return $this->visitModel;
    }

    protected function getPartialView(): string
    {
        return 'petugas/visits/_table';
    }

    protected function getDefaultOrder(): array
    {
        return [
            'visits.arrival_at' => 'DESC',
        ];
    }

    protected function applySearch(
        BaseBuilder $builder,
        string $search
    ): void {
        $builder
            ->groupStart()
            ->like('guests.name', $search)
            ->orLike('visits.visit_code', $search)
            ->orLike('guests.phone', $search)
            ->groupEnd();
    }

    protected function applyFilters(
        BaseBuilder $builder
    ): void {
        $status   = (string) ($this->request->getGet('status') ?? 'aktif');
        $deptId   = (int) $this->request->getGet('department_id');
        $empId    = (int) $this->request->getGet('employee_id');
        $dateFrom = (string) $this->request->getGet('date_from');
        $dateTo   = (string) $this->request->getGet('date_to');

        $builder->where('visits.deleted_at IS NULL', null, false);

        if ($status === 'aktif') {
            $builder->whereIn('visits.status', ['menunggu', 'masih_berkunjung']);
        } elseif ($status === 'riwayat') {
            $builder->whereIn('visits.status', ['selesai', 'ditolak', 'dibatalkan']);
        } elseif ($status === 'menunggu') {
            $builder->where('visits.status', 'menunggu');
        } elseif ($status === 'masih_berkunjung') {
            $builder->where('visits.status', 'masih_berkunjung');
        }

        if ($deptId > 0) {
            $builder->where('visits.department_id', $deptId);
        }

        if ($empId > 0) {
            $builder->where('visits.employee_id', $empId);
        }

        if (! empty($dateFrom)) {
            $builder->where('DATE(visits.arrival_at) >=', $dateFrom);
        }

        if (! empty($dateTo)) {
            $builder->where('DATE(visits.arrival_at) <=', $dateTo);
        }
    }

    protected function getListData(?int $perPage = null): array
    {
        $status   = (string) ($this->request->getGet('status') ?? 'aktif');
        $search   = trim((string) $this->request->getGet('search'));
        $deptId   = (int) $this->request->getGet('department_id');
        $empId    = (int) $this->request->getGet('employee_id');
        $dateFrom = (string) $this->request->getGet('date_from');
        $dateTo   = (string) $this->request->getGet('date_to');

        $builder = $this->visitModel
            ->select('visits.*, guests.name AS guest_name, guests.phone, guests.identity_type, guests.identity_number')
            ->select('departments.name AS department_name')
            ->select('employees.name AS employee_name')
            ->select('visit_purposes.name AS purpose_name')
            ->join('guests', 'guests.id = visits.guest_id', 'left')
            ->join('departments', 'departments.id = visits.department_id', 'left')
            ->join('employees', 'employees.id = visits.employee_id', 'left')
            ->join('visit_purposes', 'visit_purposes.id = visits.visit_purpose_id', 'left');

        $builder->where('visits.deleted_at IS NULL', null, false);

        if ($status === 'aktif') {
            $builder->whereIn('visits.status', ['menunggu', 'masih_berkunjung']);
        } elseif ($status === 'riwayat') {
            $builder->whereIn('visits.status', ['selesai', 'ditolak', 'dibatalkan']);
        } elseif ($status === 'menunggu') {
            $builder->where('visits.status', 'menunggu');
        } elseif ($status === 'masih_berkunjung') {
            $builder->where('visits.status', 'masih_berkunjung');
        }

        if ($search !== '') {
            $builder->groupStart()
                ->like('guests.name', $search)
                ->orLike('visits.visit_code', $search)
                ->orLike('guests.phone', $search)
                ->groupEnd();
        }

        if ($deptId > 0) {
            $builder->where('visits.department_id', $deptId);
        }

        if ($empId > 0) {
            $builder->where('visits.employee_id', $empId);
        }

        if (! empty($dateFrom)) {
            $builder->where('DATE(visits.arrival_at) >=', $dateFrom);
        }

        if (! empty($dateTo)) {
            $builder->where('DATE(visits.arrival_at) <=', $dateTo);
        }

        $builder->orderBy('visits.arrival_at', 'DESC');
        $builder->orderBy('visits.id', 'DESC');

        $perPage = $perPage ?? (int) $this->request->getGet('per_page');

        if (! in_array($perPage, $this->allowedPerPage, true)) {
            $perPage = $this->defaultPerPage;
        }

        $page = (int) $this->request->getGet('page');

        if ($page < 1) {
            $page = 1;
        }

        $total = $builder->countAllResults(false);

        $pageCount = $total > 0
            ? (int) ceil($total / $perPage)
            : 1;

        if ($page > $pageCount) {
            $page = $pageCount;
        }

        $offset = ($page - 1) * $perPage;

        $items = $builder
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();

        $pagination = $this->buildPaginationData(
            $page,
            $perPage,
            $total,
            $pageCount
        );

        return [
            'items' => $items,
            'pagination' => $pagination,
        ];
    }

    public function index()
    {
        $status = (string) ($this->request->getGet('status') ?? 'aktif');

        if ($status === 'terhapus') {
            throw PageNotFoundException::forPageNotFound('Akses ditolak.');
        }

        $data = $this->getListData();
        $search   = (string) ($this->request->getGet('search') ?? '');
        $perPage  = (int) ($this->request->getGet('per_page') ?? 50);
        $deptId   = (int) ($this->request->getGet('department_id') ?? 0);
        $empId    = (int) ($this->request->getGet('employee_id') ?? 0);
        $dateFrom = (string) ($this->request->getGet('date_from') ?? '');
        $dateTo   = (string) ($this->request->getGet('date_to') ?? '');

        $departments = $this->departmentModel
            ->where('is_active', true)
            ->orderBy('name', 'ASC')
            ->findAll();

        $employees = $this->employeeModel
            ->where('is_active', true)
            ->orderBy('name', 'ASC')
            ->findAll();

        return view('petugas/visits/index', [
            'title'       => 'Kunjungan',
            'status'      => $status,
            'search'      => $search,
            'perPage'     => $perPage,
            'items'       => $data['items'],
            'pagination'  => $data['pagination'],
            'departments' => $departments,
            'employees'   => $employees,
            'deptId'      => $deptId,
            'empId'       => $empId,
            'dateFrom'    => $dateFrom,
            'dateTo'      => $dateTo,
            'isAdmin'     => false,
        ]);
    }

    public function partial()
    {
        $status = (string) ($this->request->getGet('status') ?? 'aktif');

        if ($status === 'terhapus') {
            return $this->response->setJSON([
                'html'       => '<div class="app-empty"><h2 class="app-empty-title">Akses ditolak</h2><p class="app-empty-text">Anda tidak memiliki akses ke data terhapus.</p></div>',
                'pagination' => null,
            ]);
        }

        $data = $this->getListData();

        $html = view($this->getPartialView(), [
            'items'      => $data['items'],
            'pagination' => $data['pagination'],
            'status'     => $status,
            'isAdmin'    => false,
        ]);

        return $this->response->setJSON([
            'html'       => $html,
            'pagination' => $data['pagination'],
        ]);
    }

    public function show($id)
    {
        $visit = $this->visitModel
            ->select('visits.*, guests.name AS guest_name, guests.phone, guests.address, guests.identity_type, guests.identity_number')
            ->select('departments.name AS department_name')
            ->select('employees.name AS employee_name')
            ->select('visit_purposes.name AS purpose_name')
            ->join('guests', 'guests.id = visits.guest_id', 'left')
            ->join('departments', 'departments.id = visits.department_id', 'left')
            ->join('employees', 'employees.id = visits.employee_id', 'left')
            ->join('visit_purposes', 'visit_purposes.id = visits.visit_purpose_id', 'left')
            ->where('visits.id', $id)
            ->first();

        if (! $visit) {
            throw PageNotFoundException::forPageNotFound('Data kunjungan tidak ditemukan.');
        }

        $histories = $this->statusHistoryModel
            ->select('visit_status_histories.*, users.username')
            ->join('users', 'users.id = visit_status_histories.user_id', 'left')
            ->where('visit_status_histories.visit_id', $id)
            ->orderBy('visit_status_histories.created_at', 'ASC')
            ->findAll();

        return view('petugas/visits/show', [
            'title'     => 'Detail Kunjungan',
            'visit'     => $visit,
            'histories' => $histories,
        ]);
    }

    public function getData($id)
    {
        $visit = $this->visitModel
            ->select('visits.*, guests.name AS guest_name, guests.phone, guests.address, guests.identity_type, guests.identity_number')
            ->select('departments.name AS department_name')
            ->select('employees.name AS employee_name')
            ->select('visit_purposes.name AS purpose_name')
            ->join('guests', 'guests.id = visits.guest_id', 'left')
            ->join('departments', 'departments.id = visits.department_id', 'left')
            ->join('employees', 'employees.id = visits.employee_id', 'left')
            ->join('visit_purposes', 'visit_purposes.id = visits.visit_purpose_id', 'left')
            ->where('visits.id', $id)
            ->first();

        if (! $visit) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data kunjungan tidak ditemukan.',
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

        return $this->response->setJSON([
            'success'  => true,
            'visit'    => $visit,
            'duration' => $duration,
        ]);
    }

    public function edit($id)
    {
        $visit = $this->visitModel
            ->select('visits.*, guests.name AS guest_name, guests.phone, guests.address, guests.identity_type, guests.identity_number')
            ->select('departments.name AS department_name')
            ->select('employees.name AS employee_name')
            ->select('visit_purposes.name AS purpose_name')
            ->join('guests', 'guests.id = visits.guest_id', 'left')
            ->join('departments', 'departments.id = visits.department_id', 'left')
            ->join('employees', 'employees.id = visits.employee_id', 'left')
            ->join('visit_purposes', 'visit_purposes.id = visits.visit_purpose_id', 'left')
            ->where('visits.id', $id)
            ->first();

        if (! $visit) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data kunjungan tidak ditemukan.',
            ]);
        }

        $departments = $this->departmentModel
            ->where('is_active', true)
            ->orderBy('name', 'ASC')
            ->findAll();

        $employees = $this->employeeModel
            ->where('is_active', true)
            ->orderBy('name', 'ASC')
            ->findAll();

        $purposes = (new \App\Models\VisitPurposeModel())
            ->where('is_active', true)
            ->orderBy('name', 'ASC')
            ->findAll();

        return $this->response->setJSON([
            'success'     => true,
            'visit'       => $visit,
            'departments' => $departments,
            'employees'   => $employees,
            'purposes'    => $purposes,
        ]);
    }

    public function update($id)
    {
        $visit = $this->visitModel->find($id);

        if (! $visit) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data kunjungan tidak ditemukan.',
            ]);
        }

        if ($visit['status'] !== 'menunggu') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Kunjungan dengan status "' . $visit['status'] . '" tidak dapat diedit.',
            ]);
        }

        $rules = VisitRules::update();

        if (! $this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors'  => $this->validator->getErrors(),
            ]);
        }

        $departmentId = (int) $this->request->getPost('department_id');
        $employeeId   = (int) $this->request->getPost('employee_id');

        $employee = $this->employeeModel
            ->where('id', $employeeId)
            ->where('department_id', $departmentId)
            ->where('is_active', true)
            ->first();

        if (! $employee) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors'  => [
                    'employee_id' => 'Pegawai tidak terdaftar di departemen yang dipilih.',
                ],
            ]);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $db->table('guests')
                ->where('id', $visit['guest_id'])
                ->update([
                    'name'            => $this->request->getPost('name'),
                    'phone'           => $this->request->getPost('phone'),
                    'address'         => $this->request->getPost('address'),
                    'identity_type'   => $this->request->getPost('identity_type'),
                    'identity_number' => $this->request->getPost('identity_number'),
                    'updated_at'      => date('Y-m-d H:i:s'),
                ]);

            $this->visitModel->update($id, [
                'origin_institution' => $this->request->getPost('origin_institution'),
                'department_id'      => (int) $this->request->getPost('department_id'),
                'employee_id'        => (int) $this->request->getPost('employee_id'),
                'visit_purpose_id'   => (int) $this->request->getPost('visit_purpose_id'),
                'group_count'        => (int) $this->request->getPost('group_count'),
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Transaksi gagal.');
            }

            $this->activityLogService->log(
                'update',
                'visits',
                'Kunjungan ' . $visit['visit_code'] . ' diperbarui.',
                null,
                $id
            );

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data kunjungan berhasil diperbarui.',
            ]);
        } catch (\Throwable $e) {
            $db->transRollback();

            log_message('error', 'Update visit failed: ' . $e->getMessage());

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memperbarui data kunjungan.',
            ]);
        }
    }

    public function checkIn($id)
    {
        $visit = $this->visitModel->find($id);

        if (! $visit) {
            return $this->jsonError('Data kunjungan tidak ditemukan.');
        }

        if ($visit['status'] !== 'menunggu') {
            return $this->jsonError('Kunjungan tidak dapat di-check-in. Status saat ini: ' . $visit['status']);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $builder = $this->visitModel->builder();
            $builder->where('id', $id);
            $builder->where('status', 'menunggu');
            $builder->update([
                'status'     => 'masih_berkunjung',
                'checkin_at' => date('Y-m-d H:i:s'),
            ]);

            if ($db->affectedRows() === 0) {
                $db->transRollback();
                return $this->jsonError('Kunjungan sudah diproses oleh pengguna lain. Silakan refresh halaman.');
            }

            $statusHistoryId = $this->statusHistoryModel->insert([
                'visit_id'   => $id,
                'user_id'    => session()->get('user_id'),
                'status'     => 'masih_berkunjung',
                'created_at' => date('Y-m-d H:i:s'),
            ], true);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Transaksi gagal.');
            }

            $this->activityLogService->log(
                'check_in',
                'visits',
                'Check-in kunjungan ' . $visit['visit_code'],
                null,
                $id,
                $statusHistoryId
            );

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Check-in berhasil.',
            ]);
        } catch (\Throwable $e) {
            $db->transRollback();

            log_message('error', 'Check-in failed: ' . $e->getMessage());

            return $this->jsonError('Check-in gagal. Silakan coba lagi.');
        }
    }

    public function reject($id)
    {
        $visit = $this->visitModel->find($id);

        if (! $visit) {
            return $this->jsonError('Data kunjungan tidak ditemukan.');
        }

        if ($visit['status'] !== 'menunggu') {
            return $this->jsonError('Kunjungan tidak dapat ditolak. Status saat ini: ' . $visit['status']);
        }

        $reason = trim((string) $this->request->getPost('reason'));

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $builder = $this->visitModel->builder();
            $builder->where('id', $id);
            $builder->where('status', 'menunggu');
            $builder->update(['status' => 'ditolak']);

            if ($db->affectedRows() === 0) {
                $db->transRollback();
                return $this->jsonError('Kunjungan sudah diproses oleh pengguna lain. Silakan refresh halaman.');
            }

            $statusHistoryId = $this->statusHistoryModel->insert([
                'visit_id'   => $id,
                'user_id'    => session()->get('user_id'),
                'status'     => 'ditolak',
                'created_at' => date('Y-m-d H:i:s'),
            ], true);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Transaksi gagal.');
            }

            $this->activityLogService->log(
                'reject',
                'visits',
                'Kunjungan ' . $visit['visit_code'] . ' ditolak. Alasan: ' . ($reason ?: '-'),
                null,
                $id,
                $statusHistoryId
            );

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Kunjungan berhasil ditolak.',
            ]);
        } catch (\Throwable $e) {
            $db->transRollback();

            log_message('error', 'Reject failed: ' . $e->getMessage());

            return $this->jsonError('Gagal menolak kunjungan.');
        }
    }

    public function cancel($id)
    {
        $visit = $this->visitModel->find($id);

        if (! $visit) {
            return $this->jsonError('Data kunjungan tidak ditemukan.');
        }

        if ($visit['status'] !== 'menunggu') {
            return $this->jsonError('Kunjungan tidak dapat dibatalkan. Status saat ini: ' . $visit['status']);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $builder = $this->visitModel->builder();
            $builder->where('id', $id);
            $builder->where('status', 'menunggu');
            $builder->update(['status' => 'dibatalkan']);

            if ($db->affectedRows() === 0) {
                $db->transRollback();
                return $this->jsonError('Kunjungan sudah diproses oleh pengguna lain. Silakan refresh halaman.');
            }

            $statusHistoryId = $this->statusHistoryModel->insert([
                'visit_id'   => $id,
                'user_id'    => session()->get('user_id'),
                'status'     => 'dibatalkan',
                'created_at' => date('Y-m-d H:i:s'),
            ], true);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Transaksi gagal.');
            }

            $this->activityLogService->log(
                'cancel',
                'visits',
                'Kunjungan ' . $visit['visit_code'] . ' dibatalkan.',
                null,
                $id,
                $statusHistoryId
            );

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Kunjungan berhasil dibatalkan.',
            ]);
        } catch (\Throwable $e) {
            $db->transRollback();

            log_message('error', 'Cancel failed: ' . $e->getMessage());

            return $this->jsonError('Gagal membatalkan kunjungan.');
        }
    }

    public function checkout($id)
    {
        $visit = $this->visitModel->find($id);

        if (! $visit) {
            return $this->jsonError('Data kunjungan tidak ditemukan.');
        }

        if ($visit['status'] !== 'masih_berkunjung') {
            return $this->jsonError('Kunjungan tidak dapat di-checkout. Status saat ini: ' . $visit['status']);
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
            $builder->where('id', $id);
            $builder->where('status', 'masih_berkunjung');
            $builder->update([
                'status'      => 'selesai',
                'checkout_at' => $checkoutAt,
                'duration'    => $duration,
            ]);

            if ($db->affectedRows() === 0) {
                $db->transRollback();
                return $this->jsonError('Kunjungan sudah diproses oleh pengguna lain. Silakan refresh halaman.');
            }

            $statusHistoryId = $this->statusHistoryModel->insert([
                'visit_id'   => $id,
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
                'Checkout kunjungan ' . $visit['visit_code'] . '. Durasi: ' . $this->formatDuration($duration ?? 0),
                null,
                $id,
                $statusHistoryId
            );

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Checkout berhasil.',
            ]);
        } catch (\Throwable $e) {
            $db->transRollback();

            log_message('error', 'Checkout failed: ' . $e->getMessage());

            return $this->jsonError('Checkout gagal. Silakan coba lagi.');
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

    protected function jsonError(string $message = 'Terjadi kesalahan.')
    {
        return $this->response->setJSON([
            'success' => false,
            'message' => $message,
        ]);
    }
}
