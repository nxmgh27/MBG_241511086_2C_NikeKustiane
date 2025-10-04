<?php

namespace App\Models;
use CodeIgniter\Model;

class PermintaanModel extends Model
{
    protected $table = 'permintaan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pemohon_id','tgl_masak','menu_makan','jumlah_porsi','status','created_at'];

    // Ambil semua permintaan beserta detail bahan
    public function getPermintaanWithDetail()
    {
        $builder = $this->db->table('permintaan p')
                    ->select('p.*, pd.bahan_id, pd.jumlah_diminta, b.nama as bahan_nama, b.jumlah as stok')
                    ->join('permintaan_detail pd', 'pd.permintaan_id = p.id', 'left')
                    ->join('bahan_baku b', 'b.id = pd.bahan_id', 'left')
                    ->orderBy('p.created_at', 'DESC');
        return $builder->get()->getResultArray();
    }

    // Method khusus untuk Dapur
    public function getPermintaanWithDetailDapur()
    {
        $builder = $this->db->table('permintaan p')
                    ->select('p.*, pd.bahan_id, pd.jumlah_diminta, b.nama as bahan_nama, b.jumlah as stok')
                    ->join('permintaan_detail pd', 'pd.permintaan_id = p.id', 'left')
                    ->join('bahan_baku b', 'b.id = pd.bahan_id', 'left')
                    ->orderBy('p.created_at', 'DESC');

        return $builder->get()->getResultArray();
    }

}
