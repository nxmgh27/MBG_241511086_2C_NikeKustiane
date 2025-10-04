<?php
namespace App\Controllers;
use App\Models\PermintaanModel;

class Dapur extends BaseController
{
    protected $permintaanModel;

    public function __construct()
    {
        $this->permintaanModel = new PermintaanModel();
    }

    public function statusPermintaan()
    {
        $permintaan = $this->permintaanModel->getPermintaanWithDetailDapur();
        return view('dapur/status_permintaan', ['permintaan' => $permintaan]);
    }
}
