<?php
// Lakukan koneksi ke database
require_once("config.php");

// Query untuk mengambil data karyawan
$sql_karyawan = "SELECT * FROM karyawan";
$stmt_karyawan = $db->query($sql_karyawan);
$karyawan = $stmt_karyawan->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Aqua Safe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
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

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
            text-align: left;
        }

        table th {
            background-color: #007bff;
            color: #fff;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #e9ecef;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Daftar Karyawan</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Karyawan</th>
                    <th>Alamat</th>
                    <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($karyawan as $kar) : ?>
                    <tr>
                        <td><?= $kar['id'] ?></td>
                        <td><?= $kar['nama_karyawan'] ?></td>
                        <td><?= $kar['alamat'] ?></td>
                        <!-- Tambahkan sel lainnya sesuai kebutuhan -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <form action="daftar_karyawan.php" method="post">
            <input type="submit" name="input_karyawan" value="Input Data Karyawan">
        </form>
        <!-- Button to go back to dashboard_admin.php -->
        <a href="dashboard_admin.php"><button type="button" class="btn-back">Kembali ke halaman admin</button></a>
    </div>
</body>

</html>
