<?php

namespace App\Controllers;

use App\Models\KontrakModel;
use App\Models\VendorModel;
use App\Models\CabangModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\PenilaianModel;


class KontrakController extends BaseController
{
    protected $kontrakModel;
    protected $penilaianModel;

    public function __construct()
    {
        $this->kontrakModel = new KontrakModel();
        $this->penilaianModel = new PenilaianModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('katakunci');

        $kontrak = $this->kontrakModel->getKontrakData($keyword);

        $data = [
            'tittle' => 'Daftar Kontrak',
            'kontrak' => $kontrak,
        ];

        $katakunci = $this->request->getGet('katakunci');

        // Membuat query untuk mencari data kontrak dengan atau tanpa kata kunci
        $query = $this->kontrakModel;

        // Memeriksa apakah ada kata kunci pencarian
        if ($katakunci !== null) {
            $query = $query->like('no_kontrak', $katakunci)
                ->orLike('nama_vendor', $katakunci)
                ->orLike('nama_cabang', $katakunci);
        }

        $data['title'] = 'Data Kontrak';
        return view('kontrak/index', $data);
    }

    public function tambah()
    {
        helper(['form']);
        $vendorModel = new VendorModel();
        $cabangModel = new CabangModel();
        $data = [
            'tittle' => 'Tambah Data Kontrak',
            'vendorOptions' => $vendorModel->getVendorOptions(),
            'cabangOptions' => $cabangModel->getCabangOptions(),
        ];

        return view('kontrak/tambah', $data);
    }

    public function simpan()
    {
        $fileKontrak = $this->request->getFile('file_kontrak');
        var_dump($fileKontrak);
        $validationRules = [
            'no_kontrak' => 'required|is_unique[kontrak.no_kontrak]',
            'jenis_petugas' => 'required',
            'nama_vendor' => 'required',
            'nama_cabang' => 'required',
            'awal_kontrak' => 'required',
            'akhir_kontrak' => 'required',
            'file_kontrak' => 'uploaded[file_kontrak]|max_size[file_kontrak,102400]|mime_in[file_kontrak,application/pdf,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
        ];

        $validationMessages = [
            'no_kontrak' => [
                'required' => 'No Kontrak harus diisi.',
                'is_unique' => 'No Kontrak sudah terdaftar.',
            ],
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            $validation = \Config\Services::validation();
            var_dump($validation);  // Tambahkan ini
            return redirect()->back()->withInput()->with('validation', $validation);
        }


        $fileKontrak = $this->request->getFile('file_kontrak');
        if ($fileKontrak->isValid() && !$fileKontrak->hasMoved()) {
            $newName = $fileKontrak->getRandomName();
            $fileKontrak->move(ROOTPATH . 'public/uploads/kontrak', $newName);

            var_dump($newName);

            $data = [
                'no_kontrak' => $this->request->getPost('no_kontrak'),
                'jenis_petugas' => $this->request->getPost('jenis_petugas'),
                'nama_vendor' => $this->request->getPost('nama_vendor'),
                'nama_cabang' => $this->request->getPost('nama_cabang'),
                'awal_kontrak' => $this->request->getPost('awal_kontrak'),
                'akhir_kontrak' => $this->request->getPost('akhir_kontrak'),
                'file_kontrak' => $newName,
            ];

            $data2 = [
                'no_kontrak' => $this->request->getPost('no_kontrak'),
                'jenis_petugas' => $this->request->getPost('jenis_petugas'),
                'nama_vendor' => $this->request->getPost('nama_vendor'),
                'nama_cabang' => $this->request->getPost('nama_cabang'),
            ];
            // dd($data2);

            $this->kontrakModel->insert($data);
            $this->penilaianModel->save($data2);

            session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');

            return redirect()->to('/kontrak/index');
        } else {
            echo 'Tidak ada file yang diunggah atau terjadi kesalahan.';
            return redirect()->back()->withInput()->with('error', 'Tidak ada file yang diunggah atau terjadi kesalahan.');
        }
    }


    public function tambahPenilaian($kontrakId)
    {
        // Tambahkan pengecekan apakah kontrakId ada di database
        $kontrak = $this->kontrakModel->find($kontrakId);
        if (!$kontrak) {
            return redirect()->to('/kontrak/index')->with('error', 'Kontrak tidak ditemukan.');
        }

        // Kirim ID kontrak ke view untuk digunakan dalam hidden field
        $penilaian = $this->penilaianModel->getPenilaianByKontrak($kontrakId);

        $data = [
            'title' => 'Penilaian Kontrak',
            'kontrak' => $kontrak,
            'penilaianData' => $penilaian, // Perubahan disini
        ];

        return view('penilaian/tambah', $data);
    }


    public function hapus($id)
    {
        // Periksa apakah data dengan ID tersebut ada
        $kontrak = $this->kontrakModel->find($id);

        if ($kontrak) {
            // Hapus file PDF (jika ada)
            $file_path = WRITEPATH . 'uploads/kontrak/' . $kontrak['file_kontrak'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            // Hapus data dari database
            $this->kontrakModel->deleteKontrak($id); // Use deleteKontrak method

            // Set pesan sukses
            session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        } else {
            // Set pesan kesalahan jika data tidak ditemukan
            session()->setFlashdata('error', 'Data tidak ditemukan.');
        }

        // Redirect ke halaman utama atau halaman lain yang sesuai
        return redirect()->to('/kontrak/index');
    }
    public function edit($id)
    {
        // Dapatkan data berdasarkan ID
        $kontrak = $this->kontrakModel->find($id);

        helper(['form']);
        $vendorModel = new VendorModel();
        $cabangModel = new CabangModel();
        $data = [
            'tittle' => 'Edit Data Kontrak',
            'kontrak' => $kontrak,
            'vendorOptions' => $vendorModel->getVendorOptions(),
            'cabangOptions' => $cabangModel->getCabangOptions(),
        ];

        return view('kontrak/edit', $data);
    }
    // KontrakController.php

    public function update($id)
    {
        // Validasi input form
        $validationRules = [
            'no_kontrak' => 'required|is_unique[kontrak.no_kontrak,id,' . $id . ']',
            'jenis_petugas' => 'required',
            'nama_vendor' => 'required',
            'nama_cabang' => 'required',
            'awal_kontrak' => 'required',
            'akhir_kontrak' => 'required',
            'file_kontrak' => 'uploaded[file_kontrak]|max_size[file_kontrak,102400]|mime_in[file_kontrak,application/pdf,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
        ];

        $validationMessages = [
            'no_kontrak' => [
                'required' => 'No Kontrak harus diisi.',
                'is_unique' => 'No Kontrak sudah terdaftar.',
            ],
            // Tambahkan pesan validasi untuk kolom lainnya sesuai kebutuhan
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Ambil data dari formulir
        $data = [
            'no_kontrak' => $this->request->getPost('no_kontrak'),
            'jenis_petugas' => $this->request->getPost('jenis_petugas'),
            'nama_vendor' => $this->request->getPost('nama_vendor'),
            'nama_cabang' => $this->request->getPost('nama_cabang'),
            'awal_kontrak' => $this->request->getPost('awal_kontrak'),
            'akhir_kontrak' => $this->request->getPost('akhir_kontrak'),

        ];

        // Update file kontrak jika ada file baru yang diunggah
        $fileKontrak = $this->request->getFile('file_kontrak');
        if ($fileKontrak->isValid() && !$fileKontrak->hasMoved()) {
            $newName = $fileKontrak->getRandomName();
            $fileKontrak->move(WRITEPATH . 'uploads/kontrak', $newName);
            $data['file_kontrak'] = $newName;
        }

        // Update data ke dalam database
        $this->kontrakModel->update($id, $data);

        // Set pesan sukses
        session()->setFlashdata('pesan', 'Data berhasil diperbarui.');

        // Redirect ke halaman utama atau halaman lain yang sesuai
        return redirect()->to('/kontrak/index');
    }
    public function cetakPDF()
    {
        $kontrak = $this->kontrakModel->getKontrakData();

        $data = [
            'title' => 'Cetak Data Kontrak',
            'kontrak' => $kontrak,
        ];

        // Load the Dompdf library
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // Load the view content
        $html = view('kontrak/cetak_pdf', $data);

        // Load HTML into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Output PDF to browser
        $dompdf->stream('DaftarKontrak.pdf');
        return;
    }
}
