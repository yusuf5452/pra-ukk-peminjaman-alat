<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeminjamAlatController extends Controller
{
    public function index()
    {
        // Return view ke folder 'resources/views/petugas/dashboard.blade.php'
        return view('peminjam.alat');
    }
}
