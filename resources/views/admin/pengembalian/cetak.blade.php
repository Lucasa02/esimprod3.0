<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengembalian</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #444;
        }
        th {
            background: #1b365d;
            color: white;
            padding: 6px;
            text-align: center;
            font-weight: bold;
        }
        td {
            padding: 5px;
        }
    </style>
</head>
<body>

    <h2 style="text-align:center; margin-bottom:10px;">Laporan Pengembalian Barang</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Peminjaman</th>
                <th>Tanggal Kembali</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Peminjam</th>
                <th>Status</th>
                <th>Deskripsi</th>
            </tr>
        </thead>

        <tbody>
           @foreach ($pengembalian as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->peminjaman->kode_peminjaman }}</td>
        <td>{{ date('d-m-Y', strtotime($item->tanggal_kembali)) }}</td>

        {{-- GABUNG KODE BARANG --}}
        <td>
            @foreach ($item->detailPengembalian as $detail)
                {{ $detail->kode_barang }} <br>
            @endforeach
        </td>

        {{-- GABUNG NAMA BARANG --}}
        <td>
            @foreach ($item->detailPengembalian as $detail)
                {{ $detail->barang->nama_barang }} <br>
            @endforeach
        </td>

        {{-- GABUNG JENIS BARANG --}}
        <td>
            @foreach ($item->detailPengembalian as $detail)
                {{ $detail->barang->jenisBarang->jenis_barang }} <br>
            @endforeach
        </td>

        {{-- PEMINJAM --}}
        <td>{{ $item->peminjaman->peminjam }}</td>

        {{-- GABUNG STATUS --}}
        <td>
            @foreach ($item->detailPengembalian as $detail)
                {{ ucfirst($detail->status) }} <br>
            @endforeach
        </td>

        {{-- GABUNG DESKRIPSI --}}
        <td>
            @foreach ($item->detailPengembalian as $detail)
                {{ $detail->deskripsi }} <br>
            @endforeach
        </td>
    </tr>
@endforeach
        </tbody>
    </table>

</body>
</html>