<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDetail;
use App\Models\AdminTransaksiDetail;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminTransaksiDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambahTransaksiDetail(Request $request)
    {
        // die('masuk');
        $kd_barang = $request->kd_barang;
        $id_transaksi = $request->id_transaksi;

        $td = AdminTransaksiDetail::whereKdBarang($kd_barang)->whereIdTransaksi($id_transaksi)->first();

        $transaksi = TransaksiDetail::find($id_transaksi);
        if ($td == null) {

            $data = [
                'kd_barang' => $kd_barang,
                'nama_produk' => $request->nama_produk,
                'id_transaksi' => $id_transaksi,
                'jumlah' => $request->jumlah,
                'subtotal' => $request->subtotal,
            ];    
            AdminTransaksiDetail::create($data);
            $dt = [
                'total' => $request->subtotal + $transaksi->total
            ];
            $transaksi->update($dt);
        } else {
            $data = [
                'jumlah' => $td->jumlah + $request->jumlah,
                'subtotal' => $request->subtotal + $td->subtotal,
            ];
            $td->update($data);

            $dt = [
                'total' => $request->subtotal + $transaksi->total
            ];
            $transaksi->update($dt);
        }
        return redirect()->route('transaksiDetail.index.edit', ['id' => $id_transaksi]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
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
    public function selesai($id)
    {
        // Mencari transaksi berdasarkan ID
        $transaksi = TransaksiDetail::find($id);
        
        // Jika transaksi tidak ditemukan, redirect ke halaman daftar transaksi
        if (!$transaksi) {
            return redirect()->route('transaksiDetail.index');
        }

        // Update status menjadi 'selesai'
        $transaksi->update(['status' => 'selesai']);
        
        // Redirect kembali ke halaman daftar transaksi
        return redirect()->route('transaksiDetail.index');
    }

    // public function downloadlaporan(Request $request, $id)
    // {
    //     $produk = Produk::all();
    //     $transaksis =Transaksi::all();
    //     $laporandetail = TransaksiDetail::with('transaksiDetails')->findOrFail($id);

    //     if  ($request->get('export') == 'pdf') {
    //         $pdf = Pdf::loadView('admin.cetaklaporan.cetak', compact('laporandetail'));
    //         $pdf->setPaper('A4', 'portrait'); 
    //         return $pdf->download('Laporan Transaksi.pdf');
    //     }

    //     return view('admin.histori.cetak', compact('transaksis', 'produk','laporandetail'));
    // }
    public function historiorder()
    {
        $laporan = TransaksiDetail::where('status', 'selesai')->get();

        return view('admin.histori.index', compact('laporan'));
    }

    public function downloadPDF()
{
    $laporan = TransaksiDetail::where('status', 'selesai')->latest()->get();
    $pdf = Pdf::loadView('admin.histori.cetak', compact('laporan'));
    return $pdf->download('laporan_transaksi.pdf');
}


}
