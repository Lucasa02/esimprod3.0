@extends('layouts.admin.main')

@section('content')
<div class="-m-1.5 overflow-x-auto ml-5 mr-3">
    <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="border rounded-lg shadow overflow-hidden dark:border-neutral-700">
            <div class="container mx-auto p-4">

                <form action="{{ route('bmn.update', [$ruangan, $barang->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4">
                        {{-- Kolom kiri --}}
                        <div class="flex flex-col space-y-4">
                            {{-- Nama Barang --}}
                            <div>
                                <label class="block text-sm font-bold text-black">Nama Barang</label>
                                <input type="text" name="nama_barang" autocomplete="off"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                                @error('nama_barang')
                                    <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Kode Barang --}}
                            <div>
                                <label class="block text-sm font-bold text-black">Kode Barang</label>
                                <input type="text" name="kode_barang" autocomplete="off"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    value="{{ old('kode_barang', $barang->kode_barang) }}" required>
                                @error('kode_barang')
                                    <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Kategori --}}
                            <div>
                                <label class="block text-sm font-bold text-black">Kategori</label>
                                <input type="text" name="kategori" autocomplete="off"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    value="{{ old('kategori', $barang->kategori) }}" required>
                                @error('kategori')
                                    <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Jumlah --}}
                            <div>
                                <label class="block text-sm font-bold text-black">Jumlah</label>
                                <input type="number" name="jumlah" min="1" autocomplete="off"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    value="{{ old('jumlah', $barang->jumlah) }}" required>
                                @error('jumlah')
                                    <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Tahun Pengadaan --}}
                            <div>
                                <label class="block text-sm font-bold text-black">Tahun Pengadaan</label>
                                <input type="number" name="tahun_pengadaan" min="1900" max="{{ date('Y') }}" autocomplete="off"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    value="{{ old('tahun_pengadaan', $barang->tahun_pengadaan) }}">
                                @error('tahun_pengadaan')
                                    <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Persentase Kondisi --}}
                            <div>
                                <label class="block text-sm font-bold text-black">Persentase Kondisi (%)</label>
                                <input type="number" name="persentase_kondisi" min="0" max="100" autocomplete="off"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    value="{{ old('persentase_kondisi', $barang->persentase_kondisi) }}" required>
                                @error('persentase_kondisi')
                                    <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Kondisi Otomatis --}}
                            <div>
                                <label class="block text-sm font-bold text-black">Kondisi (otomatis dihitung)</label>
                                <input type="text" disabled
                                    class="border border-gray-300 text-gray-500 text-sm rounded-lg block w-full p-2.5 bg-gray-100 cursor-not-allowed"
                                    value="{{ $barang->kondisi }}">
                            </div>

                            {{-- Catatan --}}
                            <div>
                                <label class="block text-sm font-bold text-black">Catatan</label>
                                <textarea name="catatan" rows="3"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">{{ old('catatan', $barang->catatan) }}</textarea>
                                @error('catatan')
                                    <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Kolom kanan --}}
                        <div class="flex flex-col space-y-4">
                            {{-- Upload Foto --}}
                            <div>
                                <label class="block text-sm font-bold text-black">Upload Foto Barang</label>
                                <div class="mb-2">
                                    <img id="photoPreview"
                                        src="{{ $barang->foto ? asset('storage/' . $barang->foto) : 'https://via.placeholder.com/150' }}"
                                        alt="Photo Preview" class="w-28 h-28 object-cover rounded-lg shadow-md border border-gray-300">
                                </div>
                                <input type="file" name="foto" id="foto" accept="image/*"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                                @error('foto')
                                    <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('bmn.index', $ruangan) }}"
                            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Kembali
                        </a>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('foto').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
