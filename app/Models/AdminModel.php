<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'tb_admin';
    protected $primaryKey       = 'id_admin';

    public function getAdmin($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_admin' => $id])->first();
    }

    public function updateProfile($data, $id)
    {
        $update_query = $this->db->table($this->table)->update($data, array('id_admin' => $id));
        return $update_query;
    }
}
