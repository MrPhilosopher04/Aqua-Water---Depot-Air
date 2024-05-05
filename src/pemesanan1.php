<?php
// Ambil data pemesanan dari database
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

// Query untuk mengambil data pemesanan dan informasi pelanggan dengan JOIN
$sql = "SELECT pemesanan.*, customers.name AS customer_name FROM pemesanan JOIN customers ON pemesanan.customer_id = customers.id ORDER BY pemesanan.id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $pemesanan = array();
    while ($row = $result->fetch_assoc()) {
        $pemesanan[] = $row;
    }
} else {
    echo "Tidak ada data pemesanan.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        .container {
            width: 400px;
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
        .pemesanan-list {
            margin-bottom: 10px;
        }
        .pemesanan-list-item {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .pemesanan-info {
            margin-bottom: 5px;
        }
        .customer-info {
            margin-top: 10px;
            font-size: 14px;
        }
        .customer-info span {
            font-weight: bold;
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
        </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Data Pemesanan</h2>
        </div>
        <div class="pemesanan-list">
            <?php foreach ($pemesanan as $pesan) : ?>
                <div class="pemesanan-list-item">
                    <p><span>Nama Pelanggan:</span> <?php echo $pesan['customer_name']; ?></p>
                    <p><span>Struk Pemesanan ID:</span> <?php echo $pesan['id']; ?></p>
                    <button onclick="window.location.href='struk_pemesanan.php?id=<?php echo $pesan['id']; ?>'">Tampilkan / Cetak</button>
                </div>
            <?php endforeach; ?>
        </div>
        <button onclick="window.location.href='dashboard_admin.php'">Kembali ke Dashboard</button>
        <button onclick="window.location.href='grafik_pemesanan.php'">Grafik Pemesanan</button>
    </div>
</body>
</html>
