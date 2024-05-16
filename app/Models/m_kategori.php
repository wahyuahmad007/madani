<?php

namespace App\Models;

use CodeIgniter\Model;

class m_kategori extends Model
{
    protected $table      = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = ['nm_kategori'];
}
