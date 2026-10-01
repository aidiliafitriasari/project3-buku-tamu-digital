<?php

namespace App\Controllers\Admin;

use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Services\ActivityLogService;
use App\Validation\EmployeeRules;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Exceptions\PageNotFoundException;

class EmployeeController extends BaseAjaxController
{
    protected EmployeeModel $employeeModel;

    protected DepartmentModel $departmentModel;

    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->departmentModel = new DepartmentModel();
        $this->activityLogService = new ActivityLogService();
    }

    protected function getModel()
    {
        $status = (string) $this->request->getGet('status');

        if ($status === 'deleted') {
            return $this->employeeModel->withDeleted();
        }

        return $this->employeeModel;
    }

    protected function getPartialView(): string
    {
        return 'admin/employees/_table';
    }

    protected function getListData(?int $perPage = null): array
    {
        $model = $this->getModel();

        $builder = $model->builder();

        $builder
            ->select('employees.*, departments.name AS department_name')
            ->join(
                'departments',
                'departments.id = employees.department_id',
                'left'
            );

        foreach ($this->getDefaultOrder() as $column => $direction) {
            $builder->orderBy($column, $direction);
        }

        $search = trim(
            (string) $this->request->getGet('search')
        );

        if ($search !== '') {
            $this->applySearch($builder, $search);
        }

        $this->applyFilters($builder);

        $perPage = $perPage ?? (int) $this->request->getGet('per_page');

        if (! in_array($perPage, $this->allowedPerPage, true)) {
            $perPage = $this->defaultPerPage;
        }

        $page = (int) $this->request->getGet('page');

        if ($page < 1) {
            $page = 1;
        }

        $countBuilder = clone $builder;
        $total = $countBuilder->countAllResults(false);

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

    protected function getDefaultOrder(): array
    {
        return [
            'employees.name' => 'ASC',
        ];
    }

    protected function applySearch(
        BaseBuilder $builder,
        string $search
    ): void {
        $builder
            ->groupStart()
            ->like('employees.name', $search)
            ->orLike('employees.nomor_hp', $search)
            ->orLike('employees.email', $search)
            ->orLike('departments.name', $search)
            ->groupEnd();
    }

    protected function applyFilters(
        BaseBuilder $builder
    ): void {
        $status = (string) $this->request->getGet('status');
        $departmentId = (int) $this->request->getGet('department_id');

        if ($status === 'deleted') {
            $builder->where('employees.deleted_at IS NOT NULL', null, false);

            return;
        }

        $builder->where('employees.deleted_at IS NULL', null, false);

        if ($status === 'active') {
            $builder->where('employees.is_active', 1);
        }

        if ($status === 'inactive') {
            $builder->where('employees.is_active', 0);
        }

        if ($departmentId > 0) {
            $builder->where('employees.department_id', $departmentId);
        }
    }

    public function index()
    {
        $data = $this->getListData();

        $departments = $this->departmentModel
            ->where('is_active', 1)
            ->orderBy('name', 'ASC')
            ->findAll();

        return view('admin/employees/index', [
            'title' => 'Pegawai',
            'items' => $data['items'],
            'pagination' => $data['pagination'],
            'departments' => $departments,
        ]);
    }

    public function store()
    {
        $rules = EmployeeRules::create();

        if (! $this->validate($rules)) {
            return redirect()
                ->to('/admin/employees')
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('form_id', 'create_employee');
        }

        $departmentId = (int) $this->request->getPost('department_id');

        $department = $this->departmentModel
            ->where('id', $departmentId)
            ->where('is_active', 1)
            ->first();

        if (! $department) {
            return redirect()
                ->to('/admin/employees')
                ->withInput()
                ->with('error', 'Bagian yang dipilih tidak tersedia atau sudah tidak aktif.');
        }

        $employeeId = $this->employeeModel->insert([
            'department_id' => $departmentId,
            'name' => trim((string) $this->request->getPost('name')),
            'nomor_hp' => trim((string) $this->request->getPost('nomor_hp')),
            'email' => trim((string) $this->request->getPost('email')),
            'is_active' => 1,  // ← default aktif
        ], true);

        if ($employeeId === false) {
            return redirect()
                ->to('/admin/employees')
                ->withInput()
                ->with('error', 'Data pegawai gagal disimpan.');
        }

        $this->activityLogService->log(
            'create',
            'employees',
            'Pegawai baru berhasil dibuat. ID: ' . $employeeId
        );

        return redirect()
            ->to('/admin/employees')
            ->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function update(int $id)
    {
        $employee = $this->employeeModel->find($id);

        if (! $employee) {
            throw PageNotFoundException::forPageNotFound(
                'Data pegawai tidak ditemukan.'
            );
        }

        $rules = EmployeeRules::update($id);

        if (! $this->validate($rules)) {
            return redirect()
                ->to('/admin/employees')
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('form_id', 'edit_employee')
                ->with('edit_employee_id', $id);
        }

        $departmentId = (int) $this->request->getPost('department_id');

        $department = $this->departmentModel
            ->where('id', $departmentId)
            ->where('is_active', 1)
            ->first();

        if (! $department) {
            return redirect()
                ->to('/admin/employees')
                ->withInput()
                ->with('error', 'Bagian yang dipilih tidak tersedia atau sudah tidak aktif.');
        }

        $updated = $this->employeeModel->update($id, [
            'department_id' => $departmentId,
            'name' => trim((string) $this->request->getPost('name')),
            'nomor_hp' => trim((string) $this->request->getPost('nomor_hp')),
            'email' => trim((string) $this->request->getPost('email')),
        ]);

        if (! $updated) {
            return redirect()
                ->to('/admin/employees')
                ->with('error', 'Data pegawai gagal diperbarui.');
        }

        $this->activityLogService->log(
            'update',
            'employees',
            'Pegawai berhasil diperbarui. ID: ' . $id
        );

        return redirect()
            ->to('/admin/employees')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function toggleStatus(int $id)
    {
        $employee = $this->employeeModel
            ->withDeleted()
            ->find($id);

        if (! $employee) {
            throw PageNotFoundException::forPageNotFound(
                'Data pegawai tidak ditemukan.'
            );
        }

        if (! empty($employee['deleted_at'])) {
            return redirect()
                ->to('/admin/employees')
                ->with(
                    'error',
                    'Pegawai yang sudah terhapus tidak dapat diubah statusnya.'
                );
        }

        $newStatus = (int) $employee['is_active'] === 1 ? 0 : 1;

        if ($newStatus === 1) {
            $department = $this->departmentModel
                ->withDeleted()
                ->find($employee['department_id']);

            if (! $department) {
                return redirect()
                    ->to('/admin/employees')
                    ->with(
                        'error',
                        'Pegawai tidak dapat diaktifkan karena bagiannya tidak ditemukan.'
                    );
            }

            if (! empty($department['deleted_at'])) {
                return redirect()
                    ->to('/admin/employees')
                    ->with(
                        'error',
                        'Pegawai tidak dapat diaktifkan karena bagiannya sudah terhapus.'
                    );
            }

            if ((int) $department['is_active'] !== 1) {
                return redirect()
                    ->to('/admin/employees')
                    ->with(
                        'error',
                        'Pegawai tidak dapat diaktifkan karena bagiannya sudah nonaktif.'
                    );
            }
        }

        $updated = $this->employeeModel->update($id, [
            'is_active' => $newStatus,
        ]);

        if (! $updated) {
            return redirect()
                ->to('/admin/employees')
                ->with('error', 'Status pegawai gagal diperbarui.');
        }

        $activity = $newStatus === 1 ? 'activate' : 'deactivate';
        $statusLabel = $newStatus === 1 ? 'diaktifkan' : 'dinonaktifkan';

        $this->activityLogService->log(
            $activity,
            'employees',
            'Pegawai berhasil ' . $statusLabel . '. ID: ' . $id
        );

        return redirect()
            ->to('/admin/employees')
            ->with('success', 'Pegawai berhasil ' . $statusLabel . '.');
    }

    public function delete(int $id)
    {
        $employee = $this->employeeModel
            ->withDeleted()
            ->find($id);

        if (! $employee) {
            throw PageNotFoundException::forPageNotFound(
                'Data pegawai tidak ditemukan.'
            );
        }

        if (! empty($employee['deleted_at'])) {
            return redirect()
                ->to('/admin/employees')
                ->with('error', 'Data pegawai sudah terhapus.');
        }

        $deleted = $this->employeeModel->delete($id);

        if (! $deleted) {
            return redirect()
                ->to('/admin/employees')
                ->with('error', 'Data pegawai gagal dihapus.');
        }

        $this->activityLogService->log(
            'delete',
            'employees',
            'Pegawai berhasil dihapus. ID: ' . $id
        );

        return redirect()
            ->to('/admin/employees')
            ->with('success', 'Data pegawai berhasil dihapus.');
    }

    public function restore(int $id)
    {
        $employee = $this->employeeModel
            ->withDeleted()
            ->find($id);

        if (! $employee) {
            throw PageNotFoundException::forPageNotFound(
                'Data pegawai tidak ditemukan.'
            );
        }

        if (empty($employee['deleted_at'])) {
            return redirect()
                ->to('/admin/employees')
                ->with(
                    'error',
                    'Data pegawai tersebut masih aktif.'
                );
        }

        $department = $this->departmentModel
            ->withDeleted()
            ->find($employee['department_id']);

        if (! $department) {
            return redirect()
                ->to('/admin/employees')
                ->with(
                    'error',
                    'Pegawai tidak dapat dipulihkan karena bagiannya tidak ditemukan.'
                );
        }

        if (! empty($department['deleted_at'])) {
            return redirect()
                ->to('/admin/employees')
                ->with(
                    'error',
                    'Pegawai tidak dapat dipulihkan karena bagiannya sudah terhapus.'
                );
        }

        if ((int) $department['is_active'] !== 1) {
            return redirect()
                ->to('/admin/employees')
                ->with(
                    'error',
                    'Pegawai tidak dapat dipulihkan karena bagiannya sudah nonaktif.'
                );
        }

        $updated = $this->employeeModel
            ->builder()
            ->where('id', $id)
            ->set('deleted_at', null)
            ->set('updated_at', date('Y-m-d H:i:s'))
            ->update();

        if (! $updated) {
            return redirect()
                ->to('/admin/employees')
                ->with('error', 'Data pegawai gagal dipulihkan.');
        }

        $this->activityLogService->log(
            'restore',
            'employees',
            'Pegawai berhasil dipulihkan. ID: ' . $id
        );

        return redirect()
            ->to('/admin/employees')
            ->with('success', 'Data pegawai berhasil dipulihkan.');
    }
}
