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
            'id'    => $id
        ];
        return view('penilaian/personil', $data);
    }

    public function tambahpersonil($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'total' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'id'    => $id,
            'personil' => $this->request->getVar('total'),
            // tambahkan data lainnya sesuai kebutuhan
        ];

        $this->penilaianModel->update($id, $data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate.');
        return redirect()->to('/penilaian/index');
    }
    public function kinerja($id)
    {
        $data = [
            'id'    => $id
        ];
        return view('penilaian/kinerja', $data);
    }

    public function tambahkinerja($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'total' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'id'    => $id,
            'kinerja' => $this->request->getVar('total'),
            // tambahkan data lainnya sesuai kebutuhan
        ];

        $this->penilaianModel->update($id, $data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate.');
        return redirect()->to('/penilaian/index');
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
        $validation = \Config\Services::validation();

        $validation->setRules([
            'total' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'id'    => $id,
            'm_mitra' => $this->request->getVar('total'),
            // tambahkan data lainnya sesuai kebutuhan
        ];

        $this->penilaianModel->update($id, $data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate.');
        return redirect()->to('/penilaian/index');
    }
    public function material($id)
    {
        $data = [
            'id'    => $id
        ];
        return view('penilaian/material', $data);
    }

    public function tambahmaterial($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'total' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'id'    => $id,
            'material' => $this->request->getVar('total'),
            // tambahkan data lainnya sesuai kebutuhan
        ];

        $this->penilaianModel->update($id, $data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate.');
        return redirect()->to('/penilaian/index');
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
        $validation = \Config\Services::validation();

        $validation->setRules([
            'total' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'id'    => $id,
            'kedisiplinan' => $this->request->getVar('total'),
            // tambahkan data lainnya sesuai kebutuhan
        ];

        $this->penilaianModel->update($id, $data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate.');
        return redirect()->to('/penilaian/index');
    }
    public function fatal_error($id)
    {
        $data = [
            'id'    => $id
        ];
        return view('penilaian/fatal_error', $data);
    }

    public function tambahfatal_error($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'total' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'id'    => $id,
            'fatal_error' => $this->request->getVar('total'),
            // tambahkan data lainnya sesuai kebutuhan
        ];

        $this->penilaianModel->update($id, $data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate.');
        return redirect()->to('/penilaian/index');
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

        $data = [
            'title' => 'Penilaian Kontrak',
            'penilaian' => $penilaian,
            'search_term' => $searchTerm,
        ];

        return view('penilaian/index', $data);
    }

    public function cetakPDF()
    {
        // Retrieve the search criteria from the request
        $searchTerm = $this->request->getGet('katakunci');
        $vendor = session()->get('nama_vendor');

        // Use the search criteria to get the corresponding penilaian data
        if (!empty($searchTerm)) {
            $penilaian = $this->penilaianModel->searchPenilaian($searchTerm, $vendor);
        } else {
            // If not searching, get all penilaian data
            $penilaian = $this->penilaianModel->findAll();
        }

        // Rest of your code for generating PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // Mulai pembuatan dokumen PDF
        $html = view('penilaian/cetak', ['penilaian' => $penilaian]);
        $dompdf->loadHtml($html);

        // Atur ukuran dan orientasi halaman
        $dompdf->setPaper('A4', 'landscape'); // Set paper to A4 size and landscape orientation


        // Render PDF (membutuhkan ekstensi php-xml)
        $dompdf->render();

        // Keluarkan hasil ke browser
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
}
