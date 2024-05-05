<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Pesanan</title>
    <link rel="stylesheet" type="text/css" href="css/stylesnotifikasi.css">
    <style>
        /* CSS untuk memberikan jarak antara notifikasi pesanan */
        .pesanan-item {
            margin-bottom: 20px; /* Atur jarak bawah antara notifikasi pesanan */
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="h2">Status Pesanan</h2>
        <div class="notification" id="notification">
            <div class="pesanan-items">
                <?php
                // Koneksi ke database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "depot_air1";
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Memeriksa koneksi
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Ambil ID pelanggan dari sesi
                session_start();
                $customer_id = $_SESSION['user']['id'];

                // Query SQL untuk mengambil data pesanan berdasarkan customer_id
                $sql = "SELECT pemesanan.id, produk.nama_produk, produk.harga, pemesanan.jumlah
                        FROM pemesanan
                        INNER JOIN produk ON pemesanan.jenis_produk = produk.id
                        WHERE pemesanan.customer_id = $customer_id";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Tampilkan data pesanan
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="pesanan-item">
                            <a href='detail_pesanan.php?id=<?php echo $row["id"]; ?>' class="order-link">
                                <div class="order-details">
                                    <div class="order-id"><?php echo $row["id"]; ?></div>
                                    <div class="product-details">
                                        <class="product-name"><?php echo $row["nama_produk"]; ?>
                                        <class="product-price">| Rp <?php echo number_format($row["harga"], 0, ',', '.'); ?>
                                        <class="product-quantity">x <?php echo $row["jumlah"]; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>Tidak ada data pemesanan yang tersedia.</p>";
                }

                // Menutup koneksi database
                $conn->close();
                ?>
            </div>
            <a href="pelanggan.php" class="back-btn">Kembali</a>
        </div>
    </div>
    <footer class="footer">
        <p>&copy; 2024 Notifikasi Pesanan. All rights reserved.</p>
    </footer>
</body>

</html>
