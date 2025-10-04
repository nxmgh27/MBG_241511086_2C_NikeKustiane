<?php

namespace App\Controllers;

use App\Models\PermintaanModel;
use CodeIgniter\Controller;

class Permintaan extends Controller
{
    public function index()
    {
        $model = new PermintaanModel();
        $data['permintaan'] = $model->findAll();
        return view('gudang/status_permintaan', $data);
    }
}
