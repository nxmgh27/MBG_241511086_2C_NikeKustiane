<?php

namespace App\Models;
use CodeIgniter\Model;

class BahanModel extends Model
{
    protected $table = 'bahan_baku';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama', 'kategori', 'jumlah', 'satuan', 'status', 'tanggal_masuk', 'tanggal_kadaluarsa', 'created_at'
    ];
    
    protected $useTimestamps = false;
}
