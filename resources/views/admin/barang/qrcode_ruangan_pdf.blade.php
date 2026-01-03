<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: sans-serif; }
        .qr-item { 
            width: 100%; 
            text-align: center; 
            padding-top: 50px; 
            padding-bottom: 50px;
            border-bottom: 1px dashed #ccc; /* Garis bantu potong */
            page-break-inside: avoid;
        }
        .room-name { 
            font-size: 28px; 
            font-weight: bold; 
            margin-top: 20px; 
            text-transform: uppercase;
        }
        .label-text { font-size: 14px; color: #555; margin-bottom: 10px; }
    </style>
</head>
<body>
    @foreach($ruangans as $r)
        <div class="qr-item">
            <div class="label-text">QR CODE INVENTARIS</div>
            {{-- Generate QR Code --}}
            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->margin(2)->generate(route('user.inventaris.rak', $r->nama_ruangan))) !!} ">
            <div class="room-name">{{ $r->nama_ruangan }}</div>
        </div>
        
        {{-- Jika ingin satu QR per satu lembar kertas, aktifkan baris di bawah ini --}}
        {{-- <div style="page-break-after: always;"></div> --}}
    @endforeach
</body>
</html>