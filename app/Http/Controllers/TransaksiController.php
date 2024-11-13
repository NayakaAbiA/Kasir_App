<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produk = Produk::all();
        $pembayarans = Pembayaran::all();
        $transaksis =Transaksi::all();
        $hargaJual = null;

        // Mengecek apakah nama produk sudah dipilih dan ambil harga jualnya
        if ($request->has('nama_produk') && $request->nama_produk != "") {
            $produkDipilih = Produk::where('nama_produk', $request->nama_produk)->first();
            $hargaJual = $produkDipilih ? $produkDipilih->harga_jual : null;
        }
        return view('admin.transaksi.index', compact('transaksis', 'produk', 'pembayarans', 'hargaJual'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produk = Produk::all();
        $pembayarans = Pembayaran::all();
        $transaksis =Transaksi::all();
        return view('admin.transaksi.create', compact('transaksis', 'produk', 'pembayarans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
       // Validasi inputan dari pengguna
       $validatedData = $request->validate([
        'nama_produk' => 'required|string|exists:produk,nama_produk', 
        'nama_pay' => 'required|string',
        'nomor_pay' => 'required|string',
        'harga_jual' => 'required|string',
        'jumlah' => 'required|integer',
        'bayar' => 'required|numeric',
    ]);

    // Ambil produk untuk mendapatkan nama produk dan harga jual
    $produk = Produk::where('nama_produk', $request->nama_produk)->first(); // Mendapatkan produk berdasarkan nama_produk

    // Hitung subtotal dan kembalian
    $subtotal = $produk->harga_jual * $request->jumlah;
    $kembalian = $request->bayar - $subtotal;

    if ($kembalian < 0) {
        return redirect()->back()->withErrors(['message' => 'Jumlah bayar kurang dari subtotal.']);
    }

    // Simpan transaksi ke database
    Transaksi::create([
        'nama_produk' => $request->nama_produk,
        'nama_pay' => $request->nama_pay,
        'nomor_pay' => $request->nomor_pay,
        'harga_jual' => $request->harga_jual,
        'jumlah' => $request->jumlah,
        'subtotal' => $subtotal,
        'bayar' => $request->bayar,
        'kembalian' => $kembalian,
        'tanggal' => $request->date,
    ]);

    return redirect()->route('transaksi.index');
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
        $produk = Produk::all();
        $pembayarans = Pembayaran::all();
        $transaksis =Transaksi::all();
        return view('admin.transaksi.edit', compact('transaksis', 'produk', 'pembayarans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|exists:produk,nama_produk', 
            'nama_pay' => 'required|string',
            'nomor_pay' => 'required|string',
            'harga_jual' => 'required|integer',
            'jumlah' => 'required|integer',
            'bayar' => 'required|integer',
        ]);
    
        // Ambil produk untuk mendapatkan nama produk dan harga jual
        $produk = Produk::where('nama_produk', $request->nama_produk)->firstOrFail();
    
        // Hitung subtotal dan kembalian
        $subtotal = $request->harga_jual * $request->jumlah;
        $kembalian = $request->bayar - $subtotal;
    
        // Simpan transaksi ke database
        Transaksi::create([
            'nama_produk' => $request->nama_produk,
            'nama_pay' => $request->nama_pay,
            'nomor_pay' => $request->nomor_pay,
            'harga_jual' => $request->harga_jual,
            'jumlah' => $request->jumlah,
            'subtotal' => $subtotal,
            'bayar' => $request->bayar,
            'kembalian' => $kembalian,
        ]);
    
        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index');
    }
    
    public function cetaklaporan(Request $request)
    {
        $produk = Produk::all();
        $pembayarans = Pembayaran::all();
        $transaksis =Transaksi::all();

        if  ($request->get('export') == 'pdf') {
            $pdf = Pdf::loadView('histori.cetak', compact('produk', 'pembayarans', 'transaksis'));
            return $pdf->download('Laporan.pdf');
        }

        return view('histori.cetak', compact('transaksis', 'produk', 'pembayarans'));
    }
    
}
