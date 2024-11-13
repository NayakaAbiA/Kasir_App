<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all(); 
        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
            $request->validate([
                'nama_kategori' => 'required',
            ]);

                Kategori::create([
                'nama_kategori' => $request->nama_kategori,
            ]);
                return redirect()->route('kategori.admin')->with('success', 'Kategori berhasil ditambahkan');
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
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id); 
        return view('admin.kategori.edit', compact('kategori')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);
    
        $kategori = Kategori::findOrFail($id); // Mengambil kategori berdasarkan ID
        $kategori->update([
            'nama_kategori' => $request->nama_kategori, // Memperbarui kategori dengan data baru
        ]);
    
        return redirect()->route('kategori.admin')->with('success', 'Kategori berhasil diperbarui');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kategori::where('id_kategori', $id)->delete();

        return redirect()->route('kategori.admin');
    }
}
