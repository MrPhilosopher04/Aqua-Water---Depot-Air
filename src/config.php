<?php

$host = "localhost"; // Sesuaikan dengan host Anda
$dbname = "depot_air1"; // Sesuaikan dengan nama database Anda
$username = "root"; // Sesuaikan dengan username database Anda
$password = ""; // Sesuaikan dengan password database Anda

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set mode error untuk PDO agar melemparkan pengecualian saat terjadi kesalahan
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Tangani kesalahan koneksi jika terjadi
    echo "Koneksi gagal: " . $e->getMessage();
    die(); // Hentikan eksekusi skrip jika koneksi gagal
}
?>
