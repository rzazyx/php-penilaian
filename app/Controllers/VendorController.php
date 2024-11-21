<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\VendorModel;

class VendorController extends BaseController
{
    protected $vendorModel;
    protected $userModel;
    public function __construct()
    {

        $this->vendorModel = new VendorModel();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $katakunci = $this->request->getGet('katakunci');
        $vendor = $this->vendorModel->findAll();

        if (!empty($katakunci)) {
            $vendor = $this->vendorModel->like('nama_vendor', $katakunci)->findAll();
        } else {
            $vendor = $this->vendorModel->findAll();
        }


        $data = [
            'tittle' => 'Daftar Vendor',
            'vendor' => $vendor
        ];
        return view('vendor/index', $data);
    }
    public function tambah()
    {
        //session();
        $data = [
            'tittle' => 'Form Tambah Data Vendor',
            'validation' => \Config\Services::validation()
        ];


        return view('vendor/tambah', $data);
    }
    public function simpan()
    {
        // dd($_POST);
        //validasi input
        $data = $this->request->getPost();
        if (!$this->validate([
            'nama_vendor' => [
                'rules' => 'required|is_unique[vendor.nama_vendor]',
                'errors' => [
                    'required' => '{field} Vendor Harus Diisi',
                    'is_unique' => '{field} Vendor Sudah Terdaftar'
                ]
            ]
        ]))
            if (!$this->validate([
                'nama_user' => [
                    'rules' => 'required[vendor.nama_users]',
                    'errors' => [
                        'required' => '{field} User Harus Diisi'
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
                        'password' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Password Harus Diisi'
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
        //simpan user

        // Simpan data user
        $userData = [
            'username' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'user_level' => UserModel::vendor, // Sesuaikan dengan user level vendor
        ];

        // Insert data user ke dalam tabel users
        $this->userModel->insert($userData);


        $data = [
            'nama_vendor' => $this->request->getPost('nama_vendor'),
            'nama_user' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'no_telp' => $this->request->getPost('no_telp')
        ];

        $this->vendorModel->insert($data);


        // $data = [

        //     'nama_user' => $this->request->getPost('nama_user'),
        //     'email' => $this->request->getPost('email'),
        //     'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        //     'no_telp' => $this->request->getPost('no_telp'),
        //     'role'=>'vendor'
        // ];
        //$this->userModel->insert($data);
        //mengambil id yang terakhir ditambahkan
        //$idUserTerakhir=$id_useruserModel->insertID();
        //DATA VENDOR
        // $data = [
        //     'nama_vendor' => $this->request->getPost('nama_vendor'),
        //     'id_user'=>$idUserTerakhir
        // ];

        // $this->vendorModel->insert($data);


        // $this->vendorModel->insert([
        //     'nama_vendor' => $this->request->getPost('nama_vendor'),
        //     'nama_user' => $this->request->getPost('nama_user'),
        //     'email' => $this->request->getPost('email'),
        //     'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        //     'no_telp' => $this->request->getPost('no_telp')

        // ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('/vendor/index');
    }
    public function hapus($id)
    {
        $vendorModel = new VendorModel();
        $userModel = new UserModel();

        // Retrieve the vendor data
        $vendor = $vendorModel->find($id);

        if (!$vendor) {
            return redirect()->to('/vendor')->with('error', 'Data tidak ditemukan.');
        }

        // Delete the user data associated with the vendor
        $userModel->where('email', $vendor['email'])->delete();

        // Delete the vendor
        $vendorModel->delete($id);

        session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
        return redirect()->to('/vendor/index');
    }
    public function edit($id)
    {
        $vendor = $this->vendorModel->find($id);

        if (!$vendor) {
            return redirect()->to('/vendor/index')->with('error', 'Vendor tidak ditemukan.');
        }

        // Retrieve the original user data associated with the vendor
        $userModel = new UserModel();
        $userData = $userModel->where('email', $vendor['email'])->first();

        $data = [
            'title' => 'Edit Data Vendor',
            'vendor' => $vendor,
            'userData' => $userData, // Pass the user data to the view
            'validation' => \Config\Services::validation(),
        ];

        return view('vendor/edit', $data);
    }
    public function update($id)
    {
        $data = $this->request->getPost();

        if (!$this->validate([
            'nama_vendor' => 'required|is_unique[vendor.nama_vendor,id,' . $id . ']',
            'nama_user' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required',
            'no_telp' => 'required',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Update vendor data
        $this->vendorModel->update($id, [
            'nama_vendor' => $data['nama_vendor'],
            'nama_user' => $data['nama_user'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'no_telp' => $data['no_telp'],
        ]);

        // Update user data
        $userModel = new UserModel();

        // Get the user ID associated with the vendor
        $vendor = $this->vendorModel->find($id);
        $userId = $vendor['id']; // Assuming the user ID is the same as the vendor ID

        $userModel->update($userId, [
            'username' => $data['nama_user'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            // Add other user data fields if needed
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Diperbarui.');
        return redirect()->to('/vendor/index');
    }
    public function nonaktifkan($id)
    {
        // Mengakses model
        $model = new VendorModel();

        // Ubah status menjadi nonaktif
        $model->update($id, ['status' => 'nonaktif']);

        // Redirect atau tampilkan pesan sukses
        return redirect()->to('/vendor/index')->with('pesan', 'Data berhasil dinonaktifkan');
    }
    public function aktifkan($id)
    {
        $model = new VendorModel();

        // Ubah status menjadi aktif
        $model->update($id, ['status' => 'aktif']);

        // Redirect atau tampilkan pesan sukses
        return redirect()->to('/vendor/index')->with('pesan', 'Data berhasil diaktifkan');
    }
}
