<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function gudang()
    {
        return view('dashboard/gudang');
    }

    public function dapur()
    {
        return view('dashboard/dapur');
    }
}
