<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TeacherModel;
use App\Models\AdministrationModel;
use App\Models\AdminModel;

class AdminController extends BaseController
{
    protected $db;
    protected $idUser;

    protected $userModel;
    protected $teacherModel;
    protected $administrationModel;
    protected $adminModel;

    public function __construct()
    {
        $this->db                  = \Config\Database::Connect();
        $this->idUser              = session('id_user');

        $this->userModel           = new UserModel();
        $this->teacherModel        = new TeacherModel();
        $this->administrationModel = new AdministrationModel();
        $this->adminModel          = new AdminModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'admin' => $this->db->query("SELECT * FROM tb_admin WHERE id_user = '$this->idUser'")->getRow(),
            'user'  => $this->userModel->getUser($this->idUser),
        ];
        return view('v_admin/v_sub_dashboard/dashboard', $data);
    }

    // Profile Start
    public function profile()
    {
        $data = [
            'title' => 'Profile Admin',
            'admin' => $this->db->query("SELECT * FROM tb_admin WHERE id_user = '$this->idUser'")->getRow()
        ];
        return view('v_admin/v_sub_profile/profile', $data);
    }

    public function profileInfo($idAdmin)
    {
        $data = [
            'admin' => $this->adminModel->getAdmin($idAdmin)
        ];
        echo view('v_admin/v_sub_profile/profile-info', $data);
    }

    public function profileSetting($idAdmin)
    {
        $data = [
            'admin' => $this->adminModel->getAdmin($idAdmin)
        ];
        echo view('v_admin/v_sub_profile/profile-setting', $data);
    }

    public function updateProfile()
    {
        $dataAdmin = [
            'id_user'      => $this->idUser,
            'name'         => $this->request->getPost('name'),
            'gender'       => $this->request->getPost('gender'),
            'email'        => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number'),
            'address'      => $this->request->getPost('address'),
            'photo'        => "user.png"
        ];

        $user = $this->userModel->getUser($this->idUser);

        $dataUser = [
            'username' => $user['username'],
            'role'     => $user['role'],
            'email'    => $this->request->getPost('email'),
            'password' => $user['password']
        ];
        $this->adminModel->updateProfile($dataAdmin, $this->request->getPost('id'));
        $this->userModel->updateUser($dataUser, $this->idUser);
    }
    // Profile End

    // User Start
    public function userRole()
    {
        $data = [
            'title' => 'Role User',
            'owner' => $this->db->query("SELECT owner FROM tb_admin WHERE id_user = '$this->idUser'")->getRow()->owner
        ];

        return view('v_admin/v_sub_user/user-role', $data);
    }

    public function userList($role)
    {
        $data = [
            'title' => 'User Role ' . $role,
            'role'  => $role,
        ];
        return view('v_admin/v_sub_user/user-list', $data);
    }

    public function userListData($role)
    {
        if ($role == 'admin') {
            $user = $this->db->query("SELECT * FROM tb_user INNER JOIN tb_admin ON tb_admin.id_user = tb_user.id_user WHERE tb_user.role = 'admin' ORDER BY tb_user.id_user")->getResultArray();
        } elseif ($role == 'administration') {
            $user = $this->db->query("SELECT * FROM tb_user INNER JOIN tb_administration ON tb_administration.id_user = tb_user.id_user WHERE tb_user.role = 'administration' ORDER BY tb_user.id_user")->getResultArray();
        } elseif ($role == 'teacher') {
            $user = $this->db->query("SELECT * FROM tb_user INNER JOIN tb_teacher ON tb_teacher.id_user = tb_user.id_user WHERE tb_user.role = 'teacher' ORDER BY tb_user.id_user")->getResultArray();
        }

        $data = [
            'user' => $user,
            'role' => $role,
        ];
        echo view('v_admin/v_sub_user/user-list-data', $data);
    }

    public function userDetail($idUser)
    {
        $role = $this->db->query("SELECT role FROM tb_user WHERE id_user = '$idUser'")->getRow()->role;
        if ($role == 'admin') {
            $user = $this->db->query("SELECT * FROM tb_user INNER JOIN tb_admin ON tb_admin.id_user = tb_user.id_user WHERE tb_user.id_user = '$idUser'")->getRow();
        } elseif ($role == 'administration') {
            $user = $this->db->query("SELECT * FROM tb_user INNER JOIN tb_administration ON tb_administration.id_user = tb_user.id_user WHERE tb_user.id_user = '$idUser'")->getRow();
        } elseif ($role == 'teacher') {
            $user = $this->db->query("SELECT * FROM tb_user INNER JOIN tb_teacher ON tb_teacher.id_user = tb_user.id_user WHERE tb_user.id_user = '$idUser'")->getRow();
        }
        echo json_encode($user);
    }

    public function getUsername()
    {
        $username = $this->request->getPost('username');
        $idUser = $this->request->getPost('idUser');

        if (isset($idUser)) {
            echo json_encode($this->db->query("SELECT username FROM tb_user WHERE username = '$username' AND NOT id_user = '$idUser'")->getRow(0));
        } else {
            echo json_encode($this->db->query("SELECT username FROM tb_user WHERE username = '$username'")->getRow(0));
        }
    }

    public function getEmail()
    {
        $email = $this->request->getPost('email');
        $idUser = $this->request->getPost('idUser');

        if (isset($idUser)) {
            echo json_encode($this->db->query("SELECT email FROM tb_user WHERE email = '$email' AND NOT id_user = '$idUser'")->getRow(0));
        } else {
            echo json_encode($this->db->query("SELECT email FROM tb_user WHERE email = '$email'")->getRow(0));
        }
    }

    public function userDetailIpdate()
    {
        $idUser = $this->request->getPost('idUser');
        $username = $this->request->getPost('username');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        $this->db->query("UPDATE tb_user SET username = '$username', email = '$email', password = '$password' WHERE id_user = '$idUser'");
        if ($role == 'admin') {
            $this->db->query("UPDATE tb_admin SET name = '$name', email = '$email' WHERE id_user = '$idUser'");
        }

        if ($role == 'administration') {
            $this->db->query("UPDATE tb_administration SET name = '$name', email = '$email' WHERE id_user = '$idUser'");
        }

        if ($role == 'teacher') {
            $this->db->query("UPDATE tb_teacher SET name = '$name', email = '$email' WHERE id_user = '$idUser'");
        }
    }

    public function saveUser()
    {
        $username = $this->request->getPost('username');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        $this->db->query("INSERT INTO tb_user VALUES ('', '$username', '$role', '$email', '$password')");

        if ($role == 'admin') {
            $idUser = $this->db->query("SELECT MAX(id_user) AS idUser FROM tb_user")->getRow()->idUser;
            $this->db->query("INSERT INTO tb_admin VALUES ('', '$idUser', '$name', '', '$email', '', '', 'user.png', 'no')");
        } elseif ($role == 'administration') {
            $idUser = $this->db->query("SELECT MAX(id_user) AS idUser FROM tb_user")->getRow()->idUser;
            $this->db->query("INSERT INTO tb_administration VALUES ('', '$idUser', '$name', '', '$email', '', '', 'user.png')");
        } elseif ($role == 'teacher') {
            $idUser = $this->db->query("SELECT MAX(id_user) AS idUser FROM tb_user")->getRow()->idUser;
            $this->db->query("INSERT INTO tb_teacher VALUES ('', '$idUser', '$name', '', '$email', '', '', 'user.png', 'no')");
        }
    }

    public function deleteUser()
    {
        $idUser = $this->request->getPost('idUser');
        $role = $this->request->getPost('role');

        if ($role == 'admin') {
            $this->db->query("DELETE FROM tb_admin WHERE id_user = '$idUser'");
        } elseif ($role == 'administration') {
            $this->db->query("DELETE FROM tb_administration WHERE id_user = '$idUser'");
        } elseif ($role == 'teacher') {
            $idTeacher = $this->db->query("SELECT id_teacher FROM tb_teacher WHERE id_user = '$idUser'")->getRow()->id_teacher;
            $idSubject = $this->db->query("SELECT id_subject FROM tb_subject WHERE id_teacher = '$idTeacher'")->getRow(0);
            if (isset($idSubject)) {
                $this->db->query("DELETE FROM tb_subject_score_merdeka WHERE id_subject = '$idSubject'");
                $this->db->query("DELETE FROM tb_subject_score_k13 WHERE id_subject = '$idSubject'");
            }
            $this->db->query("DELETE FROM tb_timetable WHERE id_teacher = '$idTeacher'");
            $this->db->query("UPDATE tb_class SET id_teacher = '' WHERE id_teacher = '$idTeacher'");
            $this->db->query("DELETE FROM tb_subject WHERE id_teacher = '$idTeacher'");
            $this->db->query("DELETE FROM tb_teacher WHERE id_user = '$idUser'");
        }
        $this->db->query("DELETE FROM tb_user WHERE id_user = '$idUser'");
    }
}
