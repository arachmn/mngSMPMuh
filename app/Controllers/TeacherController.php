<?php

namespace App\Controllers;

use App\Models\SubjectModel;
use App\Models\UserModel;
use App\Models\TeacherModel;
use App\Models\StudentModel;
use App\Models\TimetableModel;
use App\Models\ClassModel;
use Dompdf\Dompdf;

class TeacherController extends BaseController
{
    protected $db;
    protected $idUser;

    protected $subjectModel;
    protected $userModel;
    protected $teacherModel;
    protected $studentModel;
    protected $timetableModel;
    protected $classModel;

    protected $domPdf;

    public function __construct()
    {
        $this->db             = \Config\Database::Connect();
        $this->idUser         = session('id_user');

        $this->subjectModel   = new SubjectModel();
        $this->userModel      = new UserModel();
        $this->teacherModel   = new TeacherModel();
        $this->studentModel   = new StudentModel();
        $this->timetableModel = new TimetableModel();
        $this->classModel     = new ClassModel();

        $this->domPdf         = new Dompdf();
    }

    // Start Dashboard
    public function index()
    {
        $data = [
            'title'     => 'Dashboard Guru',
            'teacher'   => $this->db->query("SELECT * FROM tb_teacher WHERE id_user = '$this->idUser'")->getRow(),
            'user'      => $this->userModel->getUser($this->idUser),
            'idTeacher' => $this->db->query("SELECT id_teacher FROM tb_teacher WHERE id_user = '$this->idUser'")->getRow()->id_teacher,
        ];
        return view('v_teacher/v_sub_dashboard/dashboard', $data);
    }

    public function indexTimetable($idTeacher)
    {
        $t = date('d-m-Y');
        if (date("D", strtotime($t)) == 'Mon') {
            $day = 'Senin';
        } elseif (date("D", strtotime($t)) == 'Tue') {
            $day = 'Selasa';
        } elseif (date("D", strtotime($t)) == 'Wed') {
            $day = 'Rabu';
        } elseif (date("D", strtotime($t)) == 'Thu') {
            $day = 'Kamis';
        } elseif (date("D", strtotime($t)) == 'Fri') {
            $day = 'Jumat';
        } elseif (date("D", strtotime($t)) == 'Sat') {
            $day = 'Sabtu';
        } elseif (date("D", strtotime($t)) == 'Sun') {
            $day = 'Minggu';
        }

        $cMonth = date('n');
        $cYear = date('Y');
        if ($cMonth <= 6) {
            $cYear--;
            $year = $cYear . '-' . date('Y');
        } elseif ($cMonth >= 7) {
            $cYear++;
            $year = $cYear . '-' . date('Y');
        }

        $data = [
            'timetable' => $this->db->query("SELECT * FROM tb_timetable INNER JOIN tb_subject ON tb_subject.id_subject = tb_timetable.id_subject WHERE tb_timetable.id_teacher = '$idTeacher' AND day = '$day' AND school_year = '$year' ORDER BY lesson_hours")->getResultArray(),
            'idTeacher' => $idTeacher,
            'day'       => $day,
            'year'      => $year
        ];
        echo view('v_teacher/v_sub_dashboard/dashboard-timetable', $data);
    }
    // End Dashboard

    // Start Profile
    public function profile()
    {
        $idTeacher = $this->db->query("SELECT id_teacher FROM tb_teacher WHERE id_user = '$this->idUser'")->getRow()->id_teacher;
        $data = [
            'title'     => 'Profile Guru',
            'idTeacher' => $idTeacher
        ];
        return view('v_teacher/v_sub_profile/profile', $data);
    }

    public function profileTimetable($idTeacher)
    {
        $cMonth = date('n');
        $cYear = date('Y');
        if ($cMonth <= 6) {
            $cYear--;
            $year = $cYear . '-' . date('Y');
        } elseif ($cMonth >= 7) {
            $cYear++;
            $year = $cYear . '-' . date('Y');
        }
        $data = [
            'senin'     => $this->timetableModel->getDayTimetable($idTeacher, 'Senin', $year),
            'selasa'    => $this->timetableModel->getDayTimetable($idTeacher, 'Selasa', $year),
            'rabu'      => $this->timetableModel->getDayTimetable($idTeacher, 'Rabu', $year),
            'kamis'     => $this->timetableModel->getDayTimetable($idTeacher, 'Kamis', $year),
            'jumat'     => $this->timetableModel->getDayTimetable($idTeacher, 'Jumat', $year),
            'sabtu'     => $this->timetableModel->getDayTimetable($idTeacher, 'Sabtu', $year),
            'idTeacher' => $idTeacher,
            'year'      => $year
        ];
        echo view('v_teacher/v_sub_profile/profile-timetable', $data);
    }

    public function profileInfo($idTeacher)
    {
        $data = [
            'teacher' => $this->teacherModel->getTeacher($idTeacher)
        ];
        echo view('v_teacher/v_sub_profile/profile-info', $data);
    }

    public function profileSetting($idTeacher)
    {
        $data = [
            'teacher' => $this->teacherModel->getTeacher($idTeacher)
        ];
        echo view('v_teacher/v_sub_profile/profile-setting', $data);
    }

    public function updateProfile()
    {
        $dataTeacher = [
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
        $this->teacherModel->updateProfile($dataTeacher, $this->request->getPost('id'));
        $this->userModel->updateUser($dataUser, $this->idUser);
    }
    // End Profile

    // Start Subject
    public function subjectYear()
    {
        $data = [
            'title' => 'Tahun Ajaran',
        ];
        return view('v_teacher/v_sub_subject/subject-year', $data);
    }

    public function subjectYearData()
    {
        $idTeacher = $this->db->query("SELECT id_teacher FROM tb_teacher WHERE id_user = '$this->idUser'")->getRow()->id_teacher;
        $jml = $this->db->query("SELECT COUNT(id_subject) AS ress FROM tb_subject WHERE id_teacher = '$idTeacher'")->getRow()->ress;
        if ($jml > 0) {
            $data = [
                'subject' => $this->db->query("SELECT * FROM tb_subject WHERE id_teacher = (SELECT id_teacher FROM tb_teacher WHERE id_user = '$this->idUser') GROUP BY school_year")->getResultArray(),
                'jumlah'  => $jml
            ];
        } else {
            $data = [
                'jumlah'  => $jml
            ];
        }

        echo view('v_teacher/v_sub_subject/subject-year-data', $data);
    }

    public function subjectList($year)
    {
        $idTeacher = $this->db->query("SELECT id_teacher FROM tb_teacher WHERE id_user = '$this->idUser'")->getRow()->id_teacher;
        $data = [
            'title'  => 'Mata Pelajaran | ' . $year,
            'year'   => $year,
            'master' => $this->db->query("SELECT school_master FROM tb_teacher WHERE id_user = '$this->idUser'")->getRow()->school_master,
            'VII'    => $this->subjectModel->countSubjectList($idTeacher, 'VII'),
            'VIII'   => $this->subjectModel->countSubjectList($idTeacher, 'VIII'),
            'IX'     => $this->subjectModel->countSubjectList($idTeacher, 'IX'),
        ];
        return view('v_teacher/v_sub_subject/subject-list', $data);
    }

    public function subjectListAll($year)
    {
        $data = [
            'title'  => 'Mata Pelajaran | ' . $year,
            'year'   => $year,
            'master' => $this->db->query("SELECT school_master FROM tb_teacher WHERE id_user = '$this->idUser'")->getRow()->school_master
        ];
        return view('v_teacher/v_sub_subject/subject-list-all', $data);
    }

    public function subjectListDataVII($year)
    {
        $idTeacher = $this->db->query("SELECT id_teacher FROM tb_teacher WHERE id_user = '$this->idUser'")->getRow()->id_teacher;
        $data = [
            'subject' => $this->subjectModel->getSubjectList($idTeacher, $year, 'VII'),
            'year'    => $year
        ];
        echo view('v_teacher/v_sub_subject/subject-list-data-vii', $data);
    }

    public function subjectListDataVIII($year)
    {
        $idTeacher = $this->db->query("SELECT id_teacher FROM tb_teacher WHERE id_user = '$this->idUser'")->getRow()->id_teacher;
        $data = [
            'subject' => $this->subjectModel->getSubjectList($idTeacher, $year, 'VIII'),
            'year'    => $year
        ];

        echo view('v_teacher/v_sub_subject/subject-list-data-viii', $data);
    }

    public function subjectListDataIX($year)
    {
        $idTeacher = $this->db->query("SELECT id_teacher FROM tb_teacher WHERE id_user = '$this->idUser'")->getRow()->id_teacher;
        $data = [
            'subject' => $this->subjectModel->getSubjectList($idTeacher, $year, 'IX'),
            'year'    => $year
        ];

        echo view('v_teacher/v_sub_subject/subject-list-data-ix', $data);
    }

    public function subjectListDataAllVII($year)
    {
        $data = [
            'subject' => $this->subjectModel->getSubjectListAll($year, 'VII'),
            'year'    => $year
        ];
        echo view('v_teacher/v_sub_subject/subject-list-data-vii', $data);
    }

    public function subjectListDataAllVIII($year)
    {
        $data = [
            'subject' => $this->subjectModel->getSubjectListAll($year, 'VIII'),
            'year'    => $year
        ];
        echo view('v_teacher/v_sub_subject/subject-list-data-viii', $data);
    }

    public function subjectListDataAllIX($year)
    {
        $data = [
            'subject' => $this->subjectModel->getSubjectListAll($year, 'IX'),
            'year'    => $year
        ];
        echo view('v_teacher/v_sub_subject/subject-list-data-ix', $data);
    }

    public function subjectShow($year, $idSubject, $semester)
    {
        $data = [
            'title'     => $this->subjectModel->getSubject($idSubject)['subject_name'],
            'subject'   => $this->subjectModel->getSubject($idSubject),
            'semester'  => $semester,
            'idSubject' => $idSubject,
            'year'      => $year,
            'idClass'   => $this->db->query("SELECT id_class FROM tb_subject WHERE id_subject = '$idSubject'")->getRow()->id_class
        ];
        return view('v_teacher/v_sub_subject/subject-show', $data);
    }

    public function subjectDetailModal($idSubject)
    {
        echo json_encode($this->db->query("SELECT * FROM tb_subject INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_subject.id_teacher WHERE id_subject = '$idSubject'")->getRow());
    }

    public function openSubjectPresenceModal($idSubject)
    {
        echo json_encode($this->db->query("SELECT * FROM tb_subject WHERE id_subject = '$idSubject'")->getRow());
    }

    public function subjectPresenceModal($idSubject)
    {
        echo json_encode($this->db->query("SELECT * FROM tb_timetable WHERE id_subject = '$idSubject' GROUP BY day ORDER BY FIELD(day, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")->getResultArray());
    }

    public function getLastHour($idSubject, $day)
    {
        echo json_encode('date_' . $this->db->query("SELECT MAX(lesson_hours) AS ress FROM tb_timetable WHERE day = '$day' AND id_subject = '$idSubject'")->getRow()->ress);
    }

    public function getLastActifity($idSubject, $semester, $week, $day)
    {
        $last = $this->db->query("SELECT MAX(lesson_hours) AS ress FROM tb_timetable WHERE day = '$day' AND id_subject = '$idSubject'")->getRow()->ress;
        $hour = 'date_' . $last;
        $pres = 'presence_' . $last;
        $idClass = $this->db->query("SELECT id_class FROM tb_subject WHERE id_subject = '$idSubject'")->getRow()->id_class;
        $w = str_replace("-", "_", $week);
        $tab = strtolower('tb_presence_' . $w . '_' . $day);

        $dataDate = $this->db->query("SELECT MAX($hour) AS ress FROM $tab WHERE id_class = '$idClass' AND semester = '$semester'")->getRow()->ress;
        $hadir = $this->db->query("SELECT COUNT($pres) AS ress FROM $tab WHERE id_class = '$idClass' AND semester = '$semester' AND $pres = 'hadir'")->getRow()->ress;
        $izin = $this->db->query("SELECT COUNT($pres) AS ress FROM $tab WHERE id_class = '$idClass' AND semester = '$semester' AND $pres = 'izin'")->getRow()->ress;
        $sakit = $this->db->query("SELECT COUNT($pres) AS ress FROM $tab WHERE id_class = '$idClass' AND semester = '$semester' AND $pres = 'sakit'")->getRow()->ress;
        $alpa = $this->db->query("SELECT COUNT($pres) AS ress FROM $tab WHERE id_class = '$idClass' AND semester = '$semester' AND $pres = 'alpa'")->getRow()->ress;

        if (isset($dataDate)) {
            $date = strtotime($dataDate);
            $result = date('H:i:s d-m-Y', $date);
        } else {
            $result = 'Belum ada aktifitas';
        }

        $data = [
            'lastActivity' => $result,
            'hadir'        => $hadir,
            'izin'         => $izin,
            'sakit'        => $sakit,
            'alpa'         => $alpa,
        ];

        echo json_encode($data);
    }

    public function subjectPresenceShow($idSubject, $semester, $week, $day, $choice)
    {
        for ($i = 1; $i <= 16; $i++) {
            if ($week == 'week-' . $i) {
                $pekan = 'Pekan ' . $i;
            }
        }

        $data = [
            'title'    => $this->subjectModel->getSubject($idSubject)['subject_name'],
            'subject'  => $this->subjectModel->getSubject($idSubject),
            'id'       => $idSubject,
            'semester' => $semester,
            'pekan'    => $pekan,
            'week'     => $week,
            'day'      => $day,
            'choice'   => $choice
        ];
        return view('v_teacher/v_sub_subject/subject-presence-show', $data);
    }

    public function subjectPresenceTableFull($idSubject, $semester, $week, $day)
    {
        $tab = $this->subjectModel->getTabPresence($day, $week);

        $this->subjectModel->insertPresence($idSubject, $semester, $day, $week);

        $idClass = $this->subjectModel->getSubject($idSubject)['id_class'];

        $data = [
            'presence'    => $this->subjectModel->getPresenceData($tab, $semester, $idClass),
            'tab'         => $tab,
            'lessonHours' => $this->timetableModel->getLessonHours($idSubject, $day),
            'day'         => $day
        ];

        echo view('v_teacher/v_sub_subject/subject-presence-table-full', $data);
    }

    public function subjectPresenceTableSimple($idSubject, $semester, $week, $day)
    {
        $tab = $this->subjectModel->getTabPresence($day, $week);

        $this->subjectModel->insertPresence($idSubject, $semester, $day, $week);

        $idClass = $this->subjectModel->getSubject($idSubject)['id_class'];

        $data = [
            'presence'    => $this->subjectModel->getPresenceData($tab, $semester, $idClass),
            'tab'         => $tab,
            'lesson'      => $this->timetableModel->getMaxLessonHours($idSubject, $day),
            'day'         => $day
        ];

        echo view('v_teacher/v_sub_subject/subject-presence-table-simple', $data);
    }

    public function printPresenceSimple($idSubject, $semester, $week, $day)
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

    public function printPresenceFull($idSubject, $semester, $week, $day)
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

    public function subjectPresenceUpdateFull()
    {
        $id        = $this->request->getPost('id');
        $presence  = $this->request->getPost('presence');
        $tab       = $this->request->getPost('tab');
        $idSubject = $this->request->getPost('idSubject');
        $lesson    = $this->request->getPost('lesson');
        $date      = date('Y-m-d G:i:s', time());

        $this->db->query("UPDATE $tab SET presence_$lesson = '$presence', date_$lesson = '$date', id_subject_$lesson = '$idSubject' WHERE id_presence = '$id'");
    }

    public function subjectPresenceUpdateSimple()
    {
        $id        = $this->request->getPost('id');
        $presence  = $this->request->getPost('presence');
        $tab       = $this->request->getPost('tab');
        $idSubject = $this->request->getPost('idSubject');
        $day       = $this->request->getPost('day');
        $date      = date('Y-m-d G:i:s', time());
        for ($i = 1; $i <= 9; $i++) {
            ${'lh' . $i} = $this->db->query("SELECT COUNT(lesson_hours) AS resNum FROM tb_timetable WHERE id_subject = '$idSubject' AND day = '$day' AND lesson_hours = '$i'")->getRow()->resNum;
            if (${'lh' . $i} > 0) {
                $this->db->query("UPDATE $tab SET presence_$i = '$presence', date_$i = '$date', id_subject_$i = '$idSubject' WHERE id_presence = '$id'");
            }
        }
    }

    public function subjectScore($id, $semester)
    {
        $data = [
            'title'     => $this->subjectModel->getSubject($id)['subject_name'],
            'subject'   => $this->subjectModel->getSubject($id),
            'kurikulum' => $this->subjectModel->getSubject($id)['kurikulum'],
            'id'        => $id,
            'semester'  => $semester
        ];
        return view('v_teacher/v_sub_subject/subject-score', $data);
    }

    public function subjectScoreTable($idSubject, $semester)
    {
        $kurikulum = $this->subjectModel->getSubject($idSubject)['kurikulum'];

        $this->subjectModel->insertScore($idSubject, $semester, $kurikulum);

        $idClass = $this->subjectModel->getSubject($idSubject)['id_class'];

        if ($kurikulum == 'Merdeka') {
            $tab = 'tb_subject_score_merdeka';
            $eView = 'v_teacher/v_sub_subject/subject-score-table-merdeka';
        } elseif ($kurikulum == 'K-13') {
            $tab = 'tb_subject_score_k13';
            $eView = 'v_teacher/v_sub_subject/subject-score-table-k13';
        }

        $data = [
            'score'     => $this->subjectModel->getScoreData($tab, $semester, $idSubject, $idClass),
            'tab'       => $tab,
            'idSubject' => $idSubject,
            'semester'  => $semester,
            'kurikulum' => $kurikulum
        ];

        echo view($eView, $data);
    }

    public function subjectScoreShowMerdeka()
    {
        $idSubject = $this->request->getPost('idSubject');
        $idStudent = $this->request->getPost('idStudent');
        $semester  = $this->request->getPost('semester');

        echo json_encode($this->db->query("SELECT * FROM tb_subject_score_merdeka WHERE id_subject = '$idSubject' AND id_student = '$idStudent' AND semester = '$semester'")->getRow());
    }

    public function subjectScoreUpdateFormatif()
    {
        for ($i = 1; $i <= 5; $i++) {
            $lm = $this->request->getPost('lm');
            if ($lm == $i) {
                $idSubject = $this->request->getPost('idSubject');
                $idStudent = $this->request->getPost('idStudent');
                $semester = $this->request->getPost('semester');
                ${'lm' . $i . '_tp1'} = $this->request->getPost('lm' . $i . '_tp1');
                ${'lm' . $i . '_tp2'} = $this->request->getPost('lm' . $i . '_tp2');
                ${'lm' . $i . '_tp3'} = $this->request->getPost('lm' . $i . '_tp3');
                ${'lm' . $i . '_tp4'} = $this->request->getPost('lm' . $i . '_tp4');

                $this->subjectModel->updateScoreFormatif($lm, ${'lm' . $i . '_tp1'}, ${'lm' . $i . '_tp2'}, ${'lm' . $i . '_tp3'}, ${'lm' . $i . '_tp4'}, $idSubject, $idStudent, $semester);
                $this->subjectModel->updateNR($idSubject, $idStudent, $semester);
            }
        }
    }

    public function subjectScoreUpdateSumatif()
    {
        $idSubject = $this->request->getPost('idSubject');
        $idStudent = $this->request->getPost('idStudent');
        $semester = $this->request->getPost('semester');
        $lm1 = $this->request->getPost('lm1');
        $lm2 = $this->request->getPost('lm2');
        $lm3 = $this->request->getPost('lm3');
        $lm4 = $this->request->getPost('lm4');
        $lm5 = $this->request->getPost('lm5');

        $this->subjectModel->updateScoreSumatif($lm1, $lm2, $lm3, $lm4, $lm5, $idSubject, $idStudent, $semester);
        $this->subjectModel->updateNR($idSubject, $idStudent, $semester);
    }

    public function subjectScoreUpdateSumatifLast()
    {
        $idSubject = $this->request->getPost('idSubject');
        $idStudent = $this->request->getPost('idStudent');
        $semester = $this->request->getPost('semester');
        $smLast = $this->request->getPost('smLast');

        $this->subjectModel->updateScoreSumatifLast($smLast, $idSubject, $idStudent, $semester);
        $this->subjectModel->updateNR($idSubject, $idStudent, $semester);
    }

    public function subjectScoreShowK13()
    {
        $idSubject = $this->request->getPost('idSubject');
        $idStudent = $this->request->getPost('idStudent');
        $semester  = $this->request->getPost('semester');

        echo json_encode($this->db->query("SELECT * FROM tb_subject_score_k13 WHERE id_subject = '$idSubject' AND id_student = '$idStudent' AND semester = '$semester'")->getRow());
    }

    public function subjectScoreUpdateK13()
    {
        $idSubject = $this->request->getPost('idSubject');
        $idStudent = $this->request->getPost('idStudent');
        $semester = $this->request->getPost('semester');
        $k1 = $this->request->getPost('k1');
        $k2 = $this->request->getPost('k2');
        $opt = $this->request->getPost('opt');
        $pro1 = $this->request->getPost('pro1');
        $pro2 = $this->request->getPost('pro2');
        $opy = $this->request->getPost('opy');
        $sekor = $this->request->getPost('sekor');
        $pos = $this->request->getPost('pos');

        $this->subjectModel->updateScoreK13($pos, $k1, $k2, $opt, $pro1, $pro2, $opy, $sekor, $idSubject, $idStudent, $semester);
    }

    public function printScoreMerdeka($idSubject, $semester)
    {
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
    }

    public function printScoreK13($idSubject, $semester)
    {
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
