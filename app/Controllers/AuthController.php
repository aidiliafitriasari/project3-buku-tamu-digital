<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Services\ActivityLogService;

class AuthController extends BaseController
{
    protected UserModel $userModel;
    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->activityLogService = new ActivityLogService();
    }

    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $credential = trim((string) $this->request->getPost('credential'));
        $password   = (string) $this->request->getPost('password');

        if ($credential === '' || $password === '') {
            $this->activityLogService->systemLog(
                'login_failed',
                'authentication',
                'Percobaan login gagal karena data login tidak lengkap.'
            );

            return redirect()
                ->to('/akses-panel')
                ->withInput()
                ->with('error', 'Username/email dan password wajib diisi.');
        }

        $user = $this->userModel
            ->withDeleted()
            ->groupStart()
            ->where('username', $credential)
            ->orWhere('email', $credential)
            ->groupEnd()
            ->first();

        if (! $user || ! password_verify($password, $user['password'])) {
            $this->activityLogService->systemLog(
                'login_failed',
                'authentication',
                'Percobaan login gagal karena username/email atau password tidak valid.'
            );

            return redirect()
                ->to('/akses-panel')
                ->withInput()
                ->with('error', 'Username/email atau password salah.');
        }

        if (! empty($user['deleted_at'])) {
            $this->activityLogService->systemLog(
                'login_failed',
                'authentication',
                'Percobaan login gagal karena akun telah dihapus.'
            );

            return redirect()
                ->to('/akses-panel')
                ->withInput()
                ->with('error', 'Akun Anda telah dihapus. Silakan hubungi administrator.');
        }

        if ((int) $user['is_active'] !== 1) {
            $this->activityLogService->systemLog(
                'login_failed',
                'authentication',
                'Percobaan login gagal karena akun dinonaktifkan.'
            );

            return redirect()
                ->to('/akses-panel')
                ->withInput()
                ->with('error', 'Akun Anda dinonaktifkan. Silakan hubungi administrator.');
        }

        session()->regenerate();

        session()->set([
            'user_id'      => $user['id'],
            'username'     => $user['username'],
            'role'         => $user['role'],
            'is_logged_in' => true,
        ]);

        $this->activityLogService->log(
            'login',
            'authentication',
            'Pengguna berhasil login.'
        );

        if ($user['role'] === 'administrator') {
            return redirect()->to('/admin/dashboard');
        }

        if ($user['role'] === 'petugas') {
            return redirect()->to('/petugas/dashboard');
        }

        session()->destroy();

        $this->activityLogService->systemLog(
            'login_failed',
            'authentication',
            'Login dihentikan karena role pengguna tidak valid.'
        );

        return redirect()
            ->to('/akses-panel')
            ->with('error', 'Role pengguna tidak valid.');
    }

    public function logout()
    {
        $userId = session()->get('user_id');

        if ($userId !== null) {
            $this->activityLogService->log(
                'logout',
                'authentication',
                'Pengguna berhasil logout.',
                (int) $userId
            );
        }

        session()->destroy();

        return redirect()
            ->to('/akses-panel')
            ->with('success', 'Anda berhasil logout.');
    }
}
