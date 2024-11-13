<?php

use App\Http\Controllers\AdminTransaksiDetailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Historicontroller;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PetugasHistoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiDetailConroller;
use App\Models\AdminTransaksiDetail;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login/verifikasi', [AuthController::class, 'loginverify'])->name('login.verify');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard.admin');
Route::get('/dashboard/petugas', [DashboardController::class, 'petugas'])->name('dashboard.petugas');
Route::get('/dashboard/pimpinan', [DashboardController::class, 'pimpinan'])->name('dashboard.pimpinan');
Route::get('/dashboard/konsumen', [DashboardController::class, 'konsumen'])->name('dashboard.konsumen');


//ADMIN KATEGORI
Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('kategori.admin');
Route::get('/admin/kategori/create', [KategoriController::class, 'create'])->name('kategori.admin.create');
Route::post('/admin/kategori/', [KategoriController::class, 'store'])->name('kategori.admin.store');
Route::get('/admin/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.admin.edit');
Route::put('/admin/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.admin.update');
Route::delete('/admin/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.admin.delete');


//ADMIN PRODUK
Route::get('/admin/produk', [ProdukController::class, 'index'])->name('produk.admin');
Route::get('/admin/produk/create',  [ProdukController::class, 'create'])->name('produk.admin.create');
Route::post('/admin/produk/', [ProdukController::class, 'store'])->name('produk.admin.store');
Route::get('/admin/produk/edit/{id}', [ProdukController::class, 'edit'])->name('produk.admin.edit');
Route::put('/admin/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.admin.update');
Route::delete('/admin/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.admin.delete');


//ADMIN PETUGAS
Route::get('/admin/petugas', [PetugasController::class, 'index'])->name('petugas.index');
Route::get('/admin/petugas/create', [PetugasController::class, 'create'])->name('petugas.admin.create');
Route::post('/admin/petugas/', [PetugasController::class, 'store'])->name('petugas.admin.store');
Route::get('/admin/petugas/edit/{id}', [PetugasController::class, 'edit'])->name('petugas.admin.edit');
Route::put('/admin/petugas/update/{id}', [PetugasController::class, 'update'])->name('petugas.admin.update');
Route::delete('/admin/petugas/{id}', [PetugasController::class, 'destroy'])->name('petugas.admin.delete');

//ADMIN JENIS PEMBAYARAN
Route::get('/jenis/pembayaran', [PembayaranController::class, 'index'])->name('jenispay.index');
Route::get('/jenis/pembayaran/create', [PembayaranController::class, 'create'])->name('jenispay.create');
Route::post('/jenis/pembayaran/', [PembayaranController::class, 'store'])->name('jenispay.store');
Route::get('/jenis/pembayaran/edit/{id}', [PembayaranController::class, 'edit'])->name('jenispay.edit');
Route::put('/jenis/pembayaran/update/{id}', [PembayaranController::class, 'update'])->name('jenispay.update');
Route::delete('/jenis/pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('jenispay.delete');

//TRANSAKSI
// Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
// Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
// Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
// Route::get('/transaksi/edit/{id}', [TransaksiController::class, 'edit'])->name('transaksi.edit');
// Route::put('/transaksi/update/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
// Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.delete');
// Route::get('/cetak/laporan/transaksi', [TransaksiController::class, 'cetaklaporan'])->name('histori.download');

// TRANSAKSI
Route::post('/transaksidetail/tambah', [AdminTransaksiDetailController::class, 'tambahTransaksiDetail'])->name('Transaksi.detail.store');
Route::post('/transaksi/{id}/selesai', [AdminTransaksiDetailController::class, 'selesai'])->name('transaksi.selesai');
Route::get('/transaksi/detail', [TransaksiDetailConroller::class, 'index'])->name('transaksiDetail.index');
Route::get('/transaksi/detail/create', [TransaksiDetailConroller::class, 'create'])->name('transaksiDetail.create');
Route::post('/transaksi/detail/store', [TransaksiDetailConroller::class, 'store'])->name('transaksiDetail.store');
Route::get('/transaksi/detail/{id}/edit', [TransaksiDetailConroller::class, 'edit'])->name('transaksiDetail.index.edit');
Route::get('/laporan/transaksi/detail/{id}', [TransaksiDetailConroller::class, 'laporanAdmin'])->name('admin.transaksi.detail');


//HISTORI
Route::get('/histori/transaksi', [AdminTransaksiDetailController::class, 'historiorder'])->name('histori.index');
Route::get('/cetak/laporan/transaksi', [AdminTransaksiDetailController::class, 'downloadPDF'])->name('download.pdf');
