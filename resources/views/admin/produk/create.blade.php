@extends('layouts.main')

@section('title')
    Tambah Produk
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{{ route('produk.admin') }}">Produk</a></li>
    <li class="active">Tambah</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Produk</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('produk.admin.store') }}" method="POST" class="form-horizontal">
                        @csrf
                        <!-- <div class="form-group row">
                            <label for="kd_barang" class="col-md-2 control-label">Kode Barang</label>
                            <div class="col-md-10">
                                <input type="text" name="kd_barang" id="kd_barang" class="form-control" autofocus>
                                @error('kd_barang')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label for="nama_produk" class="col-md-2 control-label">Produk</label>
                            <div class="col-md-10">
                                <input type="text" name="nama_produk" id="nama_produk" class="form-control" required autofocus>
                                @error('nama_produk')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_kategori" class="col-md-2 control-label">Kategori</label>
                            <div class="col-sm-10">
                            <select name="id_kategori" class="form-control">
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="harga_beli" class="col-md-2 control-label">Harga Beli</label>
                            <div class="col-md-10">
                                <input type="text" name="harga_beli" id="harga_beli" class="form-control" required autofocus>
                                @error('harga_beli')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga_jual" class="col-md-2 control-label">Harga Jual</label>
                            <div class="col-md-10">
                                <input type="text" name="harga_jual" id="harga_jual" class="form-control" required autofocus>
                                @error('harga_jual')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stok" class="col-md-2 control-label">Stok</label>
                            <div class="col-md-10">
                                <input type="text" name="stok" id="stok" class="form-control" required autofocus>
                                @error('stok')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-md-offset-2 col-md-10 justify-content-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('produk.admin') }}" class="btn btn-default">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
