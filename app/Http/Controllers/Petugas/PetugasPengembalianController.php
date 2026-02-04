<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetugasPengembalianController extends Controller
{
    public function index()
    {
        // Return view ke folder 'resources/views/admin/dashboard.blade.php'
        return view('petugas.pengembalian');
    }
}
