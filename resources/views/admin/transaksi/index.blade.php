@extends('layouts.main')

@section('title', 'Daftar Transaksi')

@section('breadcrumb')
    @parent
    <li class="active">Daftar Transaksi</li>
@endsection

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

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
        <!-- Tabel Daftar Transaksi -->
        <div class="box-body table-responsive">
        <a href="{{ route('histori.download') }}?export=pdf" class="btn btn-success btn-sm btn-flat" target="_blank">
                <i class="fa fa-download"></i> Download Laporan
            </a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Produk</th>
                        <th>Nama Pembayaran</th>
                        <th>Nomor Pembayarn</th>
                        <th>Jumlah</th>
                        <th>Harga Jual</th>
                        <th>Subtotal</th>
                        <th>Bayar</th>
                        <th>Kembalian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksis as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->nama_pay }}</td>
                        <td>{{ $item->nomor_pay }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ format_uang($item->harga_jual) }}</td>
                        <td>{{ format_uang($item->subtotal) }}</td>
                        <td>{{ format_uang($item->bayar) }}</td>
                        <td>{{ format_uang($item->kembalian) }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('transaksi.edit', ['id' => $item->nama_produk]) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('transaksi.delete', ['id' => $item->nama_produk]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
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

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <!-- Tampilan Jumlah Uang yang Harus Dibayar -->
            <div class="tampil-bayar mb-3">
                Total Bayar: <span id="total-bayar"> 0</span>
            </div>

            <!-- Form Create Transaksi -->
            <div class="box-body" style="padding: 15px;">
                <form id="transaction-form" action="{{ route('transaksi.store') }}" method="POST" class="form-produk">
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

                    <div class="form-group row">
                        <label for="nama_produk" class="col-md-2">Nama Produk</label>
                        <div class="col-sm-5">
                            <select name="nama_produk" id="nama_produk" class="form-control" onchange="this.form.submit()">
                                <option value="">Pilih Produk</option>
                                @foreach ($produk as $p)
                                    <option value="{{ $p->nama_produk }}" {{ old('produk') == $p->nama_produk ? 'selected' : '' }}>
                                        {{ $p->nama_produk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="nomor_pay" class="col-lg-2">Nomor</label>
                        <div class="col-lg-5">
                            <input type="number" name="nomor_pay" id="nomor_pay" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jumlah" class="col-lg-2">Jumlah</label>
                        <div class="col-lg-5">
                            <input type="number" name="jumlah" id="jumlah" class="form-control" onchange="hitungSubtotal()" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="harga_jual" class="col-md-2">Harga Jual</label>
                        <div class="col-sm-5">
                            <input type="text" name="harga_jual" id="harga_jual" value="{{ old('harga_jual', format_uang($hargaJual)) }}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="subtotal" class="col-lg-2">Subtotal</label>
                        <div class="col-lg-5">
                            <input type="text" name="subtotal" id="subtotal" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- Kolom Bayar dengan Tampilan Lebih Besar -->
                    <div class="form-group row">
                        <label for="bayar" class="col-lg-2">Bayar</label>
                        <div class="col-lg-5">
                            <input type="text" name="bayar" id="bayar" onchange="hitungKembalian()" class="form-control form-control-lg" placeholder="Masukkan jumlah bayar" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kembalian" class="col-lg-2">Kembalian</label>
                        <div class="col-lg-5">
                            <input type="text" name="kembalian" id="kembalian" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal" class="col-lg-2">Tanggal</label>
                        <div class="col-lg-5">
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm btn-flat">Simpan Transaksi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            
            <div class="form-group row">
                <label for="nama_pay" class="col-md-2">Nama Pembayaran</label>
                    <div class="col-sm-5">
                        <select name="nama_pay" class="form-control">
                            @foreach ($pembayarans as $p)
                                <option value="{{ $p->nama_pay }}">{{ $p->nama_pay }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
        </div>
    </div>
</div>

@push('js')
<script>
// Menghapus karakter non-numerik dan mengembalikan nilai numerik murni
function getNumericValue(value) {
    return value.replace(/[^0-9]/g, '');
}

// Format angka menjadi format Rupiah
function formatUang(angka) {
    return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

// Hitung subtotal berdasarkan harga jual dan jumlah
function hitungSubtotal() {
    const hargaJual = parseFloat(getNumericValue(document.getElementById('harga_jual').value)) || 0;
    const jumlah = parseFloat(getNumericValue(document.getElementById('jumlah').value)) || 0;
    const subtotal = hargaJual * jumlah;

    document.getElementById('subtotal').value = formatUang(subtotal);
    document.getElementById('total-bayar').textContent = formatUang(subtotal);
}

// Hitung kembalian berdasarkan subtotal dan bayar
function hitungKembalian() {
    const subtotal = parseFloat(getNumericValue(document.getElementById('subtotal').value)) || 0;
    const bayar = parseFloat(getNumericValue(document.getElementById('bayar').value)) || 0;

    const kembalian = bayar - subtotal;

    document.getElementById('kembalian').value = formatUang(kembalian);
}
</script>
@endpush
@endsection
