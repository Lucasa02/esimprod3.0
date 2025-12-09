@extends('layouts.admin.main')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Tambahan CSS supaya teks button SweetAlert selalu terlihat --}}
<style>
    /* Button Confirm ("Ya, Hapus!") */
    .swal2-confirm.swal2-styled {
        color: #fff !important;
        background-color: #d33 !important;
        opacity: 1 !important;
    }

    /* Button Cancel */
    .swal2-cancel.swal2-styled {
        color: #fff !important;
        background-color: #6c757d !important;
        opacity: 1 !important;
    }

    /* Hover tetap terlihat */
    .swal2-confirm.swal2-styled:hover,
    .swal2-cancel.swal2-styled:hover {
        color: #fff !important;
        opacity: 1 !important;
    }
</style>

@section('content')

<div class="p-5">
    
    {{-- Menggunakan variabel $backUrl dari controller --}}
    <a href="{{ $backUrl }}"
       class="inline-flex items-center px-4 py-2 mb-4 rounded-lg text-white"
       style="background-color:#1b365d;">
        <i class="fa-solid fa-arrow-left mr-2"></i>
        Kembali
    </a>

    {{-- Menggunakan variabel $title dari controller --}}
    <h2 class="text-xl font-bold mb-3">{{ $title }}</h2>

    <table class="min-w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-center">Nama Barang</th>
                
                {{-- Menggunakan variabel $tableHeader dari controller --}}
                <th class="px-4 py-2 text-center">{{ $tableHeader }}</th>
                
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($surat as $s)
                <tr class="border-b">
                    <td class="px-4 py-2 text-center">{{ $s->barang->nama_barang ?? 'Barang Terhapus' }}</td>

                    <td class="px-4 py-2 text-center">
                        <a href="{{ url('uploads/surat/' . $s->nama_file) }}"
                           class="text-blue-600 underline font-medium"
                           target="_blank">
                           Lihat File
                        </a>
                    </td>

                    <td class="px-4 py-2 text-center flex justify-center space-x-2">
                        {{-- Button Hapus --}}
                        <button type="button"
                                onclick="confirmDelete({{ $s->id }})"
                                class="p-2 rounded-full bg-red-600 text-white shadow">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                        <form id="delete-form-{{ $s->id }}"
                            action="{{ route('perawatan.surat.hapus', $s->id) }}"
                            method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Hapus Surat?",
            text: "Surat ini akan dihapus permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
            customClass: {
                popup: 'rounded-xl'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

@endsection
