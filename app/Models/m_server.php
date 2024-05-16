<?php

namespace App\Models;

use CodeIgniter\Model;

class m_server extends Model
{
    protected $table          = 'server';
    protected $primaryKey = "id";
    protected $allowedFields  = [
        'server_key', 'client_key'
    ];
}
