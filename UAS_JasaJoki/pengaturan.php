<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location:login.php");
    exit;
}

if($_SESSION['role']!="admin"){
    header("Location:dashboard.php");
    exit;
}

$data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM pengaturan WHERE id='1'"));

if(isset($_POST['simpan'])){

    $nama=mysqli_real_escape_string($conn,$_POST['nama']);

    $boss=(int)$_POST['boss'];

    $dungeon=(int)$_POST['dungeon'];

    $rift=(int)$_POST['rift'];

    $wa=mysqli_real_escape_string($conn,$_POST['wa']);

    mysqli_query($conn,"
    UPDATE pengaturan SET

    nama_website='$nama',

    harga_boss='$boss',

    harga_dungeon='$dungeon',

    harga_rift='$rift',

    wa_admin='$wa'

    WHERE id='1'
    ");

    header("Location:setting.php?sukses=1");

    exit;

}
?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Pengaturan Website</title>

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

</style>

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-body">

<h2 class="text-warning">

⚙️ Pengaturan Website

</h2>

<hr>

<?php

if(isset($_GET['sukses'])){

?>

<div class="alert alert-success">

Pengaturan berhasil disimpan.

</div>

<?php

}

?>

<form method="POST">

<div class="mb-3">

<label class="form-label">

🏷️ Nama Website

</label>

<input
type="text"
name="nama"
class="form-control"
value="<?= $data['nama_website']; ?>"
required>

</div>

<div class="row">

<div class="col-md-4">

<div class="mb-3">

<label class="form-label">

👹 Harga Boss

</label>

<input
type="number"
name="boss"
class="form-control"
value="<?= $data['harga_boss']; ?>"
required>

</div>

</div>

<div class="col-md-4">

<div class="mb-3">

<label class="form-label">

🗝️ Harga Dungeon

</label>

<input
type="number"
name="dungeon"
class="form-control"
value="<?= $data['harga_dungeon']; ?>"
required>

</div>

</div>

<div class="col-md-4">

<div class="mb-3">

<label class="form-label">

🌌 Harga Rift

</label>

<input
type="number"
name="rift"
class="form-control"
value="<?= $data['harga_rift']; ?>"
required>

</div>

</div>

</div>

<div class="mb-3">

<label class="form-label">

📱 Nomor WhatsApp Admin

</label>

<input
type="text"
name="wa"
class="form-control"
value="<?= $data['wa_admin']; ?>"
required>

</div>

<hr>

<div class="d-grid gap-2">

<button
type="submit"
name="simpan"
class="btn btn-warning btn-lg">

<i class="bi bi-floppy-fill"></i>

Simpan Pengaturan

</button>

<a
href="dashboard_admin.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

Kembali ke Dashboard

</a>

</div>

</form>

</div>

</div>

<div class="text-center mt-4 text-secondary">

© 2026 Catch A Monster Joki - Admin Panel

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>