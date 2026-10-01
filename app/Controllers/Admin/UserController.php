<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Services\ActivityLogService;
use App\Validation\UserRules;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends BaseAjaxController
{
    protected UserModel $userModel;

    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->activityLogService = new ActivityLogService();
    }

    protected function getModel()
    {
        $status = (string) $this->request->getGet('status');

        if ($status === 'deleted') {
            return $this->userModel->withDeleted();
        }

        return $this->userModel;
    }

    protected function getPartialView(): string
    {
        return 'admin/users/_table';
    }

    protected function applySearch(
        BaseBuilder $builder,
        string $search
    ): void {
        $builder
            ->groupStart()
            ->like('username', $search)
            ->orLike('email', $search)
            ->groupEnd();
    }

    protected function applyFilters(
        BaseBuilder $builder
    ): void {
        $role = (string) $this->request->getGet('role');
        $status = (string) $this->request->getGet('status');

        if (in_array($role, ['administrator', 'petugas'], true)) {
            $builder->where('role', $role);
        }

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

        return view('admin/users/index', [
            'title' => 'Pengguna',
            'items' => $data['items'],
            'pagination' => $data['pagination'],
        ]);
    }

    public function store()
    {
        $rules = UserRules::create();

        if (! $this->validate($rules)) {
            return redirect()
                ->to('/admin/users')
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('form_id', 'create_user');
        }

        $userId = $this->userModel->insert([
            'username' => trim((string) $this->request->getPost('username')),
            'email' => trim((string) $this->request->getPost('email')),
            'password' => password_hash(
                (string) $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'role' => (string) $this->request->getPost('role'),
            'nomor_hp' => trim(
                (string) $this->request->getPost('nomor_hp')
            ),
            'is_active' => 1,
        ], true);

        if ($userId === false) {
            return redirect()
                ->to('/admin/users')
                ->withInput()
                ->with('error', 'Pengguna gagal ditambahkan.');
        }

        $this->activityLogService->log(
            'create',
            'users',
            'Pengguna baru berhasil dibuat. ID: ' . $userId
        );

        return redirect()
            ->to('/admin/users')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function update(int $id)
    {
        $user = $this->userModel->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound(
                'Pengguna tidak ditemukan.'
            );
        }

        if ((int) $id === (int) session()->get('user_id')) {
            $newRole = (string) $this->request->getPost('role');

            if ($newRole !== $user['role']) {
                return redirect()
                    ->to('/admin/users')
                    ->withInput()
                    ->with('errors', [
                        'role' => 'Tidak dapat mengubah role akun sendiri.',
                    ])
                    ->with('form_id', 'edit_user')
                    ->with('edit_user_id', $id);
            }
        }

        $rules = UserRules::update($id);

        if (! $this->validate($rules)) {
            return redirect()
                ->to('/admin/users')
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('form_id', 'edit_user')
                ->with('edit_user_id', $id);
        }

        $updated = $this->userModel->update($id, [
            'username' => trim(
                (string) $this->request->getPost('username')
            ),
            'email' => trim(
                (string) $this->request->getPost('email')
            ),
            'nomor_hp' => trim(
                (string) $this->request->getPost('nomor_hp')
            ),
            'role' => (string) $this->request->getPost('role'),
        ]);

        if (! $updated) {
            return redirect()
                ->to('/admin/users')
                ->with('error', 'Pengguna gagal diperbarui.');
        }

        $this->activityLogService->log(
            'update',
            'users',
            'Data pengguna berhasil diperbarui. ID: ' . $id
        );

        return redirect()
            ->to('/admin/users')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function resetPassword(int $id)
    {
        $user = $this->userModel
            ->withDeleted()
            ->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound(
                'Pengguna tidak ditemukan.'
            );
        }

        if (! empty($user['deleted_at'])) {
            return redirect()
                ->to('/admin/users')
                ->with(
                    'error',
                    'Password pengguna yang sudah dihapus tidak dapat direset.'
                );
        }

        if (! $this->validate(UserRules::resetPassword())) {
            return redirect()
                ->to('/admin/users')
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('form_id', 'reset_password')
                ->with('target_user_id', $id)
                ->with('target_user_username', $user['username'])
                ->with('target_user_email', $user['email']);
        }

        $updated = $this->userModel->update($id, [
            'password' => password_hash(
                (string) $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
        ]);

        if (! $updated) {
            return redirect()
                ->to('/admin/users')
                ->with('error', 'Password pengguna gagal diubah.');
        }

        $this->activityLogService->log(
            'reset_password',
            'users',
            'Password pengguna berhasil direset. ID: ' . $id
        );

        return redirect()
            ->to('/admin/users')
            ->with('success', 'Password pengguna berhasil direset.');
    }

    public function toggleStatus(int $id)
    {
        $user = $this->userModel
            ->withDeleted()
            ->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound(
                'Pengguna tidak ditemukan.'
            );
        }

        if (! empty($user['deleted_at'])) {
            return redirect()
                ->to('/admin/users')
                ->with(
                    'error',
                    'Pengguna yang sudah terhapus tidak dapat diubah statusnya.'
                );
        }

        if ((int) $id === (int) session()->get('user_id')) {
            return redirect()
                ->to('/admin/users')
                ->with(
                    'error',
                    'Tidak dapat mengubah status akun sendiri.'
                );
        }

        $newStatus = (int) $user['is_active'] === 1 ? 0 : 1;

        $updated = $this->userModel->update($id, [
            'is_active' => $newStatus,
        ]);

        if (! $updated) {
            return redirect()
                ->to('/admin/users')
                ->with('error', 'Status pengguna gagal diperbarui.');
        }

        $activity = $newStatus === 1
            ? 'activate'
            : 'deactivate';

        $statusLabel = $newStatus === 1
            ? 'diaktifkan'
            : 'dinonaktifkan';

        $this->activityLogService->log(
            $activity,
            'users',
            'Pengguna berhasil ' . $statusLabel . '. ID: ' . $id
        );

        return redirect()
            ->to('/admin/users')
            ->with(
                'success',
                'Pengguna berhasil ' . $statusLabel . '.'
            );
    }

    public function delete(int $id)
    {
        $user = $this->userModel
            ->withDeleted()
            ->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound(
                'Pengguna tidak ditemukan.'
            );
        }

        if (! empty($user['deleted_at'])) {
            return redirect()
                ->to('/admin/users')
                ->with('error', 'Pengguna sudah terhapus.');
        }

        if ((int) $id === (int) session()->get('user_id')) {
            return redirect()
                ->to('/admin/users')
                ->with(
                    'error',
                    'Tidak dapat menghapus akun sendiri.'
                );
        }

        $deleted = $this->userModel->delete($id);

        if (! $deleted) {
            return redirect()
                ->to('/admin/users')
                ->with('error', 'Pengguna gagal dihapus.');
        }

        $this->activityLogService->log(
            'delete',
            'users',
            'Pengguna berhasil dihapus. ID: ' . $id
        );

        return redirect()
            ->to('/admin/users')
            ->with('success', 'Pengguna berhasil dihapus.');
    }

    public function restore(int $id)
    {
        $user = $this->userModel
            ->withDeleted()
            ->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound(
                'Pengguna tidak ditemukan.'
            );
        }

        if (empty($user['deleted_at'])) {
            return redirect()
                ->to('/admin/users')
                ->with(
                    'error',
                    'Pengguna belum berstatus terhapus.'
                );
        }

        $updated = $this->userModel
            ->builder()
            ->where('id', $id)
            ->set('deleted_at', null)
            ->set('updated_at', date('Y-m-d H:i:s'))
            ->update();

        if (! $updated) {
            return redirect()
                ->to('/admin/users')
                ->with('error', 'Pengguna gagal dipulihkan.');
        }

        $this->activityLogService->log(
            'restore',
            'users',
            'Pengguna berhasil dipulihkan. ID: ' . $id
        );

        return redirect()
            ->to('/admin/users')
            ->with('success', 'Pengguna berhasil dipulihkan.');
    }
}
