<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengembalian</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        
        /* Gaya untuk Header Logo */
        .header-container {
            width: 100%;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header-table {
            width: 100%;
            border: none;
        }
        .header-table td {
            border: none;
            vertical-align: middle;
            padding: 0;
        }
        .logo-left {
            text-align: left;
        }
        .logo-right {
            text-align: right;
        }
        .title-center {
            text-align: center;
        }

        /* Ukuran khusus Logo TVRI (Kiri) */
        .logo-tvri {
            height: 50px; 
            width: auto;
        }

        /* Ukuran khusus Logo ESIMPROD (Kanan) - Dibuat lebih kecil */
        .logo-esimprod {
            height: 35px; 
            width: auto;
        }

        /* Gaya untuk Tabel Data */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #444;
        }
        th {
            background: #1b365d;
            color: white;
            padding: 6px;
            text-align: center;
            font-weight: bold;
        }
        td {
            padding: 5px;
        }
    </style>
</head>
<body>

    <div class="header-container">
        <table class="header-table">
            <tr>
                <td class="logo-left">
                    <img src="{{ public_path('img/assets/logo_tvri_icon.png') }}" class="logo-tvri">
                </td>
                <td class="title-center">
                    <h2 style="margin: 0;">Laporan Pengembalian Barang</h2>
                    <p style="margin: 5px 0 0 0; color: #555;"></p>
                </td>
                <td class="logo-right">
                    <img src="{{ public_path('img/assets/esimprod_logo.png') }}" class="logo-esimprod">
                </td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Peminjaman</th>
                <th>Tanggal Kembali</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Peminjam</th>
                <th>Status</th>
                <th>Deskripsi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pengembalian as $item)
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td>{{ $item->peminjaman->kode_peminjaman }}</td>
                <td>{{ date('d-m-Y', strtotime($item->tanggal_kembali)) }}</td>

                <td>
                    @foreach ($item->detailPengembalian as $detail)
                        {{ $detail->kode_barang }} <br>
                    @endforeach
                </td>

                <td>
                    @foreach ($item->detailPengembalian as $detail)
                        {{ $detail->barang->nama_barang }} <br>
                    @endforeach
                </td>

                <td>
                    @foreach ($item->detailPengembalian as $detail)
                        {{ $detail->barang->jenisBarang->jenis_barang }} <br>
                    @endforeach
                </td>

                <td>{{ $item->peminjaman->peminjam }}</td>

                <td>
                    @foreach ($item->detailPengembalian as $detail)
                        {{ ucfirst($detail->status) }} <br>
                    @endforeach
                </td>

                <td>
                    @foreach ($item->detailPengembalian as $detail)
                        {{ $detail->deskripsi }} <br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>