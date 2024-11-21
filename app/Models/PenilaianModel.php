<?php

// app/Models/PenilaianModel.php
// app/Models/PenilaianModel.php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianModel extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id';
    protected $allowedFields = ['no_kontrak', 'jenis_petugas', 'nama_vendor', 'nama_cabang', 'tanggal', 'personil', 'nilai_personil1', 'gambar_personil1', 'nilai_personil2', 'gambar_personil2', 'nilai_personil3', 'gambar_personil3', 'nilai_personil4', 'gambar_personil4', 'nilai_personil5', 'gambar_personil5', 'kinerja', 'kinerja1', 'kinerja2', 'kinerja3', 'kinerja4', 'kinerja5', 'gambar_kinerja1', 'gambar_kinerja2', 'gambar_kinerja3', 'gambar_kinerja4', 'gambar_kinerja5', 'm_mitra', 'mitra1', 'mitra2', 'mitra3', 'gambar_mitra1', 'gambar_mitra2', 'gambar_mitra3', 'material', 'nilai_material', 'gambar_material', 'kedisiplinan', 'disiplin', 'gambar_disiplin', 'fatal_error', 'fatal1', 'fatal2', 'fatal3', 'gambar_fatal1', 'gambar_fatal2', 'gambar_fatal3', 'status'];

    public function getPenilaianByKontrak($kontrakId)
    {
        return $this->where('kontrak_id', $kontrakId)->findAll();
    }
    public function getPenilaianByVendor($vendor)
    {
        return $this->where('id', $vendor)->findAll();
    }

    function getById($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }

    public function getPenilaianByDateRange($startDate, $endDate)
    {
        return $this->where('waktu_upload >=', $startDate)
            ->where('waktu_upload <=', $endDate)
            ->findAll();
    }
    public function deleteByKontrakId($kontrakId)
    {
        return $this->where('id', $kontrakId)->delete();
    }
    public function getLaporan()
    {
        return $this->select('no_kontrak, nama_vendor, nama_cabang, MONTHNAME(tanggal) as month, personil, kinerja, m_mitra, material, kedisiplinan, fatal_error')
            ->findAll();
    }
    public function searchPenilaian($searchTerm, $vendor)
    {
        // Retrieve penilaian data based on the search term
        return $this->like('nama_vendor', $searchTerm)
            ->orLike('nama_cabang', $searchTerm)
            ->orLike('no_kontrak', $searchTerm)
            ->orLike('MONTHNAME(tanggal)', $searchTerm) // Assuming tanggal is a date column, adjust accordingly
            ->where('id', $vendor)
            ->findAll();
    }
    public function getMonthlyPenalties()
    {
        // Your logic to fetch monthly penalties from the database or other source
        // Example: replace this with your actual database query
        return $this->db->table('monthly_penalties')->get()->getResultArray();
    }
}
