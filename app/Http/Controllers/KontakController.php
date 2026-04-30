<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KontakController extends Controller // Dia otomatis extends Base Controller tadi
{
    public function index()
    {
        return view('kontak'); // Ini akan memanggil resources/views/kontak.blade.php
    }
}