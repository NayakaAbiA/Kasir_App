@extends('layouts.main')

@section('title')
    Tambah Kategori
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{{ route('kategori.admin') }}">Kategori</a></li>
    <li class="active">Tambah</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Kategori</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('kategori.admin.store') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="form-group row">
                            <label for="nama_kategori" class="col-md-2 control-label">Kategori</label>
                            <div class="col-md-10">
                                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required autofocus>
                                @error('nama_kategori')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-md-offset-2 col-md-10 justify-content-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('kategori.admin') }}" class="btn btn-default">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
