<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar Barang</title>
    <style>
        @font-face {
            font-family: 'Gotham Black';
            src: url('{{ public_path('fonts/Gotham-Black.ttf') }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        * {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
        }

        body {
            margin: 15px;
        }

        h1 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 25px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #eee;
            text-align: center;
            padding: 8px 10px;
            vertical-align: middle;
        }

        th {
            background-color: #f8f9fa;
            color: #555;
            text-transform: uppercase;
            border: 1px solid #ddd;
        }

        .qr-border-box {
            border: 1px solid #000;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
            background-color: #fff;
        }

        .qr-container {
            display: table;
            width: auto;
            margin: 0 auto;
            border: none;
        }

        .qr-item {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            padding: 0 10px;
        }

        .img-logo-tvri {
            height: 26px;
            width: auto;
            display: block;
            margin: 0 auto 2px auto;
        }

        .text-kalsel {
            font-family: 'Gotham Black', sans-serif;
            font-size: 5px;
            font-weight: bold;
            letter-spacing: 0.2px;
            text-align: center;
            line-height: 1;
            white-space: nowrap;
        }

        /* Penyesuaian Ukuran Logo Esimprod BMN */
        .img-logo-esimprod {
            height: 28px;
            /* Sedikit diperbesar agar teks BMN terbaca jelas */
            width: auto;
        }

        .img-qr {
            height: 55px;
            width: auto;
        }

        .nama-barang {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
            color: #2c3e50;
        }
    </style>
</head>

<body>
    <h1>Daftar Barang</h1>
    <table>
        <thead>
            <tr>
                <th width="70%">QR Label</th>
                <th width="30%">Nama Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $b)
                @php
                    $isBmn = isset($b->ruangan);

                    if ($isBmn) {
                        $qrPath = public_path('storage/' . $b->qr_code);
                    } else {
                        $qrPath = public_path('storage/uploads/qr_codes_barang/' . $b->qr_code);
                    }

                    $logoTvri = public_path('img/assets/logo_tvri_icon.png');
                    $logoEsimprod = public_path('img/assets/logo_esimprod_bmn.png');
                @endphp
                <tr>
                    <td>
                        @if ($isBmn)
                            <div class="qr-border-box">
                                <div class="qr-container">

                                    <div class="qr-item">
                                        <img src="{{ $logoTvri }}" class="img-logo-tvri" alt="TVRI">
                                        <div class="text-kalsel">KALIMANTAN SELATAN</div>
                                    </div>

                                    <div class="qr-item">
                                        @if ($b->qr_code && file_exists($qrPath))
                                            <img src="{{ $qrPath }}" class="img-qr" alt="QR Code">
                                        @else
                                            <span style="color: #e74c3c; font-size: 8px;">QR KOSONG</span>
                                        @endif
                                    </div>

                                    <div class="qr-item">
                                        <img src="{{ $logoEsimprod }}" class="img-logo-esimprod" alt="ESIMPROD BMN">
                                    </div>

                                </div>
                            </div>
                        @else
                            @if ($b->qr_code && file_exists($qrPath))
                                <img src="{{ $qrPath }}" class="img-qr" alt="QR Code">
                            @else
                                <span style="color: #e74c3c; font-size: 8px;">QR KOSONG</span>
                            @endif
                        @endif
                    </td>
                    <td class="nama-barang">{{ $b->nama_barang }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
