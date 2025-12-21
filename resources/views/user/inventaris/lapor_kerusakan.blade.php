<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lapor Kerusakan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6">

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-4">Lapor Kerusakan Barang</h2>

    <p class="text-gray-600 text-sm mb-6">
        Barang: <span class="font-semibold">{{ $barang->nama_barang }}</span>
    </p>

    @if (session('success'))
        <div class="p-3 bg-green-200 text-green-800 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('user.inventaris.lapor-kerusakan.store') }}" 
          method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <input type="hidden" name="barang_id" value="{{ $barang->id }}">

        <div>
            <label class="block font-semibold mb-1">Jenis Kerusakan</label>
            <input type="text" name="jenis_kerusakan"
                   class="w-full border rounded-lg p-2"
                   placeholder="Contoh: layar pecah" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi"
                      class="w-full border rounded-lg p-2"
                      rows="3"
                      placeholder="Ceritakan detail kerusakan"></textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">Foto Kerusakan</label>
            <input type="file" name="foto"
                   class="w-full border p-2 rounded-lg">
        </div>

        <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
            Kirim Laporan
        </button>
    </form>

    <a href="{{ url()->previous() }}"
       class="block mt-4 text-center text-gray-600 hover:underline">
        ← Kembali
    </a>

</div>

</body>
</html>
