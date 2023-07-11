<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'tb_user';
    protected $primaryKey       = 'id_user';

    public function getUser($id_user = false)
    {
        if ($id_user == false) {
            return $this->findAll();
        }

        return $this->where(['id_user' => $id_user])->first();
    }

    public function updateUser($data, $id)
    {
        $update_query = $this->db->table($this->table)->update($data, array('id_user' => $id));
        return $update_query;
    }
}
