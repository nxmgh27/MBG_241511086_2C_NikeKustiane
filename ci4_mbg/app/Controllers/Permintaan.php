<?php

namespace App\Controllers;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;
use App\Models\BahanModel;

class Permintaan extends BaseController
{
    protected $permintaanModel;
    protected $permintaanDetailModel;
    protected $bahanModel;

    public function __construct()
    {
        $this->permintaanModel = new PermintaanModel();
        $this->permintaanDetailModel = new PermintaanDetailModel();
        $this->bahanModel = new BahanModel();
    }

    public function statusPermintaan()
    {
        $permintaanList = $this->permintaanModel->orderBy('created_at', 'DESC')->findAll();
        $dataPermintaan = [];

        foreach ($permintaanList as $p) {
            $details = $this->permintaanDetailModel
                            ->select('permintaan_detail.*, bahan_baku.nama as bahan_nama, bahan_baku.jumlah as stok')
                            ->join('bahan_baku', 'bahan_baku.id = permintaan_detail.bahan_id')
                            ->where('permintaan_id', $p['id'])
                            ->findAll();

            $dataPermintaan[] = [
                'id' => $p['id'],
                'menu_makan' => $p['menu_makan'],
                'jumlah_porsi' => $p['jumlah_porsi'],
                'tgl_masak' => $p['tgl_masak'],
                'status' => $p['status'],
                'created_at' => $p['created_at'],
                'detail' => $details
            ];
        }

        return view('gudang/status_permintaan', ['permintaan' => $dataPermintaan]);
    }

    public function approve($id)
    {
        $details = $this->permintaanDetailModel->where('permintaan_id', $id)->findAll();

        foreach($details as $d){
            $bahan = $this->bahanModel->find($d['bahan_id']);
            if($bahan){
                $stokAkhir = $bahan['jumlah'] - $d['jumlah_diminta'];
                $statusBahan = $stokAkhir <= 0 ? 'habis' : $bahan['status'];

                $this->bahanModel->update($bahan['id'], [
                    'jumlah' => $stokAkhir,
                    'status' => $statusBahan
                ]);
            }
        }

        $this->permintaanModel->update($id, ['status' => 'disetujui']);
        return redirect()->to('/gudang/status_permintaan')->with('success', 'Permintaan disetujui.');
    }

    public function reject($id)
    {
        $alasan = $this->request->getPost('alasan');
        $this->permintaanModel->update($id, ['status' => 'ditolak', 'alasan' => $alasan]);
        return redirect()->to('/gudang/status_permintaan')->with('success', 'Permintaan ditolak.');
    }
}
