<?php
// Lakukan koneksi ke database
require_once("config.php");

// Query untuk mengambil data supplier
$sql_supplier = "SELECT * FROM supplier";
$stmt_supplier = $db->query($sql_supplier);
$suppliers = $stmt_supplier->fetchAll(PDO::FETCH_ASSOC);

// Query untuk mengambil data faktur supplier
$sql_faktur = "SELECT faktur_supplier.*, supplier.nama_supplier 
               FROM faktur_supplier 
               INNER JOIN supplier ON faktur_supplier.supplier_id = supplier.id";
$stmt_faktur = $db->query($sql_faktur);
$faktur_suppliers = $stmt_faktur->fetchAll(PDO::FETCH_ASSOC);
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
            margin-bottom: 20px;
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

        .btn-back {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Daftar Supplier</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Supplier</th>
                    <th>Alamat</th>
                    <th>Keterangan</th>
                    <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($suppliers as $supplier) : ?>
                    <tr>
                        <td><?= $supplier['id'] ?></td>
                        <td><?= $supplier['nama_supplier'] ?></td>
                        <td><?= $supplier['alamat'] ?></td>
                        <td>
                            <table>
                                <thead>
                                    <tr>
                                        <th>No. Faktur</th>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Harga Satuan (Rp)</th>
                                        <th>Total Harga (Rp)</th>
                                        <th>Cetak Faktur</th> <!-- Tambahkan kolom untuk tombol cetak faktur -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($faktur_suppliers as $faktur_supplier) : ?>
                                        <?php if ($faktur_supplier['supplier_id'] == $supplier['id']) : ?>
                                            <tr>
                                                <td><?= $faktur_supplier['id'] ?></td>
                                                <td><?= $faktur_supplier['barang'] ?></td>
                                                <td><?= $faktur_supplier['jumlah'] ?></td>
                                                <td><?= $faktur_supplier['satuan'] ?></td>
                                                <td><?= $faktur_supplier['harga'] ?></td>
                                                <td><?= $faktur_supplier['total'] ?></td>
                                                <td>
                                                    <form action="cetak_faktur_supplier.php" method="get">
                                                        <input type="hidden" name="id_faktur" value="<?= $faktur_supplier['id'] ?>">
                                                        <input type="submit" name="cetak_faktur" value="Cetak Faktur">
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </td>
                        <!-- Tambahkan sel lainnya sesuai kebutuhan -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <form action="daftar_supplier.php" method="post">
            <input type="submit" name="input_supplier" value="Input Data Supplier">
        </form>
        <form action="faktur_supplier.php" method="post">
            <input type="submit" name="input_faktur" value="Input Faktur Supplier">
        </form>
        <!-- Button to go back to supplier.php -->
        <a href="dashboard_admin.php"><button type="button" class="btn-back">Kembali ke halaman admin</button></a>
    </div>
</body>

</html>

