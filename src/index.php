<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selamat datang di Aqua Safe</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Gaya khusus */
        body {
            padding-top: 50px; /* Meninggikan body agar tidak tumpang tindih dengan jumbotron */
            background-color: #f8f9fa; /* Warna latar belakang */
        }
        .jumbotron {
            background-image: url('https://i.pinimg.com/736x/87/27/76/8727768620eb00afd7fd89efb26d7eaa.jpg');
            background-size: 500px; /* Mengurangi ukuran gambar logo */
            background-attachment: fixed; /* Mencegah gambar latar belakang bergulir saat halaman digulir */
            background-repeat: no-repeat; /* Menghindari pengulangan gambar */
            background-position: center center; /* Posisikan gambar di tengah */
            color: white;
            text-align: center;
            padding: 200px 0; /* Meninggikan jumbotron */
            margin-bottom: 0;
        }
        .btn-container {
            margin-top: 20px;
        }
        .btn-masuk, .btn-daftar {
            transition: transform 0.3s ease-in-out;
        }
        .btn-masuk:hover, .btn-daftar:hover {
            transform: scale(1.05);
        }
        .welcome-text {
            color: red; /* Warna teks merah */
        }
        .info-text {
            margin-top: 20px; /* Jarak antara teks selamat datang dan teks informasi */
        }
        footer {
            background-color: #343a40; /* Warna latar belakang footer */
            color: white;
            text-align: center;
            padding: 40px 0; /* Meninggikan footer */
        }
    </style>
</head>
<body>
    <header>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <h1 class="welcome-text">Selamat datang di Aqua Safe</h1>
                        <p class="info-text">Aqua Safe adalah platform untuk menjaga keamanan dan kualitas air konsumsi Anda.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mx-auto btn-container">
                        <a href="login.php" class="btn btn-outline-light btn-lg btn-masuk">Masuk</a> <!-- Ganti warna tombol dan ukuran sesuai kebutuhan -->
                        <a href="register.php" class="btn btn-success btn-lg btn-daftar">Daftar</a> <!-- Ganti warna tombol sesuai kebutuhan -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>&copy; 2024 Aqua Safe. All rights reserved. by Delon, iron, Ando</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Sisipkan JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Tambahkan script untuk animasi saat masuk -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".jumbotron").classList.add("fadeIn");
        });
    </script>
</body>
</html>
