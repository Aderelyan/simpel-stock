<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pembelian extends BaseController
{
    public function index()
    {
        // Memuat dan menampilkan file view
        // yang berlokasi di app/Views/pembelian/index.php
        return view('pembelian/index');
    }
    public function history()
    {
        return view('pembelian/history');
    }
}