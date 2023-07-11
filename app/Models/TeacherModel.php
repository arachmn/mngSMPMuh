<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherModel extends Model
{
    protected $table            = 'tb_teacher';
    protected $primaryKey       = 'id_teacher';

    public function getTeacher($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_teacher' => $id])->first();
    }

    public function updateProfile($data, $id)
    {
        $update_query = $this->db->table($this->table)->update($data, array('id_teacher' => $id));
        return $update_query;
    }

    public function getMaster()
    {
        return $this->db->query("SELECT name FROM tb_teacher WHERE school_master = 'yes'")->getRow()->name;
    }
}
