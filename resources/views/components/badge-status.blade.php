@props(['status'])

@php
    $map = [
        'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-300',
        'proses' => 'bg-blue-100 text-blue-700 border-blue-300',
        'selesai' => 'bg-green-100 text-green-700 border-green-300',
        'gagal' => 'bg-red-100 text-red-700 border-red-300',
        'ditolak' => 'bg-red-100 text-red-700 border-red-300',

        // tambahan
        'penghapusan' => 'bg-red-700 text-white border-red-800',
        'rencana_penghapusan' => 'bg-red-500 text-white border-red-600',
    ];

    $class = $map[$status] ?? 'bg-gray-100 text-gray-700 border-gray-300';
@endphp

<span class="text-[10px] px-2 py-0.5 rounded-full border {{ $class }}">
    {{ ucfirst(str_replace('_', ' ', $status)) }}
</span>
