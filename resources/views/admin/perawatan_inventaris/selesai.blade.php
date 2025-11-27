@extends('layouts.admin.main')

@section('content')

<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">
        Selesaikan Perbaikan
    </h2>

    <div class="mb-4">
        <p class="text-sm text-gray-600 dark:text-gray-300">
            <strong>Nama Barang:</strong> {{ $data->barang->nama_barang }}
        </p>
        <p class="text-sm text-gray-600 dark:text-gray-300">
            <strong>Tanggal Perawatan:</strong> {{ $data->tanggal_perawatan }}
        </p>
    </div>

    <form action="{{ route('perawatan_inventaris.selesaiSubmit', $data->id) }}" 
          method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label class="block mb-1 text-gray-700 dark:text-gray-300 text-sm">Deskripsi Perbaikan</label>
            <textarea name="deskripsi" rows="4"
                class="w-full border rounded p-2 bg-slate-50 dark:bg-slate-700 text-gray-800 dark:text-gray-200"
                required>{{ old('deskripsi') }}</textarea>
        </div>

        {{-- Biaya --}}
        <div class="mb-4">
            <label class="block mb-1 text-gray-700 dark:text-gray-300 text-sm">Biaya Perbaikan</label>
            <input type="number" name="biaya" 
                class="w-full border rounded p-2 bg-slate-50 dark:bg-slate-700 text-gray-800 dark:text-gray-200"
                required>
        </div>

        {{-- Foto Bukti --}}
        <div class="mb-4">
            <label class="block mb-1 text-gray-700 dark:text-gray-300 text-sm">Foto Bukti (Opsional)</label>
            <input type="file" name="foto_bukti"
                class="w-full border rounded p-2 bg-slate-50 dark:bg-slate-700 text-gray-800 dark:text-gray-200">
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('perawatan_inventaris.index') }}"
                class="px-4 py-2 rounded bg-gray-500 hover:bg-gray-600 text-white">
                Kembali
            </a>

            <button type="submit"
                class="px-4 py-2 rounded bg-green-600 hover:bg-green-700 text-white font-semibold">
                Simpan & Selesaikan
            </button>
        </div>

    </form>

</div>

@endsection
