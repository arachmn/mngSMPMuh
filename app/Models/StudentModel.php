<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'tb_student';
    protected $primaryKey       = 'id_student';

    public function getStudent($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_student' => $id])->first();
    }
}
