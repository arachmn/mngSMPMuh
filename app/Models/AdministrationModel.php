<?php

namespace App\Models;

use CodeIgniter\Model;

class AdministrationModel extends Model
{
    protected $table            = 'tb_administration';
    protected $primaryKey       = 'id_administration';

    public function getAdministration($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_administration' => $id])->first();
    }

    public function updateProfile($data, $id)
    {
        $update_query = $this->db->table($this->table)->update($data, array('id_administration' => $id));
        return $update_query;
    }
}
