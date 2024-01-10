<?php

namespace App\Models;

use CodeIgniter\Model;

class KontrakModel extends Model
{
    protected $table      = 'kontrak';
    protected $primaryKey = 'id';
    protected $pagerSection = 'group1';
    protected $allowedFields = ['no_kontrak', 'jenis_petugas', 'nama_vendor', 'nama_cabang', 'awal_kontrak', 'akhir_kontrak', 'sisa_waktu', 'file_kontrak'];

    public function getKontrakData($keyword = null)
    {
        // Mengambil data kontrak
        // Mengambil data kontrak
        if ($keyword) {
            // Jika ada kata kunci pencarian, filter data berdasarkan nama_vendor dan nama_cabang
            $this->like('nama_vendor', $keyword);
            $this->orLike('nama_cabang', $keyword);
            $this->orlike('no_kontrak', $keyword);
        }
        $kontrakData = $this->findAll();

        // Menghitung sisa kontrak dan menetapkan keterangan
        foreach ($kontrakData as &$kontrak) {
            $sisaKontrak = strtotime($kontrak['akhir_kontrak']) - strtotime(date('Y-m-d'));
            $sisaKontrak = max(0, floor($sisaKontrak / (60 * 60 * 24))); // Menghitung sisa dalam hari

            $kontrak['sisa_waktu'] = $sisaKontrak;

            if ($sisaKontrak <= 0) {
                $kontrak['keterangan'] = 'Berakhir';
            } else {
                $kontrak['keterangan'] = 'Masih Berjalan';
            }
        }

        return $kontrakData;
    }

    public function deleteKontrak($id)
    {
        // Find the kontrak data
        $kontrak = $this->find($id);

        if ($kontrak) {
            // Hapus file PDF (jika ada)
            $file_path = WRITEPATH . 'uploads/kontrak/' . $kontrak['file_kontrak'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            // Hapus data dari tabel penilaian
            $penilaianModel = new PenilaianModel();
            $penilaianModel->deleteByKontrakId($id);

            // Hapus data dari tabel kontrak
            $this->delete($id);

            return true; // Return true to indicate successful deletion
        }

        return false; // Return false if data is not found
    }
    public function getKontrakDataByCabang($cabangName)
    {
        // Mengambil data kontrak berdasarkan nama cabang
        return $this->where('nama_cabang', $cabangName)->findAll();
    }
}
