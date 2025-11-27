@extends('layouts.admin.main')

@section('content')

<div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">
        Detail Perbaikan Barang
    </h2>

    <div class="border rounded-lg p-4 bg-gray-50 dark:bg-gray-700 mb-4">

        <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
            <strong>Nama Barang:</strong> {{ $data->barang->nama_barang }}
        </p>

        <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
            <strong>Kode Barang:</strong> {{ $data->barang->kode_barang }}
        </p>

        <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
            <strong>Tanggal Perawatan:</strong> {{ $data->tanggal_perawatan }}
        </p>

        <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
            <strong>Status:</strong> 
            <span class="px-2 py-1 text-white rounded 
                @if($data->status == 'selesai') bg-green-600 
                @elseif($data->status == 'proses') bg-blue-600
                @else bg-yellow-600 @endif">
                {{ ucfirst($data->status) }}
            </span>
        </p>

        <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
            <strong>Deskripsi Perbaikan:</strong><br>
            {{ $data->deskripsi ?? '-' }}
        </p>

        <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
            <strong>Biaya Perbaikan:</strong> 
            {{ $data->biaya ? 'Rp ' . number_format($data->biaya, 0, ',', '.') : '-' }}
        </p>

        @if ($data->foto_bukti)
            <div class="mt-4">
                <strong class="text-gray-700 dark:text-gray-300">Foto Bukti:</strong><br>
                <img src="{{ asset('storage/' . $data->foto_bukti) }}" 
                     class="mt-2 w-64 rounded shadow">
            </div>
        @endif

    </div>

    <div class="flex justify-between mt-6">
        <a href="{{ route('perawatan_inventaris.index') }}"
            class="px-4 py-2 rounded bg-gray-500 hover:bg-gray-600 text-white">
            Kembali
        </a>
    </div>

</div>

@endsection
