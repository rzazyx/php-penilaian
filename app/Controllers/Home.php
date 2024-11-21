<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('templates/awal');
    }
    public function register()
    {
        return view('auth/register');
    }
    public function user()
    {
        return view('/login/index');
    }
}
