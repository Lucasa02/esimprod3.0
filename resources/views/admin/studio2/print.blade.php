<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Data Peralatan Studio</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    @media print {
      body {
        background: white;
        margin: 0;
      }
      .no-print {
        display: none !important;
      }
      table {
        border-collapse: collapse;
        width: 100%;
        font-size: 12px;
      }
      th, td {
        border: 1px solid #000;
        padding: 6px;
      }
      h1 {
        font-size: 18px;
        margin-bottom: 10px;
      }
    }
  </style>
</head>

<body class="bg-white text-gray-900 font-sans p-6">

  {{-- Header --}}
  <div class="text-center mb-6">
    <h1 class="text-2xl font-bold">LAPORAN DATA PERALATAN STUDIO</h1>
    <p class="text-sm text-gray-600">Dicetak pada: {{ now()->format('d F Y') }}</p>
  </div>

  {{-- Tombol Cetak & Kembali --}}
  <div class="flex justify-between items-center mb-4 no-print">
    <a href="{{ route('studio2.index') }}" class="bg-gray-600 hover:bg-gray-800 text-white px-4 py-2 rounded">
      ← Kembali
    </a>
    <button onclick="window.print()" class="bg-blue-700 hover:bg-blue-900 text-white px-4 py-2 rounded">
      🖨 Cetak Halaman Ini
    </button>
  </div>

  {{-- Tabel Data --}}
  <div class="overflow-x-auto">
    <table class="min-w-full border border-gray-400 text-sm">
      <thead class="bg-gray-100 text-gray-800 font-semibold">
        <tr>
          <th class="border border-gray-400 px-3 py-2 text-center w-8">No</th>
          <th class="border border-gray-400 px-3 py-2">Nama Barang</th>
          <th class="border border-gray-400 px-3 py-2">Kode Barang</th>
          <th class="border border-gray-400 px-3 py-2">Kategori</th>
          <th class="border border-gray-400 px-3 py-2">Merk</th>
          <th class="border border-gray-400 px-3 py-2">Nomor Seri</th>
          <th class="border border-gray-400 px-3 py-2 text-center">Jumlah</th>
          <th class="border border-gray-400 px-3 py-2 text-center">Kondisi (%)</th>
          <th class="border border-gray-400 px-3 py-2 text-center">Tahun Pengadaan</th>
          <th class="border border-gray-400 px-3 py-2">Asal Pengadaan</th>
          <th class="border border-gray-400 px-3 py-2 text-center">Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($barangs as $index => $barang)
          <tr class="hover:bg-gray-50">
            <td class="border border-gray-400 px-3 py-1 text-center">{{ $index + 1 }}</td>
            <td class="border border-gray-400 px-3 py-1">{{ $barang->nama_barang }}</td>
            <td class="border border-gray-400 px-3 py-1">{{ $barang->kode_barang }}</td>
            <td class="border border-gray-400 px-3 py-1">{{ $barang->jenis_barang_id ?? '-' }}</td>
            <td class="border border-gray-400 px-3 py-1">{{ $barang->merk ?? '-' }}</td>
            <td class="border border-gray-400 px-3 py-1">{{ $barang->nomor_seri ?? '-' }}</td>
            <td class="border border-gray-400 px-3 py-1 text-center">{{ $barang->jumlah ?? '-' }}</td>
            <td class="border border-gray-400 px-3 py-1 text-center">{{ $barang->kondisi ?? '-' }}</td>
            <td class="border border-gray-400 px-3 py-1 text-center">{{ $barang->tahun_pengadaan ?? '-' }}</td>
            <td class="border border-gray-400 px-3 py-1">{{ $barang->asal_pengadaan ?? '-' }}</td>
            <td class="border border-gray-400 px-3 py-1 text-center">{{ $barang->status ?? '-' }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="11" class="border border-gray-400 px-3 py-2 text-center text-gray-500">
              Tidak ada data untuk ditampilkan.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Footer Tanda Tangan --}}
  <div class="mt-10 text-sm">
    <p class="text-right mb-1">Banjarmasin, {{ now()->format('d F Y') }}</p>
    <br><br><br>
    <p class="text-right mr-6">__________________________</p>
    <p class="text-right mr-6 text-gray-600">Petugas Inventaris</p>
  </div>

</body>
</html>
