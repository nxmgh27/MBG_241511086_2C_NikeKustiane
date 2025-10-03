<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BahanBakuModel;

class BahanBaku extends BaseController
{
    protected $bahanBakuModel;

    public function __construct()
    {
        $this->bahanBakuModel = new BahanBakuModel();
    }

    // tampilkan daftar bahan baku
    public function index()
    {
        $bahanBaku = $this->bahanBakuModel->findAll();
        return view('bahan_baku/index', ['bahanBaku' => $bahanBaku]);
    }

    // tampilkan form tambah
    public function create()
    {
        return view('bahan_baku/create');
    }

    // simpan data ke database
    public function store()
    {
        $data = [
            'nama'               => $this->request->getPost('nama'),
            'kategori'           => $this->request->getPost('kategori'),
            'jumlah'             => $this->request->getPost('jumlah'),
            'satuan'             => $this->request->getPost('satuan'),
            'tanggal_masuk'      => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status'             => 'Tersedia'
        ];

        $this->bahanBakuModel->insert($data);

        return redirect()->to('/bahanbaku')->with('success', 'Bahan baku berhasil ditambahkan!');
    }
}
