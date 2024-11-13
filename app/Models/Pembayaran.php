<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pay';
    protected $guarded = [];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'nama_pay', 'nama_pay');
    }
}
