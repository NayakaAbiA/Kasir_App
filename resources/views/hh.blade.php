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
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body" style="padding: 15px;">
                
                <form action="{{ route('transaksi.store') }}" method="POST" class="form-produk">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


            <!-- Form Create Transaksi -->
            <div class="box-body" style="padding: 15px;">
                <form id="transaction-form" action="{{ route('transaksi.store') }}" method="POST" class="form-produk">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group row">
                        <label for="nama_produk" class="col-md-2">Nama Produk</label>
                        <div class="col-sm-5">
                            <select name="nama_produk" class="form-control">
                                @foreach ($produk as $p)
                                    <option value="{{ $p->nama_produk }}">{{ $p->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_pay" class="col-md-2">Nama Pembayaran</label>
                        <div class="col-sm-5">
                            <select name="nama_pay" class="form-control">
                                @foreach ($pembayarans as $p)
                                    <option value="{{ $p->nama_pay }}">{{ $p->nama_pay }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nomor_pay" class="col-lg-2">Nomor</label>
                        <div class="col-lg-5">
                            <input type="number" name="nomor_pay" id="nomor_pay" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jumlah" class="col-lg-2">Jumlah</label>
                        <div class="col-lg-5">
                            <input type="number" name="jumlah" id="jumlah" class="form-control" onchange="hitungSubtotal()" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="harga_jual" class="col-md-2">Harga Jual</label>
                        <div class="col-sm-5">
                            @foreach ($produk as $p)
                                <option name="harga_jual" name="harga_jual" id="harga_jual" class="form-control"  oninput="hitungSubtotal()" value="{{ $p->harga_jual }}">{{ format_uang($p->harga_jual) }}</option>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="subtotal" class="col-lg-2">Subtotal</label>
                        <div class="col-lg-5">
                        @foreach ($transaksis as $item)
                            <input type="text" id="subtotal"  value="{{ format_uang($item->subtotal) }}" class="form-control" readonly>
                        @endforeach 
                        </div>
                    </div>

                    <!-- Kolom Bayar dengan Tampilan Lebih Besar -->
                    <div class="form-group row">
                        <label for="bayar" class="col-lg-2">Bayar</label>
                        <div class="col-lg-5">
                        @foreach ($transaksis as $item)
                            <input type="text" name="bayar" value="{{ format_uang($item->bayar) }}"  id="bayar" onchange="hitungKembalian()" class="form-control form-control-lg" placeholder="Masukkan jumlah bayar" required>
                         @endforeach   
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kembalian" class="col-lg-2">Kembalian</label>
                        <div class="col-lg-5">
                        @foreach ($transaksis as $item)
                            <option type="text" name="kembalian" id="kembalian" value="{{ format_uang($item->kembalian) }}" class="form-control" readonly></option>
                        @endforeach     
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal" class="col-lg-2">Tanggal</label>
                        <div class="col-lg-5">
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                        </div>
                    <button type="submit" class="btn btn-primary btn-sm btn-flat">Simpan Transaksi</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function updateHargaJual() {
    const selectedOption = document.getElementById('nama_produk').selectedOptions[0];
    const hargaJual = selectedOption.getAttribute('data-harga'); // Ambil harga dari atribut data-harga
    document.getElementById('harga_jual').value = hargaJual; // Isi harga jual ke input harga_jual
    hitungSubtotal(); // Update subtotal otomatis ketika harga jual berubah
}
function hitungSubtotal() {
    const hargaJual = document.getElementById('harga_jual').value;
    const jumlah = document.getElementById('jumlah').value;
    const subtotal = hargaJual * jumlah;
    document.getElementById('subtotal').value = subtotal;
}

function hitungKembalian() {
    const subtotal = document.getElementById('subtotal').value;
    const bayar = document.getElementById('bayar').value;
    const kembalian = bayar - subtotal;
    document.getElementById('kembalian').value = kembalian;
}
</script>
@endsection



@extends('layouts.main')

@section('title')
    Laporan Transaksi
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <a href="{{ route('download.laporan', $laporandetail->id) }}?export=pdf" class="btn btn-success btn-xs btn-flat">
                    <i class="fa fa-download">download</i>
                </a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah Produk</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>                      
                    @foreach ($laporandetail->transaksiDetails as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>{{$item->jumlah}}</td>
                            <td>{{ format_uang($item->subtotal) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
    </div>
@endsection





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login </title>
</head>
<body>
    <div class="row justify-content-center">
        <div class="col-md-5">
        <form action="{{route('login.verify')}}" method="post">
        @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email </label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>

    </div>
</body>
</html>


