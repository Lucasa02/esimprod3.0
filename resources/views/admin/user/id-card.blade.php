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
            /* Background abu-abu seperti contoh */
            margin: 0;
            padding: 50px 0;
            text-align: center;
        }

        /* Container pembungkus agar kartu berdampingan  */
        .card-wrapper {
            display: block;
            width: 100%;
            white-space: nowrap;
            /* Mencegah kartu turun ke bawah */
        }

        /* Base Styling untuk kedua sisi kartu */
        .card-base {
            width: 400px;
            height: 600px;
            display: inline-block;
            /* Membuat kartu berjejer ke samping */
            margin: 0 15px;
            /* Jarak antar kartu */
            position: relative;
            overflow: hidden;
            border-radius: 25px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            vertical-align: top;
            background-color: #fff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            /* Shadow halus agar terlihat elegan */
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
            top: 160px;
            left: 0;
            width: 100%;
            text-align: center;
        }

        .photo-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            display: inline-block;
            background-color: #ddd;
        }

        .details {
            padding: 0 15px;
            margin-top: 20px;
            white-space: normal;
            /* Mengembalikan wrap teks normal untuk nama */
        }

        .user-name {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            font-size: 26px;
            text-transform: capitalize;
            margin: 0 0 2px 0;
            color: #333;
        }

        .user-nip {
            font-family: 'Poppins-Regular', sans-serif;
            font-size: 15px;
            color: #333;
            margin: 0 0 5px 0;
        }

        .user-jabatan {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            font-size: 18px;
            color: #333;
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
                    <div class="user-nip">NIP {{ $user->nip }}</div>
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
