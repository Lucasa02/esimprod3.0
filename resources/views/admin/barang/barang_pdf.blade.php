<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Laporan Barang</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 10px;
    }

    /* Gaya untuk Header Logo */
    .header-table {
      width: 100%;
      border-collapse: collapse;
      border: none;
      margin-bottom: 20px;
    }

    .header-table td {
      border: none;
      vertical-align: middle;
      padding: 0;
    }

    .logo-left {
      text-align: left;
      width: 20%;
    }

    .logo-right {
      text-align: right;
      width: 20%;
    }

    .header-text {
      text-align: center;
      width: 60%;
    }

    h5 {
      margin: 0;
      font-size: 18px;
      text-transform: uppercase;
    }

    h6 {
      margin: 5px 0 0 0;
      font-size: 12px;
      font-weight: normal;
    }

    /* Gaya Tabel Data */
    table.main-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    table.main-table th,
    table.main-table td {
      padding: 8px;
      border: 1px solid #ddd;
      font-size: 9pt;
    }

    /* Warna Header Tabel sesuai request (#1b365d) */
    table.main-table th {
      background-color: #1b365d;
      color: white;
      text-transform: uppercase;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .center-text {
      text-align: center;
    }
  </style>
</head>

<body>

  <table class="header-table">
    <tr>
      <td class="logo-left">
        <img src="{{ public_path('img/assets/logo_tvri_icon.png') }}" style="width: 80px;">
      </td>
      <td class="header-text">
        <h5>Laporan Data Barang</h5>
      </td>
      <td class="logo-right">
        <img src="{{ public_path('img/assets/esimprod_logo.png') }}" style="width: 120px;">
      </td>
    </tr>
  </table>

  <hr style="border: 1px solid #1b365d; margin-top: -10px; margin-bottom: 20px;">

  <table class="main-table">
    <thead>
      <tr>
        <th class="center-text">No</th>
        <th class="center-text">Kode QR</th>
        <th class="center-text">Kode Barang</th>
        <th class="center-text">Nama Barang</th>
        <th class="center-text">Nomor Seri</th>
        <th class="center-text">Merk</th>
        <th class="center-text">Jenis</th>
        <th class="center-text">Limit</th>
        <th class="center-text">Catatan</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($barang as $b)
        <tr>
          <td class="center-text">{{ $loop->iteration }}</td>

          <td class="center-text">
              @php
                  if (isset($b->ruangan)) {
                      $qrPath = public_path('storage/' . $b->qr_code);
                  } else {
                      $qrPath = public_path('storage/uploads/qr_codes_barang/' . $b->qr_code);
                  }
              @endphp
              @if($b->qr_code && file_exists($qrPath))
                  <img src="{{ $qrPath }}" width="40px">
              @else
                  -
              @endif
          </td>

          <td class="center-text">{{ $b->kode_barang }}</td>
          <td>{{ $b->nama_barang }}</td>
          <td class="center-text">{{ $b->nomor_seri ?? '-' }}</td>
          <td class="center-text">{{ $b->merk ?? '-' }}</td>

          <td class="center-text">
            @if(isset($b->jenisBarang))
                {{ $b->jenisBarang->jenis_barang }}
            @elseif(isset($b->kategori))
                BMN - {{ $b->kategori }}
            @else
                -
            @endif
          </td>

          <td class="center-text">
             @if(isset($b->limit))
                {{ $b->limit }} Hari
             @elseif(isset($b->kondisi))
                {{ $b->kondisi }}
             @else
                -
             @endif
          </td>

          <td>
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