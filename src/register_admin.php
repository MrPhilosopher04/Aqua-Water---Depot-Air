<?php

require_once("config.php");

$register_error = "";

if(isset($_POST['register'])){
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $role = 'admin'; // Set role as admin

    // Persiapan kueri SQL untuk menyimpan data admin
    $sql = "INSERT INTO admins (name, username, email, password, role) VALUES (:name, :username, :email, :password, :role)";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
        ":name" => $name,
        ":username" => $username,
        ":email" => $email,
        ":password" => $password,
        ":role" => $role
    );

    if($stmt->execute($params)){
        // Redirect to login page after successful registration
        header("Location: login.php");
        exit; // Exit to prevent further execution
    } else {
        $register_error = "Gagal melakukan pendaftaran. Silakan coba lagi.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Admin - Aqua Safe</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .container {
            max-width: 500px;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            <p>&larr; <a href="index.php">Home</a></p>

            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Registrasi Admin di Aqua Safe</h3>
                    <p class="text-center">Sudah punya akun? <a href="login.php">Login di sini</a></p>
                    <form action="register_admin.php" method="POST">

                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input class="form-control" type="text" name="name" placeholder="Nama lengkap Anda" required />
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" type="text" name="username" placeholder="Username" required />
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" placeholder="Alamat Email" required />
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Password" required />
                        </div>

                        <input type="submit" class="btn btn-success btn-block" name="register" value="Daftar sebagai Admin" />

                        <?php if(!empty($register_error)) : ?>
                            <div class="text-danger mt-3"><?php echo $register_error; ?></div>
                        <?php endif; ?>

                    </form>
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
