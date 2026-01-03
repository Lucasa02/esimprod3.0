<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Barang Rusak</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; margin: 0; padding: 0; }
        
        /* Header Style */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: none;
        }
        .header-table td {
            border: none;
            vertical-align: middle;
        }

        /* Table Content Style */
        .data-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
        }
        .data-table th { 
            background-color: #1b356d; 
            color: white; 
            text-transform: uppercase;
            font-size: 11px;
        }
        .data-table th, .data-table td { 
            border: 1px solid #000; 
            padding: 8px; 
            text-align: left; 
        }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td width="20%">
                <img src="{{ public_path('img/assets/logo_tvri_icon.png') }}" alt="TVRI" width="80">
            </td>
            <td width="60%" class="text-center">
                <h2 style="margin:0; color:#000000; font-weight:bold;">LAPORAN BARANG RUSAK</h2>
            </td>
            <td width="20%" style="text-align:right;">
                <img src="{{ public_path('img/assets/esimprod_logo.png') }}" alt="Esimprod" width="100">
            </td>
        </tr>
    </table>

    <hr style="border: 1px solid #1b356d;">

    <table class="data-table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama Barang</th>
                <th>Kode Barang</th>
                <th>Nomor Seri</th>
                <th>Merk</th>
                <th>Jenis Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $index => $b)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $b->nama_barang }}</td>
                <td>{{ $b->kode_barang }}</td>
                <td>{{ $b->nomor_seri }}</td>
                <td>{{ $b->merk }}</td>
                <td>{{ $b->jenisBarang->jenis_barang ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>