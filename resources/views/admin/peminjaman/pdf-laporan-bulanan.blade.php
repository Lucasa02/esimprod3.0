<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan Penggunaan</title>

    <style>
        /* Setup Font & General */
        * { font-family: "Helvetica", "Arial", sans-serif; box-sizing: border-box; }
        body { margin: 10px; font-size: 11px; color: #333; line-height: 1.4; }

        /* Header Styling */
        .header-container { width: 100%; border-bottom: 2px solid #1b365d; padding-bottom: 10px; margin-bottom: 20px; }
        .header-table { width: 100%; border-collapse: collapse; border: none; }
        .header-table td { border: none; vertical-align: middle; padding: 0; }
        
        .header-title { text-align: center; }
        .header-title h2 { margin: 0; color: #1b365d; font-size: 18px; text-transform: uppercase; letter-spacing: 1px; }
        .periode { font-size: 11px; margin-top: 5px; color: #666; }

        /* Table Styling */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; table-layout: fixed; }
        
        /* Main Table Header */
        .main-table th {
            background-color: #1b365d;
            color: #ffffff;
            font-size: 10px;
            padding: 10px 5px;
            border: 1px solid #1b365d;
            text-align: center;
            text-transform: uppercase;
        }

        .main-table td {
            border: 1px solid #dee2e6;
            padding: 8px 6px;
            word-wrap: break-word;
            vertical-align: middle;
        }

        .main-table tr:nth-child(even) { background-color: #fcfcfc; }

        /* Sub-table (Detail Barang) */
        .sub-table-container { background-color: #f8fafc; padding: 10px !important; }
        .sub-table {
            width: 95%;
            margin: 0 auto;
            border: 1px solid #cbd5e1;
            background-color: #ffffff;
        }
        .sub-table th {
            background-color: #f1f5f9;
            color: #475569;
            font-size: 9px;
            padding: 5px;
            border: 1px solid #cbd5e1;
        }
        .sub-table td {
            font-size: 9px;
            padding: 4px 6px;
            border: 1px solid #cbd5e1;
        }

        .text-center { text-align: center; }
        .badge { font-weight: bold; color: #1b365d; }

        .footer {
            width: 100%;
            text-align: right;
            font-size: 9px;
            color: #94a3b8;
            position: fixed;
            bottom: -10px;
            left: 0;
            padding: 10px 0;
            border-top: 1px solid #eee;
        }

        @page { size: A4 landscape; margin: 15mm 15mm; }
    </style>
</head>

<body>
    {{-- HEADER DENGAN LOGO YANG DISESUAIKAN --}}
    <div class="header-container">
        <table class="header-table">
            <tr>
                {{-- Logo TVRI Tetap --}}
                <td style="width: 20%; text-align: left;">
                    <img src="{{ public_path('img/assets/logo_tvri_icon.png') }}" alt="TVRI" height="45">
                </td>
                
                {{-- Judul Tengah --}}
                <td style="width: 60%;" class="header-title">
                    <h2>Laporan Bulanan Penggunaan</h2>
                    <div class="periode">Periode: <strong>{{ $periode }}</strong></div>
                </td>
                
                {{-- Logo Esimprod Dikecilkan --}}
                <td style="width: 20%; text-align: right;">
                    <img src="{{ public_path('img/assets/esimprod_logo.png') }}" alt="Esimprod" height="32">
                    <div style="font-size: 7px; color: #94a3b8; margin-top: 2px;"></div>
                </td>
            </tr>
        </table>
    </div>

    {{-- TABEL UTAMA --}}
    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th style="width: 85px;">Kode</th>
                <th style="width: 100px;">No. Penggunaan</th>
                <th>Pengguna</th>
                <th>Peruntukan</th>
                <th style="width: 80px;">Tgl Pinjam</th>
                <th style="width: 80px;">Tgl Kembali</th>
                <th style="width: 75px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjamanBulanan as $key => $p)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">{{ $p->kode_peminjaman }}</td>
                    <td>{{ $p->nomor_peminjaman }}</td>
                    <td style="font-weight: bold;">{{ $p->peminjam }}</td>
                    <td>{{ $p->peruntukan->peruntukan ?? '-' }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($p->tanggal_peminjaman)->format('d/m/Y') }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') }}</td>
                    <td class="text-center"><span class="badge">{{ strtoupper($p->status) }}</span></td>
                </tr>

                @if ($p->detailPeminjaman->count() > 0)
                    <tr>
                        <td colspan="8" class="sub-table-container">
                            <table class="sub-table">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">No</th>
                                        <th style="width: 100px;">Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th style="width: 120px;">Nomor Seri</th>
                                        <th style="width: 120px;">Jenis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($p->detailPeminjaman as $i => $d)
                                        <tr>
                                            <td class="text-center">{{ $i + 1 }}</td>
                                            <td class="text-center">{{ $d->kode_barang }}</td>
                                            <td>{{ $d->barang->nama_barang ?? 'Tidak Diketahui' }}</td>
                                            <td>{{ $d->barang->nomor_seri ?? '-' }}</td>
                                            <td>{{ $d->barang->jenisBarang->jenis_barang ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 20px;">Tidak ada data penggunaan pada periode ini</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak otomatis oleh Sistem ESIMPROD pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}
    </div>
</body>
</html>