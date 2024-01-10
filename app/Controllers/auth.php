<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VendorModel;
use App\Models\UserModel;

class auth extends BaseController
{
    protected $vendorModel;
    public function __construct()
    {
        $this->vendorModel = new  VendorModel();
    }
    public function index()
    {
        return view('auth/login');
    }
    public function login()
    {
        $model = new VendorModel();
        $session = session();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $model->where('email', $email)->first();

        // Validasi input
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[3]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/auth')->withInput()->with('validation', $this->validator);
        }

        // Ambil data dari form
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Cari user berdasarkan email
        $user = $model->where('email', $email)->first();

        // Tambahkan pernyataan var_dump
        var_dump($user);
        var_dump($user['password']); // Tambahkan ini

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Set session
                $sessionData = [
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    // Tambahkan data sesuai kebutuhan
                ];
                session()->set($sessionData);

                // Redirect ke halaman yang sesuai
                return redirect()->to('/dashboard');
            } else {
                // Password tidak cocok
                session()->setFlashdata('error', 'Password salah.');
                return redirect()->to('/auth')->withInput();
            }
        } else {
            // User tidak ditemukan
            session()->setFlashdata('error', 'Email tidak terdaftar.');
            return redirect()->to('/auth')->withInput();
        }
    }

    public function logout()
    {
        // Hapus semua session
        session()->destroy();

        // Redirect ke halaman login
        return redirect()->to('/auth');
    }
}
