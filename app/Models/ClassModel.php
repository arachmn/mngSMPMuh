<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassModel extends Model
{
    protected $table            = 'tb_class';
    protected $primaryKey       = 'id_class';

    public function getClass($id_class = false)
    {
        if ($id_class == false) {
            return $this->findAll();
        }

        return $this->where(['id_class' => $id_class])->first();
    }
}
