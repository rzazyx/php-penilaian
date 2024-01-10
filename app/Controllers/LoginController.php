<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('/login/index');
    }

    public function cekUser()
    {
        $email = $this->request->getPost('email');
        $password = (string) $this->request->getPost('pass');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'pass' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $sessError = [
                'errEmail' => $validation->getError('email'),
                'errPassword' => $validation->getError('pass')
            ];

            session()->setFlashdata($sessError);
            return redirect()->to(site_url('login/index'));
        } else {
            $userModel = new UserModel();

            $cekUserLogin = $userModel->where('email', $email)->first();

            if ($cekUserLogin == null) {
                $sessError = [
                    'errEmail' => 'Maaf User Tidak Terdaftar',
                ];
                session()->setFlashdata($sessError);
                return redirect()->to(site_url('login/index'));
            } else {
                $passwordUser = $cekUserLogin['password'];

                if (password_verify($password, $passwordUser)) {
                    $simpan_session = [
                        'userid' => $cekUserLogin['id'],
                        'email' => $email,
                        'user_level' => $cekUserLogin['user_level'],
                        'logged_in' => TRUE
                    ];

                    session()->set($simpan_session);

                    // Redirect ke halaman dashboard atau halaman lain yang diinginkan
                    return redirect()->to(site_url('penilaian/index')); // Ganti dengan halaman yang diinginkan setelah login berhasil
                } else {
                    $sessError = [
                        'errPassword' => 'Password Salah',
                    ];
                    session()->setFlashdata($sessError);
                    return redirect()->to(site_url('login/index'));
                }
            }
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
