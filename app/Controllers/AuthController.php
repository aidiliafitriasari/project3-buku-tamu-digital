<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
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
            return redirect()
                ->to('/akses-panel')
                ->withInput()
                ->with('error', 'Username/email dan password wajib diisi.');
        }

        $user = $this->userModel
            ->groupStart()
            ->where('username', $credential)
            ->orWhere('email', $credential)
            ->groupEnd()
            ->where('is_active', 1)
            ->first();

        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()
                ->to('/akses-panel')
                ->withInput()
                ->with('error', 'Username/email atau password salah.');
        }

        session()->regenerate();

        session()->set([
            'user_id'      => $user['id'],
            'username'     => $user['username'],
            'role'         => $user['role'],
            'is_logged_in' => true,
        ]);

        if ($user['role'] === 'administrator') {
            return redirect()->to('/admin/dashboard');
        }

        if ($user['role'] === 'petugas') {
            return redirect()->to('/petugas/dashboard');
        }

        session()->destroy();

        return redirect()
            ->to('/akses-panel')
            ->with('error', 'Role pengguna tidak valid.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()
            ->to('/akses-panel')
            ->with('success', 'Anda berhasil logout.');
    }
}
