@extends('layouts.main')

@section('title')
    Metoda Pembayaran
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Metoda Pembayaran</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <a href="{{ route('jenispay.create') }}" class="btn btn-primary btn-xs btn-flat">
                    <i class="fa fa-plus-circle">Tambah</i>
                </a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nama Pembayaran</th>
                        <th>Metode Pembayaran</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                    @foreach ($pays as $pay)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pay->nama_pay }}</td>
                            <td>{{ $pay->jenis_pay }}</td>
                            <td>
                                <div class="btn btn-group btn-sm">
                                    <a href="{{ route('jenispay.edit', ['id' => $pay->id_pay]) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('jenispay.delete', ['id' => $pay->id_pay]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
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
