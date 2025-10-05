<?php

namespace App\Controllers;

use App\Models\BahanModel;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;

class PermintaanDapur extends BaseController
{
    // Form buat permintaan bahan
    public function create()
    {
        $bahanModel = new BahanModel();

        // hanya bahan yang masih tersedia dan stoknya > 0
        $data['bahan'] = $bahanModel->where('status', 'tersedia')
                                   ->where('jumlah >', 0)
                                   ->findAll();

        return view('dapur/create_permintaan', $data);
    }

    // Simpan permintaan bahan ke database
    public function store()
    {
        $permintaanModel = new PermintaanModel();
        $detailModel = new PermintaanDetailModel();

        // Data utama permintaan
        $dataPermintaan = [
            'tgl_masak'     => $this->request->getPost('tgl_masak'),
            'menu'          => $this->request->getPost('menu_makan'),
            'jumlah_porsi'  => $this->request->getPost('jumlah_porsi'),
            'status'        => 'menunggu'
        ];

        // Simpan ke tabel permintaan
        $permintaanId = $permintaanModel->insert($dataPermintaan);

        // Ambil array bahan & jumlah dari form
        $bahanIds = $this->request->getPost('bahan_id');
        $jumlahs = $this->request->getPost('jumlah_diminta');

        // Simpan ke tabel permintaan_detail
        if ($permintaanId && !empty($bahanIds)) {
            foreach ($bahanIds as $index => $bahanId) {
                if (!empty($bahanId) && !empty($jumlahs[$index])) {
                    $detailModel->insert([
                        'permintaan_id' => $permintaanId,
                        'bahan_id'      => $bahanId,
                        'jumlah'        => $jumlahs[$index]
                    ]);
                }
            }
        }

        return redirect()->to('/dapur/create_permintaan')->with('success', 'Permintaan bahan berhasil dikirim!');
    }

    // Lihat daftar permintaan
    public function status()
    {
        $permintaanModel = new PermintaanModel();
        $data['permintaan'] = $permintaanModel->orderBy('id', 'DESC')->findAll();

        return view('dapur/status_permintaan', $data);
    }
}
