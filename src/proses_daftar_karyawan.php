<?php
// Lakukan koneksi ke database
require_once("config.php");

// Ambil data dari form
$nama_karyawan = $_POST['nama_karyawan'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];
$email = $_POST['email'];
$jabatan = $_POST['jabatan'];
$gaji = $_POST['gaji'];

// Query untuk menyimpan data karyawan ke database
$sql = "INSERT INTO karyawan (nama_karyawan, alamat, telepon, email, jabatan, gaji) 
        VALUES (:nama_karyawan, :alamat, :telepon, :email, :jabatan, :gaji)";
$stmt = $db->prepare($sql);

// Bind parameter ke query
$stmt->bindParam(":nama_karyawan", $nama_karyawan);
$stmt->bindParam(":alamat", $alamat);
$stmt->bindParam(":telepon", $telepon);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":jabatan", $jabatan);
$stmt->bindParam(":gaji", $gaji);

// Eksekusi query
if ($stmt->execute()) {
    // Redirect ke halaman karyawan.php jika berhasil
    header("Location: karyawan.php");
} else {
    // Tampilkan pesan error jika terjadi masalah
    echo "Gagal menyimpan data karyawan.";
}
?>
