<?php
// Memulai session
session_start();

// Periksa apakah parameter id_pesanan ada dalam request POST
if(isset($_POST['id_pesanan'])) {
    $id_pesanan = $_POST['id_pesanan'];

    // Lakukan koneksi ke database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "depot_air1";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query SQL untuk memperbarui status pesanan menjadi 'Dibatalkan' dan mencatat waktu pembatalan
    $sql = "UPDATE pemesanan SET status='Dibatalkan', waktu_pembatalan=NOW() WHERE id=$id_pesanan";

    if ($conn->query($sql) === TRUE) {
        // Pesanan berhasil dibatalkan, bisa tambahkan tindakan lain jika diperlukan
        $_SESSION['pesan'] = "Pesanan telah berhasil dibatalkan.";
    } else {
        $_SESSION['pesan'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi database
    $conn->close();

    // Redirect kembali ke halaman detail pesanan
    header("Location: detail_pesanan.php?id=$id_pesanan");
    exit();
} else {
    // Jika parameter tidak ditemukan, redirect ke halaman lain atau lakukan tindakan yang sesuai
    header("Location: error_page.php");
    exit();
}
?>
