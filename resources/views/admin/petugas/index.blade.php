@extends('layouts.main')

@section('title')
    Petugas
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Petugas</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <a href="{{ route('petugas.admin.create') }}" class="btn btn-primary btn-xs btn-flat">
                    <i class="fa fa-plus-circle">Tambah</i>
                </a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Telpon</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                    @foreach ($petugass as $ptgs)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ptgs->name }}</td>
                            <td>{{ $ptgs->email  }}</td>
                            <td>{{ $ptgs->alamat  }}</td>
                            <td>{{ $ptgs->no_hp  }}</td>
                            <td>{{ $ptgs->password  }}</td>
                            <td>{{ ucfirst($ptgs->status) }}</td>
                            <td>
                                <div class="btn btn-group btn-sm">
                                    <a href="{{ route('petugas.admin.edit', ['id' => $ptgs->id]) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('petugas.admin.delete', ['id' => $ptgs->id]) }}" method="POST" style="display:inline;">
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
