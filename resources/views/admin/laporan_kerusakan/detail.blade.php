@extends('layouts.admin.main')

@section('content')

<div class="p-6 max-w-3xl mx-auto">

    <h2 class="text-xl font-bold mb-4">Detail Laporan Kerusakan</h2>

    <div class="bg-white p-6 rounded-lg shadow">

        <p><b>Barang :</b> {{ $laporan->barang->nama_barang }}</p>
        <p><b>Jenis Kerusakan :</b> {{ $laporan->jenis_kerusakan }}</p>
        <p><b>Deskripsi :</b> {{ $laporan->deskripsi }}</p>

        @if ($laporan->foto)
            <img src="{{ asset('storage/'.$laporan->foto) }}"
                 class="w-48 mt-3 rounded shadow">
        @endif

        <div class="mt-5 flex gap-3">

            <form action="{{ route('admin.laporan-kerusakan.setujui', $laporan->uuid) }}" method="POST">
                @csrf
                <button class="px-4 py-2 bg-green-600 text-white rounded">Setujui</button>
            </form>

            <form action="{{ route('admin.laporan-kerusakan.tolak', $laporan->uuid) }}" method="POST">
                @csrf
                <button class="px-4 py-2 bg-red-600 text-white rounded">Tolak</button>
            </form>

        </div>

    </div>

</div>

@endsection
