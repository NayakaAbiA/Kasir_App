<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class PetugasHistoriController extends Controller
{
    public function index()
    {
        $laporan = TransaksiDetail::with('user')->get();
        return view('admin.transaksi detail.index', compact('laporan'));
    }
}
