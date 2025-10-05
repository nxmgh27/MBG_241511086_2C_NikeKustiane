<?php

namespace App\Controllers;
use App\Models\BahanModel;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;

class PermintaanGudang extends BaseController
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

    // Tampilkan daftar permintaan
    public function statusPermintaan()
    {
        $permintaan = $this->permintaanModel->findAll();

        // Ambil detail per permintaan
        foreach($permintaan as &$p){
            $p['detail'] = $this->permintaanDetailModel
                                ->select('permintaan_detail.*, bahan_baku.nama as bahan_nama, bahan_baku.jumlah as stok')
                                ->join('bahan_baku', 'bahan_baku.id = permintaan_detail.bahan_id')
                                ->where('permintaan_id', $p['id'])
                                ->findAll();
        }

        $data['permintaan'] = $permintaan;
        return view('gudang/status_permintaan', $data);
    }

    // Setujui permintaan
    public function approve($id)
    {
        $permintaan = $this->permintaanModel->find($id);
        if (!$permintaan) {
            return redirect()->back()->with('error', 'Permintaan tidak ditemukan!');
        }

        $detail = $this->permintaanDetailModel
                       ->where('permintaan_id', $id)
                       ->findAll();

        foreach($detail as $d) {
            $bahan = $this->bahanModel->find($d['bahan_id']);
            if ($bahan) {
                $stokAkhir = $bahan['jumlah'] - $d['jumlah_diminta'];
                $statusBahan = $stokAkhir <= 0 ? 'habis' : $bahan['status'];

                $this->bahanModel->update($bahan['id'], [
                    'jumlah' => $stokAkhir,
                    'status' => $statusBahan
                ]);
            }
        }

        $this->permintaanModel->update($id, [
            'status' => 'disetujui'
        ]);

        return redirect()->back()->with('success', 'Permintaan berhasil disetujui!');
    }

    // Tolak permintaan
    public function reject($id)
    {
        $alasan = $this->request->getPost('alasan');

        $this->permintaanModel->update($id, [
            'status' => 'ditolak',
            'alasan' => $alasan
        ]);

        return redirect()->back()->with('error', 'Permintaan ditolak. Alasan: ' . $alasan);
    }

    

    public function edit_status($id)
    {
        $status = $this->request->getPost('status');
        if($status) {
            $this->permintaanModel->update($id, ['status' => $status]);
            return redirect()->to('/gudang/status_permintaan')->with('success', 'Status berhasil diperbarui');
        }
        return redirect()->to('/gudang/status_permintaan')->with('error', 'Gagal memperbarui status');
    }

}
