@extends('layouts.main')

@section('title')
    Tambah Jenis Pembayaran 
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{{ route('jenispay.index') }}">Jenis Pembayaran</a></li>
    <li class="active">Tambah</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Jenis Pembayaran</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('jenispay.store') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="form-group row">
                            <label for="nama_pay" class="col-md-2 control-label">Nama Pembayaran</label>
                            <div class="col-md-10">
                                <input type="text" name="nama_pay" id="nama_pay" class="form-control" required autofocus>
                                @error('nama_pay')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_pay" class="col-md-2 control-label">Jenis Pembayaran</label>
                            <div class="col-md-10">
                                <input type="text" name="jenis_pay" id="jenis_pay" class="form-control" required autofocus>
                                @error('jenis_pay')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-md-offset-2 col-md-10 justify-content-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('jenispay.index') }}" class="btn btn-default">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
