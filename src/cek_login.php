<?php
require_once("config.php");

$register_error = ""; // Inisialisasi variabel pesan kesalahan

if(isset($_POST['register'])){
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek apakah username sudah terdaftar
    $sql_check_username = "SELECT COUNT(*) FROM customers WHERE username = :username";
    $stmt_check_username = $db->prepare($sql_check_username);
    $stmt_check_username->bindParam(':username', $username);
    $stmt_check_username->execute();
    $username_exists = $stmt_check_username->fetchColumn();

    if($username_exists) {
        // Jika username sudah ada, berikan pesan kesalahan
        $register_error = "Username sudah digunakan. Silakan pilih username lain.";
    } else {
        // Jika username belum terdaftar, lanjutkan proses pendaftaran
        $sql = "INSERT INTO customers (nama, username, email, password) VALUES (:nama, :username, :email, :password)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Redirect ke halaman login setelah pendaftaran berhasil
        header("Location: login.php");
        exit;
    }
}

// Jika terjadi kesalahan, redirect kembali ke halaman pendaftaran dengan pesan kesalahan
header("Location: register.php?error=" . urlencode($register_error));
exit;
?>
