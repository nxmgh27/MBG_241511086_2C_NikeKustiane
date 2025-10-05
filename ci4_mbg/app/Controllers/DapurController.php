<?php

namespace App\Controllers;

use App\Models\BahanModel;
use App\Models\PermintaanModel;

class DapurController extends BaseController
{
    public function index()
    {
        if (session()->get('role') !== 'dapur') {
            return redirect()->to('/login');
        }

        $permintaanModel = new PermintaanModel();
        $data['permintaan'] = $permintaanModel->findAll();

        return view('dapur/status_permintaan', $data);
    }

    public function create()
    {
        if (session()->get('role') !== 'dapur') {
            return redirect()->to('/login');
        }

        $bahanModel = new BahanModel();
        $data['bahan'] = $bahanModel->findAll();

        return view('dapur/create_permintaan', $data);
    }

    public function store()
    {
        $permintaanModel = new \App\Models\PermintaanModel();
        $detailModel = new \App\Models\PermintaanDetailModel();

        // simpan data permintaan utama
        $permintaanData = [
            'pemohon_id'   => session()->get('user_id'), // opsional kalau ada login user
            'tgl_masak'    => $this->request->getPost('tgl_masak'),
            'menu_makan'   => $this->request->getPost('menu_makan'),
            'jumlah_porsi' => $this->request->getPost('jumlah_porsi'),
            'status'       => 'Menunggu'
        ];
        $permintaanModel->insert($permintaanData);

        // ambil ID permintaan baru
        $permintaan_id = $permintaanModel->getInsertID();

        // simpan detail bahan
        $bahan_ids = $this->request->getPost('bahan_id');
        $jumlah_diminta = $this->request->getPost('jumlah_diminta');

        if ($bahan_ids && $jumlah_diminta) {
            foreach ($bahan_ids as $i => $bahan_id) {
                if (!empty($bahan_id) && !empty($jumlah_diminta[$i])) {
                    $detailModel->insert([
                        'permintaan_id' => $permintaan_id,
                        'bahan_id' => $bahan_id,
                        'jumlah_diminta' => $jumlah_diminta[$i]
                    ]);
                }
            }
        }

        session()->setFlashdata('success', 'Permintaan berhasil dikirim!');
        return redirect()->to('/dapur/status_permintaan');
    }

    public function dataBahan()
    {
        if (session()->get('role') !== 'dapur') {
            return redirect()->to('/login');
        }

        $bahanModel = new BahanModel();
        $data['bahan'] = $bahanModel->findAll();

        return view('dapur/data_bahan', $data);
    }

}
