<?php

namespace App\Controllers;

use App\Models\CabangModel;
use App\Models\UserModel;

class CabangController extends BaseController
{
    protected $userModel;
    protected $cabangModel;
    public function __construct()
    {
        $this->cabangModel = new CabangModel();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $cabang = $this->cabangModel->findAll();

        $data = [
            'tittle' => 'Daftar Cabang',
            'cabang' => $cabang
        ];
        return view('cabang/index', $data);
    }
    public function tambah()
    {
        //session();
        $data = [
            'tittle' => 'Form Tambah Data Cabang',
            'validation' => \Config\Services::validation()
        ];


        return view('cabang/tambah', $data);
    }
    public function simpan()
    {
        //validasi input
        if (!$this->validate([
            'nama_cabang' => [
                'rules' => 'required|is_unique[cabang.nama_cabang]',
                'errors' => [
                    'required' => '{field} Cabang Harus Diisi',
                    'is_unique' => '{field} Cabang Sudah Terdaftar'
                ]
            ]
        ]))
            if (!$this->validate([
                'nama_pic' => [
                    'rules' => 'required[cabang.nama_pic]',
                    'errors' => [
                        'required' => '{field} PIC Harus Diisi'
                    ]
                ]
            ]))
                if (!$this->validate([
                    'email' => [
                        'rules' => 'required[cabang.email]',
                        'errors' => [
                            'required' => '{field} Email Harus Diisi'
                        ]
                    ]
                ]))
                    if (!$this->validate([
                        'no_telp' => [
                            'rules' => 'required[cabang.no_telp]',
                            'errors' => [
                                'required' => '{field} Telp Harus Diisi'
                            ]
                        ]
                    ])) {
                        $validation = \Config\Services::validation();
                        return redirect()->back()->withInput()->with('validation', $validation);
                    }
        $userData = [
            'username' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'user_level' => UserModel::pic, // Sesuaikan dengan user level vendor
        ];

        // Insert data user ke dalam tabel users
        $this->userModel->insert($userData);


        $this->cabangModel->insert([
            'nama_cabang' => $this->request->getPost('nama_cabang'),
            'nama_pic' => $this->request->getPost('nama_pic'),
            'email' => $this->request->getPost('email'),
            'no_telp' => $this->request->getPost('no_telp')

        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('/cabang/index');
    }
    public function hapus($id)
    {
        $cabangModel = new CabangModel();
        $userModel = new UserModel();

        // Retrieve the branch data
        $cabang = $cabangModel->find($id);

        if (!$cabang) {
            return redirect()->to('/cabang')->with('error', 'Data tidak ditemukan.');
        }

        // Delete the user data associated with the branch
        $userModel->where('email', $cabang['email'])->delete();

        // Delete the branch
        $cabangModel->delete($id);

        session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
        return redirect()->to('/cabang/index');
    }

    public function edit($id)
    {
        $cabang = $this->cabangModel->find($id);

        if (!$cabang) {
            return redirect()->to('/cabang')->with('error', 'Data tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Data Cabang',
            'cabang' => $cabang,
        ];

        return view('cabang/edit', $data);
    }

    public function update($id)
    {
        $validationRules = [
            'nama_cabang' => 'required',
            'nama_pic' => 'required',
            'email' => 'required|valid_email',
            'no_telp' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/cabang/edit/' . $id)->withInput()->with('validation', $this->validator);
        }

        $userData = [
            'email' => $this->request->getPost('email'),
        ];

        $password = (string) $this->request->getPost('password');
        if (!empty($password)) {
            $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Update data pada tabel users
        $this->userModel->update($id, $userData);

        // Periksa apakah ada kesalahan pada model users
        if ($this->userModel->errors()) {
            print_r($this->userModel->errors());
            // Atau jika ingin menghentikan proses dan menampilkan pesan kesalahan ke pengguna:
            // return redirect()->to('/cabang/edit/' . $id)->with('error', 'Pesan Kesalahan yang Anda Inginkan');
        }

        // Update data pada tabel cabang
        $this->cabangModel->update($id, [
            'nama_cabang' => $this->request->getPost('nama_cabang'),
            'nama_pic' => $this->request->getPost('nama_pic'),
            'email' => $this->request->getPost('email'),
            'no_telp' => $this->request->getPost('no_telp'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Diedit.');

        return redirect()->to('/cabang/index');
    }


    public function cari()
    {
        $keyword = $this->request->getGet('katakunci');
        $cabang = $this->cabangModel->like('nama_cabang', $keyword)->findAll();

        $data = [
            'tittle' => 'Daftar Cabang',
            'cabang' => $cabang
        ];

        return view('cabang/index', $data);
    }
    public function nonaktifkan($id)
    {
        // Akses model
        $model = new CabangModel();

        // Ubah status menjadi nonaktif
        $model->update($id, ['status' => 'nonaktif']);

        // Redirect atau tampilkan pesan sukses
        return redirect()->to('/cabang/index')->with('pesan', 'Data berhasil dinonaktifkan');
    }
    public function aktifkan($id)
    {
        $model = new CabangModel();

        // Ubah status menjadi aktif
        $model->update($id, ['status' => 'aktif']);

        // Redirect atau tampilkan pesan sukses
        return redirect()->to('/cabang/index')->with('pesan', 'Data berhasil diaktifkan');
    }
}
