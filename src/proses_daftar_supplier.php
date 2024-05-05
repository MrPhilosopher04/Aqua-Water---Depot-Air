<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai yang dikirimkan dari form
    $nama_supplier = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    // SQL untuk menyimpan data supplier ke database
    $sql = "INSERT INTO supplier (nama_supplier, alamat, telepon, email) VALUES (:nama_supplier, :alamat, :telepon, :email)";
    
    // Menyiapkan statement SQL menggunakan PDO
    $stmt = $db->prepare($sql);
    
    // Mengikat parameter dengan nilai yang diterima dari form
    $stmt->bindParam(':nama_supplier', $nama_supplier);
    $stmt->bindParam(':alamat', $alamat);
    $stmt->bindParam(':telepon', $telepon);
    $stmt->bindParam(':email', $email);
    
    // Menjalankan statement SQL
    if ($stmt->execute()) {
        // Redirect ke halaman daftar_supplier.php setelah selesai menyimpan data
        header("location: daftar_supplier.php");
        exit;
    } else {
        echo "Gagal menyimpan data supplier.";
    }
}
?>
