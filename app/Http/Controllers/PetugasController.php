<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $petugass = User::where('role', 'petugas')->get();  // Mengambil hanya petugas kasir
        return view('admin.petugas.index', compact('petugass'));
    }

    // Menampilkan form untuk menambah petugas kasir
    public function create()
    {
        return view('admin.petugas.create');
    }

    // Menyimpan data petugas kasir baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|numeric',
            'role' => 'required|in:petugas',
            'status' => 'required|in:aktif,non-aktif',
        ]);

        $petugass = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Tambahkan password
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas petugas berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit petugas petugas
    public function edit($id)
    {
        $petugass = User::findOrFail($id);
        return view('admin.petugas.edit', compact('petugass'));
    }

    // Menyimpan perubahan data petugas petugas
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|numeric',
            'role' => 'required|in:petugas,admin',
            'status' => 'required|in:aktif,non-aktif',
        ]);

        $petugass = User::findOrFail($id);
        $petugass->name = $request->name;
        $petugass->email = $request->email;
        $petugass->alamat = $request->alamat;
        $petugass->role = $request->role;
        $petugass->no_hp = $request->no_hp;
        $petugass->status = $request->status;

        if ($request->password) {
            $petugass->password = Hash::make($request->password);
        }

        $petugass->save();

        return redirect()->route('petugas.index')->with('success', 'Petugas petugas berhasil diperbarui');
    }

    // Menghapus petugas petugas
    public function destroy($id)
    {
        $petugas = User::findOrFail($id);
        $petugas->delete();

        return redirect()->route('petugas.index')->with('success', 'Petugas petugas berhasil dihapus');
    }
}