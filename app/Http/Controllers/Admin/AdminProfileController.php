<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function index()
    {
        // Return view ke folder 'resources/views/admin/dashboard.blade.php'
        return view('admin.profile');
    }
}
