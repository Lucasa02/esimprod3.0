<!DOCTYPE html>
<html>
<head>
    <title>Laporan Rencana Penghapusan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        
        /* Style untuk Header Logo */
        .header-table {
            width: 100%;
            border: none;
            margin-bottom: 20px;
        }
        .header-table td {
            border: none;
            vertical-align: middle;
        }
        .logo-left {
            text-align: left;
            width: 15%;
        }
        .logo-right {
            text-align: right;
            width: 15%;
        }
        .header-text {
            text-align: center;
            width: 70%;
        }
        .header-text h2 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        /* Style untuk Tabel Data */
        table.data-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        table.data-table th, table.data-table td { 
            border: 1px solid #333; 
            padding: 10px 8px; 
            text-align: left; 
        }
        
        /* Bagian yang diubah: Header Tabel berwarna #1b365d */
        table.data-table th { 
            background-color: #1b365d; 
            color: white; 
            text-transform: uppercase;
            font-size: 11px;
        }

        /* Zebra striping (opsional: agar baris lebih mudah dibaca) */
        table.data-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="logo-left">
                <img src="{{ public_path('img/assets/logo_tvri_icon.png') }}" style="height: 60px;">
            </td>
            <td class="header-text">
                <h2>DAFTAR RENCANA PENGHAPUSAN BARANG</h2>
                <p style="margin: 5px 0 0 0;">Tanggal Cetak: {{ now()->translatedFormat('d F Y') }}</p>
            </td>
            <td class="logo-right">
                <img src="{{ public_path('img/assets/esimprod_logo.png') }}" style="height: 40px;">
            </td>
        </tr>
    </table>

    <hr style="border: 1px solid #eee;"> 

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 25%;">Kode Barang</th>
                <th style="width: 45%;">Nama Barang</th>
                <th style="width: 25%;">Status Surat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $item->barang->kode_barang ?? '-' }}</td>
                <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                <td>
                    {{ $item->surat_penghapusan ? 'Sudah Upload' : 'Belum Upload' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>