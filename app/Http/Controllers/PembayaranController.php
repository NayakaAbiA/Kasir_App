<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pays = Pembayaran::all(); 
        return view('admin.metode pembayaran.index', compact('pays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.metode pembayaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
            $request->validate([
                'nama_pay' => 'required',
                'jenis_pay' => 'required',
            ]);

                Pembayaran::create([
                'nama_pay' => $request->nama_pay,
                'jenis_pay' => $request->jenis_pay,
            ]);
                return redirect()->route('jenispay.index')->with('success', 'Kategori berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pays = Pembayaran::findOrFail($id); 
        return view('admin.metode pembayaran.edit', compact('pays')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pay' => 'required',
            'jenis_pay' => 'required',
        ]);
    
        $pays = Pembayaran::findOrFail($id); // mencari berdasarkan id

        //untuk mengupdate
        $pays->update([
            'nama_pay' => $request->nama_pay,
            'jenis_pay' => $request->jenis_pay,
        ]);
    
        return redirect()->route('jenispay.index')->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
