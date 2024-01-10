<?php

namespace App\Models;

use CodeIgniter\Model;

class CabangModel extends Model
{
    protected $table = "cabang";
    protected $useTimestamps = true;
    protected $primarykey = "id";
    protected $allowedFields = ['nama_cabang', 'nama_pic', 'email', 'password', 'no_telp'];

    public function getCabangOptions()
    {
        $cabangData = $this->findAll();

        $options = [];
        foreach ($cabangData as $cabang) {
            $options[$cabang['nama_cabang']] = $cabang['nama_cabang'];
        }

        return $options;
    }
    public function getUserLogin($id)
    {
        $this->select('nama_cabang', 'nama_pic', 'email', 'password', 'no_telp');
        return $this->getWhere(['id' => $id])->getRowArray();
    }
}
