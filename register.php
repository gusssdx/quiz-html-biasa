<?php
session_start();
include_once 'koneksi.php';

// Proses registrasi
if(isset($_POST['register'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    
    // Enkripsi password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data ke tabel login
    $query = "INSERT INTO login (username, password) VALUES ('$username', '$hashed_password')";
    $result = mysqli_query($koneksi, $query);

    if($result){
        echo '<script>alert("Registrasi berhasil. Silakan login."); window.location="login.php"</script>';
    } else {
        echo '<script>alert("Registrasi gagal. Silakan coba lagi.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="regis.css">
</head>

<body>
    <div class="container">
        <form method="POST" class="register-form">
            <h2>Registrasi</h2>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="register">Register</button>
        </form>
    </div>
</body>
</html>
