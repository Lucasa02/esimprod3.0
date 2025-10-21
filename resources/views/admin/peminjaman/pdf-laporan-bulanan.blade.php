<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Bulanan Peminjaman</title>

  <style>
    * {
      font-family: "DejaVu Sans", sans-serif;
      box-sizing: border-box;
    }

    body {
      margin: 20px;
      font-size: 13px;
      position: relative;
    }

    h2,
    h4 {
      margin: 0;
    }

    .header-table {
      width: 100%;
      margin-bottom: 20px;
    }

    .header-left {
      font-size: 24px;
      font-weight: bold;
    }

    .header-right {
      text-align: right;
    }

    .periode {
      font-size: 16px;
      margin-top: 5px;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    table th {
      background-color: rgb(96 165 250);
      color: #fff;
      font-size: 13px;
      padding: 8px;
      text-align: left;
      border: 1px solid #ccc;
    }

    table td {
      border: 1px solid #ccc;
      padding: 7px;
      font-size: 12px;
    }

    tr:nth-child(even) {
      background-color: rgb(241 245 249);
    }

    .note-container {
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 16px;
      margin-top: 25px;
      background-color: #f9f9f9;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .note-title {
      font-weight: bold;
      font-size: 13px;
      margin-bottom: 6px;
    }

    .note-content {
      font-size: 12px;
    }

    /* Footer */
    .footer {
      width: 100%;
      text-align: right;
      font-size: 11px;
      color: #555;
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 8px 20px;
      border-top: 1px solid #ccc;
    }

    /* Print-friendly */
    @page {
      margin: 20mm;
    }

    @media print {
      body {
        margin: 0;
      }

      .note-container {
        box-shadow: none;
      }

      .footer {
        position: fixed;
        bottom: 0;
      }
    }
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
        <img src="{{ public_path('img/assets/esimprod_logo.png') }}" alt="Esimprod" width="100">
        <div style="font-size: 13px;">Version 3.0</div>
      </td>
    </tr>
  </table>

  {{-- TABLE DATA --}}
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Kode Peminjaman</th>
        <th>Nomor Peminjaman</th>
        <th>Peminjam</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($peminjamanBulanan as $key => $p)
        <tr>
          <td>{{ $key + 1 }}</td>
          <td>{{ $p->kode_peminjaman }}</td>
          <td>{{ $p->nomor_peminjaman }}</td>
          <td>{{ $p->peminjam }}</td>
          <td>{{ \Carbon\Carbon::parse($p->tanggal_peminjaman)->format('d/m/Y') }}</td>
          <td>{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') }}</td>
          <td>{{ $p->status }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="7" style="text-align: center;">Tidak ada data peminjaman bulan ini</td>
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
