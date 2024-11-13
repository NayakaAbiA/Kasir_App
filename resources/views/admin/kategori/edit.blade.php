@extends('layouts.main')

@section('title')
    Edit Kategori
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{{ route('kategori.admin') }}">Kategori</a></li>
    <li class="active">Edit Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Kategori</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('kategori.admin.update', ['id' => $kategori->id_kategori]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="nama_kategori" class="col-md-2 col-md-offset-1 control-label">Kategori</label>
                            <div class="col-md-9">
                                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 col-md-offset-2">
                                <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
                                <a href="{{ route('kategori.admin') }}" class="btn btn-default btn-flat">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
