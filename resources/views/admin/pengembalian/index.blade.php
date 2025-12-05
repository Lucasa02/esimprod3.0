@extends('layouts.admin.main')

@section('content')
  <div class="flex p-3 ml-3 mr-3">
    @if (Route::currentRouteName() == 'pengembalian.search')
      @if ($pengembalian->isEmpty())
        <a href="{{ route('pengembalian.index') }}"
          class="mr-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
          Kembali
        </a>
      @endif
    @endif
  </div>

  <div class="flex flex-col md:flex-row justify-between items-center w-full p-3 ml-3 mr-3">

  <form action="{{ route('pengembalian.search') }}" method="GET"
    class="flex space-x-3 w-full md:w-auto">

    <input id="search-input" type="text" name="search" value="{{ request('search') }}"
      placeholder="Cari kode pengembalian..."
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2 dark:bg-gray-700 dark:text-white w-48">

    <select name="bulan"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2 dark:bg-gray-700 dark:text-white">
      <option value="">Semua Bulan</option>
      @for ($m = 1; $m <= 12; $m++)
        <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
          {{ date('F', mktime(0, 0, 0, $m, 1)) }}
        </option>
      @endfor
    </select>

    <select name="tahun"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2 dark:bg-gray-700 dark:text-white">
      <option value="">Semua Tahun</option>
      @for ($y = 2023; $y <= date('Y'); $y++)
        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
          {{ $y }}
        </option>
      @endfor
    </select>

    <select name="status"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2 dark:bg-gray-700 dark:text-white">
      <option value="">Semua Status</option>
      <option value="Lengkap" {{ request('status') == 'Lengkap' ? 'selected' : '' }}>Lengkap</option>
      <option value="Tidak Lengkap" {{ request('status') == 'Tidak Lengkap' ? 'selected' : '' }}>Tidak Lengkap</option>
    </select>

    <button type="submit"
      class="text-white bg-blue-600 hover:bg-blue-700 rounded-lg px-4 py-2">
      Filter
    </button>

  </form>

  {{-- BUTTON CETAK PDF --}}
  <a href="{{ route('pengembalian.cetak', request()->only(['search','bulan','tahun','status'])) }}"
    class="flex items-center space-x-2 text-white bg-red-600 hover:bg-red-700 rounded-lg px-4 py-2"
    target="_blank">
    <i class="fa-solid fa-print"></i>
    <span>Cetak PDF</span>
  </a>

</div>

  @if ($pengembalian->isEmpty())
    <x-empty-data></x-empty-data>
  @else
    <div class="flex flex-col p-3 ml-3">
      <div class="relative overflow-x-auto sm:rounded-lg border rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-md text-gray-700 capitalize bg-gray-50 dark:bg-gray-700 dark:text-gray-400 font-bold">
            <tr>
              <th scope="col" class="px-6 py-3 text-center">No.</th>
              <th scope="col" class="px-6 py-3 text-center">Kode Pengembalian</th>
              <th scope="col" class="px-6 py-3 text-center">Kode Penggunaan</th>
              <th scope="col" class="px-6 py-3 text-center">Tanggal Kembali</th>
              <th scope="col" class="px-6 py-3 text-center">Peminjam</th>
              <th scope="col" class="px-6 py-3 text-center">Status</th>
              <th scope="col" class="px-6 py-3 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pengembalian as $row)
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                  {{ $pengembalian->firstItem() + $loop->index }}
                </th>
                <td class="px-6 py-4 text-center font-medium">{{ $row->kode_pengembalian }}</td>
                <td class="px-6 py-4 text-center">{{ $row->kode_peminjaman }}</td>
                <td class="px-6 py-4 text-center">{{ date('d F Y', strtotime($row->tanggal_kembali)) }}</td>
                <td class="px-6 py-4 text-center">{{ $row->peminjam }}</td>
                <td class="px-6 py-4 text-center">
                  @if ($row->status == 'Tidak Lengkap')
                    <span
                      class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"><i
                        class="fa-solid fa-circle-xmark mr-2"></i>Tidak Lengkap</span>
                  @else
                    <span
                      class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300"><i
                        class="fa-solid fa-circle-check mr-2"></i>Lengkap</span>
                  @endif
                </td>

                <td class="flex items-center px-6 py-4 justify-center space-x-2">
                  <a href="{{ route('pengembalian.show', ['uuid' => $row->uuid]) }}"
                    class="text-white bg-yellow-300 hover:bg-yellow-500 font-medium rounded-lg text-sm px-2 py-1">Detail</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @endif

  <div class="p-3 ml-3">
    {{ $pengembalian->links() }}
  </div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');

    // Cegah submit jika user menekan Enter di kolom search dalam keadaan kosong
    searchInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && searchInput.value.trim() === "") {
            e.preventDefault();
            alert("Kolom pencarian tidak boleh kosong!");
        }
    });
});
</script>
