<?php

require_once("config.php");

$login_error = "";

if(isset($_POST['login'])){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $login_as = $_POST['login_as']; // Ambil nilai dari pilihan login

    if ($login_as === 'admin') {
        // Proses login untuk admin
        $sql = "SELECT * FROM admins WHERE username=:username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            if (password_verify($password, $admin["password"])) {
                // buat Session
                session_start();
                $_SESSION["admin"] = $admin;
                // login sukses, alihkan ke halaman admin yang sesuai
                header("Location: dashboard_admin.php");
                exit;
            } else {
                $login_error = "Username atau password salah.";
            }
        } else {
            $login_error = "Anda belum terdaftar sebagai admin.";
        }
    } else if ($login_as === 'customer') {
        // Proses login untuk pelanggan
        $sql = "SELECT * FROM customers WHERE username=:username OR email=:email";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user["password"])) {
                // buat Session
                session_start();
                $_SESSION["user"] = $user;
                // login sukses, alihkan ke halaman pelanggan yang sesuai
                header("Location: pelanggan.php");
                exit;
            } else {
                $login_error = "Username atau password salah.";
            }
        } else {
            $login_error = "Anda belum terdaftar. Silakan daftar terlebih dahulu.";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login to Aqua Safe</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin-top: 100px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 15px 15px 0 0;
            text-align: center;
            padding: 20px;
        }

        .card-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-login {
            background-color: #007bff;
            border: none;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Masuk ke Aqua Safe</h4>
                </div>
                <div class="card-body">
                    <form action="login.php" method="POST">
                        <?php if(!empty($login_error)) : ?>
                            <div class="error-message"><?php echo $login_error; ?></div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" type="text" name="username" placeholder="Username atau email" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <label for="login_as">Login Sebagai</label>
                            <select class="form-control" name="login_as">
                                <option value="customer">Pelanggan</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary btn-block btn-login" name="login" value="Masuk" />
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
                    <div class="card-footer text-center">
    <p>Belum punya akun? <a href="register.php">Daftar sebagai pelanggan</a> | <a href="register_admin.php">Daftar sebagai admin</a></p>
</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
