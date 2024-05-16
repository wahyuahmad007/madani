<?php

namespace App\Models;

use CodeIgniter\Model;

class m_user extends Model
{
    protected $table          = 'users';
    protected $primaryKey     = 'id';
    protected $allowedFields  = [
        'username', 'password', 'levels', 'telp', 'alamat', 'email'
    ];

    public function getall()
    {
        $builder = $this->db->table('users');
        $builder->join('levels', 'levels.id_levels=users.levels');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function edit($id_user)
    {
        return $this->where(['id' => $id_user])->first();
    }

    public function user()
    {
        $builder = $this->db->table('users');
        $builder->where('id', session()->id);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
