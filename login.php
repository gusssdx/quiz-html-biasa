<?php 
session_start();
include_once 'koneksi.php';
if (!isset($_SESSION['log'])) {
} else {
  header('locarion:index.php');
}

if(isset($_POST['login'])){
  $user = mysqli_real_escape_string($koneksi, $_POST['username']);
  $pass = mysqli_real_escape_string($koneksi, $_POST['password']);
  $queryuser = mysqli_query($koneksi, "SELECT * FROM login where username='$user'");
  $cariuser = mysqli_fetch_assoc($queryuser);
  if (password_verify($pass, $cariuser['password'])){
    $_SESSION['userid'] =  $cariuser['id'];
    $_SESSION['username'] =  $cariuser['username'];
    $_SESSION['log'] = 'login';

    if($cariuser){
    header('location:index.html');
    exit;
    } else {
      echo '<script>alert("Data yang anda masukkan salah!!");   </script>';
    }
  } else {
    echo '<script>alert("Data yang anda masukkan salah!!");history.go(-1);</script>';
  }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>

<body>
    <div class="container">
        <form method="POST" class="login-form">
            <h2>Login</h2>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login">Login</button>
        <div class="register-link">
        <p>Belum punya akun? <a href="register.php">Registrasi disini</a></p>
        </div>
        </form>
    </div>
</body>

</html>