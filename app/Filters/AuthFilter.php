<?php

namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{

    // Memastikan user sudah login sebelum mengakses halaman yang membutuhkan autentikasi.

    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('is_logged_in')) {
            return redirect()->to('/akses-panel');
        }

        $userModel = new UserModel();
        $user = $userModel
            ->withDeleted()
            ->find((int) session()->get('user_id'));

        if (! $user) {
            session()->destroy();

            return redirect()->to('/akses-panel')
                ->with('error', 'Akun Anda tidak ditemukan. Silakan login kembali.');
        }

        if (! empty($user['deleted_at'])) {
            session()->destroy();

            return redirect()->to('/akses-panel')
                ->with('error', 'Akun Anda telah dihapus. Silakan hubungi administrator.');
        }

        if ((int) $user['is_active'] !== 1) {
            session()->destroy();

            return redirect()->to('/akses-panel')
                ->with('error', 'Akun Anda telah dinonaktifkan. Silakan hubungi administrator.');
        }

        if ($user['role'] !== session()->get('role')) {
            session()->set('role', $user['role']);
        }

        return null;
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Tidak digunakan.
    }
}
