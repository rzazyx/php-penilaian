<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password', 'user_level'];

    // Tambahkan konstanta untuk ENUM
    const admin = 'admin';
    const pic = 'pic';
    const vendor = 'vendor';

    // ...

    // Definisi validasi untuk kolom user_level
    protected $validationRules = [
        'user_level' => 'required|in_list[' . self::admin . ',' . self::pic . ',' . self::vendor . ']',
    ];
    // Tambahkan metode atau fungsi tambahan sesuai kebutuhan aplikasi
}
