<?php 
namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getVar('email');
        $password = md5($this->request->getVar('password'));

        $user = $model->getUserByEmail($email);

        if ($user) {
            if ($user['password'] === $password) {
                $session->set([
                    'id'    => $user['id'],
                    'name'  => $user['name'],
                    'email' => $user['email'],
                    'role'  => $user['role'],
                    'logged_in' => true
                ]);

                // Redirect sesuai role
                if ($user['role'] == 'gudang') {
                    return redirect()->to('/dashboard/gudang');
                } else {
                    return redirect()->to('/dashboard/dapur');
                }
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
