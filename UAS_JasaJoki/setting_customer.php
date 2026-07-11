<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location:login.php");
    exit;
}

$id=$_SESSION['id'];

$data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE id='$id'"));

if(isset($_POST['simpan'])){

    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $nama=mysqli_real_escape_string($conn,$_POST['nama']);
    $wa=mysqli_real_escape_string($conn,$_POST['wa']);
    $password=$_POST['password'];

    if($password==""){

        mysqli_query($conn,"
        UPDATE users SET

        username='$username',

        nama='$nama',

        wa='$wa'

        WHERE id='$id'
        ");

    }else{

        mysqli_query($conn,"
        UPDATE users SET

        username='$username',

        nama='$nama',

        wa='$wa',

        password='$password'

        WHERE id='$id'
        ");

    }

    $_SESSION['username']=$username;

    header("Location:setting_customer.php?sukses=1");
    exit;

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Profil Saya</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{

background:#0d1117;
color:white;

}

.card{

background:#161b22;
border:none;
border-radius:20px;
color:white;

}

.form-control{

background:#21262d;
border:none;
color:white;

}

.form-control:focus{

background:#21262d;
color:white;
box-shadow:none;

}

.avatar{

width:120px;
height:120px;
border-radius:50%;
background:#ffc107;
display:flex;
align-items:center;
justify-content:center;
font-size:50px;
margin:auto;
color:#000;

}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-body">

<h2 class="text-warning">

👤 Profil Customer

</h2>

<hr>

<?php

if(isset($_GET['sukses'])){

?>

<div class="alert alert-success">

Profil berhasil diperbarui.

</div>

<?php

}

?>

<div class="text-center mb-4">

<div class="avatar">

<i class="bi bi-person-fill"></i>

</div>

<h4 class="mt-3">

<?= $_SESSION['username']; ?>

</h4>

<p class="text-secondary">

Customer Catch A Monster

</p>

</div>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

<i class="bi bi-person-fill"></i>

Username

</label>

<input
type="text"
name="username"
class="form-control"
value="<?= $data['username']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

<i class="bi bi-person-badge-fill"></i>

Nama Panggilan

</label>

<input
type="text"
name="nama"
class="form-control"
value="<?= $data['nama']; ?>"
required>

</div>

</div>

<div class="mb-3">

<label class="form-label">

<i class="bi bi-whatsapp"></i>

Nomor WhatsApp

</label>

<input
type="text"
name="wa"
class="form-control"
value="<?= $data['wa']; ?>"
placeholder="08xxxxxxxxxx"
required>

</div>

<div class="mb-3">

<label class="form-label">

<i class="bi bi-lock-fill"></i>

Password Baru

</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Kosongkan jika tidak ingin mengganti password">

<div class="form-text text-light">

Biarkan kosong jika password tidak ingin diubah.

</div>

</div>

<hr>

<div class="row">

<div class="col-md-6 d-grid">

<button
type="submit"
name="simpan"
class="btn btn-warning btn-lg">

<i class="bi bi-floppy-fill"></i>

Simpan Perubahan

</button>

</div>

<div class="col-md-6 d-grid">

<a
href="dashboard.php"
class="btn btn-secondary btn-lg">

<i class="bi bi-arrow-left"></i>

Kembali

</a>

</div>

</div>

</form>

</div>

</div>

<div class="text-center mt-4 text-secondary">

<hr>

<p>

© 2026 Catch A Monster Joki

</p>

<p>

Customer Profile v1.0

</p>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>