<?php

namespace App\Controllers\Admin;

use App\Models\VisitPurposeModel;
use App\Services\ActivityLogService;
use App\Validation\VisitPurposeRules;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Exceptions\PageNotFoundException;

class VisitPurposeController extends BaseAjaxController
{
    protected VisitPurposeModel $visitPurposeModel;

    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        $this->visitPurposeModel = new VisitPurposeModel();
        $this->activityLogService = new ActivityLogService();
    }

    protected function getModel()
    {
        $status = (string) $this->request->getGet('status');

        if ($status === 'deleted') {
            return $this->visitPurposeModel->withDeleted();
        }

        return $this->visitPurposeModel;
    }

    protected function getPartialView(): string
    {
        return 'admin/visit_purposes/_table';
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

        return view('admin/visit_purposes/index', [
            'title' => 'Keperluan Kunjungan',
            'items' => $data['items'],
            'pagination' => $data['pagination'],
        ]);
    }

    public function store()
    {
        $rules = VisitPurposeRules::create();

        if (! $this->validate($rules)) {
            return redirect()
                ->to('/admin/visit-purposes')
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('form_id', 'create_visit_purpose');
        }

        $name = trim((string) $this->request->getPost('name'));

        $existingPurpose = $this->visitPurposeModel
            ->withDeleted()
            ->where('name', $name)
            ->first();

        if ($existingPurpose) {
            if (! empty($existingPurpose['deleted_at'])) {
                return redirect()
                    ->to('/admin/visit-purposes')
                    ->withInput()
                    ->with('errors', [
                        'name' => 'Nama keperluan tersebut pernah digunakan dan masih berada di data terhapus.',
                    ])
                    ->with('form_id', 'create_visit_purpose');
            }

            return redirect()
                ->to('/admin/visit-purposes')
                ->withInput()
                ->with('errors', [
                    'name' => 'Nama keperluan tersebut sudah digunakan.',
                ])
                ->with('form_id', 'create_visit_purpose');
        }

        $purposeId = $this->visitPurposeModel->insert([
            'name' => $name,
            'is_active' => 1,
        ], true);

        if ($purposeId === false) {
            return redirect()
                ->to('/admin/visit-purposes')
                ->withInput()
                ->with('error', 'Data keperluan gagal disimpan.');
        }

        $this->activityLogService->log(
            'create',
            'visit_purposes',
            'Keperluan kunjungan baru berhasil dibuat. ID: ' . $purposeId
        );

        return redirect()
            ->to('/admin/visit-purposes')
            ->with('success', 'Keperluan kunjungan berhasil ditambahkan.');
    }

    public function update(int $id)
    {
        $purpose = $this->visitPurposeModel->find($id);

        if (! $purpose) {
            throw PageNotFoundException::forPageNotFound(
                'Data keperluan tidak ditemukan.'
            );
        }

        $rules = VisitPurposeRules::update($id);

        if (! $this->validate($rules)) {
            return redirect()
                ->to('/admin/visit-purposes')
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('form_id', 'edit_visit_purpose')
                ->with('edit_visit_purpose_id', $id);
        }

        $name = trim((string) $this->request->getPost('name'));

        $existingPurpose = $this->visitPurposeModel
            ->withDeleted()
            ->where('name', $name)
            ->where('id !=', $id)
            ->first();

        if ($existingPurpose) {
            if (! empty($existingPurpose['deleted_at'])) {
                return redirect()
                    ->to('/admin/visit-purposes')
                    ->withInput()
                    ->with('errors', [
                        'name' => 'Nama keperluan tersebut pernah digunakan dan masih berada di data terhapus.',
                    ])
                    ->with('form_id', 'edit_visit_purpose')
                    ->with('edit_visit_purpose_id', $id);
            }

            return redirect()
                ->to('/admin/visit-purposes')
                ->withInput()
                ->with('errors', [
                    'name' => 'Nama keperluan tersebut sudah digunakan.',
                ])
                ->with('form_id', 'edit_visit_purpose')
                ->with('edit_visit_purpose_id', $id);
        }

        $updated = $this->visitPurposeModel->update($id, [
            'name' => $name,
        ]);

        if (! $updated) {
            return redirect()
                ->to('/admin/visit-purposes')
                ->with('error', 'Data keperluan gagal diperbarui.');
        }

        $this->activityLogService->log(
            'update',
            'visit_purposes',
            'Keperluan kunjungan berhasil diperbarui. ID: ' . $id
        );

        return redirect()
            ->to('/admin/visit-purposes')
            ->with('success', 'Data keperluan berhasil diperbarui.');
    }

    public function toggleStatus(int $id)
    {
        $purpose = $this->visitPurposeModel
            ->withDeleted()
            ->find($id);

        if (! $purpose) {
            throw PageNotFoundException::forPageNotFound(
                'Data keperluan tidak ditemukan.'
            );
        }

        if (! empty($purpose['deleted_at'])) {
            return redirect()
                ->to('/admin/visit-purposes')
                ->with(
                    'error',
                    'Keperluan yang sudah terhapus tidak dapat diubah statusnya.'
                );
        }

        $newStatus = (int) $purpose['is_active'] === 1 ? 0 : 1;

        $updated = $this->visitPurposeModel->update($id, [
            'is_active' => $newStatus,
        ]);

        if (! $updated) {
            return redirect()
                ->to('/admin/visit-purposes')
                ->with('error', 'Status keperluan gagal diperbarui.');
        }

        $activity = $newStatus === 1 ? 'activate' : 'deactivate';
        $statusLabel = $newStatus === 1 ? 'diaktifkan' : 'dinonaktifkan';

        $this->activityLogService->log(
            $activity,
            'visit_purposes',
            'Keperluan kunjungan berhasil ' . $statusLabel . '. ID: ' . $id
        );

        return redirect()
            ->to('/admin/visit-purposes')
            ->with('success', 'Keperluan kunjungan berhasil ' . $statusLabel . '.');
    }

    public function delete(int $id)
    {
        $purpose = $this->visitPurposeModel
            ->withDeleted()
            ->find($id);

        if (! $purpose) {
            throw PageNotFoundException::forPageNotFound(
                'Data keperluan tidak ditemukan.'
            );
        }

        if (! empty($purpose['deleted_at'])) {
            return redirect()
                ->to('/admin/visit-purposes')
                ->with('error', 'Data keperluan sudah terhapus.');
        }

        $deleted = $this->visitPurposeModel->delete($id);

        if (! $deleted) {
            return redirect()
                ->to('/admin/visit-purposes')
                ->with('error', 'Data keperluan gagal dihapus.');
        }

        $this->activityLogService->log(
            'delete',
            'visit_purposes',
            'Keperluan kunjungan berhasil dihapus. ID: ' . $id
        );

        return redirect()
            ->to('/admin/visit-purposes')
            ->with('success', 'Data keperluan berhasil dihapus.');
    }

    public function restore(int $id)
    {
        $purpose = $this->visitPurposeModel
            ->withDeleted()
            ->find($id);

        if (! $purpose) {
            throw PageNotFoundException::forPageNotFound(
                'Data keperluan tidak ditemukan.'
            );
        }

        if (empty($purpose['deleted_at'])) {
            return redirect()
                ->to('/admin/visit-purposes')
                ->with(
                    'error',
                    'Data keperluan tersebut masih aktif.'
                );
        }

        $updated = $this->visitPurposeModel
            ->builder()
            ->where('id', $id)
            ->set('deleted_at', null)
            ->set('updated_at', date('Y-m-d H:i:s'))
            ->update();

        if (! $updated) {
            return redirect()
                ->to('/admin/visit-purposes')
                ->with('error', 'Data keperluan gagal dipulihkan.');
        }

        $this->activityLogService->log(
            'restore',
            'visit_purposes',
            'Keperluan kunjungan berhasil dipulihkan. ID: ' . $id
        );

        return redirect()
            ->to('/admin/visit-purposes')
            ->with('success', 'Data keperluan berhasil dipulihkan.');
    }
}
