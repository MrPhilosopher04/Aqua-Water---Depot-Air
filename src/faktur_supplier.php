<?php
// Lakukan koneksi ke database
require_once("config.php");

// Query untuk mengambil data supplier
$sql = "SELECT * FROM supplier";
$stmt = $db->query($sql);
$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Supply Supplier - Aqua Safe</title>
    <style>
        /* Tambahkan styling CSS sesuai kebutuhan */
        .container {
            max-width: 600px;
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

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .btn-back {
            background-color: #ccc;
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-back:hover {
            background-color: #999;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Input Supply Supplier</h2>
        <form action="proses_daftar_faktur_supplier.php" method="post" id="supplyForm">
            <label for="supplier">Pilih Supplier:</label>
            <select id="supplier" name="supplier">
                <?php foreach ($suppliers as $supplier) : ?>
                    <option value="<?= $supplier['id'] ?>"><?= $supplier['nama_supplier'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="barang">Barang yang Disupply:</label>
            <input type="text" id="barang" name="barang" required>

            <label for="jumlah">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" required>
            <select id="satuan" name="satuan">
                <option value="kg">kg</option>
                <option value="g">g</option>
                <option value="ml">ml</option>
                <option value="liter">Liter</option>
            </select>

            <label for="harga">Harga Satuan (Rp):</label>
            <input type="text" id="harga" name="harga" required>

            <!-- Input hidden untuk menyimpan total pembayaran -->
            <input type="hidden" id="total_hidden" name="total" value="0">

            <!-- Input text untuk menampilkan total pembayaran -->
            <label for="total">Total Harga (Rp):</label>
            <input type="text" id="total" name="total_display" readonly>

            <!-- Button to submit with confirmation -->
            <input type="submit" value="Submit" onclick="return confirm('Apakah Anda yakin ingin menyimpan data?')">

            <!-- Button to go back to supplier.php -->
            <a href="supplier.php"><button type="button" class="btn-back">Kembali ke Supplier</button></a>
        </form>
    </div>

    <script>
        // Function to format number as currency
        function formatCurrency(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(number);
        }

        // Calculate total harga when jumlah or harga satuan changes
        document.getElementById('jumlah').addEventListener('input', calculateTotal);
        document.getElementById('harga').addEventListener('input', calculateTotal);

        function calculateTotal() {
            var jumlah = parseFloat(document.getElementById('jumlah').value);
            var harga = parseFloat(document.getElementById('harga').value.replace(/\D/g, '')); // Remove non-digit characters
            var total = jumlah * harga;

            // Set value to hidden input
            document.getElementById('total_hidden').value = total;

            // Display formatted total
            document.getElementById('total').value = formatCurrency(total);
        }
    </script>
</body>

</html>
