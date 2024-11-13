@extends('layouts.main')

@section('title')
    Laporan Transaksi
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Transaksi Detail</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="box">
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

