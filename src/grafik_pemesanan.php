<?php
// Ambil data pemesanan dari database
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

// Query untuk mengambil data pemesanan dan produk
$sql = "SELECT pemesanan.*, produk.nama_produk 
        FROM pemesanan 
        JOIN produk ON pemesanan.jenis_produk = produk.id 
        ORDER BY pemesanan.created_at";
$result = $conn->query($sql);

// Menyiapkan data untuk grafik
$dataset = array();
$labels = array();

while ($row = $result->fetch_assoc()) {
    $tanggal = date('Y-m', strtotime($row['created_at']));
    $nama_produk = $row['nama_produk'];
    $jumlah = $row['jumlah'];

    // Inisialisasi data untuk produk jika belum ada
    if (!isset($dataset[$nama_produk])) {
        $dataset[$nama_produk] = array_fill(0, 12, 0);
    }

    // Menambahkan jumlah pemesanan ke bulan yang sesuai
    $bulan = intval(date('m', strtotime($row['created_at']))) - 1;
    $dataset[$nama_produk][$bulan] += $jumlah;

    // Menambahkan bulan ke label jika belum ada
    if (!in_array($tanggal, $labels)) {
        $labels[] = $tanggal;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Pemesanan</title>
    <!-- Sertakan Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 800px;
            height: 500px;
            position: relative;
        }
        canvas {
            width: 100%;
            height: 100%;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px 0;
            background-color: #f8f9fa;
            border-top: 1px solid #ddd;
        }
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <canvas id="grafikPemesanan"></canvas>
        <button class="back-btn" onclick="window.history.back()">Kembali</button>
        <footer>
            Data Pemesanan &copy; <?php echo date("Y"); ?>
        </footer>
    </div>
    <script>
        // Ambil data yang telah diproses dari PHP
        var dataset = <?php echo json_encode($dataset); ?>;
        var labels = <?php echo json_encode($labels); ?>;

        // Siapkan label bulan
        var bulanLabels = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Siapkan data untuk grafik
        var data = {
            labels: bulanLabels,
            datasets: []
        };

        // Loop untuk setiap produk
        for (var produk in dataset) {
            var dataProduk = {
                label: produk,
                data: dataset[produk],
                fill: false,
                borderColor: '#' + Math.floor(Math.random()*16777215).toString(16), // Warna acak untuk setiap produk
                tension: 0.4
            };
            data.datasets.push(dataProduk);
        }

        // Konfigurasi grafik
        var config = {
            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Membuat grafik
        var myChart = new Chart(
            document.getElementById('grafikPemesanan'),
            config
        );
    </script>
</body>
</html>

