@extends('layouts.main')

@section('title')
    Transaksi Detail
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Transaksi Detail</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <a href="{{route('transaksiDetail.create')}}" class="btn btn-primary btn-xs btn-flat">
                    <i class="fa fa-plus-circle">Tambah</i>
                </a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Tanggal Transaksi</th>
                            <th>Nama Petugas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$item->created_at->format('d - m - Y')}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>
                                <a href="{{route('admin.transaksi.detail', $item->id)}}" class="btn btn-primary fa fa-eye"></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {
       $('.table').DataTable({
            processing: true,
            autoWidth: false,
       });
    });
</script>
@endpush
