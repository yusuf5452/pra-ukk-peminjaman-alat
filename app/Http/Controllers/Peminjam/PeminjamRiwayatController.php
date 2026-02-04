<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeminjamRiwayatController extends Controller
{
    public function index()
    {
        // Return view ke folder 'resources/views/admin/dashboard.blade.php'
        return view('peminjam.riwayat');
    }
}
