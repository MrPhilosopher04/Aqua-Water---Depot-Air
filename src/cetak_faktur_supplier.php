<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "depot_air1";

// Create connection
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

// Ambil data faktur_supplier dari database
$query = "SELECT * FROM faktur_supplier";
$result = mysqli_query($koneksi, $query);

// Pastikan ada data yang ditemukan
if (mysqli_num_rows($result) > 0) {
    // ...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Faktur Supplier</title>
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
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        a.button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a.button:hover {
            background-color: #45a049;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cetak Faktur Supplier</h2>
        <?php if (mysqli_num_rows($result) > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Supplier ID</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Tanggal Pembelian</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['supplier_id']; ?></td>
                        <td><?php echo $row['barang']; ?></td>
                        <td><?php echo $row['jumlah']; ?></td>
                        <td><?php echo $row['satuan']; ?></td>
                        <td><?php echo $row['harga']; ?></td>
                        <td><?php echo $row['total']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a href="javascript:void(0);" onclick="window.print();" class="button">Cetak Faktur</a>
        <?php } else { ?>
        <p>Tidak ada data faktur supplier yang ditemukan.</p>
        <?php } ?>
        <a href="supplier.php" class="button">Kembali</a>
    </div>
    <div class="footer">
        &copy; 2024 Aqua Saffe
    </div>
</body>
</html>


    <?php
} else {
    echo "Tidak ada data faktur supplier yang ditemukan.";
}
?>
