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
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Produk</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('produk.admin.update', ['id' => $produk->id_produk]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="kd_barang" class="col-md-2 control-label">Kode Barang</label>
                            <div class="col-md-10">
                                <input type="text" name="kd_barang" id="kd_barang" class="form-control" value="{{ old('kd_barang', $produk->kd_barang) }}" required autofocus>
                                @error('kd_barang')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_produk" class="col-md-2 control-label">Produk</label>
                            <div class="col-md-10">
                                <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="{{ old('nama_produk', $produk->nama_produk) }}" required autofocus>
                                @error('nama_produk')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_kategori" class="col-md-2 control-label">Kategori</label>
                            <div class="col-sm-10">
                                <select name="id_kategori" id="id_kategori" class="form-control">
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori', $produk->id_kategori) == $kategori->id_kategori ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="harga_beli" class="col-md-2 control-label">Harga Beli</label>
                            <div class="col-md-10">
                                <input type="text" name="harga_beli" id="harga_beli" class="form-control" value="{{ old('harga_beli', $produk->harga_beli) }}" required>
                                @error('harga_beli')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga_jual" class="col-md-2 control-label">Harga Jual</label>
                            <div class="col-md-10">
                                <input type="text" name="harga_jual" id="harga_jual" class="form-control" value="{{ old('harga_jual', $produk->harga_jual) }}" required>
                                @error('harga_jual')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stok" class="col-md-2 control-label">Stok</label>
                            <div class="col-md-10">
                                <input type="text" name="stok" id="stok" class="form-control" value="{{ old('stok', $produk->stok) }}" required>
                                @error('stok')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-9 col-md-offset-2">
                                <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
                                <a href="{{ route('produk.admin') }}" class="btn btn-default btn-flat">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
