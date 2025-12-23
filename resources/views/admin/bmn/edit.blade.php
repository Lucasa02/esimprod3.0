@extends('layouts.admin.main')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        {{-- Tentukan state awal untuk JS --}}
        @php
            $currentRuangan = $barang->ruangan;
            $isMcr = Str::contains($currentRuangan, 'MCR');
            $isStudio = Str::contains($currentRuangan, 'Studio');
            
            // Parsing Rak jika MCR (Contoh: "MCR - Rak 1" -> "Rak 1")
            $valRak = '';
            if($isMcr) {
                $parts = explode(' - ', $currentRuangan);
                $valRak = $parts[1] ?? '';
            }
        @endphp

        <form action="{{ route('bmn.update', [$ruangan, $barang->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- SECTION 1: LOKASI --}}
            <div class="bg-blue-50/50 border border-blue-100 rounded-xl p-6 shadow-sm">
                <div class="flex items-center gap-2 mb-4 text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    </svg>
                    <h3 class="font-bold text-lg">Edit Konfigurasi Lokasi</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Ruangan Utama <span class="text-red-500">*</span></label>
                        <select id="ruangan_select" name="ruangan_pilihan" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2.5 transition-all">
                            <option value="Mcr" {{ $isMcr ? 'selected' : '' }}>MCR (Master Control Room)</option>
                            <option value="Studio" {{ $isStudio ? 'selected' : '' }}>Studio</option>
                        </select>
                    </div>

                    {{-- Container Detail Studio --}}
                    <div id="sub_lokasi_container" class="{{ $isStudio ? '' : 'hidden' }}">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Detail Studio</label>
                        <select name="detail_lokasi" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2.5">
                            <option value="Studio 1" {{ $currentRuangan == 'Studio 1' ? 'selected' : '' }}>Studio 1</option>
                            <option value="Studio 2" {{ $currentRuangan == 'Studio 2' ? 'selected' : '' }}>Studio 2</option>
                        </select>
                    </div>

                    {{-- Container Rak MCR --}}
                    <div id="rak_mcr_container" class="{{ $isMcr ? '' : 'hidden' }} space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Rak (MCR)</label>
                            <select id="rak_select" name="rak_pilihan" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="Rak {{ $i }}" {{ $valRak == "Rak $i" ? 'selected' : '' }}>Rak {{ $i }}</option>
                                @endfor
                                <option value="Lainnya" {{ (!empty($valRak) && !Str::contains($valRak, 'Rak')) || $valRak == 'Lainnya' ? 'selected' : '' }}>Lainnya / Manual</option>
                            </select>
                        </div>
                        <div id="custom_rak_container" class="{{ (!empty($valRak) && !Str::contains($valRak, 'Rak')) ? '' : 'hidden' }}">
                            <input type="text" name="custom_rak" value="{{ $valRak }}" placeholder="Ketik nomor rak..." class="w-full border-gray-300 rounded-lg p-2.5">
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION 2: INFORMASI DASAR (Sama dengan Create) --}}
            <div class="bg-white shadow-sm border rounded-xl overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h3 class="font-bold text-gray-800">Informasi Dasar & Identitas</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Barang <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" class="w-full border-gray-300 rounded-lg p-2.5" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                        <input type="text" name="kategori" value="{{ old('kategori', $barang->kategori) }}" class="w-full border-gray-300 rounded-lg p-2.5" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Seri (S/N)</label>
                        <input type="text" name="nomor_seri" value="{{ old('nomor_seri', $barang->nomor_seri) }}" class="w-full border-gray-300 rounded-lg p-2.5">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Merk / Brand</label>
                        <input type="text" name="merk" value="{{ old('merk', $barang->merk) }}" class="w-full border-gray-300 rounded-lg p-2.5">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kode Barang</label>
                        <input type="text" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" class="w-full border-gray-300 rounded-lg bg-gray-50 p-2.5" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">NUP</label>
                        <input type="number" name="nup" value="{{ old('nup', $barang->nup) }}" class="w-full border-gray-300 rounded-lg p-2.5">
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
                        <input type="number" name="jumlah" value="{{ old('jumlah', $barang->jumlah) }}" min="1" class="w-full border-gray-300 rounded-lg p-2.5" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Persentase Kondisi (%)</label>
                        <input type="number" name="persentase_kondisi" value="{{ old('persentase_kondisi', $barang->persentase_kondisi) }}" min="0" max="100" class="w-full border-gray-300 rounded-lg p-2.5" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun Pengadaan</label>
                        <input type="number" name="tahun_pengadaan" value="{{ old('tahun_pengadaan', $barang->tahun_pengadaan) }}" class="w-full border-gray-300 rounded-lg p-2.5">
                    </div>
                </div>
            </div>

            {{-- SECTION 4: MEDIA --}}
            <div class="bg-white shadow-sm border rounded-xl overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b text-gray-800 flex justify-between">
                    <h3 class="font-bold">Update Media Dokumentasi</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700">Foto Fisik Barang</label>
                        <div class="group relative border-2 border-dashed border-gray-300 rounded-xl p-4 hover:border-blue-400 text-center">
                            <input type="file" name="foto" id="foto" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div id="previewContainer" class="mb-2 flex justify-center">
                                <img id="photoPreview" src="{{ $barang->foto ? asset('storage/'.$barang->foto) : '' }}" class="h-32 w-48 object-cover rounded-lg {{ $barang->foto ? '' : 'hidden' }}">
                            </div>
                            <p class="text-sm text-gray-500">Klik untuk ganti foto</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700">Foto Posisi Terpasang</label>
                        <div class="group relative border-2 border-dashed border-gray-300 rounded-xl p-4 hover:border-blue-400 text-center">
                            <input type="file" name="posisi" id="fotoPosisi" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div id="posisiPreviewContainer" class="mb-2 flex justify-center">
                                <img id="fotoPosisiPreview" src="{{ $barang->posisi ? asset('storage/'.$barang->posisi) : '' }}" class="h-32 w-48 object-cover rounded-lg {{ $barang->posisi ? '' : 'hidden' }}">
                            </div>
                            <p class="text-sm text-gray-500">Klik untuk ganti lokasi</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION 5: CATATAN --}}
            <div class="bg-white shadow-sm border rounded-xl p-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan Tambahan</label>
                <textarea name="catatan" rows="3" class="w-full border-gray-300 rounded-lg p-2.5">{{ old('catatan', $barang->catatan) }}</textarea>
            </div>

            {{-- ACTION BUTTONS --}}
           {{-- ACTION BUTTONS --}}
            <div class="flex gap-4 justify-end pt-6 border-t">
                {{-- UBAH href di bawah ini jika ingin tombol Batal kembali ke index utama --}}
                <a href="{{ route('barang.index') }}" class="px-6 py-3 border rounded-lg text-gray-700 bg-white hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="px-10 py-3 font-bold rounded-lg text-white bg-blue-600 hover:bg-blue-700 shadow-lg transition-all">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Preview Script (Sama seperti create)
    function setupPreview(inputId, previewImgId, containerId) {
        const input = document.getElementById(inputId);
        input.addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById(previewImgId);
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }
    setupPreview('foto', 'photoPreview', 'previewContainer');
    setupPreview('fotoPosisi', 'fotoPosisiPreview', 'posisiPreviewContainer');

    // Dynamic Select Script
    document.addEventListener('DOMContentLoaded', function() {
        const ruanganSelect = document.getElementById('ruangan_select');
        const subLokasiContainer = document.getElementById('sub_lokasi_container');
        const rakMcrContainer = document.getElementById('rak_mcr_container');
        const rakSelect = document.getElementById('rak_select');
        const customRakContainer = document.getElementById('custom_rak_container');

        ruanganSelect.addEventListener('change', function() {
            subLokasiContainer.classList.add('hidden');
            rakMcrContainer.classList.add('hidden');
            if (this.value === 'Studio') subLokasiContainer.classList.remove('hidden');
            if (this.value === 'Mcr') rakMcrContainer.classList.remove('hidden');
        });

        rakSelect.addEventListener('change', function() {
            if (this.value === 'Lainnya') customRakContainer.classList.remove('hidden');
            else customRakContainer.classList.add('hidden');
        });
    });
</script>
@endsection