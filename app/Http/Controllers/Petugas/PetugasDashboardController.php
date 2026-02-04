<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        // Return view ke folder 'resources/views/petugas/dashboard.blade.php'
        return view('petugas.dashboard');
    }
}