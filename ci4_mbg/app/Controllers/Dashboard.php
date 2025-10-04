<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function gudang()
    {
        if (session()->get('role') !== 'gudang') {
            return redirect()->to('/login');
        }
        return view('dashboard_gudang');
    }

    public function dapur()
    {
        if (session()->get('role') !== 'dapur') {
            return redirect()->to('/login');
        }
        return view('dashboard_dapur');
    }
}
