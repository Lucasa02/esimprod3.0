@extends('layouts.admin.main')

@section('content')
  <div class="flex p-3 ml-3 mr-3">
    @if (Route::currentRouteName() == 'bmn.kategori.search')
        <a href="{{ route('bmn.kategori.index') }}" class="mr-3 text-white bg-gray-700 hover:bg-gray-800 font-medium rounded-lg text-sm px-4 py-2">Kembali</a>
    @endif

    <button data-modal-target="create-modal" data-modal-toggle="create-modal"
      class="mr-3 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
      Tambah Kategori
    </button>
  </div>

  <form class="flex items-center max-w-sm mx-auto p-3 ml-3" action="{{ route('bmn.kategori.search') }}" method="GET">
    <div class="w-full relative">
      <input type="text" id="search" name="search" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10" placeholder="Cari kategori...">
      <svg class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500" fill="none" viewBox="0 0 20 20">
        <path stroke="currentColor" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
      </svg>
    </div>
  </form>

  @if ($kategori->isEmpty())
    <x-empty-data></x-empty-data>
  @else
    <div class="flex flex-col p-3 ml-3">
      <div class="relative overflow-x-auto sm:rounded-lg border">
        <table class="w-full text-sm text-left text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 font-bold">
            <tr>
              <th class="px-6 py-3">No</th>
              <th class="px-6 py-3">Nama Kategori</th>
              <th class="px-6 py-3">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($kategori as $row)
              <tr class="bg-white border-b hover:bg-gray-50">
                <td class="px-6 py-4">{{ $kategori->firstItem() + $loop->index }}</td>
                <td class="px-6 py-4 font-medium text-gray-900">{{ $row->nama_kategori }}</td>
                <td class="px-6 py-4">
                  <button type="button" data-uuid="{{ $row->uuid }}" class="edit-item-kategori text-blue-600 hover:underline">Edit</button>
                  <button onclick="confirmDelete('{{ route('bmn.kategori.destroy', $row->uuid) }}')" data-modal-target="delete-modal" data-modal-toggle="delete-modal" class="text-red-600 hover:underline ml-2">Hapus</button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="p-3 ml-6">{{ $kategori->links() }}</div>
  @endif

  {{-- Modal Create --}}
  <div id="create-modal" tabindex="-1" aria-hidden="true" class="{{ session('showModal') || $errors->any() ? 'flex' : 'hidden' }} overflow-y-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full backdrop-blur-sm">
    <div class="relative p-4 w-full max-w-md">
      <div class="relative bg-white rounded-lg shadow border">
        <div class="flex items-center justify-between p-4 border-b">
          <h3 class="text-lg font-semibold">Tambah Kategori</h3>
          <button type="button" data-modal-hide="create-modal" class="text-gray-400">✕</button>
        </div>
        <form action="{{ route('bmn.kategori.store') }}" method="POST" class="p-4">
          @csrf
          <div class="mb-4">
            <label class="block mb-2 text-sm font-medium">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5" required>
          </div>
          <button type="submit" class="w-full text-white bg-blue-700 rounded-lg px-5 py-2.5">Simpan Data</button>
        </form>
      </div>
    </div>
  </div>

  {{-- Modal Edit --}}
  <div id="edit-modal-kategori" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen">
      <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="flex items-center justify-between p-4 border-b">
          <h3 class="text-lg font-semibold">Edit Kategori</h3>
          <button type="button" class="close-modal-kategori text-gray-400">✕</button>
        </div>
        <form id="updateFormKategori" class="p-4">
          @csrf @method('PUT')
          <input type="hidden" id="kategori_uuid" name="uuid">
          <div class="mb-4">
            <label class="block mb-2 text-sm font-medium">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="edit_nama_kategori" class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5">
          </div>
          <div class="flex justify-end gap-2">
            <button type="button" class="close-modal-kategori px-4 py-2 bg-gray-200 rounded-lg">Kembali</button>
            <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded-lg">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @include('components.modal-delete')

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editModal = document.getElementById('edit-modal-kategori');

        document.querySelectorAll('.edit-item-kategori').forEach(button => {
            button.addEventListener('click', function() {
                const uuid = this.getAttribute('data-uuid');
                fetch(`/admin/bmn/kategori/edit/${uuid}`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('kategori_uuid').value = uuid;
                        document.getElementById('edit_nama_kategori').value = data.nama_kategori;
                        editModal.classList.remove('hidden');
                    });
            });
        });

        document.querySelectorAll('.close-modal-kategori, [data-modal-hide="create-modal"]').forEach(btn => {
            btn.addEventListener('click', () => {
                editModal.classList.add('hidden');
                document.getElementById('create-modal').classList.add('hidden');
            });
        });

        document.getElementById('updateFormKategori').addEventListener('submit', function(e) {
            e.preventDefault();
            const uuid = document.getElementById('kategori_uuid').value;
            fetch(`/admin/bmn/kategori/update/${uuid}`, {
                method: 'POST',
                body: new FormData(this),
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(data => { if(data.success) location.reload(); });
        });
    });

    function confirmDelete(url) {
        document.getElementById('deleteForm').action = url;
    }
</script>
@endsection