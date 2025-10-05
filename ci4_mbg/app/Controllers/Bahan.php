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
        $data = [
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status' => 'tersedia',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->bahanModel->insert($data);

        return redirect()->to('/bahan')->with('success', 'Bahan baru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $bahan = $this->bahanModel->find($id);

        if (!$bahan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Bahan dengan ID $id tidak ditemukan");
        }

        $today = date('Y-m-d');
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

        return view('bahan/edit', ['bahan' => $bahan]);
    }

    public function update($id)
    {
        $bahan = $this->bahanModel->find($id);

        if (!$bahan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Bahan dengan ID $id tidak ditemukan");
        }

        $today = date('Y-m-d');
        $tglKadaluarsa = $this->request->getPost('tanggal_kadaluarsa');
        $stok = (int)$this->request->getPost('jumlah');

        if ($stok == 0) {
            $status = 'habis';
        } elseif ($today >= $tglKadaluarsa) {
            $status = 'kadaluarsa';
        } elseif ((strtotime($tglKadaluarsa) - strtotime($today)) / (60*60*24) <= 3) {
            $status = 'segera_kadaluarsa';
        } else {
            $status = 'tersedia';
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $tglKadaluarsa,
            'status' => $status,
            'created_at' => $bahan['created_at'] 
        ];

        $this->bahanModel->update($id, $data);

        return redirect()->to('/bahan')->with('success', 'Bahan berhasil diupdate');
    }

    public function delete($id)
    {
        $this->bahanModel->delete($id);
        return redirect()->to('/bahan')->with('success', 'Data berhasil dihapus!');
    }
}
