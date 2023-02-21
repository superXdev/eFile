<?php

namespace App\Models;

use CodeIgniter\Model;

class Fakultas extends Model
{
    protected $table            = 'fakultas';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama_fakultas', 'tanggal'];
}
