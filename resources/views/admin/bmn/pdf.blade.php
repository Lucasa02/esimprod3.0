<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>{{ $title }}</title>
  <style>
      body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
      table { width: 100%; border-collapse: collapse; margin-top: 10px; }
      th, td { border: 1px solid #000; padding: 6px; text-align: left; }
      th { background-color: #f0f0f0; }
      h2, h3 { text-align: center; margin: 5px 0; }
      .filters { margin-bottom: 10px; }
  </style>
</head>
<body>
  <h2>{{ $title }}</h2>
  <h3>Ruangan: {{ ucfirst($ruangan) }}</h3>

  {{-- Tampilkan filter --}}
  <div class="filters">
    <strong>Filter:</strong>
    <ul>
      @if($filterTahun)<li>Tahun Pengadaan: {{ $filterTahun }}</li>@endif
      @if($filterKondisi)<li>Kondisi: {{ $filterKondisi }}</li>@endif
      @if($filterKategori)<li>Kategori: {{ $filterKategori }}</li>@endif
      @if($filterAsal)<li>Asal Pengadaan: {{ $filterAsal }}</li>@endif
      @if($filterPosisi)<li>Posisi: {{ $filterPosisi }}</li>@endif
      @if(!$filterTahun && !$filterKondisi && !$filterKategori && !$filterAsal && !$filterPosisi)
        <li>Tidak ada filter (semua data)</li>
      @endif
    </ul>
  </div>

  <table>
      <thead>
          <tr>
              <th>No</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Kategori</th>
              <th>Merk</th>
              <th>Kondisi</th>
              <th>Persentase</th>
              <th>Tahun Perolehan</th>
              <th>Asal Pengadaan</th>
              <th>Posisi</th>
              <th>ruangan</th>
              <th>Keterangan</th>
          </tr>
      </thead>
      <tbody>
          @forelse ($data as $i => $item)
              <tr>
                  <td>{{ $i + 1 }}</td>
                  <td>{{ $item->kode_barang }}</td>
                  <td>{{ $item->nama_barang }}</td>
                  <td>{{ $item->kategori }}</td>
                  <td>{{ $item->merk }}</td>
                  <td>{{ $item->kondisi }}</td>
                  <td>{{ $item->persentase_kondisi }}%</td>
                  <td>{{ $item->tahun_pengadaan }}</td>
                  <td>{{ $item->asal_pengadaan }}</td>
                  <td>{{ $item->posisi }}</td>
                  <td>{{ $item->ruangan }}</td>
                  <td>{{ $item->catatan }}</td>
              </tr>
          @empty
              <tr>
                  <td colspan="10" style="text-align:center;">Tidak ada data dengan filter ini.</td>
              </tr>
          @endforelse
      </tbody>
  </table>
</body>
</html>
