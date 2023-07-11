<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model
{
    protected $table            = 'tb_subject';
    protected $primaryKey       = 'id_subject';

    public function getSubject($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_subject' => $id])->first();
    }

    public function countSubjectList($idTeacher, $class)
    {
        return $this->db->query("SELECT COUNT(class) AS ress FROM tb_subject WHERE id_teacher = '$idTeacher' AND class LIKE '$class %'")->getRow()->ress;
    }

    public function getSubjectList($idTeacher, $year, $class)
    {
        return $this->db->query("SELECT * FROM tb_subject WHERE id_teacher = '$idTeacher' AND school_year = '$year' AND class LIKE '$class %' ORDER BY class ASC, subject_name ASC")->getResultArray();
    }

    public function getSubjectListAll($year, $class)
    {
        return $this->db->query("SELECT * FROM tb_subject WHERE school_year = '$year' AND class LIKE '$class %' ORDER BY class ASC, subject_name ASC")->getResultArray();
    }

    public function getTabPresence($day, $week)
    {
        for ($i = 1; $i <= 16; $i++) {
            if ($week == 'week-' . $i) {
                return strtolower('tb_presence_week_' . $i . '_' . $day);
            }
        }
    }

    public function getNamaTeacherSubject($idSubject)
    {
        return $this->db->query("SELECT * FROM tb_subject INNER JOIN tb_teacher ON tb_teacher.id_teacher = tb_subject.id_teacher WHERE tb_subject.id_subject = '$idSubject'")->getRow()->name;
    }

    public function getDatePresence($idSubject, $tab, $semester, $lesson)
    {
        $getDate =  $this->db->query("SELECT MAX(date_$lesson) AS ress FROM $tab WHERE id_subject_$lesson = '$idSubject' AND semester = '$semester'")->getRow();

        if (isset($getDate)) {
            return date("d-m-Y", strtotime($getDate->ress));
        } else {
            return '...';
        }
    }

    public function getPresenceData($tab, $semester, $idClass)
    {
        return $this->db->query("SELECT * FROM $tab INNER JOIN tb_student ON tb_student.id_student = $tab.id_student WHERE semester = '$semester' AND id_class = '$idClass'")->getResultArray();
    }

    public function getScoreData($tab, $semester, $idSubject, $idClass)
    {
        return $this->db->query("SELECT * FROM $tab INNER JOIN tb_student ON tb_student.id_student = $tab.id_student WHERE id_subject = '$idSubject' AND semester = '$semester' AND id_class = '$idClass'")->getResultArray();
    }

    public function insertScore($idSubject, $semester, $kurikulum)
    {
        $idClass = $this->db->query("SELECT id_class FROM tb_subject WHERE id_subject = '$idSubject'")->getRow()->id_class;
        $class = $this->db->query("SELECT class FROM tb_subject WHERE id_subject = '$idSubject'")->getRow()->class;
        if ($semester == 'Ganjil') {
            $statSub = $this->db->query("SELECT stat_sub_ganjil FROM tb_subject WHERE id_subject = '$idSubject'")->getRow()->stat_sub_ganjil;
        } elseif ($semester == 'Genap') {
            $statSub = $this->db->query("SELECT stat_sub_genap FROM tb_subject WHERE id_subject = '$idSubject'")->getRow()->stat_sub_genap;
        }

        if (strpos($class, 'IX ') !== false) {
            $tabClass = 'tb_class_ix';
        } elseif (strpos($class, 'VIII ') !== false) {
            $tabClass = 'tb_class_viii';
        } elseif (strpos($class, 'VII ') !== false) {
            $tabClass = 'tb_class_vii';
        }

        if ($kurikulum == 'Merdeka') {
            $tabScore = 'tb_subject_score_merdeka';
        } elseif ($kurikulum == 'K-13') {
            $tabScore = 'tb_subject_score_k13';
        }

        if ($statSub == '0') {
            $this->db->query("INSERT INTO $tabScore (id_class, id_student) SELECT id_class, id_student FROM $tabClass WHERE id_class = '$idClass'");
            $this->db->query("UPDATE $tabScore INNER JOIN $tabClass ON $tabClass.id_student = $tabScore.id_student SET semester  = '$semester', id_subject = '$idSubject' WHERE $tabScore.id_student = $tabClass.id_student AND semester IS NULL");
            if ($semester == 'Ganjil') {
                $this->db->query("UPDATE tb_subject SET stat_sub_ganjil = '1' WHERE id_subject = '$idSubject'");
            } elseif ($semester == 'Genap') {
                $this->db->query("UPDATE tb_subject SET stat_sub_genap = '1' WHERE id_subject = '$idSubject'");
            }
        }
    }

    public function insertPresence($idSubject, $semester, $day, $week)
    {
        for ($i = 1; $i <= 16; $i++) {
            if ($week == 'week-' . $i) {
                $tab = strtolower('tb_presence_week_' . $i . '_' . $day);
            }
        }

        if ($semester == 'Ganjil') {
            for ($i = 1; $i <= 16; $i++) {
                if ($tab == strtolower('tb_presence_week_' . $i . '_' . $day)) {
                    $statPresence = 'stat_presence_week_' . $i . '_' . $day;
                }
            }
        } elseif ($semester == 'Genap') {
            for ($i = 1; $i <= 16; $i++) {
                if ($tab == strtolower('tb_presence_week_' . $i . '_' . $day)) {
                    $statPresence = 'stat_presence_week_' . $i . '_' . $day . '_2';
                }
            }
        }

        $idClass = $this->db->query("SELECT id_class FROM tb_subject WHERE id_subject = '$idSubject'")->getRow()->id_class;
        $class = $this->db->query("SELECT class FROM tb_subject WHERE id_subject = '$idSubject'")->getRow()->class;
        $stat = $this->db->query("SELECT $statPresence FROM tb_class WHERE id_class = '$idClass'")->getRow()->$statPresence;

        if (strpos($class, 'IX ') !== false) {
            $tabClass = 'tb_class_ix';
        } elseif (strpos($class, 'VIII ') !== false) {
            $tabClass = 'tb_class_viii';
        } elseif (strpos($class, 'VII ') !== false) {
            $tabClass = 'tb_class_vii';
        }

        if ($stat == '0') {
            $this->db->query("INSERT INTO $tab (id_class, id_student) SELECT id_class, id_student FROM $tabClass WHERE id_class = '$idClass'");
            $this->db->query("UPDATE $tab SET semester = '$semester' WHERE id_class = '$idClass' AND semester IS NULL");
            $this->db->query("UPDATE tb_class SET $statPresence = '1' WHERE id_class = '$idClass'");
        }
    }

    public function updateScoreFormatif($lm, $lm1, $lm2, $lm3, $lm4, $idSubject, $idStudent, $semester)
    {
        for ($i = 1; $i <= 5; $i++) {
            if ($lm == $i) {
                $tp1 = 'lm' . $i . '_tp1';
                $tp2 = 'lm' . $i . '_tp2';
                $tp3 = 'lm' . $i . '_tp3';
                $tp4 = 'lm' . $i . '_tp4';
                $lm1 = $lm1 == '' && $lm1 !== 0 ? 'NULL' : $lm1;
                $lm2 = $lm2 == '' && $lm2 !== 0 ? 'NULL' : $lm2;
                $lm3 = $lm3 == '' && $lm3 !== 0 ? 'NULL' : $lm3;
                $lm4 = $lm4 == '' && $lm4 !== 0 ? 'NULL' : $lm4;
                $this->db->query("UPDATE tb_subject_score_merdeka SET $tp1 = $lm1, $tp2 = $lm2, $tp3 = $lm3, $tp4 = $lm4 WHERE id_subject = '$idSubject' AND id_student = '$idStudent' AND semester = '$semester'");
            }
        }

        $this->db->query("UPDATE tb_subject_score_merdeka SET average_for = ((lm1_tp1 + lm1_tp2 + lm1_tp3 + lm1_tp4 + lm2_tp1 + lm2_tp2 + lm2_tp3 + lm2_tp4 + lm3_tp1 + lm3_tp2 + lm3_tp3 + lm3_tp4 + lm4_tp1 + lm4_tp2 + lm4_tp3 + lm4_tp4 + lm5_tp1 + lm5_tp2 + lm5_tp3 + lm5_tp4) / 20) WHERE id_subject = '$idSubject' AND id_student = '$idStudent' AND semester = '$semester'");
    }

    public function updateScoreSumatif($lm1, $lm2, $lm3, $lm4, $lm5, $idSubject, $idStudent, $semester)
    {
        $lm1 = $lm1 == '' && $lm1 !== 0 ? 'NULL' : $lm1;
        $lm2 = $lm2 == '' && $lm2 !== 0 ? 'NULL' : $lm2;
        $lm3 = $lm3 == '' && $lm3 !== 0 ? 'NULL' : $lm3;
        $lm4 = $lm4 == '' && $lm4 !== 0 ? 'NULL' : $lm4;
        $lm5 = $lm5 == '' && $lm5 !== 0 ? 'NULL' : $lm5;
        $this->db->query("UPDATE tb_subject_score_merdeka SET sum_lm_1 = $lm1, sum_lm_2 = $lm2, sum_lm_3 = $lm3, sum_lm_4 = $lm4, sum_lm_5 = $lm5 WHERE id_subject = '$idSubject' AND id_student = '$idStudent' AND semester = '$semester'");

        $this->db->query("UPDATE tb_subject_score_merdeka SET average_sum = ((sum_lm_1 + sum_lm_2 + sum_lm_3 + sum_lm_4 + sum_lm_5) / 5) WHERE id_subject = '$idSubject' AND id_student = '$idStudent' AND semester = '$semester'");
    }

    public function updateScoreSumatifLast($smLast, $idSubject, $idStudent, $semester)
    {
        $smLast = $smLast == '' && $smLast !== 0 ? 'NULL' : $smLast;
        $this->db->query("UPDATE tb_subject_score_merdeka SET sum_last = $smLast WHERE id_subject = '$idSubject' AND id_student = '$idStudent' AND semester = '$semester'");
    }

    public function updateScoreK13($pos, $k1, $k2, $opt, $pro1, $pro2, $opy, $sk, $idSubject, $idStudent, $semester)
    {
        for ($h = 1; $h <= 6; $h++) {
            if ($pos == $h) {
                $k1 = $k1 == '' && $k1 !== 0 ? 'NULL' : $k1;
                $k2 = $k2 == '' && $k2 !== 0 ? 'NULL' : $k2;
                $opt = $opt == '' && $opt !== 0 ? 'NULL' : $opt;
                $pro1 = $pro1 == '' && $pro1 !== 0 ? 'NULL' : $pro1;
                $pro2 = $pro2 == '' && $pro2 !== 0 ? 'NULL' : $pro2;
                $opy = $opy == '' && $opy !== 0 ? 'NULL' : $opy;
                $sk = $sk == '' && $sk !== 0 ? 'NULL' : $sk;
                $kin1 = 'ph' . $h . '_kinerja1';
                $kin2 = 'ph' . $h . '_kinerja2';
                $optimum = 'ph' . $h . '_optimum';
                $proyek1 = 'ph' . $h . '_proyek1';
                $proyek2 = 'ph' . $h . '_proyek2';
                $opyimum = 'ph' . $h . '_opyimum';
                $sekor = 'ph' . $h . '_sekor';
                $this->db->query("UPDATE tb_subject_score_k13 SET $kin1 = $k1, $kin2 = $k2, $optimum = $opt, $proyek1 = $pro1, $proyek2 = $pro2, $opyimum = $opy, $sekor = $sk WHERE id_subject = '$idSubject' AND id_student = '$idStudent' AND semester = '$semester'");
            }
        }
    }

    public function updateNR($idSubject, $idStudent, $semester)
    {
        $this->db->query("UPDATE tb_subject_score_merdeka SET nr = ((average_for + average_sum + sum_last) / 3) WHERE id_subject = '$idSubject' AND id_student = '$idStudent' AND semester = '$semester'");
    }
}
