<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aqua Safe</title>
    <link rel="stylesheet" href="https://unpkg.com/ace-css/css/ace.min.css">
    <style>
        /*Additional Style */

        /* ######## START FOCUS CSS CODE HERE */
        #sidenav {
            max-height: 100vh;
            height: 100vh;
            max-width: 70vw;
            min-width: 300px;
            overflow-x: hidden;
            overflow-y: auto;
            transition: all .3s ease-in-out;
            transform: translate(-150%, 0px);
            -webkit-transform: translate(-150%, 0px);
            /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */
            -ms-transform: translate(-150%, 0px);
        }

        #sidenav.active {
            transition: all .3s ease-in-out;
            transform: translate(0%, 0px);
            -webkit-transform: translate(0%, 0px);
            -ms-transform: translate(0%, 0px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, .4);
        }

        /* ######## END FOCUS CSS CODE HERE */

        .burger {
            height: 16px
        }

        .burger span {
            display: block;
            width: 20px;
            height: 2px;
            border-radius: 3px;
        }

        .pointer {
            cursor: pointer;
        }

        .close {
            width: 23px;
            height: 23px;
        }

        .cross {
            height: 23px;
            width: 2px;
            border-radius: 3px;
        }

        .cross.left {
            transform: rotate(45deg);
        }

        .cross.right {
            transform: rotate(-45deg);
        }

        .align-middle {
            vertical-align: middle
        }

        /* Additional CSS Code */
        body {
            box-sizing: border-box;
            scroll-behavior: smooth;
            background: linear-gradient(180deg, rgb(39, 249, 186) 50%, rgb(30, 103, 236) 50%);
        }
    </style>
</head>

<body>
    <header class="bg-blue px2 py1 m0 flex items-center white">
        <div class="burger pointer flex flex-column justify-between mr2">
            <span class="bg-white"></span>
            <span class="bg-white"></span>
            <span class="bg-white"></span>
        </div>
        <a class="white caps text-decoration-none h3 bold" href="#">Aqua Safe</a>
        <nav class="ml-auto">
            <ul class="list-reset m0 h5 caps">
                <li class="inline-block btn p0 mr1"><a href="about.php" class="text-decoration-none white">About</a></li>
                
            </ul>
        </nav>
    </header>
    <!-- ######## START FOCUS SIDEBAR CODE HERE -->
    <div id="sidenav" class="fixed z4 top-0 left-0 bg-white p2">
        <div class="close flex items-center justify-center relative pointer mb2 right">
            <div class="absolute cross bg-gray left"></div>
            <div class="absolute cross bg-gray right"></div>
        </div>
        <a href="profil.php">
            <div class="profil" style="width: 68px;height: 68px">
                <img src="gambar/profil.jpeg" alt="Profil" style="width: 68px;height: 68px">
            </div>
        </a>
        <p class="m0 muted bold">Profil</p>
        <hr>
        <ul class="list-reset muted m0">
            <li class="h6 caps mb2">Menu</li>
            <li class="pointer mb2">
                <a id="pemesananLink" href="pemesanan.php">
                    <img class="inline-block align-middle mr1" src="gambar/pesan.jpeg" alt="Pemesanan" style="width: 20px; height: 20px;">
                    <span class="align-middle">Pemesanan</span>
                </a>
            </li>
            <li class="pointer mb2">
                <a id="notifikasiLink" href="notifikasi.php">
                    <img class="inline-block align-middle mr1" src="gambar/notifikasi.jpeg" alt="Notifikasi" style="width: 20px; height: 20px;">
                    <span class="align-middle">Notifikasi</span>
                </a>
            </li>
            <li class="pointer mb2">
    <a id="logoutLink" href="index.php">
        <img class="inline-block align-middle mr1" src="gambar/logout.jpeg" alt="Log out" style="width: 20px; height: 20px;">
        <span class="align-middle">Log out</span>
    </a>
</li>

            </li>
        </ul>
        <hr>
        <ul class="list-reset muted m0">
            <li class="pointer mb2">
                <a href="page1.php">
         
                </a>
            </li>
            <li class="pointer mb2">
                <a href="page2.php">
                               
                </a>
            </li>
        </ul>
    </div>
    <!-- ######## END FOCUS SIDEBAR CODE HERE -->

    <main class="max-width-4 mx-auto bg-white p2" style="min-height: 100vh">
        <img class="fit block" src="gambar/logo.jpg" alt="Aqua Safe" style="width: 150px; height: auto;">

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

    <footer class="px2 py3 bg-silver navy center">
        <p class="muted">©2024 → <a class="text-decoration-none navy" href="https://insertapps.com/">AquWater</a> Depot Air AquWater Dibuat oleh Kelompok 1: Delon, Ando, Iron <a class="text-decoration-none navy" href="https://insertapps.com/privacy/"></a></p>
    </footer>

    <!-- ######## START FOCUS JS CODE HERE -->
    <script>
        let burger = document.querySelector('.burger');
        let close = document.querySelector('.close');
        let sidenav = document.querySelector('#sidenav');

        // Burger click function
        burger.addEventListener('click', function () {
            sidenav.classList.add('active'); // Tambah kelas 'active' untuk menampilkan menu
        });

        // Close click function
        close.addEventListener('click', function () {
            sidenav.classList.remove('active'); // Hapus kelas 'active' untuk menyembunyikan menu
        });
    </script>
    <!-- ######## /END FOCUS JS CODE HERE -->
</body>

</html>
