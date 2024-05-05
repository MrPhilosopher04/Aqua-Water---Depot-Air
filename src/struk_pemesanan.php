<?php
// Ambil data pemesanan berdasarkan ID dari parameter URL
if (isset($_GET['id'])) {
    $pemesanan_id = $_GET['id'];

    // Ambil data pemesanan dari database berdasarkan ID
    // Pastikan untuk mengganti detail koneksi dan query sesuai dengan setup database Anda
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "depot_air1";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk mengambil data pemesanan berdasarkan ID dengan JOIN tabel produk
    $sql = "SELECT pemesanan.*, produk.nama_produk, produk.harga FROM pemesanan 
            LEFT JOIN produk ON pemesanan.jenis_produk = produk.id 
            WHERE pemesanan.id = $pemesanan_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customer_id = $row['customer_id'];
        $jenis_produk = $row['nama_produk'];
        $jumlah = $row['jumlah'];
        $metode_pembayaran = $row['metode_pembayaran'];
        $rincian_pembayaran = $row['rincian_pembayaran'];
        $total_pembayaran = $row['total_pembayaran'];
        $status = $row['status'];
        $created_at = $row['created_at'];
    } else {
        echo "Tidak ada data pemesanan dengan ID tersebut.";
        exit;
    }

    $conn->close();
} else {
    echo "ID Pemesanan tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        .container {
            width: 300px;
            margin: 20px auto;
            background-color: #fff;
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .info {
            margin-bottom: 10px;
        }
        .info span {
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin: 0 5px;
        }
        button:hover {
            background-color: #45a049;
        }
        @media print {
            .container {
                width: 200px;
                padding: 10px;
                border: none;
                box-shadow: none;
                margin: 0;
            }
            .footer {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Struk Pemesanan</h2>
        </div>
        <div class="info">
            <p><span>ID Customer:</span> <?php echo $customer_id; ?></p>
            <p><span>Jenis Produk:</span> <?php echo $jenis_produk; ?></p>
            <p><span>Jumlah:</span> <?php echo $jumlah; ?></p>
            <p><span>Metode Pembayaran:</span> <?php echo $metode_pembayaran; ?></p>
            <p><span>Rincian Pembayaran:</span> <?php echo $rincian_pembayaran; ?></p>
            <p><span>Total Pembayaran:</span> <?php echo $total_pembayaran; ?></p>
            <p><span>Status:</span> <?php echo $status; ?></p>
            <p><span>Waktu Pemesanan:</span> <?php echo $created_at; ?></p>
        </div>
        <div class="footer">
            <button onclick="window.print()">Cetak</button>
            <button onclick="window.history.back()">Kembali</button>
        </div>
    </div>
</body>
</html>
