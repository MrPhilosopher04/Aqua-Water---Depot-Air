<?php
// Lakukan koneksi ke database
require_once("config.php");

// Ambil data total pemesanan dari pelanggan yang tidak dibatalkan
$sql = "SELECT SUM(total_pembayaran) AS total_pemesanan 
        FROM pemesanan 
        WHERE status <> 'dibatalkan'";
$stmt = $db->query($sql);
$total_pemesanan = $stmt->fetch(PDO::FETCH_ASSOC)['total_pemesanan'];

// Ambil data total pengeluaran untuk suplai dari supplier
$sql = "SELECT SUM(total) AS total_pengeluaran FROM faktur_supplier";
$stmt = $db->query($sql);
$total_pengeluaran = $stmt->fetch(PDO::FETCH_ASSOC)['total_pengeluaran'];

// Hitung keuntungan dalam rupiah
$keuntungan_rupiah = $total_pemesanan - $total_pengeluaran;

// Ambil data perkembangan bisnis per bulan (tanpa pesanan yang dibatalkan)
$sql = "SELECT MONTH(created_at) AS bulan, SUM(total_pembayaran) AS total_pemesanan 
        FROM pemesanan 
        WHERE status <> 'dibatalkan'
        GROUP BY MONTH(created_at)";
$stmt = $db->query($sql);
$perkembangan_bisnis = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Data untuk grafik
$labels = [];
$data = [];
foreach ($perkembangan_bisnis as $bulan) {
    $labels[] = date("F", mktime(0, 0, 0, $bulan['bulan'], 1));
    $data[] = $bulan['total_pemesanan'];
}

// Kode untuk membuat grafik menggunakan Chart.js
$chart_data = [
    'labels' => json_encode($labels),
    'data' => json_encode($data)
];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuntungan</title>
    <!-- Tambahkan link ke Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        canvas {
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            color: #777;
        }

        .back-button {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        .back-button a {
            text-decoration: none;
            color: #333;
            padding: 10px 20px;
            background-color: #eee;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button a:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Keuntungan Bulanan</h1>
        <p style="text-align: center;">Total Keuntungan: Rp <?= number_format($keuntungan_rupiah, 0, ',', '.') ?></p>
        <canvas id="myChart" width="400" height="200"></canvas>
        <div class="back-button">
            <a href="dashboard_admin.php">Kembali ke Dashboard</a>
        </div>
    </div>

    <script>
        // Ambil data dari PHP dan konversi menjadi objek JavaScript
        var chartData = <?php echo json_encode($chart_data); ?>;
        
        // Atur data grafik
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: JSON.parse(chartData.labels),
                datasets: [{
                    label: 'Total Pemesanan per Bulan',
                    data: JSON.parse(chartData.data),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <div class="footer">
        &copy; 2024 Aqua Saffe
    </div>
</body>

</html>
