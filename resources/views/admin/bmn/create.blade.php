@extends('layouts.admin.main')

@section('content')
<div class="-m-1.5 overflow-x-auto ml-5 mr-3">
  <div class="p-1.5 min-w-full inline-block align-middle">
    <div class="border rounded-lg shadow overflow-hidden dark:border-neutral-700">
      <div class="container mx-auto p-4">

        <h1 class="text-xl font-semibold text-white mb-4">Tambah Barang - {{ strtoupper($ruangan) }}</h1>

        <form action="{{ route('bmn.store', $ruangan) }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4">

            {{-- Kolom kiri --}}
            <div class="flex flex-col space-y-4">
              @php
                $fields = [
                  ['label'=>'Nama Barang','name'=>'nama_barang','type'=>'text','required'=>true],
                  ['label'=>'Kode Barang','name'=>'kode_barang','type'=>'text','required'=>true],
                  ['label'=>'Kategori','name'=>'kategori','type'=>'text','required'=>true],
                  ['label'=>'Merk (opsional)','name'=>'merk','type'=>'text','required'=>false],
                  ['label'=>'Nomor Seri (opsional)','name'=>'nomor_seri','type'=>'text','required'=>false],
                  ['label'=>'Jumlah','name'=>'jumlah','type'=>'number','required'=>true,'min'=>1],
                  ['label'=>'Persentase Kondisi (%)','name'=>'persentase_kondisi','type'=>'number','required'=>true,'min'=>0,'max'=>100],
                  ['label'=>'Tahun Pengadaan','name'=>'tahun_pengadaan','type'=>'number','required'=>false,'min'=>1900,'max'=>date('Y')],
                ];
              @endphp

              @foreach($fields as $f)
                <div>
                  <label class="block text-sm font-bold text-black">{{ $f['label'] }}</label>
                  <input type="{{ $f['type'] }}" name="{{ $f['name'] }}" autocomplete="off"
                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    value="{{ old($f['name']) }}"
                    @if($f['required']) required @endif
                    @if(isset($f['min'])) min="{{ $f['min'] }}" @endif
                    @if(isset($f['max'])) max="{{ $f['max'] }}" @endif
                  >
                  @error($f['name'])
                    <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                  @enderror
                </div>
              @endforeach

              {{-- Catatan --}}
              <div>
                <label class="block text-sm font-bold text-black">Catatan</label>
                <textarea name="catatan" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" rows="3">{{ old('catatan') }}</textarea>
                @error('catatan')
                  <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                @enderror
              </div>
            </div>

            {{-- Kolom kanan: Upload Foto --}}
            <div class="flex flex-col space-y-4">
              <div>
                <label class="block text-sm font-bold text-black">Upload Foto Barang</label>
                <div class="mb-2">
                  <img id="photoPreview" src="https://via.placeholder.com/150" alt="Photo Preview" class="w-32 h-32 object-cover rounded-lg shadow-md border border-gray-300">
                </div>
                <input type="file" name="foto" id="foto" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                @error('foto')
                  <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                @enderror
              </div>
            </div>

          </div>

          {{-- Tombol Aksi --}}
          <div class="mt-4 flex gap-2">
            <a href="{{ route('bmn.index', $ruangan) }}" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              Kembali
            </a>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">
              Simpan Barang
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
