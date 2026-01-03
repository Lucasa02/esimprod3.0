<!DOCTYPE html>
<html>
<head>
    <title>Data Penghapusan</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        
        /* Style untuk Header Logo & Judul */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            border: none;
            margin-bottom: 10px;
        }
        .header-table td {
            border: none;
            vertical-align: middle;
        }
        .logo-left {
            text-align: left;
            width: 20%;
        }
        .logo-right {
            text-align: right;
            width: 20%;
        }
        .title-center {
            text-align: center;
            width: 60%;
        }
        
        /* Ukuran Logo TVRI */
        .logo-tvri {
            height: 40px;
            width: auto;
        }
        
        /* Ukuran Logo Esimprod (Dibuat lebih kecil) */
        .logo-esimprod {
            height: 32px; 
            width: auto;
        }

        .title-text {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Style Tabel Data */
        .data-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
        }
        .data-table th, .data-table td { 
            border: 1px solid #ccc; 
            padding: 10px 8px; 
            font-size: 12px; 
        }
        
        /* Header Tabel Berwarna #1b365d */
        .data-table th { 
            background-color: #1b365d; 
            color: white; 
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        hr {
            border: 0;
            border-top: 2px solid #1b365d; /* Mengikuti warna tema */
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="logo-left">
                <img src="{{ public_path('img/assets/logo_tvri_icon.png') }}" class="logo-tvri">
            </td>
            <td class="title-center">
                <h2 class="title-text">Data Penghapusan Barang</h2>
            </td>
            <td class="logo-right">
                <img src="{{ public_path('img/assets/esimprod_logo.png') }}" class="logo-esimprod">
            </td>
        </tr>
    </table>

    <hr>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Nama Barang</th>
                <th>Kode Barang</th>
                <th>Tanggal Penghapusan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $row)
            <tr>
                <td style="text-align: center;">{{ $i + 1 }}</td>
                <td>{{ $row->barang->nama_barang }}</td>
                <td>{{ $row->barang->kode_barang }}</td>
                <td style="text-align: center;">{{ $row->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>