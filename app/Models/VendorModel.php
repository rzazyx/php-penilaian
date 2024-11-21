<?php

namespace App\Models;

use CodeIgniter\Model;

class VendorModel extends Model
{
    protected $table = 'vendor';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_vendor', 'nama_user', 'email', 'password', 'no_telp', 'status', 'status'];

    public function getVendorOptions()
    {
        // Ambil data vendor untuk opsi select
        $vendors = $this->findAll();
        $options = [];

        foreach ($vendors as $vendor) {
            $options[$vendor['nama_vendor']] = $vendor['nama_vendor'];
        }

        return $options;
    }
    public function getVendorByUser($username)
    {
        return $this->where('nama_vendor', $username)->findAll();
    }
}
