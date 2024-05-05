<?php
// Lakukan koneksi ke database
require_once("config.php");

// Ambil data dari formulir
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$jenis_kelamin = $_POST['jenis_kelamin'];

// Lakukan validasi data (misalnya: pastikan data tidak kosong)

// Siapkan query untuk menyimpan data ke dalam tabel
$sql = "INSERT INTO profil_pengguna (nama, alamat, email, no_hp, jenis_kelamin) 
        VALUES (:nama, :alamat, :email, :no_hp, :jenis_kelamin)";

// Siapkan statement
$stmt = $db->prepare($sql);

// Bind parameter ke query
$stmt->bindParam(':nama', $nama);
$stmt->bindParam(':alamat', $alamat);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':no_hp', $no_hp);
$stmt->bindParam(':jenis_kelamin', $jenis_kelamin);

// Jalankan query
if ($stmt->execute()) {
    // Jika berhasil, redirect ke halaman profil atau halaman lain
    header("Location: profil.php");
    exit();
} else {
    // Jika gagal, tampilkan pesan kesalahan
    echo "Terjadi kesalahan. Silakan coba lagi.";
}
?>
