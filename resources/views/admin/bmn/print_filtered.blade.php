<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Laporan Barang BMN' }}</title>
    <style>
        /* Margin diperkecil sedikit untuk memastikan konten fit di satu halaman */
        @page { size: a4 landscape; margin: 0.8cm; }
        * { font-family: "Calibri", Arial, sans-serif; box-sizing: border-box; }
        body { margin: 0; color: #111827; background-color: #fff; font-size: 11px; }
        
        /* CSS untuk Cover */
        .cover-page {
            width: 100%;
            text-align: center;
            display: block;
            padding-top: 50px;
        }
        .cover-title {
            font-size: 32pt;
            font-weight: bold;
            margin-bottom: 5px;
            letter-spacing: 2px;
        }
        .cover-subtitle {
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 40px;
            text-transform: uppercase;
        }
        .logo-container-cover {
            margin: 50px 0;
        }
        .logo-large {
            width: 300px;
            height: auto;
        }
        .cover-footer {
            margin-top: 60px;
            font-size: 16pt;
            font-weight: bold;
            line-height: 1.5;
            text-transform: uppercase;
        }

        .page-break {
            page-break-before: always;
            clear: both;
        }

        /* Styling Table Data & Header */
        .header-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 20px;
            border-bottom: 2px solid #e5e7eb; 
        }
        .header-table td { border: none; vertical-align: middle; padding-bottom: 10px; }
        .header-left { text-align: left; width: 50%; }
        .header-right { text-align: right; width: 50%; }
        
        /* Logo TVRI di header tetap 45px */
        .logo-img { height: 45px; width: auto; }
        
        /* Class khusus untuk mengecilkan logo Esimprod (30px) */
        .logo-esimprod { height: 30px; width: auto; }

        table.data-table { width: 100%; border-collapse: collapse; margin-top: 10px; table-layout: fixed; }
        th { 
            background-color: #1b365d; 
            color: #ffffff; 
            padding: 10px 4px; 
            text-align: center; 
            border: 1px solid #000; 
            font-weight: bold; 
            font-size: 10px; 
            text-transform: uppercase;
        }
        .data-table td { border: 1px solid #000; padding: 6px 4px; text-align: center; vertical-align: middle; word-wrap: break-word; font-size: 10px; }
        .col-no { width: 25px; }        /* Diperkecil dari 30px */
        .col-kode { width: 85px; }
        .col-nup { width: 35px; }       /* Diperkecil sedikit dari 40px */
        .col-nama { width: 160px; }     /* Dikurangi sedikit untuk memberi ruang ke Keterangan */
        .col-merk { width: 90px; }      /* Dikurangi sedikit */
        .col-kondisi { width: 65px; }   
        .col-tgl { width: 80px; }
        .col-nilai { width: 95px; text-align: right !important; }
        .col-ruang { width: 90px; }     /* Dikurangi sedikit */
        .col-ket { width: 190px; }
    </style>
</head>
<body>

    <div class="cover-page">
        <div class="cover-title">MASTER ASET</div>
        <div class="cover-subtitle">
            TVRI STASIUN KALIMANTAN SELATAN <br>
            TAHUN {{ date('Y') }}
        </div>

        <div class="logo-container-cover">
            @php $logoTvri = public_path('img/assets/logo_tvri_icon.png'); @endphp
            @if(file_exists($logoTvri))
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents($logoTvri)) }}" class="logo-large">
            @endif
        </div>

        <div class="cover-footer">
            LEMBAGA PENYIARAN PUBLIK<br>
            TELEVISI REPUBLIK INDONESIA
        </div>
    </div>

    <div class="page-break"></div>
    
    <table class="header-table">
        <tr>
            <td class="header-left">
                @if(file_exists($logoTvri))
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents($logoTvri)) }}" class="logo-img" alt="Logo TVRI">
                @endif
            </td>
            <td class="header-right">
                @php $logoEsimprod = public_path('img/assets/esimprod_logo.png'); @endphp
                @if(file_exists($logoEsimprod))
                    {{-- Menggunakan class logo-esimprod yang lebih kecil --}}
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents($logoEsimprod)) }}" class="logo-esimprod" alt="Logo Esimprod">
                @endif
            </td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-kode">Kode Barang</th>
                <th class="col-nup">NUP</th>
                <th class="col-nama">Nama Barang</th>
                <th class="col-merk">Merk</th>
                <th class="col-kondisi">Kondisi</th>
                <th class="col-tgl">Tanggal Perolehan</th>
                <th class="col-nilai">Nilai Perolehan</th>
                <th class="col-ruang">Lokasi Ruang</th>
                <th class="col-ket">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->kode_barang }}</td>
                    <td>{{ $b->nup }}</td>
                    <td class="col-nama">{{ $b->nama_barang }}</td>
                    <td>{{ $b->merk ?? '-' }}</td>
                    <td>{{ $b->kondisi }}</td>
                    <td>{{ $b->tanggal_perolehan ? \Carbon\Carbon::parse($b->tanggal_perolehan)->format('Y-m-d') : '-' }}</td>
                    <td class="col-nilai">{{ number_format($b->nilai_perolehan, 0, ',', '.') }}</td>
                    <td>{{ $b->ruangan }}</td>
                    <td>{{ $b->catatan ?? '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="padding: 20px;">Tidak ada data barang BMN untuk ditampilkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>