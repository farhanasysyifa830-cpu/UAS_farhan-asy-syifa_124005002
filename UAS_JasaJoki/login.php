<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "koneksi.php";

if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == "admin") {
        header("Location: dashboard_admin.php");
    } else {
        header("Location: dashboard.php");
    }
    exit;
}

$error = "";

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    if (!$query) {
        die("Query Error : " . mysqli_error($conn));
    }

    if (mysqli_num_rows($query) == 1) {

        $user = mysqli_fetch_assoc($query);

        // Password biasa (belum hash)
        if ($password == $user['password']) {

            $_SESSION['login'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == "admin") {
                header("Location: dashboard_admin.php");
            } else {
                header("Location: dashboard.php");
            }
            exit;

        } else {
            $error = "Password salah!";
        }

    } else {
        $error = "Username tidak ditemukan!";
    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#111;
}

.card{
background:#1b1b1b;
color:white;
border:none;
border-radius:20px;
margin-top:100px;
}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-body">

<h2 class="text-center text-warning mb-4">

LOGIN

</h2>

<?php if($error!=""){ ?>

<div class="alert alert-danger">

<?= $error ?>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label>Username</label>

<input type="text" name="username" class="form-control" required>

</div>

<div class="mb-3">

<label>Password</label>

<input type="password" name="password" class="form-control" required>

</div>

<button type="submit" name="login" class="btn btn-warning w-100">

Login

</button>

<a href="register.php" class="btn btn-secondary w-100 mt-2">

Register

</a>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>