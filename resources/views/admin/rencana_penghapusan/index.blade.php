@extends('layouts.admin.main')

@section('content')

<div class="p-6">


    @if ($data->isEmpty())
        <p class="text-center text-gray-500 mt-10">Belum ada barang dalam rencana penghapusan.</p>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

        @foreach ($data as $row)
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">

            {{-- FOTO --}}
            <img src="{{ $row->barang->foto 
                        ? asset('storage/'.$row->barang->foto) 
                        : asset('img/no-image.png') }}"
                class="w-full h-40 object-cover"
                alt="Foto Barang">

            <div class="p-4">

                {{-- Nama Barang --}}
                <p class="font-semibold text-gray-900 dark:text-white text-sm">
                    {{ $row->barang->nama_barang }}
                </p>

                {{-- Kode Barang --}}
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    {{ $row->barang->kode_barang }}
                </p>

                {{-- Status --}}
                <span class="inline-block bg-red-200 text-red-800 text-xs font-semibold px-2 py-1 mt-2 rounded-full">
                    Rencana Penghapusan
                </span>
                {{-- Tombol Hapuskan --}}
                <form action="{{ route('rencana_penghapusan.hapuskan', $row->id) }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white text-xs font-semibold px-3 py-1.5 rounded-lg">
                        Hapuskan
                    </button>
                </form>

            </div>

        </div>
        @endforeach

    </div>

</div>

@endsection
