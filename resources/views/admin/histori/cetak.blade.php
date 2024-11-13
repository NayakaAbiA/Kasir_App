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
            <th>No</th>
            <th>Tanggal Transaksi</th>
            <th>Nama Kasir</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->created_at->format('d - m - Y') }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ format_uang($item->total) }}</td>
                <p>Total Item: {{ $laporan->count() }}</p>

            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>