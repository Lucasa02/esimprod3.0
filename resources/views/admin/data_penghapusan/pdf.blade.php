<!DOCTYPE html>
<html>
<head>
    <title>Data Penghapusan</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top:20px; }
        th, td { border: 1px solid #aaa; padding: 8px; font-size: 12px; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>

<h2>Data Penghapusan Barang</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Kode Barang</th>
            <th>Tanggal Penghapusan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $row)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $row->barang->nama_barang }}</td>
            <td>{{ $row->barang->kode_barang }}</td>
            <td>{{ $row->created_at->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
