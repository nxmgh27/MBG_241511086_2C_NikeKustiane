<?php

namespace App\Models;
use CodeIgniter\Model;

class PermintaanDetailModel extends Model
{
    protected $table = 'permintaan_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = ['permintaan_id','bahan_id','jumlah_diminta'];

    public function getByPermintaan($permintaan_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table)
                      ->select('permintaan_detail.*, bahan_baku.nama as bahan_nama, bahan_baku.jumlah as stok')
                      ->join('bahan_baku', 'bahan_baku.id = permintaan_detail.bahan_id')
                      ->where('permintaan_id', $permintaan_id);
        return $builder->get()->getResultArray();
    }
}
