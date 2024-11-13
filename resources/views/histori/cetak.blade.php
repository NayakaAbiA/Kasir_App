<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Laporan Transaksi</h1>
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
                        <td>{{ $item->harga_jual }}</td>
                        <td>{{ $item->subtotal }}</td>
                        <td>{{ $item->bayar }}</td>
                        <td>{{ $item->kembalian }}</td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</body>
</html>
