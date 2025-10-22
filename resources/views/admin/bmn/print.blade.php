<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
  <title>Laporan Barang BMN</title>
  <style>
    * {
      font-family: "Calibri", Arial, sans-serif;
      box-sizing: border-box;
    }

    body {
      margin: 30px;
      color: #111827;
      background-color: #ffffff;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 3px solid #2563eb;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .header-left h2 {
      margin: 0;
      font-size: 26px;
      color: #1e3a8a;
    }

    .header-left p {
      margin: 3px 0;
      font-size: 14px;
    }

    .header-right {
      text-align: right;
    }

    .header-right img {
      width: 100px;
      height: auto;
    }

    .header-right small {
      display: block;
      margin-top: 4px;
      color: #6b7280;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
      font-size: 14px;
    }

    th {
      background-color: #2563eb;
      color: #ffffff;
      padding: 8px;
      text-align: center;
      border: 1px solid #ddd;
    }

    td {
      border: 1px solid #ddd;
      padding: 6px;
      text-align: center;
      vertical-align: middle;
    }

    tr:nth-child(even) {
      background-color: #f9fafb;
    }

    .foto img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .no-print {
      text-align: right;
      margin-bottom: 10px;
    }

    .no-print button {
      background-color: #2563eb;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 6px 12px;
      cursor: pointer;
      font-size: 14px;
    }

    .no-print button:hover {
      background-color: #1d4ed8;
    }

    @media print {
      .no-print {
        display: none;
      }
    }

    .footer {
      margin-top: 30px;
      text-align: right;
      font-size: 12px;
      color: #6b7280;
    }
  </style>
</head>

<body>

  <div class="no-print">
    <button onclick="window.print()">🖨️ Cetak Laporan</button>
  </div>

  <div class="header">
    <div class="header-left">
      <h2>Laporan Data Barang BMN</h2>
      <p>Ruangan: {{ strtoupper($ruangan ?? '-') }}</p>
      <p>Periode: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
    </div>
    <div class="header-right">
      @php
        $logoPath = public_path('img/assets/esimprod_logo.png');
      @endphp
      @if(file_exists($logoPath))
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents($logoPath)) }}" alt="ESIMPROD Logo">
      @else
        <span>ESIMPROD</span>
      @endif
      <small>Versi 3.0</small>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Foto</th>
        <th>Nama Barang</th>
        <th>Kode Barang</th>
        <th>Kategori</th>
        <th>Tahun Pengadaan</th>
        <th>Jumlah</th>
        <th>Persentase Kondisi</th>
        <th>Kondisi</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($data as $b)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td class="foto">
            @if($b->foto && file_exists(public_path('storage/' . $b->foto)))
              <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('storage/' . $b->foto))) }}">
            @else
              -
            @endif
          </td>
          <td>{{ $b->nama_barang }}</td>
          <td>{{ $b->kode_barang }}</td>
          <td>{{ $b->kategori ?? '-' }}</td>
          <td>{{ $b->tahun_pengadaan ?? '-' }}</td>
          <td>{{ $b->jumlah ?? '-' }}</td>
          <td>{{ $b->persentase_kondisi ? $b->persentase_kondisi . '%' : '-' }}</td>
          <td>
            @if ($b->kondisi == 'Sangat Baik')
              <span style="color: #16a34a; font-weight: bold;">{{ $b->kondisi }}</span>
            @elseif ($b->kondisi == 'Baik')
              <span style="color: #15803d;">{{ $b->kondisi }}</span>
            @elseif ($b->kondisi == 'Kurang Baik' || $b->kondisi == 'Cacat')
              <span style="color: #eab308;">{{ $b->kondisi }}</span>
            @elseif ($b->kondisi == 'Rusak')
              <span style="color: #dc2626; font-weight: bold;">{{ $b->kondisi }}</span>
            @else
              <span>-</span>
            @endif
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="9">Tidak ada data barang untuk ruangan ini.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div class="footer">
    Dicetak pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}
  </div>
</body>

</html>
