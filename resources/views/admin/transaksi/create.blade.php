@extends('layouts.main')

@section('title', 'Transaksi Penjualan')

@push('css')
<style>
    .tampil-bayar {
        font-size: 5em;
        text-align: center;
        height: 100px;
    }

    .tampil-terbilang {
        padding: 10px;
        background: #f0f0f0;
    }

    .table-penjualan tbody tr:last-child {
        display: none;
    }

    @media(max-width: 768px) {
        .tampil-bayar {
            font-size: 3em;
            height: 70px;
            padding-top: 5px;
        }
    }
</style>
@endpush

@section('breadcrumb')
    @parent
    <li class="active">Transaksi Penjualan</li>
@endsection

@section('content')
   <div class="row p-2">
    <div class="col-md-6">
        <div class="box">
            <div class="box-body">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="">Kode Produk</label>          
                    </div>
                    <div class="col-md-8">
                        <select name="" class="form-control"> 
                            <option value=""> Pilih Kode Produk</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="">Nama Produk</label>          
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="nama_produk" id="nama_produk" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="">Harga Jual</label>          
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="harga_jual" id="harga_jual" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="">Jumlah</label>          
                    </div>
                    <div class="col-md-8">
                        <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                                
                    </div>
                    <div class="col-md-8">
                        <h5>Subtotal : Rp 20.000</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>

   <div class="row p-4">
    <div class="col-md-6">
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    <label for="">Total Belanja</label> 
                    <input type="number" name="total_belanja" id="total_belanja" class="form-control" required>
                </div>
                <div class="form-group">        
                    <label for="">Bayar</label> 
                    <input type="number" name="bayar" id="bayar" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary btn-sm btn-block">Hitung</button>
                <br>

                <div class="form-group">
                    <label for="">Kembalian</label> 
                    <input type="number" name="kembalian" id="kembalian" class="form-control" disabled >
                </div>
            </div>
        </div>
    </div>
   </div>
@endsection
