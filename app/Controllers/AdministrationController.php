<?php

namespace App\Controllers;

use App\Models\SubjectModel;
use App\Models\UserModel;
use App\Models\TeacherModel;
use App\Models\AdministrationModel;
use App\Models\StudentModel;
use App\Models\TimetableModel;
use App\Models\ClassModel;
use Dompdf\Dompdf;

class AdministrationController extends BaseController
{
    protected $db;
    protected $idUser;

    protected $subjectModel;
    protected $userModel;
    protected $teacherModel;
    protected $administrationModel;
    protected $studentModel;
    protected $timetableModel;
    protected $classModel;

    protected $domPdf;

    public function __construct()
    {
        $this->db                  = \Config\Database::Connect();
        $this->idUser              = session('id_user');

        $this->subjectModel        = new SubjectModel();
        $this->userModel           = new UserModel();
        $this->teacherModel        = new TeacherModel();
        $this->administrationModel = new AdministrationModel();
        $this->studentModel        = new StudentModel();
        $this->timetableModel      = new TimetableModel();
        $this->classModel          = new ClassModel();

        $this->domPdf              = new Dompdf();
    }

    public function index()
    {
        $data = [
            'title'          => 'Dashboard Tata Usaha',
            'administration' => $this->db->query("SELECT * FROM tb_administration WHERE id_user = '$this->idUser'")->getRow(),
            'user'           => $this->userModel->getUser($this->idUser),
        ];
        return view('v_administration/v_sub_dashboard/dashboard', $data);
    }

    // Profile Start
    public function profile()
    {
        $data = [
            'title'          => 'Profile Tata Usaha',
            'administration' => $this->db->query("SELECT * FROM tb_administration WHERE id_user = '$this->idUser'")->getRow(),
        ];
        return view('v_administration/v_sub_profile/profile', $data);
    }

    public function profileInfo($idAdministration)
    {
        $data = [
            'administration' => $this->administrationModel->getAdministration($idAdministration)
        ];
        echo view('v_administration/v_sub_profile/profile-info', $data);
    }

    public function profileSetting($idAdministration)
    {
        $data = [
            'administration' => $this->administrationModel->getAdministration($idAdministration)
        ];
        echo view('v_administration/v_sub_profile/profile-setting', $data);
    }

    public function getEmail()
    {
        $email = $this->request->getPost('email');
        $id = $this->request->getPost('idUser');

        if (isset($id)) {
            $idUser = $id;
        } else {
            $idUser = $this->idUser;
        }

        echo json_encode($this->db->query("SELECT email FROM tb_user WHERE email = '$email' AND NOT id_user = '$idUser'")->getRow(0));
    }

    public function updateProfile()
    {
        $dataAdministration = [
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
        $this->administrationModel->updateProfile($dataAdministration, $this->request->getPost('id'));
        $this->userModel->updateUser($dataUser, $this->idUser);
    }
    // Profile End

    // Student Start
    public function studentYear()
    {
        $data = [
            'title' => 'Tahun Ajaran',
        ];
        return view('v_administration/v_sub_student/student-year', $data);
    }

    public function studentYearData()
    {
        $data = [
            'student' => $this->db->query("SELECT * FROM tb_class GROUP BY school_year")->getResultArray()
        ];
        echo view('v_administration/v_sub_student/student-year-data', $data);
    }

    public function saveClassYear()
    {
        $cY = substr($this->db->query("SELECT MAX(school_year) AS cc FROM tb_class")->getRow()->cc, 5);
        $cY++;
        $bY = substr($this->db->query("SELECT MAX(school_year) AS cc FROM tb_class")->getRow()->cc, 5);
        $year = $bY . '-' . $cY;
        $this->db->query("INSERT INTO tb_class VALUES ('', 'VII A', 'TC-23001', '$year', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0') ");
        $this->db->query("INSERT INTO tb_class VALUES ('', 'VIII A', 'TC-23001', '$year', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0') ");
        $this->db->query("INSERT INTO tb_class VALUES ('', 'IX A', 'TC-23001', '$year', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0') ");

        $this->db->query("INSERT INTO tb_subject VALUES ('', 'TC-23001', (SELECT MAX(id_class) FROM tb_class WHERE class = 'VII A'), 'Matematika', 'VII A', '', '$year', 'subject.png', '0', '0', 'Merdeka') ");
        $this->db->query("INSERT INTO tb_subject VALUES ('', 'TC-23001', (SELECT MAX(id_class) FROM tb_class WHERE class = 'VIII A'), 'Matematika', 'VIII A', '', '$year', 'subject.png', '0', '0', 'Merdeka') ");
        $this->db->query("INSERT INTO tb_subject VALUES ('', 'TC-23001', (SELECT MAX(id_class) FROM tb_class WHERE class = 'IX A'), 'Matematika', 'IX A', '', '$year', 'subject.png', '0', '0', 'Merdeka') ");
    }

    public function studentClass($year)
    {
        $data = [
            'title'   => 'Kelas Siswa',
            'year'    => $year,
            'teacher' => $this->teacherModel->getTeacher()
        ];
        return view('v_administration/v_sub_student/student-class', $data);
    }

    public function classModal($idClass)
    {
        echo json_encode($this->db->query("SELECT * FROM tb_class INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_class.id_teacher WHERE id_class = '$idClass'")->getRow());
    }

    public function teacherClass()
    {
        echo json_encode($this->teacherModel->getTeacher());
    }

    public function updateClass()
    {
        $idTeacher = $this->request->getPost('idTeacher');
        $idClass = $this->request->getPost('idClass');

        $this->db->query("UPDATE tb_class SET id_teacher = '$idTeacher' WHERE id_class = '$idClass'");
    }

    public function studentClassVIIData($year)
    {
        $data = [
            'class' => $this->db->query("SELECT * FROM tb_class INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_class.id_teacher WHERE class LIKE '%VII %' AND school_year = '$year'")->getResultArray()
        ];
        echo view('v_administration/v_sub_student/student-class-vii-data', $data);
    }

    public function studentClassVIIIData($year)
    {
        $data = [
            'class' => $this->db->query("SELECT * FROM tb_class INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_class.id_teacher WHERE class LIKE '%VIII %' AND school_year = '$year'")->getResultArray()
        ];
        echo view('v_administration/v_sub_student/student-class-viii-data', $data);
    }

    public function studentClassIXData($year)
    {
        $data = [
            'class' => $this->db->query("SELECT * FROM tb_class INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_class.id_teacher WHERE class LIKE '%IX %' AND school_year = '$year'")->getResultArray()
        ];
        echo view('v_administration/v_sub_student/student-class-ix-data', $data);
    }

    public function saveClass()
    {
        $idTeacher = $this->request->getPost('idTeacher');
        $school_year = $this->request->getPost('school_year');
        $class = $this->request->getPost('class');

        $dataClass = $this->db->query("SELECT MAX(class) AS cc FROM tb_class WHERE class LIKE '%$class %' AND school_year = '$school_year'")->getRow()->cc;
        $dataClass++;

        $this->db->query("INSERT INTO tb_class VALUES ('', '$dataClass', '$idTeacher', '$school_year', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0') ");
    }

    public function deleteClass()
    {
        $idClass = $this->request->getPost('idClass');

        $class = $this->db->query("SELECT * FROM tb_class WHERE id_class = '$idClass'")->getRow()->class;

        if (strpos($class, 'IX ') !== false) {
            $tabClass = 'tb_class_ix';
        } elseif (strpos($class, 'VIII ') !== false) {
            $tabClass = 'tb_class_viii';
        } elseif (strpos($class, 'VII ') !== false) {
            $tabClass = 'tb_class_vii';
        }

        $this->db->query("DELETE FROM tb_class WHERE id_class = '$idClass'");
        $this->db->query("DELETE FROM $tabClass WHERE id_class = '$idClass'");
        $this->db->query("DELETE FROM tb_subject WHERE id_class = '$idClass'");
        $this->db->query("DELETE FROM tb_timetable WHERE id_class = '$idClass'");
        $this->db->query("DELETE FROM tb_subject_score_k13 WHERE id_class = '$idClass'");
        $this->db->query("DELETE FROM tb_subject_score_merdeka WHERE id_class = '$idClass'");

        for ($i = 1; $i <= 16; $i++) {
            $tabSenin = 'tb_presence_week_' . $i . '_senin';
            $tabSelasa = 'tb_presence_week_' . $i . '_selasa';
            $tabRabu = 'tb_presence_week_' . $i . '_rabu';
            $tabKamis = 'tb_presence_week_' . $i . '_kamis';
            $tabJumat = 'tb_presence_week_' . $i . '_jumat';
            $tabSabtu = 'tb_presence_week_' . $i . '_sabtu';
            $this->db->query("DELETE FROM $tabSenin WHERE id_class = '$idClass'");
            $this->db->query("DELETE FROM $tabSelasa WHERE id_class = '$idClass'");
            $this->db->query("DELETE FROM $tabRabu WHERE id_class = '$idClass'");
            $this->db->query("DELETE FROM $tabKamis WHERE id_class = '$idClass'");
            $this->db->query("DELETE FROM $tabJumat WHERE id_class = '$idClass'");
            $this->db->query("DELETE FROM $tabSabtu WHERE id_class = '$idClass'");
        }
    }

    public function studentList($year, $idClass)
    {
        $class =  $this->classModel->getClass($idClass)['class'];
        $data = [
            'title'   => 'Siswa Kelas ' . $class,
            'year'    => $year,
            'idClass' => $idClass,
            'class'   => $class
        ];
        return view('v_administration/v_sub_student/student-list', $data);
    }

    public function studentListData($idClass)
    {
        $class = $this->db->query("SELECT * FROM tb_class WHERE id_class = '$idClass'")->getRow()->class;

        if (strpos($class, 'IX ') !== false) {
            $tabClass = 'tb_class_ix';
        } elseif (strpos($class, 'VIII ') !== false) {
            $tabClass = 'tb_class_viii';
        } elseif (strpos($class, 'VII ') !== false) {
            $tabClass = 'tb_class_vii';
        }

        $data = [
            'student' =>  $this->db->query("SELECT * FROM $tabClass INNER JOIN tb_student ON tb_student.id_student = $tabClass.id_student WHERE id_class = '$idClass'")->getResultArray(),
            'year'    => $this->classModel->getClass($idClass)['school_year'],
            'idClass' => $idClass
        ];
        echo view('v_administration/v_sub_student/student-list-data', $data);
    }

    public function studentDetail($idStudent)
    {
        echo json_encode($this->studentModel->getStudent($idStudent));
    }

    public function studentDetailIpdate()
    {
        $idStudent = $this->request->getPost('idStudent');
        $nis = $this->request->getPost('nis');
        $nisnPost = $this->request->getPost('nisn');
        $name = $this->request->getPost('name');
        $gender = $this->request->getPost('gender');
        $school_year = $this->request->getPost('school_year');

        $nisn = empty($nisnPost) ? 'CAST(null AS DATETIME)' : $nisnPost;

        $this->db->query("UPDATE tb_student SET nis = $nis, nisn = $nisn, name = '$name', gender = '$gender', school_year = '$school_year' WHERE id_student = '$idStudent'");
    }

    public function saveStudent()
    {
        $idClass = $this->request->getPost('idClass');
        $nis = $this->request->getPost('nis');
        $nisn = $this->request->getPost('nisn');
        $name = $this->request->getPost('name');
        $gender = $this->request->getPost('gender');
        $school_year = $this->request->getPost('school_year');

        $class = $this->db->query("SELECT * FROM tb_class WHERE id_class = '$idClass'")->getRow()->class;

        if (strpos($class, 'IX ') !== false) {
            $tabClass = 'tb_class_ix';
        } elseif (strpos($class, 'VIII ') !== false) {
            $tabClass = 'tb_class_viii';
        } elseif (strpos($class, 'VII ') !== false) {
            $tabClass = 'tb_class_vii';
        }

        $this->db->query("INSERT INTO tb_user VALUES ('', '$nis', 'student', '', 'qwerty')");
        $idUser = $this->db->query("SELECT MAX(id_user) AS idUser FROM tb_user")->getRow()->idUser;
        $this->db->query("INSERT INTO tb_student VALUES ('', '$idUser', '$nis', '$nisn', '$name', '$gender', '$school_year', 'user.png')");
        $this->db->query("INSERT INTO $tabClass VALUES ('', '$idClass', (SELECT id_teacher FROM tb_class WHERE id_class = '$idClass'), (SELECT MAX(id_student) FROM tb_student), (SELECT class FROM tb_class WHERE id_class = '$idClass'), '$school_year')");
        $this->db->query("UPDATE tb_class SET students = (SELECT COUNT(id_student) FROM $tabClass WHERE id_class = '$idClass')");
    }

    public function deleteStudent()
    {
        $idClass = $this->request->getPost('idClass');
        $idStudent = $this->request->getPost('idStudent');
        $idUser = $this->db->query("SELECT id_user FROM tb_student WHERE id_student = '$idStudent'")->getRow()->id_user;

        $class = $this->db->query("SELECT * FROM tb_class WHERE id_class = '$idClass'")->getRow()->class;

        if (strpos($class, 'IX ') !== false) {
            $tabClass = 'tb_class_ix';
        } elseif (strpos($class, 'VIII ') !== false) {
            $tabClass = 'tb_class_viii';
        } elseif (strpos($class, 'VII ') !== false) {
            $tabClass = 'tb_class_vii';
        }

        $this->db->query("DELETE FROM tb_student WHERE id_student = '$idStudent'");
        $this->db->query("DELETE FROM $tabClass WHERE id_student = '$idStudent'");
        $this->db->query("DELETE FROM tb_subject_score_k13 WHERE id_student = '$idStudent'");
        $this->db->query("DELETE FROM tb_subject_score_merdeka WHERE id_student = '$idStudent'");

        for ($a = 1; $a <= 16; $a++) {
            $tabSenin = 'tb_presence_week_' . $a . '_senin';
            $tabSelasa = 'tb_presence_week_' . $a . '_selasa';
            $tabRabu = 'tb_presence_week_' . $a . '_rabu';
            $tabKamis = 'tb_presence_week_' . $a . '_kamis';
            $tabJumat = 'tb_presence_week_' . $a . '_jumat';
            $tabSabtu = 'tb_presence_week_' . $a . '_sabtu';
            $this->db->query("DELETE FROM $tabSenin WHERE id_student = '$idStudent'");
            $this->db->query("DELETE FROM $tabSelasa WHERE id_student = '$idStudent'");
            $this->db->query("DELETE FROM $tabRabu WHERE id_student = '$idStudent'");
            $this->db->query("DELETE FROM $tabKamis WHERE id_student = '$idStudent'");
            $this->db->query("DELETE FROM $tabJumat WHERE id_student = '$idStudent'");
            $this->db->query("DELETE FROM $tabSabtu WHERE id_student = '$idStudent'");
        }
        $this->db->query("DELETE FROM tb_user WHERE id_user = '$idUser'");
        $this->db->query("UPDATE tb_class SET students = (SELECT COUNT(id_student) FROM $tabClass WHERE id_class = '$idClass')");
    }
    // Student End

    // Subject Start
    public function subjectYear()
    {
        $data = [
            'title' => 'Tahun Ajaran',
        ];
        return view('v_administration/v_sub_subject/subject-year', $data);
    }

    public function subjectYearData()
    {
        $data = [
            'subject' => $this->db->query("SELECT * FROM tb_subject GROUP BY school_year")->getResultArray()
        ];
        echo view('v_administration/v_sub_subject/subject-year-data', $data);
    }

    public function saveSubject()
    {
        $idClass = $this->request->getPost('idClass');
        $idTeacher = $this->request->getPost('idTeacher');
        $kurikulum = $this->request->getPost('kurikulum');
        $subject = $this->request->getPost('subject');
        $school_year = $this->request->getPost('school_year');
        $image = 'subject.png';

        $this->db->query("INSERT INTO tb_subject VALUES ('', '$idTeacher', '$idClass', '$subject', (SELECT class FROM tb_class WHERE id_class = '$idClass'), '', '$school_year', '$image', '0', '0', '$kurikulum')");
    }

    public function subjectClass($year)
    {
        $data = [
            'title' => 'Kelas Mata Pelajaran',
            'year'  => $year
        ];
        return view('v_administration/v_sub_subject/subject-class', $data);
    }

    public function subjectClassVIIData($year)
    {
        $data = [
            'class' => $this->db->query("SELECT * FROM tb_class INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_class.id_teacher WHERE class LIKE '%VII %' AND school_year = '$year'")->getResultArray()
        ];
        echo view('v_administration/v_sub_subject/subject-class-vii-data', $data);
    }

    public function subjectClassVIIIData($year)
    {
        $data = [
            'class' => $this->db->query("SELECT * FROM tb_class INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_class.id_teacher WHERE class LIKE '%VIII %' AND school_year = '$year'")->getResultArray()
        ];
        echo view('v_administration/v_sub_subject/subject-class-viii-data', $data);
    }

    public function subjectClassIXData($year)
    {
        $data = [
            'class' => $this->db->query("SELECT * FROM tb_class INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_class.id_teacher WHERE class LIKE '%IX %' AND school_year = '$year'")->getResultArray()
        ];
        echo view('v_administration/v_sub_subject/subject-class-ix-data', $data);
    }

    public function subjectList($year, $idClass)
    {
        $data = [
            'title' => 'Mata Pelajaran | ' . $year,
            'year'  => $year,
            'idClass' => $idClass,
            'class' => $this->classModel->getClass($idClass)['class']
        ];
        return view('v_administration/v_sub_subject/subject-list', $data);
    }

    public function subjectListData($year, $idClass)
    {
        $data = [
            'subject' => $this->db->query("SELECT * FROM tb_subject INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_subject.id_teacher WHERE id_class = '$idClass' AND school_year = '$year'")->getResultArray(),
            'year'  => $year,
            'class' => $this->classModel->getClass($idClass)['class'],
            'idClass' => $idClass,
            'teacherList' => $this->teacherModel->getTeacher()
        ];
        echo view('v_administration/v_sub_subject/subject-list-data', $data);
    }

    public function subjectDetail($idSubject)
    {
        echo json_encode($this->db->query("SELECT * FROM tb_subject INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_subject.id_teacher WHERE id_subject = '$idSubject'")->getRow());
    }

    public function getDaySubject($idSubject)
    {
        echo json_encode($this->db->query("SELECT * FROM tb_timetable WHERE id_subject = '$idSubject' GROUP BY day")->getResultArray());
    }

    public function getTeacherSubjectDetail()
    {
        echo json_encode($this->teacherModel->getTeacher());
    }

    public function subjectDetailUpdate()
    {
        $idSubject = $this->request->getPost('idSubject');
        $idTeacher = $this->request->getPost('idTeacher');
        $kurikulum = $this->request->getPost('kurikulum');

        $oldKurikulum = $this->db->query("SELECT kurikulum FROM tb_subject WHERE id_subject = '$idSubject'")->getRow()->kurikulum;

        $this->db->query("UPDATE tb_subject SET id_teacher = '$idTeacher', kurikulum = '$kurikulum' WHERE id_subject = '$idSubject'");

        if ($kurikulum == $oldKurikulum) {
            $this->db->query("UPDATE tb_subject SET stat_sub_ganjil = 0, stat_sub_genap = 0 WHERE id_subject = '$idSubject'");
            $this->db->query("DELETE FROM tb_subject_score_merdeka WHERE id_subject = '$idSubject'");
            $this->db->query("DELETE FROM tb_subject_score_k13 WHERE id_subject = '$idSubject'");
        }
    }

    public function deleteSubject()
    {
        $idSubject = $this->request->getPost('idSubject');

        $this->db->query("DELETE FROM tb_subject WHERE id_subject = '$idSubject'");
        $this->db->query("DELETE FROM tb_timetable WHERE id_subject = '$idSubject'");
        $this->db->query("DELETE FROM tb_subject_score_k13 WHERE id_subject = '$idSubject'");
        $this->db->query("DELETE FROM tb_subject_score_merdeka WHERE id_subject = '$idSubject'");
    }

    public function printPresenceSimple($idSubject, $semester, $day, $week)
    {
        for ($i = 1; $i <= 16; $i++) {
            if ($week == 'week-' . $i) {
                $pekan = 'Pekan ' . $i;
            }
        }
        $tab = $this->subjectModel->getTabPresence($day, $week);

        $this->subjectModel->insertPresence($idSubject, $semester, $day, $week);

        $idClass = $this->subjectModel->getSubject($idSubject)['id_class'];
        $lesson = $this->timetableModel->getMaxLessonHours($idSubject, $day);
        $date  = $this->subjectModel->getDatePresence($idSubject, $tab, $semester, $lesson);
        $subject     = $this->subjectModel->getSubject($idSubject);
        $subjectName = $subject['subject_name'];
        $fileName    = 'rekap-presensi-simple-' . $subjectName . '-' . $day . '-' . $date;
        $data = [
            'presence'    => $this->subjectModel->getPresenceData($tab, $semester, $idClass),
            'lesson'      => $lesson,
            'class'       => $subject['class'],
            'teacher'     => $this->subjectModel->getNamaTeacherSubject($idSubject),
            'date'        => $date,
            'subjectName' => $subjectName,
            'nameFile'    => $fileName,
            'week'        => $pekan,
            'semester'    => $semester,
            'day'         => $day,
            'master'      => $this->teacherModel->getMaster()
        ];

        // load HTML content
        $this->domPdf->loadHtml(view('v_print/print-pdf-presence-simple', $data));

        // (optional) setup the paper size and orientation
        $this->domPdf->setPaper('A4', 'potrait');

        // render html as PDF
        $this->domPdf->render();

        // output the generated pdf
        $this->domPdf->stream($fileName);
    }

    public function printPresenceFull($idSubject, $semester, $day, $week)
    {
        for ($i = 1; $i <= 16; $i++) {
            if ($week == 'week-' . $i) {
                $pekan = 'Pekan ' . $i;
            }
        }
        $tab = $this->subjectModel->getTabPresence($day, $week);

        $this->subjectModel->insertPresence($idSubject, $semester, $day, $week);

        $idClass = $this->subjectModel->getSubject($idSubject)['id_class'];
        $lesson = $this->timetableModel->getMaxLessonHours($idSubject, $day);
        $date  = $this->subjectModel->getDatePresence($idSubject, $tab, $semester, $lesson);
        $subject     = $this->subjectModel->getSubject($idSubject);
        $subjectName = $subject['subject_name'];
        $fileName    = 'rekap-presensi-full-' . $subjectName . '-' . $day . '-' . $date;

        $data = [
            'lesson_1'    => $this->timetableModel->countLessonHours($idSubject, $day, 1),
            'lesson_2'    => $this->timetableModel->countLessonHours($idSubject, $day, 2),
            'lesson_3'    => $this->timetableModel->countLessonHours($idSubject, $day, 3),
            'lesson_4'    => $this->timetableModel->countLessonHours($idSubject, $day, 4),
            'lesson_5'    => $this->timetableModel->countLessonHours($idSubject, $day, 5),
            'lesson_6'    => $this->timetableModel->countLessonHours($idSubject, $day, 6),
            'lesson_7'    => $this->timetableModel->countLessonHours($idSubject, $day, 7),
            'lesson_8'    => $this->timetableModel->countLessonHours($idSubject, $day, 8),
            'lesson_9'    => $this->timetableModel->countLessonHours($idSubject, $day, 9),
            'presence'    => $this->subjectModel->getPresenceData($tab, $semester, $idClass),
            'class'       => $subject['class'],
            'teacher'     => $this->subjectModel->getNamaTeacherSubject($idSubject),
            'date'        => $date,
            'subjectName' => $subjectName,
            'nameFile'    => $fileName,
            'week'        => $pekan,
            'semester'    => $semester,
            'day'         => $day,
            'master'      => $this->teacherModel->getMaster()
        ];

        // load HTML content
        $this->domPdf->loadHtml(view('v_print/print-pdf-presence-full', $data));

        // (optional) setup the paper size and orientation
        $this->domPdf->setPaper('A4', 'potrait');

        // render html as PDF
        $this->domPdf->render();

        // output the generated pdf
        $this->domPdf->stream($fileName);
    }

    public function printScore($idSubject, $semester)
    {
        if ($this->db->query("SELECT * FROM tb_subject WHERE id_subject = '$idSubject'")->getRow()->kurikulum == 'Merdeka') {
            $idClass = $this->subjectModel->getSubject($idSubject)['id_class'];
            $subject = $this->subjectModel->getSubject($idSubject);
            $fileName = 'rekap-nilai-' . $subject['subject_name'] . '-' . $subject['class'] . '-' . $semester;
            $data = [
                'score'     => $this->subjectModel->getScoreData('tb_subject_score_merdeka', $semester, $idSubject, $idClass),
                'idSubject' => $idSubject,
                'semester'  => $semester,
                'class'     => $this->db->query("SELECT * FROM tb_class INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_class.id_teacher WHERE id_class = '$idClass'")->getRow(),
                'date'      => date("d-m-Y"),
                'title'     => $fileName,
                'nClass'    => $subject['class'],
                'master'    => $this->teacherModel->getMaster()
            ];

            // load HTML content
            $this->domPdf->loadHtml(view('v_print/print-pdf-score-merdeka', $data));

            // (optional) setup the paper size and orientation
            $this->domPdf->setPaper('A3', 'landscape');

            // render html as PDF
            $this->domPdf->render();

            // output the generated pdf
            $this->domPdf->stream($fileName);
        } elseif ($this->db->query("SELECT * FROM tb_subject WHERE id_subject = '$idSubject'")->getRow()->kurikulum == 'K-13') {
            $idClass = $this->subjectModel->getSubject($idSubject)['id_class'];
            $subject = $this->subjectModel->getSubject($idSubject);
            $fileName = 'rekap-nilai-' . $subject['subject_name'] . '-' . $subject['class'] . '-' . $semester;
            $data = [
                'score'     => $this->subjectModel->getScoreData('tb_subject_score_k13', $semester, $idSubject, $idClass),
                'idSubject' => $idSubject,
                'semester'  => $semester,
                'class'     => $this->db->query("SELECT * FROM tb_class INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_class.id_teacher WHERE id_class = '$idClass'")->getRow(),
                'date'      => date("d-m-Y"),
                'title'     => $fileName,
                'nClass'    => $subject['class'],
                'master'    => $this->teacherModel->getMaster()
            ];

            // load HTML content
            $this->domPdf->loadHtml(view('v_print/print-pdf-score-k13', $data));

            // (optional) setup the paper size and orientation
            $this->domPdf->setPaper('A3', 'landscape');

            // render html as PDF
            $this->domPdf->render();

            // output the generated pdf
            $this->domPdf->stream($fileName);
        }
    }
    // Subject End

    // Timetable Start
    public function timetableYear()
    {
        $data = [
            'title' => 'Tahun Ajaran',
        ];
        return view('v_administration/v_sub_timetable/timetable-year', $data);
    }

    public function timetableYearData()
    {
        $data = [
            'timetable' => $this->db->query("SELECT * FROM tb_subject GROUP BY school_year")->getResultArray()
        ];
        echo view('v_administration/v_sub_timetable/timetable-year-data', $data);
    }

    public function timetableClass($year)
    {
        $data = [
            'title' => 'Kelas Jadwal',
            'year'  => $year
        ];
        return view('v_administration/v_sub_timetable/timetable-class', $data);
    }

    public function timetableClassVIIData($year)
    {
        $data = [
            'class' => $this->db->query("SELECT * FROM tb_class INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_class.id_teacher WHERE class LIKE '%VII %' AND school_year = '$year'")->getResultArray()
        ];
        echo view('v_administration/v_sub_timetable/timetable-class-vii-data', $data);
    }

    public function timetableClassVIIIData($year)
    {
        $data = [
            'class' => $this->db->query("SELECT * FROM tb_class INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_class.id_teacher WHERE class LIKE '%VIII %' AND school_year = '$year'")->getResultArray()
        ];
        echo view('v_administration/v_sub_timetable/timetable-class-viii-data', $data);
    }

    public function timetableClassIXData($year)
    {
        $data = [
            'class' => $this->db->query("SELECT * FROM tb_class INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_class.id_teacher WHERE class LIKE '%IX %' AND school_year = '$year'")->getResultArray()
        ];
        echo view('v_administration/v_sub_timetable/timetable-class-ix-data', $data);
    }

    public function timetableList($year, $idClass)
    {
        $data = [
            'title' => 'Jadwal | ' . $year,
            'year'  => $year,
            'idClass' => $idClass,
            'class' => $this->classModel->getClass($idClass)['class'],
            'teacher' => $this->db->query("SELECT * FROM tb_subject INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_subject.id_teacher GROUP BY subject_name")->getResultArray()
        ];
        return view('v_administration/v_sub_timetable/timetable-list', $data);
    }

    public function getSubjectTimetable()
    {
        $idClass = $this->request->getPost('idClass');
        echo json_encode($this->db->query("SELECT * FROM tb_subject WHERE id_class = '$idClass'")->getResultArray());
    }

    public function getTeacherTimetable()
    {
        $idSubject = $this->request->getPost('idSubject');
        echo json_encode($this->db->query("SELECT * FROM tb_subject INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_subject.id_teacher WHERE id_subject ='$idSubject'")->getResultArray());
    }

    public function timetableSenin($idClass)
    {
        $data = [
            'senin' => $this->db->query("SELECT * FROM tb_subject INNER JOIN tb_timetable ON tb_timetable.id_subject = tb_subject.id_subject INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_subject.id_teacher WHERE tb_subject.id_class = '$idClass' AND tb_timetable.day = 'Senin' ORDER BY lesson_hours")->getResultArray()
        ];
        echo view('v_administration/v_sub_timetable/timetable-list-senin', $data);
    }

    public function timetableSelasa($idClass)
    {
        $data = [
            'selasa' => $this->db->query("SELECT * FROM tb_subject INNER JOIN tb_timetable ON tb_timetable.id_subject = tb_subject.id_subject INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_subject.id_teacher WHERE tb_subject.id_class = '$idClass' AND tb_timetable.day = 'Selasa' ORDER BY lesson_hours")->getResultArray()
        ];
        echo view('v_administration/v_sub_timetable/timetable-list-selasa', $data);
    }

    public function timetableRabu($idClass)
    {
        $data = [
            'rabu' => $this->db->query("SELECT * FROM tb_subject INNER JOIN tb_timetable ON tb_timetable.id_subject = tb_subject.id_subject INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_subject.id_teacher WHERE tb_subject.id_class = '$idClass' AND tb_timetable.day = 'Rabu' ORDER BY lesson_hours")->getResultArray()
        ];
        echo view('v_administration/v_sub_timetable/timetable-list-rabu', $data);
    }

    public function timetableKamis($idClass)
    {
        $data = [
            'kamis' => $this->db->query("SELECT * FROM tb_subject INNER JOIN tb_timetable ON tb_timetable.id_subject = tb_subject.id_subject INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_subject.id_teacher WHERE tb_subject.id_class = '$idClass' AND tb_timetable.day = 'Kamis' ORDER BY lesson_hours")->getResultArray()
        ];
        echo view('v_administration/v_sub_timetable/timetable-list-kamis', $data);
    }

    public function timetableJumat($idClass)
    {
        $data = [
            'jumat' => $this->db->query("SELECT * FROM tb_subject INNER JOIN tb_timetable ON tb_timetable.id_subject = tb_subject.id_subject INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_subject.id_teacher WHERE tb_subject.id_class = '$idClass' AND tb_timetable.day = 'Jumat' ORDER BY lesson_hours")->getResultArray()
        ];
        echo view('v_administration/v_sub_timetable/timetable-list-jumat', $data);
    }

    public function timetableSabtu($idClass)
    {
        $data = [
            'sabtu' => $this->db->query("SELECT * FROM tb_subject INNER JOIN tb_timetable ON tb_timetable.id_subject = tb_subject.id_subject INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_subject.id_teacher WHERE tb_subject.id_class = '$idClass' AND tb_timetable.day = 'Sabtu' ORDER BY lesson_hours")->getResultArray()
        ];
        echo view('v_administration/v_sub_timetable/timetable-list-sabtu', $data);
    }

    public function saveTimetable()
    {
        $idSubject = $this->request->getPost('idSubject');
        $day = $this->request->getPost('day');
        $lesson = $this->request->getPost('lesson');
        $lessonTime = $this->request->getPost('lessonTime');
        $idClass = $this->request->getPost('idClass');
        $idTeacher = $this->request->getPost('idTeacher');

        $cTimetable = $this->db->query("SELECT COUNT(id_subject) AS ress FROM tb_timetable WHERE id_class = '$idClass' AND day = '$day' AND lesson_hours = $lesson")->getRow()->ress;

        if ($cTimetable != 0) {
            $this->db->query("UPDATE tb_timetable SET id_subject = '$idSubject', id_teacher = '$idTeacher' WHERE day = '$day' AND lesson_hours = $lesson AND id_class = '$idClass'");
            $this->db->query("UPDATE tb_subject SET clesson = (SELECT COUNT(id_subject) WHERE id_subject = '$idSubject') WHERE id_subject = '$idSubject'");
        } elseif ($cTimetable == 0) {
            $this->db->query("INSERT INTO tb_timetable VALUES ('', '$idSubject', '$idTeacher', '$idClass', '$lessonTime', '$day', '$lesson')");
            $this->db->query("UPDATE tb_subject SET clesson = (SELECT COUNT(id_subject) WHERE id_subject = '$idSubject') WHERE id_subject = '$idSubject'");
        }
    }
}
