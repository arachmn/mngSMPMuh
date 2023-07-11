<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $db;
    protected $userModel;
    public function __construct()
    {
        $this->db = \Config\Database::Connect();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        return redirect()->to(site_url('login'));
    }

    public function login()
    {
        if (session('role') == 'admin') {
            return redirect()->to(site_url('admin'));
        } elseif (session('role') == 'administration') {
            return redirect()->to(site_url('administration'));
        } elseif (session('role') == 'teacher') {
            return redirect()->to(site_url('teacher'));
        } else {
            return view('auth/login');
        }
    }

    public function loginProcess()
    {
        $query = $this->userModel->getWhere(['username' => $_POST['username']]);
        $user = $query->getRow();
        if ($user) {
            if ($_POST['password'] == $user->password) {
                $params = [
                    'id_user'   => $user->id_user,
                    'username'  => $user->username,
                    'role'      => $user->role,
                    'email'     => $user->email
                ];
                session()->set($params);
                if ($user->role == 'admin') {
                    return 'success';
                } elseif ($user->role == 'administration') {
                    return 'success';
                } elseif ($user->role == 'teacher') {
                    return 'success';
                }
            } else {
                return 'error password';
            }
        } else {
            return 'error username';
        }
    }

    public function logout()
    {
        session()->remove('id_user');
        session()->remove('username');
        session()->remove('email');
        session()->remove('role');
        return redirect()->to(site_url('login'));
    }
}
