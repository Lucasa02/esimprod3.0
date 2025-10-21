<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Bulanan Peminjaman</title>

  <style>
    * { font-family: "DejaVu Sans", sans-serif; box-sizing: border-box; }
    body { margin: 15px 25px; font-size: 12px; }

    h2, h4 { margin: 0; }
    .header-table { width: 100%; margin-bottom: 15px; }
    .header-left { font-size: 20px; font-weight: bold; }
    .header-right { text-align: right; }

    .periode { font-size: 13px; margin-top: 5px; color: #333; }

    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th {
      background-color: #2563eb;
      color: #fff;
      font-size: 11.5px;
      padding: 7px;
      border: 1px solid #ccc;
      text-align: center;
      vertical-align: middle;
    }
    td {
      border: 1px solid #ccc;
      padding: 6px 8px;
      font-size: 11.5px;
      vertical-align: top;
    }
    tr:nth-child(even) { background-color: #f8fafc; }

    .sub-table {
      width: 98%;
      margin: 6px auto;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .sub-table th {
      background-color: #e0e7ff;
      color: #000;
      font-size: 11px;
      padding: 6px;
    }
    .sub-table td {
      font-size: 10.5px;
      padding: 5px 6px;
    }

    .footer {
      width: 100%;
      text-align: right;
      font-size: 10.5px;
      color: #555;
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 8px 20px;
      border-top: 1px solid #ccc;
    }

    @page { size: A4 landscape; margin: 15mm 20mm 18mm 20mm; }
  </style>
</head>

<body>
  {{-- HEADER --}}
  <table class="header-table">
    <tr>
      <td style="width: 60%;">
        <div class="header-left">Laporan Bulanan Peminjaman</div>
        <div class="periode">Periode: <strong>{{ $periode }}</strong></div>
      </td>
      <td class="header-right">
        <img src="{{ public_path('img/assets/esimprod_logo.png') }}" alt="Esimprod" width="85">
        <div style="font-size: 11px;">Version 3.0</div>
      </td>
    </tr>
  </table>

  {{-- TABEL UTAMA --}}
  <table>
    <thead>
      <tr>
        <th style="width: 3%;">No</th>
        <th style="width: 10%;">Kode Peminjaman</th>
        <th style="width: 10%;">Nomor Peminjaman</th>
        <th style="width: 13%;">Peminjam</th>
        <th style="width: 12%;">Peruntukan</th>
        <th style="width: 10%;">Tgl Pinjam</th>
        <th style="width: 10%;">Tgl Kembali</th>
        <th style="width: 10%;">Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($peminjamanBulanan as $key => $p)
        <tr>
          <td style="text-align: center;">{{ $key + 1 }}</td>
          <td>{{ $p->kode_peminjaman }}</td>
          <td>{{ $p->nomor_peminjaman }}</td>
          <td>{{ $p->peminjam }}</td>
          <td>{{ $p->peruntukan->peruntukan ?? '-' }}</td>
          <td style="text-align: center;">{{ \Carbon\Carbon::parse($p->tanggal_peminjaman)->format('d/m/Y') }}</td>
          <td style="text-align: center;">{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') }}</td>
          <td style="text-align: center;">{{ $p->status }}</td>
        </tr>

        {{-- TABEL DETAIL BARANG --}}
        @if ($p->detailPeminjaman->count() > 0)
          <tr>
            <td colspan="8" style="padding: 0;">
              <table class="sub-table">
                <thead>
                  <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Kode Barang</th>
                    <th style="width: 35%;">Nama Barang</th>
                    <th style="width: 20%;">Nomor Seri</th>
                    <th style="width: 20%;">Jenis Barang</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($p->detailPeminjaman as $i => $d)
                    <tr>
                      <td style="text-align: center;">{{ $i + 1 }}</td>
                      <td>{{ $d->kode_barang }}</td>
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
          <td colspan="8" style="text-align: center;">Tidak ada data peminjaman pada periode ini</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  {{-- FOOTER --}}
  <div class="footer">
    Dicetak pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}
  </div>
</body>
</html>
