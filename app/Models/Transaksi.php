<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $guarded= [];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'nama_produk'); // sesuaikan nama kolom foreign key jika berbeda
    }
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'nama_pay');
    }
}
