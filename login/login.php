<?php
session_start();
require '../config/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input (gantilah ini sesuai kebutuhan Anda)
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Koneksi ke database
    if ($conn->connect_error) {
        die("Koneksi database gagal: " . $conn->connect_error);
    }

    // Query menggunakan hashed password (gantilah ini sesuai kebutuhan Anda)
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    if ($result && $result->num_rows == 1) {
        // Jika data ditemukan, set sesi dan arahkan ke halaman utama
        $row = $result->fetch_assoc();
        $_SESSION["username"] = $username;
        $_SESSION["id_user"] = $row["id_pegawai"]; // Menyimpan id_pegawai ke dalam sesi
        header("Location: ../index/index.php");
        exit();
    } else {
        // Jika data tidak ditemukan, tampilkan pesan error
        $error_message = "Username atau kata sandi salah.";
    }

    // Tutup koneksi database
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
        
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
        
            <!-- <div class="col-md-6 right-box"> -->
                
                <div class="row align-items-center">
                    
                    <div class="header-text mb-4">
                    <div class="mx-auto" style="max-width: 380px;">
                        <img src="img/login.png" class="img-fluid" style="max-width: 100%;">
                    </div>
                        <h2>Selamat Datang</h2>
                        <p>Di Berkah Petshop.</p>

                        <?php
                        // Tampilkan pesan kesalahan jika ada
                        if (isset($error_message)) {
                            echo '<div class="alert alert-danger" role="alert">';
                            echo $error_message;
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <form method="post" action="login.php" class="login-form">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6" name="username" placeholder="Username">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="password" class="form-control form-control-lg bg-light fs-6" name="password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <input type="checkbox" id="show-password">
                                    <label  for="show-password">Lihat Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Masuk</button>
                        </div>
                    </form>

                    
                </div>
               
            </div>
            
            
        </div>
        
    </div>
    <script>
        document.getElementById('show-password').addEventListener('change', function() {
            var passwordField = document.getElementById('password');
            if (this.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
</body>
</html>
