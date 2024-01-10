<?php

// app/Models/PenilaianModel.php
// app/Models/PenilaianModel.php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianModel extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id';
    protected $allowedFields = ['no_kontrak', 'jenis_petugas', 'nama_vendor', 'nama_cabang', 'tanggal', 'personil', 'kinerja', 'm_mitra', 'material', 'kedisiplinan', 'fatal_error'];

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
}
