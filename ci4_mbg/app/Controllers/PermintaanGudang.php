<?php

namespace App\Controllers;

use App\Models\BahanModel;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;

class PermintaanDapur extends BaseController
{
    protected $bahanModel;
    protected $permintaanModel;
    protected $permintaanDetailModel;

    public function __construct()
    {
        $this->bahanModel = new BahanModel();
        $this->permintaanModel = new PermintaanModel();
        $this->permintaanDetailModel = new PermintaanDetailModel();
    }

    // Form permintaan bahan
    public function create()
    {
        // Ambil bahan yang stok > 0 & status != kadaluarsa
        $data['bahan'] = $this->bahanModel
                              ->where('jumlah >', 0)
                              ->where('status !=', 'kadaluarsa')
                              ->findAll();

        return view('dapur/create_permintaan', $data);
    }

    // Simpan permintaan
    public function store()
    {
        $menu_makan = $this->request->getPost('menu_makan');
        $tgl_masak = $this->request->getPost('tgl_masak');
        $jumlah_porsi = $this->request->getPost('jumlah_porsi');
        $bahan_ids = $this->request->getPost('bahan_id'); // array
        $jumlah_diminta = $this->request->getPost('jumlah_diminta'); // array

        // Simpan ke tabel permintaan
        $permintaan_id = $this->permintaanModel->insert([
            'tgl_masak' => $tgl_masak,
            'menu_makan' => $menu_makan,
            'jumlah_porsi' => $jumlah_porsi,
            'status' => 'menunggu',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Simpan detail permintaan
        foreach($bahan_ids as $key => $bahan_id) {
            if($bahan_id && $jumlah_diminta[$key] > 0) {
                $this->permintaanDetailModel->insert([
                    'permintaan_id' => $permintaan_id,
                    'bahan_id' => $bahan_id,
                    'jumlah_diminta' => $jumlah_diminta[$key]
                ]);
            }
        }

        return redirect()->to('/dapur/permintaan')->with('success', 'Permintaan berhasil dibuat!');
    }

    // Lihat status permintaan
    public function index()
    {
        $rows = $this->permintaanModel->getPermintaanWithDetail();

        $permintaan = [];
        foreach ($rows as $row) {
            $id = $row['id'];
            if (!isset($permintaan[$id])) {
                $permintaan[$id] = [
                    'id' => $id,
                    'tgl_masak' => $row['tgl_masak'],
                    'menu_makan' => $row['menu_makan'],
                    'jumlah_porsi' => $row['jumlah_porsi'],
                    'status' => $row['status'],
                    'created_at' => $row['created_at'],
                    'detail' => [],
                ];
            }
            if ($row['bahan_id']) {
                $permintaan[$id]['detail'][] = [
                    'bahan_id' => $row['bahan_id'],
                    'bahan_nama' => $row['bahan_nama'],
                    'jumlah_diminta' => $row['jumlah_diminta'],
                    'stok' => $row['stok']
                ];
            }
        }

        $data['permintaan'] = array_values($permintaan);
        return view('dapur/status_permintaan', $data);
    }

}
