<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Barang Hilang</title>

    <style>
        body { font-family: sans-serif; font-size: 12px; }

        /* Logo & Version */
        .logo-box {
            text-align: right;
            font-size: 12px;
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }

        th { 
            background: #1b365d; 
            color: white; 
        }

        th, td { 
            border: 1px solid #000; 
            padding: 6px; 
            text-align: left; 
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <table width="100%" style="margin-bottom: 20px;">
    <tr>
        <td style="vertical-align: middle;">
            <h2 style="font-size:20px; margin:0; color:#1b365d; font-weight:bold;">
                Laporan Barang Hilang
            </h2>
        </td>

        <td style="text-align:right; vertical-align: middle;">
            <img src="{{ public_path('img/assets/esimprod_logo.png') }}" 
                 alt="Esimprod" width="100">
            <div style="font-size:12px;">Version 2.2</div>
        </td>
    </tr>
</table>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kode Barang</th>
                <th>Nomor Seri</th>
                <th>Merk</th>
                <th>Jenis Barang</th>
            </tr>
        </thead>

        <tbody>
            @foreach($barang as $index => $b)
            <tr>
                <td>{{ $index + 1 }}</td>
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
