@extends('layouts.main')

@section('title')
    Edit produk
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{{ route('petugas.index  ') }}">Petugas</a></li>
    <li class="active">Edit Petugas</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Petugas</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('petugas.admin.update', ['id' => $petugass->id]) }}" method="POST">
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
                            <label for="name" class="col-md-2 control-label">Nama</label>
                            <div class="col-md-10">
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $petugass->name) }}" required autofocus>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-2 control-label">Email</label>
                            <div class="col-md-10">
                                <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $petugass->email) }}" required autofocus>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="password" class="col-md-2 control-label">Password</label>
                            <div class="col-md-10">
                                <input type="text" name="password" id="password" class="form-control" value="{{ old('password', $petugass->password) }}" required autofocus>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="alamat" class="col-md-2 control-label">Alamat</label>
                            <div class="col-md-10">
                                <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat', $petugass->alamat) }}" required autofocus>
                                @error('alamat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_hp" class="col-md-2 control-label">Telpon</label>
                            <div class="col-md-10">
                                <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp', $petugass->no_hp) }}" required autofocus>
                                @error('no_hp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-2 control-label">Role</label>
                            <div class="col-md-10">
                                <!-- Input tersembunyi dengan nilai "petugas" -->
                                <input type="hidden" name="role" value="petugas">
                                <!-- Tampilkan teks bahwa hanya role "petugas" yang dipilih -->
                                <input type="text" class="form-control" value="Petugas" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-2 control-label">Status</label>
                            <div class="col-md-10">
                                <select name="status" id="status" class="form-control" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="no-aktif">Non Aktif</option>
                                </select>
                                @error('status')
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
