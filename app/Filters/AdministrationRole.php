<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdministrationRole implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session('role') == 'admin') {
            return redirect()->to(site_url('admin'));
        } elseif (session('role') == 'teacher') {
            return redirect()->to(site_url('teacher'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
