<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_details';
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 
   
    public function transaksiDetails()
    {
        return $this->hasMany(AdminTransaksiDetail::class, 'id_transaksi');
    }
}