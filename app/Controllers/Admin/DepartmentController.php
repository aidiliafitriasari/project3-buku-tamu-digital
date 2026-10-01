<?php

namespace App\Controllers\Admin;

use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Services\ActivityLogService;
use App\Validation\DepartmentRules;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Exceptions\PageNotFoundException;

class DepartmentController extends BaseAjaxController
{
    protected EmployeeModel $employeeModel;

    protected DepartmentModel $departmentModel;

    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        $this->departmentModel = new DepartmentModel();
        $this->employeeModel = new EmployeeModel();
        $this->activityLogService = new ActivityLogService();
    }

    protected function getModel()
    {
        $status = (string) $this->request->getGet('status');

        if ($status === 'deleted') {
            return $this->departmentModel->withDeleted();
        }

        return $this->departmentModel;
    }

    protected function getPartialView(): string
    {
        return 'admin/departments/_table';
    }

    protected function getDefaultOrder(): array
    {
        return [
            'name' => 'ASC',
        ];
    }

    protected function applySearch(
        BaseBuilder $builder,
        string $search
    ): void {
        $builder->like('name', $search);
    }

    protected function applyFilters(
        BaseBuilder $builder
    ): void {
        $status = (string) $this->request->getGet('status');

        if ($status === 'deleted') {
            $builder->where('deleted_at IS NOT NULL', null, false);

            return;
        }

        $builder->where('deleted_at IS NULL', null, false);

        if ($status === 'active') {
            $builder->where('is_active', 1);
        }

        if ($status === 'inactive') {
            $builder->where('is_active', 0);
        }
    }

    public function index()
    {
        $data = $this->getListData();

        return view('admin/departments/index', [
            'title' => 'Bagian',
            'items' => $data['items'],
            'pagination' => $data['pagination'],
        ]);
    }

    public function store()
    {
        $rules = DepartmentRules::create();

        if (! $this->validate($rules)) {
            return redirect()
                ->to('/admin/departments')
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('form_id', 'create_department');
        }

        $name = trim((string) $this->request->getPost('name'));

        $existingDepartment = $this->departmentModel
            ->withDeleted()
            ->where('name', $name)
            ->first();

        if ($existingDepartment) {
            if (! empty($existingDepartment['deleted_at'])) {
                return redirect()
                    ->to('/admin/departments')
                    ->withInput()
                    ->with('errors', [
                        'name' => 'Nama bagian tersebut pernah digunakan dan masih berada di data terhapus.',
                    ])
                    ->with('form_id', 'create_department');
            }

            return redirect()
                ->to('/admin/departments')
                ->withInput()
                ->with('errors', [
                    'name' => 'Nama bagian tersebut sudah digunakan.',
                ])
                ->with('form_id', 'create_department');
        }

        $departmentId = $this->departmentModel->insert([
            'name' => $name,
            'is_active' => 1,
        ], true);

        if ($departmentId === false) {
            return redirect()
                ->to('/admin/departments')
                ->withInput()
                ->with('error', 'Data bagian gagal disimpan.');
        }

        $this->activityLogService->log(
            'create',
            'departments',
            'Bagian baru berhasil dibuat. ID: ' . $departmentId
        );

        return redirect()
            ->to('/admin/departments')
            ->with('success', 'Bagian berhasil ditambahkan.');
    }

    public function update(int $id)
    {
        $department = $this->departmentModel->find($id);

        if (! $department) {
            throw PageNotFoundException::forPageNotFound(
                'Data bagian tidak ditemukan.'
            );
        }

        $rules = DepartmentRules::update($id);

        if (! $this->validate($rules)) {
            return redirect()
                ->to('/admin/departments')
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('form_id', 'edit_department')
                ->with('edit_department_id', $id);
        }

        $name = trim((string) $this->request->getPost('name'));

        $existingDepartment = $this->departmentModel
            ->withDeleted()
            ->where('name', $name)
            ->where('id !=', $id)
            ->first();

        if ($existingDepartment) {
            if (! empty($existingDepartment['deleted_at'])) {
                return redirect()
                    ->to('/admin/departments')
                    ->withInput()
                    ->with('errors', [
                        'name' => 'Nama bagian tersebut pernah digunakan dan masih berada di data terhapus.',
                    ])
                    ->with('form_id', 'edit_department')
                    ->with('edit_department_id', $id);
            }

            return redirect()
                ->to('/admin/departments')
                ->withInput()
                ->with('errors', [
                    'name' => 'Nama bagian tersebut sudah digunakan.',
                ])
                ->with('form_id', 'edit_department')
                ->with('edit_department_id', $id);
        }

        $updated = $this->departmentModel->update($id, [
            'name' => $name,
        ]);

        if (! $updated) {
            return redirect()
                ->to('/admin/departments')
                ->with('error', 'Data bagian gagal diperbarui.');
        }

        $this->activityLogService->log(
            'update',
            'departments',
            'Bagian berhasil diperbarui. ID: ' . $id
        );

        return redirect()
            ->to('/admin/departments')
            ->with('success', 'Data bagian berhasil diperbarui.');
    }

    public function toggleStatus(int $id)
    {
        $department = $this->departmentModel
            ->withDeleted()
            ->find($id);

        if (! $department) {
            throw PageNotFoundException::forPageNotFound(
                'Data bagian tidak ditemukan.'
            );
        }

        if (! empty($department['deleted_at'])) {
            return redirect()
                ->to('/admin/departments')
                ->with(
                    'error',
                    'Bagian yang sudah terhapus tidak dapat diubah statusnya.'
                );
        }

        $newStatus = (int) $department['is_active'] === 1 ? 0 : 1;

        if ($newStatus === 0) {
            $employeeCount = $this->employeeModel
                ->where('department_id', $id)
                ->where('is_active', 1)
                ->countAllResults();

            if ($employeeCount > 0) {
                return redirect()
                    ->to('/admin/departments')
                    ->with(
                        'error',
                        "Bagian tidak dapat dinonaktifkan karena masih memiliki {$employeeCount} pegawai aktif. Pindahkan atau nonaktifkan pegawai terlebih dahulu."
                    );
            }
        }

        $updated = $this->departmentModel->update($id, [
            'is_active' => $newStatus,
        ]);

        if (! $updated) {
            return redirect()
                ->to('/admin/departments')
                ->with('error', 'Status bagian gagal diperbarui.');
        }

        $activity = $newStatus === 1 ? 'activate' : 'deactivate';
        $statusLabel = $newStatus === 1 ? 'diaktifkan' : 'dinonaktifkan';

        $this->activityLogService->log(
            $activity,
            'departments',
            'Bagian berhasil ' . $statusLabel . '. ID: ' . $id
        );

        return redirect()
            ->to('/admin/departments')
            ->with('success', 'Bagian berhasil ' . $statusLabel . '.');
    }

    public function delete(int $id)
    {
        $department = $this->departmentModel
            ->withDeleted()
            ->find($id);

        if (! $department) {
            throw PageNotFoundException::forPageNotFound(
                'Data bagian tidak ditemukan.'
            );
        }

        if (! empty($department['deleted_at'])) {
            return redirect()
                ->to('/admin/departments')
                ->with('error', 'Data bagian sudah terhapus.');
        }

        $employeeCount = $this->employeeModel
            ->where('department_id', $id)
            ->where('is_active', 1)
            ->countAllResults();

        if ($employeeCount > 0) {
            return redirect()
                ->to('/admin/departments')
                ->with(
                    'error',
                    "Bagian tidak dapat dihapus karena masih memiliki {$employeeCount} pegawai aktif. Pindahkan atau nonaktifkan pegawai terlebih dahulu."
                );
        }

        $deleted = $this->departmentModel->delete($id);

        if (! $deleted) {
            return redirect()
                ->to('/admin/departments')
                ->with('error', 'Data bagian gagal dihapus.');
        }

        $this->activityLogService->log(
            'delete',
            'departments',
            'Bagian berhasil dihapus. ID: ' . $id
        );

        return redirect()
            ->to('/admin/departments')
            ->with('success', 'Bagian berhasil dihapus.');
    }

    public function restore(int $id)
    {
        $department = $this->departmentModel
            ->withDeleted()
            ->find($id);

        if (! $department) {
            throw PageNotFoundException::forPageNotFound(
                'Data bagian tidak ditemukan.'
            );
        }

        if (empty($department['deleted_at'])) {
            return redirect()
                ->to('/admin/departments')
                ->with(
                    'error',
                    'Data bagian tersebut masih aktif.'
                );
        }

        $updated = $this->departmentModel
            ->builder()
            ->where('id', $id)
            ->set('deleted_at', null)
            ->set('updated_at', date('Y-m-d H:i:s'))
            ->update();

        if (! $updated) {
            return redirect()
                ->to('/admin/departments')
                ->with('error', 'Data bagian gagal dipulihkan.');
        }

        $this->activityLogService->log(
            'restore',
            'departments',
            'Bagian berhasil dipulihkan. ID: ' . $id
        );

        return redirect()
            ->to('/admin/departments')
            ->with('success', 'Data bagian berhasil dipulihkan.');
    }
}
