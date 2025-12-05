@extends('layouts.admin.main')

@section('content')
  <div class="p-3 ml-3 mr-3 flex flex-col md:flex-row md:space-x-4 mb-3">

    {{-- table --}}
    <div
      class="w-full md:w-2/3 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 self-start">
      <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
        Riwayat</h5>

      @if ($guideBook->isEmpty())
        <small class="text-red-500">Tidak ada riwayat</small>
      @else
        <div class="relative overflow-x-auto">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3">No</th>
                <th scope="col" class="px-6 py-3">File</th>
                <th scope="col" class="px-6 py-3">Dibuat</th>
                <th scope="col" class="px-6 py-3">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($guideBook as $book)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $loop->iteration }}
                  </th>

                  <td class="px-6 py-4">
                    <button data-modal-target="fileModal{{ $book->uuid }}"
                      data-modal-toggle="fileModal{{ $book->uuid }}"
                      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                      Lihat File
                    </button>
                  </td>

                  <td class="px-6 py-4">
                    {{ $book->created_at->diffForHumans() }}
                  </td>

                  <td class="px-6 py-4">
                    <button data-modal-target="deleteModal" data-modal-toggle="deleteModal"
                      onclick="removeBook('{{ route('buku-panduan.destroy', ['uuid' => $book->uuid]) }}')"
                      class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </td>
                </tr>

                {{-- modal file --}}
                <div id="fileModal{{ $book->uuid }}" tabindex="-1" aria-hidden="true"
                  class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                  <div class="relative w-full max-w-4xl max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                      <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">File</h3>
                        <button type="button"
                          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                          data-modal-hide="fileModal{{ $book->uuid }}">
                          ✕
                        </button>
                      </div>
                      <div class="p-6 -space-y-14">
                        <iframe src="{{ asset('storage/uploads/guidebook/' . $book->file) }}"
                          class="w-full h-96" frameborder="0"></iframe>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end modal --}}
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>

    {{-- modal delete --}}
    <div id="deleteModal" tabindex="-1"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <button type="button"
            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8"
            data-modal-hide="deleteModal">✕</button>
          <div class="p-4 md:p-5 text-center">
            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
              Yakin ingin menghapus file ini?
            </h3>
            <form id="deleteForm" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                Ya, Hapus
              </button>
              <button data-modal-hide="deleteModal" type="button"
                class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                Batal
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    {{-- form input --}}
    <div
      class="w-full md:w-1/3 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-4 md:mb-0 self-start">
      <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
        Upload Buku Panduan</h5>

      <form action="{{ route('buku-panduan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload file</label>
          <input
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            type="file" name="file" id="file_input" />
          @error('file')
            <small class="text-red-500 text-sm">{{ $message }}</small>
          @enderror
        </div>

        <button type="submit"
          class="mt-4 px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Upload</button>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    function removeBook(url) {
      const form = document.getElementById('deleteForm');
      form.action = url;
    }
  </script>
@endsection
