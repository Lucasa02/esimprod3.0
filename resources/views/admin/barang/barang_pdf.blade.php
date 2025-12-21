<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Laporan Barang</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    h5,
    h6 {
      margin: 0;
      padding: 0;
    }

    h5 {
      font-size: 16px;
    }

    h6 {
      font-size: 12px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
      font-size: 10pt;
    }

    th {
      background-color: #f2f2f2;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    th,
    td {
      border: 1px solid #ddd;
    }

    .center-text {
      text-align: center;
      font-size: 12px
    }
  </style>
</head>

<body>
  <center>
    <h5>Laporan Data Barang</h5>
    {{-- Menampilkan Info Filter jika ada --}}
    @if(isset($filter_info))
        <h6>Kategori: {{ $filter_info }}</h6>
    @endif
  </center>

  <table>
    <thead>
      <tr>
        <th class="center-text">No</th>
        <th class="center-text">Kode QR</th>
        <th class="center-text">Kode Barang</th>
        <th class="center-text">Nama Barang</th>
        <th class="center-text">Nomor Seri</th>
        <th class="center-text">Merk</th>
        <th class="center-text">Jenis / Kategori</th>
        <th class="center-text">Limit / Kondisi</th>
        <th class="center-text">Catatan / Ruangan</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($barang as $b)
        <tr>
          <td class="center-text">{{ $loop->iteration }}</td>
          
          {{-- LOGIC GAMBAR QR CODE --}}
          <td class="center-text">
            @php
                // Pastikan file ada sebelum load untuk menghindari error file not found
                $qrPath = public_path('storage/uploads/qr_codes_barang/' . $b->qr_code);
            @endphp
            @if(file_exists($qrPath) && $b->qr_code)
                <img src="{{ $qrPath }}" width="40px">
            @else
                -
            @endif
          </td>

          <td class="center-text">{{ $b->kode_barang }}</td>
          <td class="center-text">{{ $b->nama_barang }}</td>
          <td class="center-text">{{ $b->nomor_seri ?? '-' }}</td>
          <td class="center-text">{{ $b->merk ?? '-' }}</td>

          {{-- PERBAIKAN UTAMA DISINI --}}
          <td class="center-text">
            @if(isset($b->jenisBarang))
                {{-- Jika Barang Master --}}
                {{ $b->jenisBarang->jenis_barang }}
            @elseif(isset($b->kategori))
                {{-- Jika Barang BMN --}}
                BMN - {{ $b->kategori }}
            @else
                -
            @endif
          </td>

          {{-- LOGIC LIMIT / KONDISI (BMN tidak punya limit, tapi punya kondisi) --}}
          <td class="center-text">
             @if(isset($b->limit))
                {{ $b->limit }} Hari
             @elseif(isset($b->kondisi))
                {{ $b->kondisi }}
             @else
                -
             @endif
          </td>

          {{-- LOGIC DESKRIPSI / RUANGAN --}}
          <td class="center-text">
             @if(isset($b->ruangan))
                Ruang: {{ $b->ruangan }}
             @else
                {{ $b->deskripsi ?? '-' }}
             @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>