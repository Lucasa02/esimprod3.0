<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Laporan Barang BMN' }}</title>
  <style>
    * { font-family: "Calibri", Arial, sans-serif; box-sizing: border-box; }
    body { margin: 20px; color: #111827; background-color: #fff; }
    .header { display: flex; justify-content: space-between; align-items: center;
              border-bottom: 3px solid #2563eb; padding-bottom: 10px; margin-bottom: 20px; }
    .header-left h2 { margin: 0; font-size: 24px; color: #1e3a8a; }
    .header-left p { margin: 3px 0; font-size: 14px; }
    .header-right { text-align: right; }
    .header-right img { width: 90px; height: auto; }
    .header-right small { display: block; margin-top: 4px; color: #6b7280; }

    table { width: 100%; border-collapse: collapse; font-size: 13px; margin-top: 15px; }
    th { background-color: #2563eb; color: #fff; padding: 6px; text-align: center; border: 1px solid #ddd; }
    td { border: 1px solid #ddd; padding: 6px; text-align: center; vertical-align: middle; }
    tr:nth-child(even) { background-color: #f9fafb; }
    .foto img { width: 55px; height: 55px; object-fit: cover; border-radius: 6px; border: 1px solid #ccc; }
    .footer { margin-top: 30px; text-align: right; font-size: 12px; color: #6b7280; }
  </style>
</head>

<body>
  <div class="header">
    <div class="header-left">
      <h2>Laporan Data Barang BMN</h2>
      <p>Ruangan: {{ strtoupper($ruangan ?? '-') }}</p>
      <p>Periode: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
    </div>
    <div class="header-right">
      @php $logoPath = public_path('img/assets/esimprod_logo.png'); @endphp
      @if(file_exists($logoPath))
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents($logoPath)) }}" alt="Logo">
      @endif
      <small>ESIMPROD v3.0</small>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Foto</th>
        <th>Nama Barang</th>
        <th>Kode</th>
        <th>Kategori</th>
        <th>Tahun</th>
        <th>Jumlah</th>
        <th>Kondisi (%)</th>
        <th>Status</th>
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
            @switch($b->kondisi)
              @case('Sangat Baik') <span style="color:#16a34a;font-weight:bold">{{ $b->kondisi }}</span> @break
              @case('Baik') <span style="color:#22c55e">{{ $b->kondisi }}</span> @break
              @case('Kurang Baik') <span style="color:#eab308">{{ $b->kondisi }}</span> @break
              @case('Rusak / Cacat') <span style="color:#dc2626;font-weight:bold">{{ $b->kondisi }}</span> @break
              @default <span>-</span>
            @endswitch
          </td>
        </tr>
      @empty
        <tr><td colspan="9">Tidak ada data barang untuk ruangan ini.</td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="footer">
    Dicetak pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}
  </div>
</body>
</html>
