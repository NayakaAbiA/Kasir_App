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
<!-- Tabel Untuk Data Yang Melakukan Transaksi -->
    <div class="row p-2">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                        @foreach ($transaksi_detail as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ format_uang($item->subtotal) }}</td>
                                <td>
                                    <a href=""><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <form action="{{route('transaksi.selesai', $transaksi->id)}}" method="POST">
                    @csrf
                        <button href="{{route('transaksiDetail.index')}}" class="btn btn-success"><i class="fa fa-check"></i>Selesai</button>
                        <a href="" class="btn btn-info"><i class="fa fa-file"></i>Pending</a>
                    </form>
                </div>
            </div>
        </div>
    </div>


<!-- Form Untuk Menginput Barang -->
    <div class="row p-2">
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="">Kode Produk</label>          
                        </div>
                        <div class="col-md-8">
                            <form method="GET">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select name="kd_barang" class="form-control"> 
                                            <option value="">{{ isset($produks) && is_object($produks) ? $produks->nama_produk : 'Nama Produk' }}</option>
                                            @foreach ($produk as $p)                                       
                                                <option value="{{ $p->kd_barang}}"  {{ isset($produks) && $produks->kd_barang == $p->kd_barang ? 'selected' : '' }}>
                                                    {{ $p->id_produk.' - '. $p->kd_barang}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary">Pilih</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form action="{{route('Transaksi.detail.store')}}" method="POST">
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

                        <input type="hidden" name="id_transaksi" value="{{Request::segment(3)}}">
                        <input type="hidden" name="kd_barang" value="{{ isset($produks) ? $produks->kd_barang : '' }}">
                        <input type="hidden" name="nama_produk" value="{{ isset($produks) ? $produks->nama_produk : '' }}">
                        <input type="hidden" name="subtotal" value="{{$subtotal}}">

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="nama_produk">Nama Produk</label>          
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{ isset($produks) && is_object($produks) ? $produks->nama_produk : '' }}"  name="nama_produk" id="nama_produk" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="">Harga Jual</label>          
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{ isset($produks) && is_object($produks) && isset($produks->harga_jual) ? format_uang($produks->harga_jual) : '' }}" name="harga_jual" id="harga_jual" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="">Jumlah</label>          
                        </div>
                        <div class="col-md-8">
                            <div class="input-group">
                                <!-- Tombol Minus di Kiri -->
                                <span class="input-group-btn">
                                    <a href="?kd_barang={{ request('kd_barang')}}&act=min&jumlah={{ $jumlah }}" class="btn btn-primary"><i class="fa fa-minus"></i></a>
                                </span>

                                <!-- Input di Tengah -->
                                <input type="number" value="{{ $jumlah }}" name="jumlah" id="jumlah" class="form-control">

                                <!-- Tombol Plus di Kanan -->
                                <span class="input-group-btn">
                                    <a href="?kd_barang={{ request('kd_barang')}}&act=plus&jumlah={{ $jumlah }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                    
                            </div>
                            <div class="col-md-8">
                                <h5>Subtotal :   {{ isset($subtotal) ? format_uang($subtotal) : '0' }}</h5>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                    
                            </div>
                            <div class="col-md-8">
                                <a href="{{route('transaksiDetail.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left">Kembali</i></a>
                                <button type="submit" class="btn btn-primary"> Tambah <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Form Untuk Melakukan Bayar -->
    <div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    <form action="" method="GET">
                        <div class="form-group">
                            <label for="">Total Belanja</label> 
                            <input type="number" value="{{ optional($transaksi)->total ?? 0 }}" name="total_belanja" id="total_belanja" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Bayar</label> 
                            <input type="number" value="{{Request('bayar')}}" name="bayar" id="bayar" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-sm btn-block">Hitung</button>

                    </form>

                    <br>

                    <div class="form-group">
                        <label for="">Kembalian</label> 
                        <input type="number" value="{{$kembalian}}" name="kembalian" id="kembalian" class="form-control" disabled >
                    </div>
                </div>
            </div>
    </div>
    </div>
@endsection
