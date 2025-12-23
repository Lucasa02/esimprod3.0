<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        @page { margin: 1cm; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
        }
        .qr-card {
            width: 160px; /* Ukuran sedikit diperkecil agar lebih proporsional */
            text-align: center;
            border: 1px solid #e2e8f0; /* Warna border lebih soft (slate-200) */
            border-radius: 12px;
            padding: 20px 10px;
            margin: 10px;
            display: inline-block;
            background-color: #fff;
        }
        .qr-wrapper {
            margin-bottom: 12px;
        }
        .qr-wrapper img {
            display: block;
            margin: 0 auto;
        }
        .label {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b; /* Warna teks abu-abu (slate-500) */
            margin-bottom: 2px;
        }
        .rack-name {
            font-weight: bold;
            font-size: 15px;
            color: #1e293b; /* Warna teks gelap (slate-800) */
            word-wrap: break-word;
        }
        .footer-line {
            margin-top: 10px;
            border-top: 2px solid #3b82f6; /* Aksen warna biru di bawah */
            width: 40px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        @foreach ($racks as $r)
            <div class="qr-card">
                <div class="label">Lokasi / Rak</div>
                <div class="qr-wrapper">
                    @php
                        $url = route('user.inventaris.rak', $r->ruangan);
                        // Menggunakan format PNG biasanya lebih aman untuk PDF daripada SVG di beberapa library
                        $qrcode = base64_encode(QrCode::format('png')->size(150)->margin(1)->errorCorrection('H')->generate($url));
                    @endphp
                    <img src="data:image/png;base64,{{ $qrcode }}" width="130">
                </div>
                <div class="rack-name">{{ $r->ruangan }}</div>
            </div>
        @endforeach
    </div>
</body>
</html>