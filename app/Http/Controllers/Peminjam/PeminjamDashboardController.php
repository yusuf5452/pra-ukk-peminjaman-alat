<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeminjamDashboardController extends Controller
{
    public function index()
    {
        // Return view ke folder 'resources/views/peminjam/dashboard.blade.php'
        return view('peminjam.dashboard');
    }
}