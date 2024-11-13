<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_transaksi_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaksi');
            $table->string('kd_barang');
            $table->string('nama_produk');
            $table->foreignId('jumlah');
            $table->string('subtotal');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_transaksi_details');
    }
};
