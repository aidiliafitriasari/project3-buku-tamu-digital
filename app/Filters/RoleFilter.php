<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    // Memastikan user memiliki role yang sesuai untuk mengakses halaman tertentu.

    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        $userRole = $session->get('role');

        // Jika role yang diperbolehkan tidak diberikan, akses ditolak.
        if (empty($arguments)) {
            return service('response')
                ->setStatusCode(403)
                ->setBody(view('errors/html/error_403'));
        }

        // Jika role user tidak termasuk role yang diperbolehkan, akses ditolak.
        if (! in_array($userRole, $arguments, true)) {
            return service('response')
                ->setStatusCode(403)
                ->setBody(view('errors/html/error_403'));
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Tidak digunakan.
    }
}
