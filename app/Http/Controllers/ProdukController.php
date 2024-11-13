<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index()
    {
        $produk = Produk::all();
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     */
    public function create()
    {
        $kategoris = Kategori::all(); //
        return view('admin.produk.create',compact('kategoris'));
    }

    /**
     * Menyimpan produk baru ke dalam database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_produk' => 'required|string|max:255',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'stok' => 'required|integer', 
        ]);
    
        // Membuat kode produk unik
        $validatedData['kd_barang'] = 'P-' . Str::upper(Str::random(8)); // Misal: P-ABCDE123
    
        Produk::create($validatedData);
    
        return redirect()->route('produk.admin')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit produk.
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategoris'));
    }

    /**
     * Memperbarui produk di database.
     */
    public function update(Request $request, $id)
    {
         // Validasi data yang diterima dari form
    $validatedData = $request->validate([
        'id_kategori' => 'required|exists:kategori,id_kategori', // Pastikan id_kategori ada di tabel kategori
        'kd_barang' => 'nullable|string|max:100',
        'nama_produk' => 'required|string|max:255',
        'harga_beli' => 'required|integer',
        'harga_jual' => 'required|integer',
        'stok' => 'required|integer',
    ]);

    $produk = Produk::findOrFail($id);

    // Memperbarui data produk menggunakan validasi yang sudah dilakukan
    $produk->update($validatedData);
    return redirect()->route('produk.admin')->with('success', 'Produk berhasil dihapus!');

}

    /**
     * Menghapus produk dari database.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.admin')->with('success', 'Produk berhasil dihapus!');
    }
}
