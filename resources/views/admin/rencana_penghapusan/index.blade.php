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
        class="w-full h-40 object-cover" alt="Foto Barang">

    <div class="p-4">

        {{-- Nama --}}
        <p class="font-semibold text-gray-900 dark:text-white text-sm">
            {{ $row->barang->nama_barang }}
        </p>

        {{-- Kode --}}
        <p class="text-xs text-gray-500 dark:text-gray-400">
            {{ $row->barang->kode_barang }}
        </p>

        {{-- Status --}}
        <span class="inline-block bg-red-200 text-red-800 text-xs font-semibold px-2 py-1 mt-2 rounded-full">
            Rencana Penghapusan
        </span>

        {{-- FORM UPLOAD SURAT --}}
        <form action="{{ route('rencana_penghapusan.uploadSurat', $row->id) }}"
              method="POST" enctype="multipart/form-data" class="mt-3">
            @csrf
            <input type="file" name="surat"
                   accept=".pdf,.jpg,.jpeg,.png"
                   class="w-full text-xs border rounded p-1 mb-2" required>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-3 py-1.5 rounded-lg">
                Upload Surat Penghapusan
            </button>
        </form>

        {{-- Info surat sudah ada --}}
        @if($row->surat_penghapusan)
            <p class="text-green-600 text-xs mt-2">✔ Surat sudah diupload</p>
        @endif

        {{-- TOMBOL HAPUSKAN --}}
        <form action="{{ route('rencana_penghapusan.hapuskan', $row->id) }}"
              method="POST" class="mt-3">
            @csrf

            @if($row->surat_penghapusan)
                <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white text-xs font-semibold px-3 py-1.5 rounded-lg">
                    Hapuskan
                </button>
            @else
                <button type="button"
                    class="w-full bg-gray-400 text-white text-xs font-semibold px-3 py-1.5 rounded-lg cursor-not-allowed">
                    Upload Surat Terlebih Dahulu
                </button>
            @endif
        </form>

    </div>
</div>

        @endforeach

    </div>

</div>

@endsection
