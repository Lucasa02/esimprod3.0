@php $title = 'Laporan Bulanan Penggunaan'; @endphp
@extends('layouts.admin.main')

@section('content')
<div class="ml-3 mr-3 p-3">
  <a href="{{ route('peminjaman.index') }}"
    class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 rounded-lg focus:ring-4 focus:ring-blue-300">
    Kembali
  </a>

  <script>
    function toggleFilterOptions() {
      const tipe = document.getElementById('tipe_filter').value;
      document.getElementById('bulanTahunFields').classList.toggle('hidden', tipe !== 'bulan');
      document.getElementById('tanggalFields').classList.toggle('hidden', tipe !== 'tanggal');
    }
    document.addEventListener('DOMContentLoaded', toggleFilterOptions);
  </script>

  <div class="container mx-auto py-8">
    {{-- HEADER --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6">
      <div class="flex justify-between items-start mb-4">
        <div>
          <h2 class="text-2xl font-bold text-gray-800">Laporan Penggunaan Detail</h2>
          <p class="text-gray-600">
            Periode:
            <span class="font-semibold text-black">
              @if (request('tipe_filter') == 'tanggal' && request('tanggal_awal') && request('tanggal_akhir'))
                {{ \Carbon\Carbon::parse(request('tanggal_awal'))->translatedFormat('d F Y') }} -
                {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->translatedFormat('d F Y') }}
              @elseif(request('tipe_filter') == 'bulan' && request('bulan') && request('tahun'))
                {{ \Carbon\Carbon::createFromDate(request('tahun'), request('bulan'), 1)->translatedFormat('F Y') }}
              @else
                Semua Periode
              @endif
            </span>
          </p>
        </div>
        <div class="text-right">
          <img src="{{ asset('img/assets/esimprod_logo.png') }}" alt="Esimprod" class="w-20 mx-auto mb-1">
          <p class="text-sm text-gray-500">Version 2.2</p>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
        <div>
          <p class="text-gray-700 mb-2"><span class="font-bold">Dibuat oleh:</span> {{ Auth::user()->name }}</p>
          <p class="text-gray-700 mb-2"><span class="font-bold">NIP:</span> {{ Auth::user()->nip }}</p>
          <p class="text-gray-700 mb-2"><span class="font-bold">Jabatan:</span> {{ Auth::user()->jabatan->jabatan ?? '-' }}</p>
        </div>
        <div class="text-right">
          <p class="text-gray-700 mb-2"><span class="font-bold">Tanggal Cetak:</span> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
          <a href="{{ route('peminjaman.laporan-bulanan.pdf', [
            'tipe_filter' => request('tipe_filter'),
            'bulan' => request('bulan'),
            'tahun' => request('tahun'),
            'tanggal_awal' => request('tanggal_awal'),
            'tanggal_akhir' => request('tanggal_akhir'),
            'peruntukan' => request('peruntukan'),
            'urutan' => request('urutan'),
          ]) }}"
            class="inline-flex items-center mt-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow">
            <i class="fa-solid fa-file-pdf mr-2"></i> Download PDF
          </a>
        </div>
      </div>
    </div>

    {{-- FILTER & TABEL --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6">
      {{-- HEADER & FILTER --}}
      <div class="flex flex-col md:flex-row justify-between md:items-center mb-4 gap-4">
        <h3 class="text-lg font-bold text-black">Filter Data Penggunaan</h3>

        <form action="{{ route('peminjaman.laporan.bulanan') }}" method="GET"
          class="flex flex-wrap items-end gap-2">

          {{-- FILTER TIPE --}}
          <div>
            <label for="tipe_filter" class="text-xs font-medium text-gray-700 block">Filter Berdasarkan</label>
            <select name="tipe_filter" id="tipe_filter" onchange="toggleFilterOptions()" class="border border-gray-300 text-gray-900 text-xs rounded-lg p-1.5">
              <option value="">Semua</option>
              <option value="bulan" {{ request('tipe_filter') == 'bulan' ? 'selected' : '' }}>Bulan</option>
              <option value="tanggal" {{ request('tipe_filter') == 'tanggal' ? 'selected' : '' }}>Tanggal</option>
            </select>
          </div>

          {{-- BULAN & TAHUN --}}
          <div id="bulanTahunFields" class="flex items-center gap-2 {{ request('tipe_filter') == 'bulan' ? '' : 'hidden' }}">
            <select name="bulan" id="bulan" class="border border-gray-300 text-gray-900 text-xs rounded-lg p-1.5">
              <option value="">Bulan</option>
              @foreach (range(1, 12) as $b)
                <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                  {{ DateTime::createFromFormat('!m', $b)->format('F') }}
                </option>
              @endforeach
            </select>
            <select name="tahun" id="tahun" class="border border-gray-300 text-gray-900 text-xs rounded-lg p-1.5">
              @foreach (range(date('Y'), date('Y') - 5) as $t)
                <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>
                  {{ $t }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- RENTANG TANGGAL --}}
          <div id="tanggalFields" class="flex items-center gap-2 {{ request('tipe_filter') == 'tanggal' ? '' : 'hidden' }}">
            <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="border border-gray-300 text-gray-900 text-xs rounded-lg p-1.5">
            <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="border border-gray-300 text-gray-900 text-xs rounded-lg p-1.5">
          </div>

          {{-- PERUNTUKAN --}}
          <div>
            <label for="peruntukan" class="text-xs font-medium text-gray-700 block">Peruntukan</label>
            <select name="peruntukan" id="peruntukan" class="border border-gray-300 text-gray-900 text-xs rounded-lg p-1.5">
              <option value="">Semua</option>
              @foreach ($daftarPeruntukan as $p)
                <option value="{{ $p->id }}" {{ request('peruntukan') == $p->id ? 'selected' : '' }}>
                  {{ $p->peruntukan }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- URUTKAN --}}
          <div>
            <label for="urutan" class="text-xs font-medium text-gray-700 block">Urutkan</label>
            <select name="urutan" id="urutan" class="border border-gray-300 text-gray-900 text-xs rounded-lg p-1.5">
              <option value="desc" {{ request('urutan') == 'desc' ? 'selected' : '' }}>Terbaru (Z - A)</option>
              <option value="asc" {{ request('urutan') == 'asc' ? 'selected' : '' }}>Terlama (A - Z)</option>
            </select>
          </div>

          {{-- BUTTON --}}
          <div class="flex items-center gap-2">
            <button type="submit"
              class="text-white bg-blue-700 hover:bg-blue-800 rounded-lg text-xs px-3 py-2">Tampilkan</button>
            @if (request()->anyFilled(['bulan','tahun','tanggal_awal','tanggal_akhir','peruntukan']))
              <a href="{{ route('peminjaman.laporan.bulanan') }}"
                class="text-white bg-gray-600 hover:bg-gray-700 rounded-lg text-xs px-3 py-2">Reset</a>
            @endif
          </div>
        </form>
      </div>

      {{-- TABEL --}}
      <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-700">
          <thead class="text-xs text-black uppercase bg-gray-100">
            <tr>
              <th class="px-6 py-3">No</th>
              <th class="px-6 py-3">Nomor Penggunaan</th>
              <th class="px-6 py-3">Penggunaan</th>
              <th class="px-6 py-3">Tanggal Penggunaan</th>
              <th class="px-6 py-3">Tanggal Kembali</th>
              <th class="px-6 py-3">Jumlah Barang</th>
              <th class="px-6 py-3">Peruntukan</th>
              <th class="px-6 py-3">Status</th>
            </tr>
          </thead>
          <tbody>
            @php $no = 1; @endphp
            @forelse ($peminjamanBulanan as $p)
              <tr class="bg-white border-b hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-medium text-gray-900">{{ $no++ }}</td>
                <td class="px-6 py-4">{{ $p->nomor_peminjaman }}</td>
                <td class="px-6 py-4">{{ $p->peminjam }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($p->tanggal_peminjaman)->translatedFormat('d F Y') }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($p->tanggal_kembali)->translatedFormat('d F Y') }}</td>
                <td class="px-6 py-4">{{ $p->detailPeminjaman->count() }}</td>
                <td class="px-6 py-4">{{ $p->peruntukan->peruntukan ?? '-' }}</td>
                <td class="px-6 py-4">
                  @if ($p->status === 'Proses')
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded"><i class="fa-solid fa-spinner mr-1"></i>Proses</span>
                  @else
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded"><i class="fa-solid fa-circle-check mr-1"></i>Selesai</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center py-4 text-gray-500">Tidak ada data penggunaan sesuai filter.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
