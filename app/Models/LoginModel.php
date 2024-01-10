<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = 'users'; // Gantilah 'users' dengan nama tabel pengguna Anda
    protected $primaryKey = 'userid';
    protected $allowedFields = ['userid', 'email', 'userpassword', 'userlevelid'];
}
