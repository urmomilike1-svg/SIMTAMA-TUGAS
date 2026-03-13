<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "koneksi.php";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query login
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

    if(!$query){
        die("Query error: " . mysqli_error($conn));
    }

    $data = mysqli_fetch_assoc($query);

    if($data){
        // Simpan session
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['nim'] = $data['nim'] ?? null; // untuk dosen bisa null

        // Redirect ke dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau Password salah";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login SIMTAMA</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-page">
    <div class="login-box">
        <h1>LOGIN SIMTAMA</h1>

        <?php
        if(isset($error)){
            echo "<p class='error'>$error</p>";
        }
        ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" class="btn-login">Login</button>
        </form>
    </div>
</div>

</body>
</html>