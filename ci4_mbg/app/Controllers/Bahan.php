<?php

namespace App\Controllers;
use App\Models\BahanModel;

class Bahan extends BaseController
{
    protected $bahanModel;

    public function __construct()
    {
        $this->bahanModel = new BahanModel();
    }

    public function index()
    {
        $bahanList = $this->bahanModel->findAll();
        $today = date('Y-m-d');

        foreach ($bahanList as &$bahan) {
            $tglKadaluarsa = $bahan['tanggal_kadaluarsa'];
            $stok = (int)$bahan['jumlah'];

            if ($stok == 0) {
                $bahan['status'] = 'habis';
            } elseif ($today >= $tglKadaluarsa) {
                $bahan['status'] = 'kadaluarsa';
            } elseif ((strtotime($tglKadaluarsa) - strtotime($today)) / (60*60*24) <= 3) {
                $bahan['status'] = 'segera_kadaluarsa';
            } else {
                $bahan['status'] = 'tersedia';
            }
        }

        $data['bahan'] = $bahanList;
        return view('bahan/index', $data);
    }

    public function create()
    {
        return view('bahan/create');
    }

    public function store()
    {
        $this->bahanModel->save([
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status' => 'tersedia',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/bahan')->with('success', 'Bahan Baku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data['bahan'] = $this->bahanModel->find($id);
        return view('bahan/edit', $data);
    }

    public function update($id)
    {
        $jumlah = $this->request->getPost('jumlah');
        if ($jumlah < 0) {
            return redirect()->back()->with('error', 'Jumlah stok tidak boleh kurang dari 0!');
        }

        $this->bahanModel->update($id, [
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah' => $jumlah,
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/bahan')->with('success', 'Data berhasil diupdate!');
    }

    public function delete($id)
    {
        $this->bahanModel->delete($id);
        return redirect()->to('/bahan')->with('success', 'Data berhasil dihapus!');
    }
}
