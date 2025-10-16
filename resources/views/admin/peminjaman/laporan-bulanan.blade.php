@php $title = 'Laporan Bulanan Peminjaman'; @endphp
@extends('layouts.admin.main')

@section('content')
  <div class="ml-3 mr-3 p-3">
    <a href="{{ route('peminjaman.index') }}"
      class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
      Kembali
    </a>

    <div class="container mx-auto py-8">

      {{-- HEADER --}}
      <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex justify-between items-start mb-4">
          <div>
            <h2 class="text-2xl font-bold text-gray-800">Laporan Bulanan Peminjaman</h2>
            <p class="text-gray-600">
              Periode:
              <span class="font-semibold text-black">
                {{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y') }}
              </span>
            </p>
          </div>
          <div class="text-right">
            <img src="{{ asset('img/assets/esimprod_logo.png') }}" alt="Esimprod" class="w-20 mx-auto mb-1">
            <p class="text-sm text-gray-500">Version 3.0</p>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <p class="text-gray-700 mb-2"><span class="font-bold">Dibuat oleh:</span> {{ Auth::user()->name }}</p>
            <p class="text-gray-700 mb-2"><span class="font-bold">NIP:</span> {{ Auth::user()->nip }}</p>
            <p class="text-gray-700 mb-2"><span class="font-bold">Jabatan:</span>
              {{ Auth::user()->jabatan->jabatan ?? '-' }}
            </p>
          </div>
          <div class="text-right">
            <p class="text-gray-700 mb-2"><span class="font-bold">Tanggal Cetak:</span>
              {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </p>
          </div>
        </div>
      </div>

      {{-- TABEL PEMINJAMAN --}}
      <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h3 class="text-lg font-bold text-black mb-4">Daftar Peminjaman Bulanan</h3>
        <div class="relative overflow-x-auto">
          <table class="w-full text-sm text-left text-gray-700">
            <thead class="text-xs text-black uppercase bg-gray-100">
              <tr>
                <th scope="col" class="px-6 py-3">No</th>
                <th scope="col" class="px-6 py-3">Nomor Peminjaman</th>
                <th scope="col" class="px-6 py-3">Peminjam</th>
                <th scope="col" class="px-6 py-3">Tanggal Peminjaman</th>
                <th scope="col" class="px-6 py-3">Tanggal Kembali</th>
                <th scope="col" class="px-6 py-3">Jumlah Barang</th>
                <th scope="col" class="px-6 py-3">Status</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach ($peminjamanBulanan as $p)
                <tr class="bg-white border-b">
                  <td class="px-6 py-4 font-medium text-gray-900">{{ $no++ }}</td>
                  <td class="px-6 py-4">{{ $p->nomor_peminjaman }}</td>
                  <td class="px-6 py-4">{{ $p->peminjam }}</td>
                  <td class="px-6 py-4">{{ \Carbon\Carbon::parse($p->tanggal_peminjaman)->translatedFormat('d F Y') }}</td>
                  <td class="px-6 py-4">{{ \Carbon\Carbon::parse($p->tanggal_kembali)->translatedFormat('d F Y') }}</td>
                  <td class="px-6 py-4">{{ $p->detailPeminjaman->count() }}</td>
                  <td class="px-6 py-4">
                    @if ($p->status === 'Proses')
                      <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">
                        <i class="fa-solid fa-spinner mr-1"></i>Proses
                      </span>
                    @else
                      <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">
                        <i class="fa-solid fa-circle-check mr-1"></i>Selesai
                      </span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      {{-- CATATAN --}}
      <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-bold text-black mb-4">Catatan Bulanan</h3>
        <div class="text-gray-700 text-sm leading-relaxed">
          @foreach ($catatan as $c)
            <div class="mb-3 border-b border-gray-200 pb-2">{!! $c->isi_catatan !!}</div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
