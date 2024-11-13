<?php

namespace App\Http\Controllers;

use App\Models\AdminTransaksiDetail;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;

class TransaksiDetailConroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporan = TransaksiDetail::with('user')->get();
        return view('admin.transaksi detail.index', compact('laporan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'user_id' => auth('admin')->user()->id,
            'nama' => auth('admin')->user()->nama_petugas,
            'total' => 0,
            'id_transaksi' => 0,
        ];

        $transaksi = TransaksiDetail::create($data);
        return redirect()->route('transaksiDetail.index.edit', ['id' => $transaksi->id]);
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Ambil semua produk dan transaksi
         $produk = Produk::get();
         $transaksis = Transaksi::all();
 
         // Ambil data dari request
         $item = $request->input('kd_barang'); // Kode barang
         $produks = Produk::where('kd_barang', $item)->first(); // Ambil produk berdasarkan kode barang
 
         // Cek jika produk ditemukan
         if (!$produks) {
             return redirect()->back()->with('error', 'Produk tidak ditemukan');
         }
 
         $act = $request->input('act'); // Tindakan (add atau min)
         $jumlah = $request->input('jumlah'); // Jumlah produk
 
         // Validasi jumlah produk
         if ($act == 'min') {
             if ($jumlah <= 1) {
                 $jumlah = 1;  // Pastikan jumlah tidak kurang dari 1
             } else {
                 $jumlah = $jumlah - 1; // Kurangi jumlah
             }
         } else {
             $jumlah = $jumlah + 1; // Tambah jumlah
         }
 
         // Hitung subtotal
         $subtotal = $jumlah * optional($produks)->harga_jual;
 
         // Simpan transaksi baru
         $transaksi = new Transaksi();
         $transaksi->kd_barang = $item;
         $transaksi->jumlah = $jumlah;
         $transaksi->subtotal = $subtotal;
         $transaksi->save();
 
         // Kembalikan respon (misalnya redirect atau JSON)
         return redirect()->route('transaksiDetail.create') // Ganti dengan route yang sesuai
                          ->with('success', 'Transaksi berhasil disimpan');
 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Produk::get();
        $transaksis =Transaksi::all();

        $item = request('kd_barang');
        $produks = Produk::where('kd_barang', $item)->first();

        $transaksi_detail = AdminTransaksiDetail::whereIdTransaksi($id)->get();

        $act = request('act');
        $jumlah = request('jumlah');
        if ( $act == 'min') {
            if ($jumlah <= 1) {

                $jumlah = 1;
            } else {
                $jumlah = $jumlah - 1;
            }
        } else {
            $jumlah = $jumlah + 1;
        }

        $subtotal = $jumlah * optional($produks)->harga_jual;

        $transaksi = TransaksiDetail::find($id);

        $bayar = request('bayar');
        $kembalian = $bayar - $transaksi->total;


        return view('admin.transaksi detail.create',compact('produk', 'item', 'produks', 'jumlah', 'subtotal', 'transaksis', 'transaksi_detail', 'transaksi', 'kembalian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function laporanAdmin($id)
    {
        $laporandetail = TransaksiDetail::with('transaksiDetails')->findOrFail($id);
        return view('admin.transaksi detail.laporan', compact('laporandetail'));
    }
}
