<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $db;
    protected $idUser;

    protected $userModel;

    public function __construct()
    {
        $this->db                  = \Config\Database::Connect();
        $this->idUser              = session('id_user');

        $this->userModel           = new UserModel();
    }

    public function openSetting()
    {
        echo json_encode($this->userModel->getUser($this->idUser));
    }

    public function updateUser()
    {
        $password = $this->request->getPost('password');
        $this->db->query("UPDATE tb_user SET password ='$password' WHERE id_user ='$this->idUser'");
    }
}
