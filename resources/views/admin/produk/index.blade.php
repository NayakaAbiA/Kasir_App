@extends('layouts.main')

@section('title')
    Produk
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Produk</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <a href="{{ route('produk.admin.create') }}" class="btn btn-primary btn-xs btn-flat">
                    <i class="fa fa-plus-circle">Tambah</i>
                </a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                    @foreach ($produk as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->kd_barang }}</td>
                            <td>{{ $p->nama_produk }}</td>
                            <td>{{ $p->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ format_uang($p->harga_beli) }}</td> {{-- Format harga --}}
                            <td>{{ format_uang($p->harga_jual) }}</td> {{-- Format harga --}}
                            <td>{{ $p->stok }}</td>
                            <td>
                                <div class="btn btn-group btn-sm">
                                    <a href="{{ route('produk.admin.edit', ['id' => $p->id_produk]) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('produk.admin.delete', ['id' => $p->id_produk]) }}" method="POST" style="display:inline;">
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
