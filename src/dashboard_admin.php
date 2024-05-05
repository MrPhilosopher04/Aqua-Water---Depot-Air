<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Aqua Safe</title>
    <link rel="stylesheet" href="https://unpkg.com/ace-css/css/ace.min.css">
    <style>
        /* Additional Style */
        body {
            box-sizing: border-box;
            scroll-behavior: smooth;
            background: linear-gradient(180deg, rgb(39, 249, 186) 50%, rgb(30, 103, 236) 50%);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        main {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #ddd;
            color: #333;
            padding: 15px;
            width: 100%;
            text-align: center;
            margin-top: auto;
        }

        /* Sidebar */
        #sidenav {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background-color: #fff;
            padding: 20px;
            transition: left 0.3s ease;
        }

        #sidenav.active {
            left: 0;
        }

        .burger,
        .close {
            display: none;
            cursor: pointer;
        }

        .burger span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: #fff;
            margin-bottom: 5px;
        }

        @media (max-width: 768px) {
            .burger {
                display: block;
            }

            .close {
                display: block;
                position: absolute;
                top: 20px;
                right: 20px;
            }

            nav ul {
                display: none;
            }

            nav ul.active {
                display: flex;
            }

            nav ul li {
                margin: 10px 0;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav>
            <ul class="menu">
                <li><a href="about.php">About</a></li>
                <li><a href="pemesanan1.php">PEMESANANAN</a></li>
                <li><a href="karyawan.php">KARYAWAN</a></li>
                <li><a href="supplier.php">SUPPLIER</a></li>
                <li><a href="keuntungan.php">KEUNTUNGAN</a></li>
                <li><a href="pelanggan1.php">PELANGGAN</a></li>
                <li><a href="index.php">Log out</a></li>
            </ul>
        </nav>
    </header>

    <div id="sidenav">
        <div class="close">
            <div class="burger">
                <span></span>
                <span></span>
            </div>
        </div>
        <ul>
            <li><a href="page1.php">Page 1</a></li>
            <li><a href="page2.php">Page 2</a></li>
        </ul>
    </div>

    <main class="container">
        <img src="gambar/logo.jpg" alt="Aqua Safe" style="width: 150px; height: auto; margin-bottom: 20px;">
        <div class="product-info">
            <h2>Aqua Safe</h2>
            <p>Aqua Safe adalah produk air minum berkualitas tinggi dari sumber alami yang segar dan murni. Dikemas dengan teknologi terkini untuk memastikan kebersihan dan kesehatan Anda.</p>
            <p>Fitur Produk:</p>
            <ul>
                <li>Terbuat dari sumber air alami yang murni</li>
                <li>Diproses dengan teknologi canggih untuk menjaga kebersihan</li>
                <li>Mengandung mineral esensial untuk kesehatan tubuh</li>
                <li>Praktis dan aman dikonsumsi setiap hari</li>
            </ul>
        </div>
    </main>

    <footer>
        <p>©2024 → <a href="https://insertapps.com/" target="_blank" rel="noopener noreferrer">Aqua Safe</a> Depot Air AquWater Dibuat oleh Kelompok 1: Delon, Ando, Iron</p>
    </footer>

    <script>
        let burger = document.querySelector('.burger');
        let close = document.querySelector('.close');
        let sidenav = document.querySelector('#sidenav');

        burger.addEventListener('click', function () {
            sidenav.classList.add('active');
        });

        close.addEventListener('click', function () {
            sidenav.classList.remove('active');
        });
    </script>
</body>

</html>
