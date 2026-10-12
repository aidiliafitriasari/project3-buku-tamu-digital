<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        $userRole = $session->get('role');

        if (empty($arguments)) {
            return service('response')
                ->setStatusCode(403)
                ->setBody(view('errors/html/error_403'));
        }

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
    ) {}
}
