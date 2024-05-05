<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil saya - AquaSafe.com</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        
        .kotak {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .judul {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .input-group {
            margin-bottom: 20px;
        }
        
        .input-group label {
            display: block;
            margin-bottom: 5px;
        }
        
        .input-group input, .input-group select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        .input-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        .input-group input[type="submit"]:hover {
            background-color: #45a049;
        }
        
        .info table {
            width: 100%;
        }
        
        .info table tr {
            line-height: 2;
        }
        
        .info table th {
            text-align: left;
        }
    </style>
</head>
<body>
    <!-- Bagian HTML Anda -->
    <div class="kotak">
        <div class="judul">
            <h1>PROFIL</h1>
        </div>
        <div class="input-group">
            <form id="formPengguna" method="POST" action="proses_data.php">
                <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <label for="no_hp">No. HP:</label>
                <input type="tel" id="no_hp" name="no_hp">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select id="jenis_kelamin" name="jenis_kelamin">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
                <input type="submit" value="Submit">
            </form>
        </div>
        
    </div>
</body>
</html>
