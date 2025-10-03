<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        // cek user + password (pakai md5 karena db masih md5)
        if ($user && md5($password) === $user['password']) {
            session()->set([
                'id'    => $user['id'],
                'name'  => $user['name'],
                'email' => $user['email'],
                'role'  => $user['role'],
                'logged_in' => true
            ]);

            // redirect sesuai role
            if ($user['role'] === 'gudang') {
                return redirect()->to('/dashboard/gudang');
            } elseif ($user['role'] === 'dapur') {
                return redirect()->to('/dashboard/dapur');
            }
        }

        return redirect()->back()->with('error', 'Email atau Password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
