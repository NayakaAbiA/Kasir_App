@extends('layouts.main')

@section('title')
   History Order
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Histori Order</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body table-responsive">
            <a href="{{ route('download.pdf') }}" class="btn btn-success btn-sm btn-flat" target="_blank">
                <i class="fa fa-download"></i> Download Laporan
            </a>
                <table class="table table-striped table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Tanggal Transaksi</th>
                            <th>Nama Kasir</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>                      
                    @foreach ($laporan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$item->created_at->format('d - m - Y')}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>{{format_uang($item->total)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
    </div>
@endsection

