<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminTransaksiDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function adminTransaksiDetail()
    {
        return $this->belongsTo(TransaksiDetail::class);
    }
    
}
