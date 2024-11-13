<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard');
    }
    public function petugas()
    {
        return view('petugas.dashboard');
    }
    public function pimpinan()
    {
        return view('pimpinan.dashboard');
    }
    public function konsumen()
    {
        return view('konsumen.dashboard');
    }
}
