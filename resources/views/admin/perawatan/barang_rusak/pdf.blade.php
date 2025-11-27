<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Barang Rusak</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>

    <h2 style="text-align:center;">Laporan Barang Rusak</h2>
    <p>Tanggal: {{ date('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Kode Barang</th>
                <th>Nomor Seri</th>
                <th>Merk</th>
                <th>Jenis Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $b)
            <tr>
                <td>{{ $b->nama_barang }}</td>
                <td>{{ $b->kode_barang }}</td>
                <td>{{ $b->nomor_seri }}</td>
                <td>{{ $b->merk }}</td>
                <td>{{ $b->jenisBarang->jenis_barang }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>