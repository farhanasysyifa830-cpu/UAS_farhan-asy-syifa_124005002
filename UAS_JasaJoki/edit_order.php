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

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM orders WHERE id='$id'");
$d = mysqli_fetch_assoc($data);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Edit Order</title>

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

}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-body">

<h2 class="text-warning text-center">

✏ Edit Order

</h2>

<hr>

<form action="update_order.php" method="POST">

<input
type="hidden"
name="id"
value="<?= $d['id']; ?>">

<div class="mb-3">

<label>Nama Customer</label>

<input
type="text"
class="form-control"
value="<?= $d['nama_customer']; ?>"
readonly>

</div>

<div class="mb-3">

<label>Jenis Joki</label>

<input
type="text"
class="form-control"
value="<?= $d['jenis_joki']; ?>"
readonly>

</div>

<div class="mb-3">

<label>Jumlah</label>

<input
type="number"
class="form-control"
value="<?= $d['jumlah']; ?>"
readonly>

</div>

<div class="mb-3">

<label>Harga per Item</label>

<input
type="number"
name="harga"
class="form-control"
value="<?= $d['harga']; ?>"
required>

</div>

<div class="mb-3">

<label>Status</label>

<select
name="status"
class="form-select">

<option value="Pending"
<?=($d['status']=="Pending")?"selected":"";?>>

Pending

</option>

<option value="Diproses"
<?=($d['status']=="Diproses")?"selected":"";?>>

Diproses

</option>

<option value="Selesai"
<?=($d['status']=="Selesai")?"selected":"";?>>

Selesai

</option>

</select>

</div>

<div class="mb-3">

<label>Catatan Customer</label>

<textarea
class="form-control"
rows="4"
readonly><?= $d['catatan']; ?></textarea>

</div>

<button
class="btn btn-warning">

Update Order

</button>

<a
href="data_order.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</body>

</html>