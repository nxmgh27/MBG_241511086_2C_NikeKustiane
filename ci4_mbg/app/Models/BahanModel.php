<?php

namespace App\Models;
use CodeIgniter\Model;

class BahanModel extends Model
{
    protected $table = 'bahan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama', 'kategori', 'jumlah', 'satuan',
        'tanggal_masuk', 'tanggal_kadaluarsa', 'status'
    ];
}
