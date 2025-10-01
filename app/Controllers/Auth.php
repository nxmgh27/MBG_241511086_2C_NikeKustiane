<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function doLogin()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // Password di database pakai md5
            if ($user['password'] === md5($password)) {
                session()->set([
                    'user_id' => $user['id'],
                    'name'    => $user['name'],
                    'email'   => $user['email'],
                    'role'    => $user['role'],
                    'logged_in' => true
                ]);

                // Redirect sesuai role
                if ($user['role'] === 'gudang') {
                    return redirect()->to('/dashboard/gudang');
                } else {
                    return redirect()->to('/dashboard/dapur');
                }
            }
        }

        return redirect()->back()->with('error', 'Email atau Password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda berhasil logout');
    }
}
