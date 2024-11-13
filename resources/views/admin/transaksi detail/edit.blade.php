@extends('layouts.main')

@section('title')
    Edit produk
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{{ route('produk.admin') }}">Produk</a></li>
    <li class="active">Edit produk</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body" style="padding: 15px;">

                <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" class="form-produk">
                    @csrf
                    @method('PUT')

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
                                    <option value="{{ $p->nama_produk }}" {{ $transaksi->nama_produk == $p->nama_produk ? 'selected' : '' }}>{{ $p->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_pay" class="col-md-2">Nama Pembayaran</label>
                        <div class="col-sm-5">
                            <select name="nama_pay" class="form-control">
                                @foreach ($pembayarans as $p)
                                    <option value="{{ $p->nama_pay }}" {{ $transaksi->nama_pay == $p->nama_pay ? 'selected' : '' }}>{{ $p->nama_pay }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nomor_pay" class="col-lg-2">Nomor</label>
                        <div class="col-lg-5">
                            <input type="number" name="nomor_pay" id="nomor_pay" class="form-control" value="{{ $transaksi->nomor_pay }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jumlah" class="col-lg-2">Jumlah</label>
                        <div class="col-lg-5">
                            <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $transaksi->jumlah }}" onchange="hitungSubtotal()" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="harga_jual" class="col-lg-2">Harga Jual</label>
                        <div class="col-lg-5">
                            <input type="number" name="harga_jual" id="harga_jual" class="form-control" value="{{ $transaksi->harga_jual }}" onchange="hitungSubtotal()" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="subtotal" class="col-lg-2">Subtotal</label>
                        <div class="col-lg-5">
                            <input type="number" name="subtotal" id="subtotal" class="form-control" value="{{ $transaksi->subtotal }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bayar" class="col-lg-2">Bayar</label>
                        <div class="col-lg-5">
                            <input type="number" name="bayar" id="bayar" class="form-control" value="{{ $transaksi->bayar }}" onchange="hitungKembalian()" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kembalian" class="col-lg-2">Kembalian</label>
                        <div class="col-lg-5">
                            <input type="number" name="kembalian" id="kembalian" class="form-control" value="{{ $transaksi->kembalian }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal" class="col-lg-2">Tanggal</label>
                        <div class="col-lg-5">
                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $transaksi->tanggal }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm btn-flat">Update Transaksi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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
