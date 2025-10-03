<?php

namespace App\Controllers;

use App\Models\BahanBakuModel;

class Dashboard extends BaseController
{
    public function gudang()
    {
        $model = new BahanBakuModel();
        $data['bahanBaku'] = $model->findAll();

        return view('dashboard/gudang', $data);
    }

    public function dapur()
    {
        return view('dashboard/dapur');
    }
}
