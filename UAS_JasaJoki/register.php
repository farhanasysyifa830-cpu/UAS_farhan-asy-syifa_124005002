<?php
include "koneksi.php";

if(isset($_POST['register'])){

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $konfirmasi = mysqli_real_escape_string($conn,$_POST['konfirmasi']);

    if($password != $konfirmasi){

        echo "<script>
        alert('Konfirmasi Password Tidak Sama!');
        </script>";

    }else{

        $cek = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");

        if(mysqli_num_rows($cek)>0){

            echo "<script>
            alert('Username Sudah Digunakan!');
            </script>";

        }else{

            mysqli_query($conn,"INSERT INTO users(username,password,role)
            VALUES('$username','$password','customer')");

            echo "<script>
            alert('Akun Berhasil Dibuat');
            window.location='login.php';
            </script>";

        }

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Register | Catch A Monster</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#111;
}

.card{
margin-top:70px;
background:#1b1b1b;
color:white;
border:none;
border-radius:20px;
}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow-lg">

<div class="card-body">

<h2 class="text-center text-warning">

🎮 Catch A Monster

</h2>

<p class="text-center text-secondary">

Buat Akun Customer

</p>

<hr>

<form method="POST">

<div class="mb-3">

<label>Username</label>

<input
type="text"
name="username"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Konfirmasi Password</label>

<input
type="password"
name="konfirmasi"
class="form-control"
required>

</div>

<button
type="submit"
name="register"
class="btn btn-warning w-100">

DAFTAR

</button>

</form>

<hr>

<a
href="login.php"
class="btn btn-outline-light w-100">

Kembali ke Login

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>