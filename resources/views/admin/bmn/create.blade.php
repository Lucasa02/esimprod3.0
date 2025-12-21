@extends('layouts.admin.main')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between border-b pb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Data BMN</h1>
                <p class="text-sm text-gray-500 mt-1">Lengkapi detail informasi barang milik negara di bawah ini.</p>
            </div>
        </div>

        <form action="{{ route('bmn.store', $ruangan) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- SECTION 1: LOKASI (Hanya jika general) --}}
            @if($ruangan == 'general')
            <div class="bg-blue-50/50 border border-blue-100 rounded-xl p-6">
                <div class="flex items-center gap-2 mb-4 text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="Intersection" />
                    </svg>
                    <h3 class="font-bold text-lg">Konfigurasi Lokasi</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Ruangan Utama <span class="text-red-500">*</span></label>
                        <select id="ruangan_select" name="ruangan_pilihan" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2.5 transition-all">
                            <option value="" disabled selected>-- Pilih Lokasi --</option>
                            <option value="Mcr" {{ old('ruangan_pilihan') == 'Mcr' ? 'selected' : '' }}>MCR (Master Control Room)</option>
                            <option value="Studio" {{ old('ruangan_pilihan') == 'Studio' ? 'selected' : '' }}>Studio</option>
                        </select>
                        @error('ruangan_pilihan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div id="sub_lokasi_container" class="{{ old('ruangan_pilihan') == 'Studio' ? '' : 'hidden' }}">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Detail Studio</label>
                        <select name="detail_lokasi" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2.5 transition-all">
                            <option value="" disabled selected>-- Pilih Studio --</option>
                            <option value="Studio 1" {{ old('detail_lokasi') == 'Studio 1' ? 'selected' : '' }}>Studio 1</option>
                            <option value="Studio 2" {{ old('detail_lokasi') == 'Studio 2' ? 'selected' : '' }}>Studio 2</option>
                        </select>
                    </div>
                </div>
            </div>
            @endif

            {{-- SECTION 2: INFORMASI DASAR --}}
            <div class="bg-white shadow-sm border rounded-xl overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h3 class="font-bold text-gray-800">Informasi Dasar & Identitas</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Barang <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Contoh: Kamera Sony A7III" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" required>
                        @error('nama_barang') <small class="text-red-500">{{ $message }}</small> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                        <input type="text" name="kategori" value="{{ old('kategori') }}" placeholder="Elektronik / Alat Studio" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Seri (S/N)</label>
                        <input type="text" name="nomor_seri" value="{{ old('nomor_seri') }}" placeholder="Masukkan S/N jika ada" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Merk / Brand</label>
                        <input type="text" name="merk" value="{{ old('merk') }}" placeholder="Contoh: Sony, Panasonic, dll" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kode Barang <span class="text-xs font-normal text-gray-400 italic">(Otomatis jika kosong)</span></label>
                        <input type="text" name="kode_barang" value="{{ old('kode_barang') }}" placeholder="Kode BMN" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 p-2.5">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">NUP <span class="text-xs font-normal text-gray-400">(Nomor Urut Pendaftaran)</span></label>
                        <input type="number" name="nup" value="{{ old('nup') }}" placeholder="0001" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                    </div>
                </div>
            </div>

            {{-- SECTION 3: SPESIFIKASI & KONDISI --}}
            <div class="bg-white shadow-sm border rounded-xl overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h3 class="font-bold text-gray-800">Spesifikasi & Kondisi</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Unit <span class="text-red-500">*</span></label>
                        <input type="number" name="jumlah" value="{{ old('jumlah') }}" min="1" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Persentase Kondisi (%) <span class="text-red-500">*</span></label>
                        <div class="relative mt-1">
                            <input type="number" name="persentase_kondisi" value="{{ old('persentase_kondisi') }}" min="0" max="100" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 pr-10" required>
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400">%</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun Pengadaan</label>
                        <input type="number" name="tahun_pengadaan" value="{{ old('tahun_pengadaan', date('Y')) }}" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Asal Pengadaan / Peruntukan</label>
                        <input type="text" name="asal_pengadaan" value="{{ old('asal_pengadaan') }}" placeholder="Contoh: Hibah APBN 2024 - Untuk Produksi Berita" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                    </div>
                </div>
            </div>

            {{-- SECTION 4: MEDIA & DOKUMENTASI --}}
            <div class="bg-white shadow-sm border rounded-xl overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b text-gray-800 flex items-center justify-between">
                    <h3 class="font-bold">Media Dokumentasi</h3>
                    <span class="text-xs text-gray-400">Format: JPG, PNG (Max 2MB)</span>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700">Foto Fisik Barang</label>
                        <div class="group relative border-2 border-dashed border-gray-300 rounded-xl p-4 hover:border-blue-400 transition-all text-center">
                            <input type="file" name="foto" id="foto" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div id="previewContainer" class="hidden mb-2 flex justify-center">
                                <img id="photoPreview" src="" class="h-32 w-48 object-cover rounded-lg shadow-md border">
                            </div>
                            <div class="text-gray-500" id="fotoLabel">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-8 w-8 mb-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-sm">Klik atau tarik foto barang ke sini</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700">Foto Posisi Terpasang</label>
                        <div class="group relative border-2 border-dashed border-gray-300 rounded-xl p-4 hover:border-blue-400 transition-all text-center">
                            <input type="file" name="posisi" id="fotoPosisi" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div id="posisiPreviewContainer" class="hidden mb-2 flex justify-center">
                                <img id="fotoPosisiPreview" src="" class="h-32 w-48 object-cover rounded-lg shadow-md border">
                            </div>
                            <div class="text-gray-500" id="posisiLabel">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-8 w-8 mb-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="text-sm">Tunjukkan lokasi penyimpanan barang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION 5: CATATAN --}}
            <div class="bg-white shadow-sm border rounded-xl p-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2 text-lg">Catatan Tambahan</label>
                <textarea name="catatan" rows="3" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" placeholder="Contoh: Barang dalam kondisi standby, butuh upgrade firmware..."></textarea>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="flex flex-col-reverse md:flex-row gap-4 justify-end pt-6 border-t">
                @if($ruangan == 'general')
                    <a href="{{ route('barang.index') }}" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                @else
                    <a href="{{ route('bmn.index', $ruangan) }}" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                @endif
                
                <button type="submit" class="inline-flex justify-center items-center px-10 py-3 border border-transparent text-sm font-bold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg transition-all">
                    Simpan Data BMN
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Fungsi preview yang lebih dinamis
function setupPreview(inputId, previewImgId, containerId, labelId) {
    const input = document.getElementById(inputId);
    if(input){
        input.addEventListener('change', function(event) {
            const file = event.target.files[0];
            const container = document.getElementById(containerId);
            const label = document.getElementById(labelId);
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewImgId).src = e.target.result;
                    if(container) container.classList.remove('hidden');
                    if(label) label.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }
}

setupPreview('foto', 'photoPreview', 'previewContainer', 'fotoLabel');
setupPreview('fotoPosisi', 'fotoPosisiPreview', 'posisiPreviewContainer', 'posisiLabel');

document.addEventListener('DOMContentLoaded', function() {
    const ruanganSelect = document.getElementById('ruangan_select');
    const subLokasiContainer = document.getElementById('sub_lokasi_container');

    if(ruanganSelect) {
        ruanganSelect.addEventListener('change', function() {
            if (this.value === 'Studio') {
                subLokasiContainer.classList.remove('hidden');
                subLokasiContainer.classList.add('animate-fade-in-down'); // Optional animation class
            } else {
                subLokasiContainer.classList.add('hidden');
                const subSelect = subLokasiContainer.querySelector('select');
                if(subSelect) subSelect.value = "";
            }
        });
    }
});
</script>

<style>
    /* Animasi kecil untuk UI yang lebih hidup */
    .animate-fade-in-down {
        animation: fadeInDown 0.3s ease-out;
    }
    @keyframes fadeInDown {
        0% { opacity: 0; transform: translateY(-10px); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection