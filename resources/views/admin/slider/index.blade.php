@extends('layouts.admin.main')

@section('content')
<div class="max-w-4xl mx-auto">

    {{-- Judul --}}
    <h2 class="text-2xl font-semibold mb-6">Kelola Gambar Slider</h2>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    {{-- Upload Card --}}
    <div class="bg-white rounded-xl shadow p-6 mb-6 border border-slate-200">
        <h3 class="text-lg font-semibold mb-3">Upload Gambar Baru</h3>

        <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-4">
            @csrf

            <input type="file" name="image" accept="image/*" required
                class="border border-slate-300 p-2 rounded-md w-64">

            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                Upload
            </button>
        </form>
    </div>

    {{-- Table Background --}}
    <div class="bg-white shadow rounded-xl p-4 border border-slate-200">
        <h3 class="text-lg font-semibold mb-4">Table Background</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 border-b">
                        <th class="p-3">Gambar</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($slider as $img)
                        <tr class="border-b">
                            <td class="p-3">
                                <img src="{{ asset('storage/' . $img->image_path) }}"
                                     class="w-24 h-16 object-cover rounded-md border shadow">
                            </td>

                            <td class="p-3">
                                <form action="{{ route('slider.destroy', $img->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus gambar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm shadow">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="p-3 text-center text-slate-500">
                                Belum ada gambar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
