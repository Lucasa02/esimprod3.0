<!DOCTYPE html>
<html>
<head>
    <title>Rekap Laporan Kerusakan</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; } /* Ukuran font sedikit dikecilkan agar deskripsi muat */
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header-table td { vertical-align: middle; }
        .logo-left { text-align: left; width: 15%; }
        .logo-right { text-align: right; width: 15%; }
        .title-center { text-align: center; width: 70%; }
        .title-center h2 { margin: 0; font-size: 16px; text-transform: uppercase; }
        .title-center p { margin: 2px 0; font-size: 12px; }
        
        table.data-table { width: 100%; border-collapse: collapse; margin-top: 10px; table-layout: fixed; } /* Fixed layout agar kolom deskripsi tidak melebar berlebih */
        table.data-table th, table.data-table td { border: 1px solid #ddd; padding: 8px; text-align: left; word-wrap: break-word; }
        
        /* Warna Header Tabel */
        table.data-table th { 
            background-color: #1b365d; 
            color: white; 
            text-transform: uppercase;
            font-size: 10px;
        }

        /* Penyesuaian Lebar Kolom */
        .col-no { width: 25px; text-align: center; }
        .col-nama { width: 100px; }
        .col-kat { width: 70px; }
        .col-jenis { width: 90px; }
        .col-tgl { width: 65px; }
        .col-desc { width: auto; } /* Deskripsi mengambil sisa ruang */

    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="logo-left">
                <img src="{{ public_path('img/assets/logo_tvri_icon.png') }}" style="height: 40px; width: auto;">
            </td>
            <td class="title-center">
                <h2>Laporan Rekap Kerusakan</h2>
                <small>Dicetak pada: {{ date('d/m/Y') }}</small>
            </td>
            <td class="logo-right">
                <img src="{{ public_path('img/assets/esimprod_logo.png') }}" style="height: 30px; width: auto;">
            </td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-nama">Nama Barang</th>
                <th class="col-kat">Kategori</th>
                <th class="col-jenis">Jenis Kerusakan</th>
                <th class="col-tgl">Tgl Lapor</th>
                <th class="col-desc">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $key => $l)
            <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td>{{ $l->barang->nama_barang }}</td>
                <td>{{ $l->barang->kategori }}</td>
                <td style="color: #b91c1c; font-weight: bold;">{{ $l->jenis_kerusakan }}</td>
                <td>{{ $l->created_at->format('d/m/Y') }}</td>
                <td style="font-style: italic; color: #475569;">
                    {{ $l->deskripsi ?? '-' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>