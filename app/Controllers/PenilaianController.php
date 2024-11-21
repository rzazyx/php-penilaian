<?php
// app/Controllers/PenilaianController.php

namespace App\Controllers;

use App\Models\PenilaianModel;
use App\Models\KontrakModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class PenilaianController extends BaseController
{
    protected $penilaianModel;
    protected $kontrakModel;

    public function __construct()
    {
        $this->penilaianModel = new PenilaianModel();
        $this->kontrakModel = new KontrakModel();
    }

    public function tambah($kontrakId)
    {
        // Kirim ID kontrak ke view untuk digunakan dalam hidden field
        $data['kontrakId'] = $kontrakId;

        return view('penilaian/tambah', $data);
    }

    public function index()
    {

        $nama_vendor = session()->get('nama_cabang');
        // dd($nama_vendor);
        // $penilaian = $this->penilaianModel->getPenilaianByVendor($nama_vendor);

        // dd($nama_vendor, $penilaian);
        $data = [
            'title' => 'Penilaian Kontrak',
            'penilaian' => $this->penilaianModel->findAll(),
        ];
        // dd($data);
        // $penilaian = $this->penilaianModel->getPenilaianByVendor($nama_vendor);

        // $data = [
        //     'title' => 'Penilaian Kontrak',
        //     'penilaian' => $penilaian
        // ];

        return view('penilaian/index', $data);
    }
    public function personil($id)
    {
        $data = [
            'id' => $id
        ];
        return view('penilaian/personil', $data);
    }

    public function tambahPersonil($id)
    {
        // Lakukan validasi
        $validation = \Config\Services::validation();
        $validation->setRules([
            'total' => 'required|numeric',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);

        // Jalankan validasi
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Tangani upload gambar
        $gambar1 = $this->request->getFile('g_personil1');
        $gambar2 = $this->request->getFile('g_personil2');
        $gambar3 = $this->request->getFile('g_personil3');
        $gambar4 = $this->request->getFile('g_personil4');
        $gambar5 = $this->request->getFile('g_personil5');

        // Pastikan file gambar telah diunggah
        if (!$gambar1->isValid() || !$gambar2->isValid() || !$gambar3->isValid() || !$gambar4->isValid() || !$gambar5->isValid()) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah gambar.');
        }

        // Generate nama file yang unik
        $namaGambar1 = $gambar1->getRandomName();
        $namaGambar2 = $gambar2->getRandomName();
        $namaGambar3 = $gambar3->getRandomName();
        $namaGambar4 = $gambar4->getRandomName();
        $namaGambar5 = $gambar5->getRandomName();

        // Pindahkan gambar ke direktori yang ditentukan
        $gambar1->move('public/uploads', $namaGambar1);
        $gambar2->move('public/uploads', $namaGambar2);
        $gambar3->move('public/uploads', $namaGambar3);
        $gambar4->move('public/uploads', $namaGambar4);
        $gambar5->move('public/uploads', $namaGambar5);

        // Siapkan data untuk disimpan ke dalam database
        $data = [
            'id' => $id,
            'personil' => $this->request->getVar('total'),
            'nilai_personil1' => $this->request->getVar('personil1'),
            'nilai_personil2' => $this->request->getVar('personil11'),
            'nilai_personil3' => $this->request->getVar('personil21'),
            'nilai_personil4' => $this->request->getVar('personil31'),
            'nilai_personil5' => $this->request->getVar('personil41'),
            'gambar_personil1' => $namaGambar1,
            'gambar_personil2' => $namaGambar2,
            'gambar_personil3' => $namaGambar3,
            'gambar_personil4' => $namaGambar4,
            'gambar_personil5' => $namaGambar5
            // Tambahkan gambar lainnya sesuai kebutuhan
        ];

        // Simpan data ke dalam database
        // Lakukan update
        if (!$this->penilaianModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data.');
        }

        session()->setFlashdata('pesan', 'Data Berhasil Diupdate.');
        return redirect()->to('/penilaian/index');
    }

    public function editpersonil($id)
    {
        // Ambil data penilaian berdasarkan ID
        $penilaian = $this->penilaianModel->find($id);

        // Kirim data penilaian ke view untuk ditampilkan dalam form edit
        return view('penilaian/editpersonil', ['penilaian' => $penilaian]);
    }

    public function updatepersonil($id)
    {
        // Validate the form data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'personil1' => 'required|numeric',
            'personil2' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Handle file uploads
        $gambar1 = $this->request->getFile('g_personil1');
        $gambar2 = $this->request->getFile('g_personil2');
        $gambar3 = $this->request->getFile('g_personil3');
        $gambar4 = $this->request->getFile('g_personil4');
        $gambar5 = $this->request->getFile('g_personil5');

        if (!$gambar1->isValid() || !$gambar2->isValid() || !$gambar3->isValid() || !$gambar4->isValid() || !$gambar5->isValid()) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah gambar.');
        }

        // Generate nama file yang unik
        $namaGambar1 = $gambar1->getRandomName();
        $namaGambar2 = $gambar2->getRandomName();
        $namaGambar3 = $gambar3->getRandomName();
        $namaGambar4 = $gambar4->getRandomName();
        $namaGambar5 = $gambar5->getRandomName();

        // Pindahkan gambar ke direktori yang ditentukan
        $gambar1->move('public/uploads', $namaGambar1);
        $gambar2->move('public/uploads', $namaGambar2);
        $gambar3->move('public/uploads', $namaGambar3);
        $gambar4->move('public/uploads', $namaGambar4);
        $gambar5->move('public/uploads', $namaGambar5);

        // Prepare data to be saved into the database
        $data = [
            // Assign data from the form inputs or processed files here
            'id' => $id,
            'personil' => $this->request->getVar('total'),
            'nilai_personil1' => $this->request->getVar('personil1'),
            'nilai_personil2' => $this->request->getVar('personil11'),
            'nilai_personil3' => $this->request->getVar('personil21'),
            'nilai_personil4' => $this->request->getVar('personil31'),
            'nilai_personil5' => $this->request->getVar('personil41'),
            'gambar_personil1' => $namaGambar1,
            'gambar_personil2' => $namaGambar2,
            'gambar_personil3' => $namaGambar3,
            'gambar_personil4' => $namaGambar4,
            'gambar_personil5' => $namaGambar5

        ];

        // Update the database record
        if (!$this->penilaianModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Failed to update data.');
        }

        // Redirect with success message if the update is successful
        return redirect()->to('/penilaian/index')->with('success', 'Data updated successfully.');
    }

    public function kinerja($id)
    {
        $data = [
            'id'    => $id
        ];
        return view('penilaian/kinerja', $data);
    }
    public function tambahKinerja($id)
    {
        // Validasi data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'personil1' => 'required|numeric',
            'personil11' => 'required|numeric',
            'personil21' => 'required|numeric',
            'personil31' => 'required|numeric',
            'personil41' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Tangani upload gambar
        $gambar1 = $this->request->getFile('g_kinerja1');
        $gambar2 = $this->request->getFile('g_kinerja2');
        $gambar3 = $this->request->getFile('g_kinerja3');
        $gambar4 = $this->request->getFile('g_kinerja4');
        $gambar5 = $this->request->getFile('g_kinerja5');
        // Tangani upload gambar lainnya sesuai kebutuhan

        // Pastikan file gambar telah diunggah
        if (!$gambar1->isValid() || !$gambar2->isValid() || !$gambar3->isValid() || !$gambar4->isValid() || !$gambar5->isValid()) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah gambar.');
        }

        // Generate nama file yang unik
        $namaGambar1 = $gambar1->getRandomName();
        $namaGambar2 = $gambar2->getRandomName();
        $namaGambar3 = $gambar3->getRandomName();
        $namaGambar4 = $gambar4->getRandomName();
        $namaGambar5 = $gambar5->getRandomName();

        // Pindahkan gambar ke direktori yang ditentukan
        $gambar1->move('public/uploads', $namaGambar1);
        $gambar2->move('public/uploads', $namaGambar2);
        $gambar3->move('public/uploads', $namaGambar3);
        $gambar4->move('public/uploads', $namaGambar4);
        $gambar5->move('public/uploads', $namaGambar5);


        // Siapkan data untuk disimpan ke dalam database
        $data = [
            'id' => $id,
            'kinerja' => $this->request->getVar('total'),
            'kinerja1' => $this->request->getVar('personil1'),
            'kinerja2' => $this->request->getVar('personil11'),
            'kinerja3' => $this->request->getVar('personil21'),
            'kinerja4' => $this->request->getVar('personil31'),
            'kinerja5' => $this->request->getVar('personil41'),
            'gambar_kinerja1' => $namaGambar1,
            'gambar_kinerja2' => $namaGambar2,
            'gambar_kinerja3' => $namaGambar3,
            'gambar_kinerja4' => $namaGambar4,
            'gambar_kinerja5' => $namaGambar5
            // Masukkan nama gambar lainnya sesuai kebutuhan
        ];

        // Simpan data ke dalam database
        // Lakukan insert data baru
        if (!$this->penilaianModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data.');
        }

        session()->setFlashdata('pesan', 'Data Berhasil Diupdate.');
        return redirect()->to('/penilaian/index');
    }
    public function editkinerja($id)
    {
        // Ambil data penilaian berdasarkan ID
        $penilaian = $this->penilaianModel->find($id);

        // Kirim data penilaian ke view untuk ditampilkan dalam form edit
        return view('penilaian/editkinerja', ['penilaian' => $penilaian]);
    }

    public function updatekinerja($id)
    {
        // Validate the form data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'personil1' => 'required|numeric',
            'personil2' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Handle file uploads
        $gambar1 = $this->request->getFile('g_kinerja1');
        $gambar2 = $this->request->getFile('g_kinerja2');
        $gambar3 = $this->request->getFile('g_kinerja3');
        $gambar4 = $this->request->getFile('g_kinerja4');
        $gambar5 = $this->request->getFile('g_kinerja5');

        if (!$gambar1->isValid() || !$gambar2->isValid() || !$gambar3->isValid() || !$gambar4->isValid() || !$gambar5->isValid()) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah gambar.');
        }

        // Generate nama file yang unik
        $namaGambar1 = $gambar1->getRandomName();
        $namaGambar2 = $gambar2->getRandomName();
        $namaGambar3 = $gambar3->getRandomName();
        $namaGambar4 = $gambar4->getRandomName();
        $namaGambar5 = $gambar5->getRandomName();

        // Pindahkan gambar ke direktori yang ditentukan
        $gambar1->move('public/uploads', $namaGambar1);
        $gambar2->move('public/uploads', $namaGambar2);
        $gambar3->move('public/uploads', $namaGambar3);
        $gambar4->move('public/uploads', $namaGambar4);
        $gambar5->move('public/uploads', $namaGambar5);

        // Prepare data to be saved into the database
        $data = [
            // Assign data from the form inputs or processed files here
            'id' => $id,
            'kinerja' => $this->request->getVar('total'),
            'kinerja1' => $this->request->getVar('personil1'),
            'kinerja2' => $this->request->getVar('personil11'),
            'kinerja3' => $this->request->getVar('personil21'),
            'kinerja4' => $this->request->getVar('personil31'),
            'kinerja5' => $this->request->getVar('personil41'),
            'gambar_kinerja1' => $namaGambar1,
            'gambar_kinerja2' => $namaGambar2,
            'gambar_kinerja3' => $namaGambar3,
            'gambar_kinerja4' => $namaGambar4,
            'gambar_kinerja5' => $namaGambar5

        ];

        // Update the database record
        if (!$this->penilaianModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Failed to update data.');
        }

        // Redirect with success message if the update is successful
        return redirect()->to('/penilaian/index')->with('success', 'Data updated successfully.');
    }

    public function m_mitra($id)
    {
        $data = [
            'id'    => $id
        ];
        return view('penilaian/manajemen', $data);
    }
    public function tambahmanajemen($id)
    {
        // Validasi data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'personil1' => 'required|numeric',
            'personil11' => 'required|numeric',
            'personil21' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Tangani upload gambar
        $gambar1 = $this->request->getFile('g_mitra1');
        $gambar2 = $this->request->getFile('g_mitra2');
        $gambar3 = $this->request->getFile('g_mitra3');
        // Tangani upload gambar lainnya sesuai kebutuhan

        // Pastikan file gambar telah diunggah
        if (!$gambar1->isValid() || !$gambar2->isValid() || !$gambar3->isValid()) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah gambar.');
        }

        // Generate nama file yang unik
        $namaGambar1 = $gambar1->getRandomName();
        $namaGambar2 = $gambar2->getRandomName();
        $namaGambar3 = $gambar3->getRandomName();

        // Pindahkan gambar ke direktori yang ditentukan
        $gambar1->move('public/uploads', $namaGambar1);
        $gambar2->move('public/uploads', $namaGambar2);
        $gambar3->move('public/uploads', $namaGambar3);

        // Siapkan data untuk disimpan ke dalam database
        $data = [
            'id' => $id,
            'm_mitra' => $this->request->getVar('total'),
            'mitra1' => $this->request->getVar('personil1'),
            'mitra2' => $this->request->getVar('personil11'),
            'mitra3' => $this->request->getVar('personil21'),
            'gambar_mitra1' => $namaGambar1,
            'gambar_mitra2' => $namaGambar2,
            'gambar_mitra3' => $namaGambar3

            // Masukkan nama gambar lainnya sesuai kebutuhan
        ];

        // Simpan data ke dalam database
        // Lakukan insert data baru
        if (!$this->penilaianModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data.');
        }

        session()->setFlashdata('pesan', 'Data Berhasil Diupdate.');
        return redirect()->to('/penilaian/index');
    }
    public function editmitra($id)
    {
        // Ambil data penilaian berdasarkan ID
        $penilaian = $this->penilaianModel->find($id);

        // Kirim data penilaian ke view untuk ditampilkan dalam form edit
        return view('penilaian/editmitra', ['penilaian' => $penilaian]);
    }

    public function updatemitra($id)
    {
        // Validate the form data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'personil1' => 'required|numeric',
            'personil2' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Handle file uploads
        $gambar1 = $this->request->getFile('g_mitra1');
        $gambar2 = $this->request->getFile('g_mitra2');
        $gambar3 = $this->request->getFile('g_mitra3');

        if (!$gambar1->isValid() || !$gambar2->isValid() || !$gambar3->isValid()) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah gambar.');
        }

        // Generate nama file yang unik
        $namaGambar1 = $gambar1->getRandomName();
        $namaGambar2 = $gambar2->getRandomName();
        $namaGambar3 = $gambar3->getRandomName();

        // Pindahkan gambar ke direktori yang ditentukan
        $gambar1->move('public/uploads', $namaGambar1);
        $gambar2->move('public/uploads', $namaGambar2);
        $gambar3->move('public/uploads', $namaGambar3);

        // Prepare data to be saved into the database
        $data = [
            // Assign data from the form inputs or processed files here
            'id' => $id,
            'm_mitra' => $this->request->getVar('total'),
            'mitra1' => $this->request->getVar('personil1'),
            'mitra2' => $this->request->getVar('personil11'),
            'mitra3' => $this->request->getVar('personil21'),
            'gambar_mitra1' => $namaGambar1,
            'gambar_mitra2' => $namaGambar2,
            'gambar_mitra3' => $namaGambar3

        ];

        // Update the database record
        if (!$this->penilaianModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Failed to update data.');
        }

        // Redirect with success message if the update is successful
        return redirect()->to('/penilaian/index')->with('success', 'Data updated successfully.');
    }
    // Controller method untuk menampilkan halaman form material
    public function material($id)
    {
        $data = [
            'id' => $id
        ];
        return view('penilaian/material', $data);
    }

    // Controller method untuk menangani penambahan data material
    public function tambahmaterial($id)
    {
        // Lakukan validasi
        $validation = \Config\Services::validation();
        $validation->setRules([
            'total' => 'required|numeric',
            'gambar' => 'uploaded[gambar]|max_size[gambar,1024]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
            'personil3' => 'required|numeric',
        ]);

        // Jalankan validasi
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        // Tangani upload gambar
        $gambar = $this->request->getFile('gambar');

        // Pastikan file gambar telah diunggah
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            // Generate nama file yang unik
            $newName = $gambar->getRandomName();
            // Pindahkan gambar ke direktori yang ditentukan
            $gambar->move('public/uploads', $newName);
        } else {
            // Kembalikan jika ada masalah dengan upload gambar
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah gambar.');
        }

        // Siapkan data untuk disimpan ke dalam database
        $data = [
            'id' => $id,
            'material' => $this->request->getVar('total'),
            'gambar_material' => $newName,
            'nilai_material' => $this->request->getVar('personil1'),
        ];

        // Lakukan update
        if (!$this->penilaianModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data.');
        }

        session()->setFlashdata('pesan', 'Data Berhasil Diupdate.');
        return redirect()->to('/penilaian/index');
    }
    public function editMaterial($id)
    {
        // Panggil model PenilaianModel untuk mengambil data penilaian berdasarkan ID
        $penilaianModel = new PenilaianModel();
        $penilaian = $penilaianModel->find($id);

        // Kirim data penilaian ke halaman edit
        return view('penilaian/editmaterial', ['id' => $id, 'penilaian' => $penilaian]);
    }

    public function updateMaterial($id)
    {
        // Lakukan validasi
        $validation = \Config\Services::validation();
        $validation->setRules([
            'personil1' => 'required|numeric',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Tangani upload gambar
        $gambar = $this->request->getFile('gambar');
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $newName = $gambar->getRandomName();
            $gambar->move('public/uploads', $newName);
        } else {
            // Kembalikan jika ada masalah dengan upload gambar
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah gambar.');
        }

        // Siapkan data untuk disimpan ke dalam database
        $data = [
            'id' => $id,
            'material' => $this->request->getVar('total'),
            'nilai_material' => $this->request->getVar('personil1'),
            'gambar_material' => $newName,
            // tambahkan data lainnya sesuai kebutuhan
        ];

        // Lakukan update
        $penilaianModel = new PenilaianModel();
        $penilaianModel->update($id, $data);

        // Redirect ke halaman utama dengan pesan sukses
        return redirect()->to('/penilaian/index')->with('success', 'Data berhasil diperbarui.');
    }

    public function kedisiplinan($id)
    {
        $data = [
            'id'    => $id
        ];
        return view('penilaian/kedisiplinan', $data);
    }

    public function tambahkedisiplinan($id)
    {
        // Lakukan validasi
        $validation = \Config\Services::validation();
        $validation->setRules([
            'total' => 'required|numeric',
            'gambar' => 'uploaded[gambar]|max_size[gambar,1024]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
            'personil1' => 'required|numeric',
        ]);

        // Jalankan validasi
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        // Tangani upload gambar
        $gambar = $this->request->getFile('gambar');

        // Pastikan file gambar telah diunggah
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            // Generate nama file yang unik
            $newName = $gambar->getRandomName();
            // Pindahkan gambar ke direktori yang ditentukan
            $gambar->move('public/uploads', $newName);
        } else {
            // Kembalikan jika ada masalah dengan upload gambar
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah gambar.');
        }

        // Siapkan data untuk disimpan ke dalam database
        $data = [
            'id' => $id,
            'kedisiplinan' => $this->request->getVar('total'),
            'gambar_disiplin' => $newName,
            'disiplin' => $this->request->getVar('personil1'),
        ];

        // Lakukan update
        if (!$this->penilaianModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data.');
        }

        session()->setFlashdata('pesan', 'Data Berhasil Diupdate.');
        return redirect()->to('/penilaian/index');
    }
    public function editdisiplin($id)
    {
        // Ambil data penilaian berdasarkan ID
        $penilaian = $this->penilaianModel->find($id);

        // Kirim data penilaian ke view untuk ditampilkan dalam form edit
        return view('penilaian/editdisiplin', ['penilaian' => $penilaian]);
    }

    public function updatedisiplin($id)
    {
        // Validate the form data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'personil1' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Handle file uploads
        $gambar = $this->request->getFile('gambar');

        if (!$gambar->isValid()) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah gambar.');
        }

        // Generate nama file yang unik
        $newname = $gambar->getRandomName();


        // Pindahkan gambar ke direktori yang ditentukan
        $gambar->move('public/uploads', $newname);


        // Prepare data to be saved into the database
        $data = [
            // Assign data from the form inputs or processed files here
            'id' => $id,
            'kedisiplinan' => $this->request->getVar('total'),
            'displin' => $this->request->getVar('personil1'),
            'gambar_disiplin' => $newname,
        ];

        // Update the database record
        if (!$this->penilaianModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Failed to update data.');
        }

        // Redirect with success message if the update is successful
        return redirect()->to('/penilaian/index')->with('success', 'Data updated successfully.');
    }
    // Controller method untuk menampilkan halaman form material
    public function fatal_error($id)
    {
        $data = [
            'id'    => $id
        ];
        return view('penilaian/fatal_error', $data);
    }

    public function tambahfatal_error($id)
    {
        // Validasi data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'personil1' => 'required|numeric',
            'personil11' => 'required|numeric',
            'personil21' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Tangani upload gambar
        $gambar1 = $this->request->getFile('g_fatal1');
        $gambar2 = $this->request->getFile('g_fatal2');
        $gambar3 = $this->request->getFile('g_fatal3');
        // Tangani upload gambar lainnya sesuai kebutuhan

        // Pastikan file gambar telah diunggah
        if (!$gambar1->isValid() || !$gambar2->isValid() || !$gambar3->isValid()) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah gambar.');
        }

        // Generate nama file yang unik
        $namaGambar1 = $gambar1->getRandomName();
        $namaGambar2 = $gambar2->getRandomName();
        $namaGambar3 = $gambar3->getRandomName();

        // Pindahkan gambar ke direktori yang ditentukan
        $gambar1->move('public/uploads', $namaGambar1);
        $gambar2->move('public/uploads', $namaGambar2);
        $gambar3->move('public/uploads', $namaGambar3);

        // Siapkan data untuk disimpan ke dalam database
        $data = [
            'id' => $id,
            'fatal_error' => $this->request->getVar('total'),
            'fatal1' => $this->request->getVar('personil1'),
            'fatal2' => $this->request->getVar('personil11'),
            'fatal3' => $this->request->getVar('personil21'),
            'gambar_fatal1' => $namaGambar1,
            'gambar_fatal2' => $namaGambar2,
            'gambar_fatal3' => $namaGambar3

            // Masukkan nama gambar lainnya sesuai kebutuhan
        ];

        // Simpan data ke dalam database
        // Lakukan insert data baru
        if (!$this->penilaianModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data.');
        }

        session()->setFlashdata('pesan', 'Data Berhasil Diupdate.');
        return redirect()->to('/penilaian/index');
    }
    public function editfatal($id)
    {
        // Ambil data penilaian berdasarkan ID
        $penilaian = $this->penilaianModel->find($id);

        // Kirim data penilaian ke view untuk ditampilkan dalam form edit
        return view('penilaian/editfatal', ['penilaian' => $penilaian]);
    }

    public function updatefatal($id)
    {
        // Validate the form data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'personil1' => 'required|numeric',
            'personil2' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Handle file uploads
        $gambar1 = $this->request->getFile('g_fatal1');
        $gambar2 = $this->request->getFile('g_fatal2');
        $gambar3 = $this->request->getFile('g_fatal3');

        if (!$gambar1->isValid() || !$gambar2->isValid() || !$gambar3->isValid()) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah gambar.');
        }

        // Generate nama file yang unik
        $namaGambar1 = $gambar1->getRandomName();
        $namaGambar2 = $gambar2->getRandomName();
        $namaGambar3 = $gambar3->getRandomName();

        // Pindahkan gambar ke direktori yang ditentukan
        $gambar1->move('public/uploads', $namaGambar1);
        $gambar2->move('public/uploads', $namaGambar2);
        $gambar3->move('public/uploads', $namaGambar3);

        // Prepare data to be saved into the database
        $data = [
            // Assign data from the form inputs or processed files here
            'id' => $id,
            'fatal_error' => $this->request->getVar('total'),
            'fatal1' => $this->request->getVar('personil1'),
            'fatal2' => $this->request->getVar('personil11'),
            'fatal3' => $this->request->getVar('personil21'),
            'gambar_fatal1' => $namaGambar1,
            'gambar_fatal2' => $namaGambar2,
            'gambar_fatal3' => $namaGambar3

        ];

        // Update the database record
        if (!$this->penilaianModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Failed to update data.');
        }

        // Redirect with success message if the update is successful
        return redirect()->to('/penilaian/index')->with('success', 'Data updated successfully.');
    }
    public function laporan()
    {
        $penilaianModel = new PenilaianModel();
        $data['laporan'] = $penilaianModel->getLaporan();

        return view('penilaian/laporan', $data);
    }
    // Controller method for handling the date range form submission
    public function cetakByDateRange()
    {
        // Retrieve start_date and end_date from the form submission
        $start_date = $this->request->getVar('start_date');
        $end_date = $this->request->getVar('end_date');

        // Retrieve penilaian data based on the date range (you need to modify this based on your logic)
        $penilaian = $this->penilaianModel->getPenilaianByDateRange($start_date, $end_date);

        // Pass data to the print view
        $data = [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'penilaian' => $penilaian,
        ];

        return view('penilaian/cetak', $data);
    }
    public function search()
    {
        $searchTerm = $this->request->getGet('katakunci');
        $vendor = session()->get('nama_vendor');

        if (empty($searchTerm)) {
            return redirect()->to('/penilaian/index');
        }

        $penilaian = $this->penilaianModel->searchPenilaian($searchTerm, $vendor);

        // Simpan hasil pencarian ke dalam session
        session()->set('search_result', $penilaian);

        $data = [
            'title' => 'Penilaian Kontrak',
            'penilaian' => $penilaian,
            'search_term' => $searchTerm,
        ];

        return view('penilaian/index', $data);
    }
    public function cetakPDF()
    {
        // Buat objek Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);
        // Retrieve the search criteria from the request
        $searchTerm = $this->request->getGet('katakunci');
        $vendor = session()->get('nama_vendor');

        // Use the search criteria to get the corresponding penilaian data
        if (!empty($searchTerm)) {
            // Gunakan hasil pencarian yang disimpan di session
            $penilaian = session()->get('search_result');
        } else {
            // Jika tidak ada pencarian, ambil semua data penilaian
            $penilaian = $this->penilaianModel->findAll();
        }

        // ... (bagian yang sama seperti sebelumnya)
        // Render PDF (membutuhkan ekstensi php-xml)
        $dompdf->render();

        // Output PDF to browser
        $dompdf->stream('laporan_penilaian.pdf', ['Attachment' => 0]);
    }

    public function cetakPDFlaporan()
    {
        $laporan = $this->penilaianModel->getLaporan();

        // Create an instance of Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML content (view) into Dompdf
        $html = view('penilaian/cetaklaporan', ['laporan' => $laporan, 'calculateMonthlyPenalty' => [$this, 'calculateMonthlyPenalty']]);
        $dompdf->loadHtml($html);

        // Set paper size (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (requires php-xml extension)
        $dompdf->render();

        // Output PDF to browser
        $dompdf->stream('laporan_penilaian.pdf', ['Attachment' => 0]);
    }

    // Function to calculate monthly penalty
    public function calculateMonthlyPenalty($totalScore)
    {
        if ($totalScore >= 92) {
            return 0.00;
        } elseif ($totalScore >= 80) {
            return 5.00;
        } elseif ($totalScore >= 70) {
            return 10.00;
        } elseif ($totalScore >= 60) {
            return 20.00;
        } elseif ($totalScore >= 50) {
            return 30.00;
        } else {
            return 100.00;
        }
    }
    public function hapus($id)
    {
        // Panggil model untuk menghapus nilai berdasarkan ID
        $this->penilaianModel->delete($id);

        // Set flashdata untuk memberikan pesan ke user
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');

        // Redirect kembali ke halaman index
        return redirect()->to('/penilaian/index');
    }
    public function reset($id)
    {
        // Reset (hapus) nilai-nilai menjadi 0 berdasarkan ID
        $data = [
            'personil' => 0,
            'kinerja' => 0,
            'm_mitra' => 0,
            'material' => 0,
            'kedisiplinan' => 0,
            'fatal_error' => 0,
        ];

        $this->penilaianModel->update($id, $data);

        // Set flashdata untuk memberikan pesan ke user
        session()->setFlashdata('pesan', 'Nilai Berhasil Direset.');

        // Redirect kembali ke halaman index
        return redirect()->to('/penilaian/index');
    }
    public function searchh()
    {
        $searchTerm = $this->request->getGet('katakunci');
        $vendor = session()->get('nama_vendor');

        if (empty($searchTerm)) {
            return redirect()->to('/penilaian/index');
        }

        $penilaian = $this->penilaianModel->searchPenilaian($searchTerm, $vendor);

        // Simpan hasil pencarian ke dalam session
        session()->set('search_result', $penilaian);

        $data = [
            'title' => 'Penilaian Kontrak',
            'penilaian' => $penilaian,
            'search_term' => $searchTerm,
        ];

        return view('penilaian/index', $data);
    }
    // PenilaianController.php
    public function cetakpenalty()
    {
        $monthlyPenalties = []; // Gantilah dengan data yang sesuai

        // Create an instance of Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $html = view('penilaian/cetakpenalty', ['monthlyPenalties' => $monthlyPenalties]);
        $dompdf->loadHtml($html);

        // Set paper size (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (requires php-xml extension)
        $dompdf->render();

        // Output PDF to browser
        $dompdf->stream('laporan_penalty.pdf', ['Attachment' => 0]);
    }
}
