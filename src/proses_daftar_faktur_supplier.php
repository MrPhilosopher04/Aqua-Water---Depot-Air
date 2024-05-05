<?php
// Lakukan koneksi ke database
require_once("config.php");

// Pastikan data yang diterima tidak kosong
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["supplier"]) && !empty($_POST["barang"]) && !empty($_POST["jumlah"]) && !empty($_POST["satuan"]) && !empty($_POST["harga"]) && !empty($_POST["total"])) {
        // Ambil data dari formulir
        $supplier = $_POST["supplier"];
        $barang = $_POST["barang"];
        $jumlah = $_POST["jumlah"];
        $satuan = $_POST["satuan"];
        $harga = $_POST["harga"];
        $total = $_POST["total"];

        // Siapkan dan jalankan query untuk memasukkan data ke database
        $sql = "INSERT INTO faktur_supplier (supplier_id, barang, jumlah, satuan, harga, total) VALUES (:supplier, :barang, :jumlah, :satuan, :harga, :total)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":supplier", $supplier);
        $stmt->bindParam(":barang", $barang);
        $stmt->bindParam(":jumlah", $jumlah);
        $stmt->bindParam(":satuan", $satuan);
        $stmt->bindParam(":harga", $harga);
        $stmt->bindParam(":total", $total);

        // Eksekusi query
        if ($stmt->execute()) {
            // Redirect ke halaman supplier.php setelah berhasil memasukkan data
            header("location: supplier.php");
            exit;
        } else {
            // Jika gagal memasukkan data, tampilkan pesan error
            echo "Error: " . $sql . "<br>" . $db->error;
        }
    } else {
        // Jika ada data yang kosong, tampilkan pesan error
        echo "Semua field harus diisi!";
    }
} else {
    // Jika request bukan POST, redirect ke halaman supplier.php
    header("location: supplier.php");
    exit;
}
?>
