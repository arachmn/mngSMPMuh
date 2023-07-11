<?php

namespace App\Models;

use CodeIgniter\Model;

class TimetableModel extends Model
{
    protected $table            = 'tb_timetable';
    protected $primaryKey       = 'id_timetable';

    public function getTimetable($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_timetable' => $id])->first();
    }

    public function getDayTimetable($idTeacher, $day, $year)
    {
        return $this->db->query("SELECT * FROM tb_timetable INNER JOIN tb_subject ON tb_subject.id_subject = tb_timetable.id_subject WHERE tb_timetable.id_teacher = '$idTeacher' AND day = '$day' AND school_year = '$year' ORDER BY lesson_hours")->getResultArray();
    }

    public function getLessonHours($idSubject, $day)
    {
        return $this->db->query("SELECT lesson_hours FROM tb_timetable WHERE id_subject = '$idSubject' AND day = '$day'")->getResultArray();
    }

    public function getMaxLessonHours($idSubject, $day)
    {
        return $this->db->query("SELECT MAX(lesson_hours) AS ress FROM tb_timetable WHERE id_subject = '$idSubject' AND day = '$day'")->getRow()->ress;
    }

    public function countLessonHours($idSubject, $day, $hours)
    {
        return $this->db->query("SELECT COUNT(lesson_hours) AS ress FROM tb_timetable WHERE id_subject = '$idSubject' AND day = '$day' AND lesson_hours = $hours")->getRow()->ress;
    }
    public function countIdSubject($idSubject, $day)
    {
        return $this->db->query("SELECT COUNT(id_subject) AS ress FROM tb_timetable WHERE id_subject = '$idSubject' AND day = '$day'")->getRow()->ress;
    }
}
