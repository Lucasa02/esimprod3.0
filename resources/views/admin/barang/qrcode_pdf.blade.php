<!DOCTYPE html>
<html lang="en">

<head>
  <title>Daftar Barang</title>
  <style>
    * {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
    }

    body {
      margin: 20px;
    }

    h1 {
      text-align: center;
      font-size: 20px;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 10px;
    }

    th,
    td {
      border: 1px solid black;
      text-align: center;
      padding: 5px;
    }

    th {
      background-color: #f2f2f2;
    }

    img {
      display: block;
      margin: auto;
      max-width: 40px;
      max-height: 40px;
    }
  </style>
</head>

<body>
  <h1>Daftar Barang</h1>
  <table>
    <thead>
      <tr>
        <th>QR Code</th>
        <th>Nama Barang</th>
      </tr>
    </thead>
    <tbody>
  @foreach ($barang as $b)
    <tr>
      <td>
        @php
            // Deteksi apakah ini barang BMN (punya kolom ruangan) atau Master
            $isBmn = isset($b->ruangan);
            
            if ($isBmn) {
                // Jalur untuk BMN: database sudah menyimpan 'bmn/qrcode/filename.png'
                $qrPath = public_path('storage/' . $b->qr_code);
            } else {
                // Jalur untuk Master: database hanya menyimpan 'filename.svg'
                $qrPath = public_path('storage/uploads/qr_codes_barang/' . $b->qr_code);
            }
        @endphp

        @if($b->qr_code && file_exists($qrPath))
            <img src="{{ $qrPath }}" alt="QR Code">
        @else
            <span style="color: red; font-size: 8px;">QR Tidak Ditemukan</span>
        @endif
      </td>
      <td>{{ $b->nama_barang }}</td>
    </tr>
  @endforeach
</tbody>
  </table>
</body>

</html>
