<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ID Card - {{ $user->kode_user }}</title>

    <style>
        @font-face {
            font-family: 'Poppins';
            src: url('{{ storage_path('fonts/Poppins-Bold.ttf') }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'Poppins-Regular';
            src: url('{{ storage_path('fonts/Poppins-Regular.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #d1d5db;
            margin: 0;
            padding: 50px 0;
            text-align: center;
        }

        .card-wrapper {
            display: block;
            width: 100%;
            white-space: nowrap;
        }

        .card-base {
            width: 400px;
            height: 600px;
            display: inline-block;
            margin: 0 15px;
            position: relative;
            overflow: hidden;
            border-radius: 25px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            vertical-align: top;
            background-color: #fff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .id-card-front {
            background-image: url('{{ public_path('img/assets/main-id-card-bg.png') }}');
        }

        .id-card-back {
            background-image: url('{{ public_path('img/assets/qr-code-bg.png') }}');
        }

        /* Konten Bagian Depan */
        .content-wrapper {
            position: absolute;
            top: 185px;
            /* Disesuaikan agar pas di bawah teks ACCESS CARD */
            left: 0;
            width: 100%;
            text-align: center;
        }

        /* Foto Kotak (Tanpa Lengkungan) Rasio 3:4 */
        .photo-img {
            width: 175px;
            height: 233px;
            object-fit: cover;
            display: inline-block;
            background-color: #ddd;
            border-radius: 0;
            /* Menghapus kelengkungan agar kotak tajam */
            border: 1px solid #ccc;
            /* Border tipis agar foto tidak 'mati' di background putih */
        }

        .details {
            padding: 0 20px;
            margin-top: 10px;
            /* Jarak foto ke teks */
            white-space: normal;
        }

        /* Menghilangkan margin dan merapatkan line-height agar teks 'mepet' */
        .user-name {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            font-size: 26px;
            text-transform: capitalize;
            margin: 0;
            padding: 0;
            line-height: 0.9;
            color: #1a1a1a;
        }

        .user-nip {
            font-family: 'Poppins-Regular', sans-serif;
            font-size: 15px;
            color: #374151;
            margin: -2px 0;
            /* Menghilangkan jarak atas-bawah */
            padding: 0;
            line-height: 1;
            /* Sangat rapat */
        }

        .user-jabatan {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            font-size: 17px;
            color: #111827;
            margin: 0;
            /* Menghilangkan jarak atas-bawah */
            padding: 0;
            line-height: 1;
            text-transform: capitalize;
        }

        /* Konten Bagian Belakang (QR) */
        .qr-content-wrapper {
            position: absolute;
            top: 180px;
            left: 0;
            width: 100%;
            text-align: center;
        }

        .qr-img {
            width: 190px;
            height: 190px;
            border: 10px solid #ffffff;
            display: inline-block;
        }
    </style>
</head>

<body>

    <div class="card-wrapper">
        <div class="card-base id-card-front">
            <div class="content-wrapper">
                <div class="photo-container">
                    <img class="photo-img"
                        src="{{ $user->foto ? public_path('storage/uploads/foto_user/' . $user->foto) : public_path('storage/uploads/foto_user/default.jpeg') }}"
                        alt="Foto Profil" />
                </div>
                <div class="details">
                    <div class="user-name">{{ $user->nama_lengkap }}</div>
                    <div class="user-nip">NIP. {{ $user->nip }}</div>
                    <div class="user-jabatan">{{ $user->jabatan->jabatan }}</div>
                </div>
            </div>
        </div>

        <div class="card-base id-card-back">
            <div class="qr-content-wrapper">
                <img class="qr-img" src="{{ public_path('storage/uploads/qr_codes_user/' . $user->qr_code) }}"
                    alt="QR Code" />
            </div>
        </div>
    </div>

</body>

</html>
