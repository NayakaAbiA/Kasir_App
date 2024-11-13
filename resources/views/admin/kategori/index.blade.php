@extends('layouts.main')

@section('title')
    Kategori
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Admin</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <a href="{{route('kategori.admin.create')}}" class="btn btn-primary btn-xs btn-flat">
                    <i class="fa fa-plus-circle">Tambah</i>
                </a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                    @foreach ($kategori as $s )
                        <tr>
                            <td>{{ $loop->iteration}} </td> 
                            <td>{{ $s->nama_kategori}}</td>
                            <td>
                            <div class="btn btn-group btn-sm">
                                <a href="{{ route('kategori.admin.edit', ['id' => $s->id_kategori]) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i></a>
                                <form action="{{ route('kategori.admin.delete', ['id' => $s->id_kategori]) }}" method="post">
                                @csrf
                                @METHOD('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i></button>
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

@include('admin.kategori.form')
@endsection

@push('scripts')
<script>
    let table;

    $(function () {
       table= $('.table').DataTable({
            processing : true,
            autoWidth: false,
            // ajax : {
            //     url: '{{ route('kategori.admin') }}',
            // }
       });
    });

    function addForm() {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Kategori');

        $('#modal-form form')[0].reset();
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_kategori]').focus();
    }    
</script>
@endpush