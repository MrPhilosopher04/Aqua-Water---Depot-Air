<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Supplier - Aqua Safe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

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
        input[type="email"] {
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

        .confirmation {
            display: none;
            text-align: center;
            margin-top: 20px;
        }

        .confirmation button {
            margin: 0 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Input Data Supplier</h2>
        <form action="proses_daftar_supplier.php" method="post" id="supplierForm">
            <label for="nama_supplier">Nama Supplier:</label>
            <input type="text" id="nama_supplier" name="nama_supplier" required>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" required>

            <label for="telepon">Telepon:</label>
            <input type="text" id="telepon" name="telepon" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <input type="submit" value="Submit" onclick="return showConfirmation()">
        </form>

        <div class="confirmation" id="confirmation">
            <p>Apakah Anda yakin ingin menambahkan data supplier?</p>
            <button onclick="submitForm(true)">Ya</button>
            <button onclick="submitForm(false)">Tidak</button>
        </div>
        <button class="back-button" onclick="window.location.href='supplier.php'">Kembali ke halaman Supplier</button>
    </div>

    <script>
        function showConfirmation() {
            var confirmation = document.getElementById("confirmation");
            confirmation.style.display = "block";
            return false; // Prevent default form submission
        }

        function submitForm(confirm) {
            if (confirm) {
                document.getElementById("supplierForm").submit();
            } else {
                var confirmation = document.getElementById("confirmation");
                confirmation.style.display = "none";
            }
        }
    </script>
</body>

</html>
