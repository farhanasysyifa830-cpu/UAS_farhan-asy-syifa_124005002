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

$total_order=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders"));

$pending=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders WHERE status='Pending'"));

$diproses=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders WHERE status='Diproses'"));

$selesai=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders WHERE status='Selesai'"));

$total_customer=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE role='customer'"));
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dashboard Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,Helvetica,sans-serif;
}

body{
background:#0d1117;
color:white;
overflow-x:hidden;
}

.sidebar{

position:fixed;
left:0;
top:0;
width:250px;
height:100vh;
background:#111827;
padding-top:25px;
box-shadow:5px 0 20px rgba(0,0,0,.4);

}

.sidebar h3{

text-align:center;
color:#ffc107;
margin-bottom:30px;

}

.sidebar a{

display:block;
color:white;
text-decoration:none;
padding:15px 25px;
transition:.3s;

}

.sidebar a:hover{

background:#ffc107;
color:#000;

}

.main{

margin-left:250px;
padding:30px;

}

.card{

background:#161b22;
border:none;
border-radius:18px;
color:white;
transition:.3s;

}

.card:hover{

transform:translateY(-8px);
box-shadow:0 0 20px rgba(255,193,7,.35);

}

.stat{

font-size:38px;
font-weight:bold;
color:#ffc107;

}

.topbar{

background:#161b22;
border-radius:20px;
padding:20px;
margin-bottom:30px;

}

.table{

color:white;

}

.table th{

background:#ffc107;
color:#000;

}

.badge{

font-size:15px;

}

</style>

</head>

<body>

<div class="sidebar">

<h3>

🎮 CAM Admin

</h3>

<a href="dashboard_admin.php">

<i class="bi bi-speedometer2"></i>

Dashboard

</a>

<a href="data_order.php">

<i class="bi bi-table"></i>

Kelola Order

</a>

<a href="customer.php">

<i class="bi bi-people-fill"></i>

Customer

</a>

<a href="chat_admin.php">

<i class="bi bi-chat-dots-fill"></i>

Chat Customer

</a>

<a href="pengaturan.php">

<i class="bi bi-gear-fill"></i>

Pengaturan

</a>

<a href="logout.php">

<i class="bi bi-box-arrow-right"></i>

Logout

</a>

</div>

<div class="main">

<div class="topbar">

<div class="row align-items-center">

<div class="col-md-8">

<h2>

Halo Admin,

<?= $_SESSION['username']; ?>

👋

</h2>

<p>

Selamat datang di Dashboard Admin Catch A Monster Joki.

Semua aktivitas customer dapat dipantau dari halaman ini.

</p>

</div>

<div class="col-md-4 text-end">

<h1 style="font-size:70px;">

🎮

</h1>

</div>

</div>

</div>

<div class="row">

<div class="col-md-2">

<div class="card">

<div class="card-body text-center">

<h6>Total Order</h6>

<div class="stat">

<?= $total_order ?>

</div>

</div>

</div>

</div>

<div class="col-md-2">

<div class="card">

<div class="card-body text-center">

<h6>Pending</h6>

<div class="stat text-warning">

<?= $pending ?>

</div>

</div>

</div>

</div>

<div class="col-md-2">

<div class="card">

<div class="card-body text-center">

<h6>Diproses</h6>

<div class="stat text-info">

<?= $diproses ?>

</div>

</div>

</div>

</div>

<div class="col-md-2">

<div class="card">

<div class="card-body text-center">

<h6>Selesai</h6>

<div class="stat text-success">

<?= $selesai ?>

</div>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<div class="card-body text-center">

<h6>Total Customer</h6>

<div class="stat">

<?= $total_customer ?>

</div>

</div>

</div>

</div>

</div>

<br>
<h3 class="mb-4 text-warning">

📋 Order Terbaru

</h3>

<div class="card">

<div class="card-body">

<div class="row mb-3">

<div class="col-md-6">

<input
type="text"
class="form-control"
placeholder="🔍 Cari Username / Layanan...">

</div>

<div class="col-md-6 text-end">

<a href="data_order.php" class="btn btn-warning">

<i class="bi bi-table"></i>

Lihat Semua Order

</a>

</div>

</div>

<div class="table-responsive">

<table class="table table-hover table-bordered align-middle text-center">

<thead>

<tr>

<th>ID</th>

<th>Customer</th>

<th>Layanan</th>

<th>Jumlah</th>

<th>Total</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$query=mysqli_query($conn,"SELECT * FROM orders ORDER BY id DESC LIMIT 10");

if(mysqli_num_rows($query)>0){

while($d=mysqli_fetch_assoc($query)){

?>

<tr>

<td>

<?= $d['id']; ?>

</td>

<td>

<?= $d['nama_customer']; ?>

</td>

<td>

<?= $d['jenis_joki']; ?>

</td>

<td>

<?= $d['jumlah']; ?>

</td>

<td class="text-warning fw-bold">

Rp <?= number_format($d['total'],0,',','.'); ?>

</td>

<td>

<?php

if($d['status']=="Pending"){

?>

<span class="badge bg-warning">

Pending

</span>

<?php

}elseif($d['status']=="Diproses"){

?>

<span class="badge bg-info">

Diproses

</span>

<?php

}else{

?>

<span class="badge bg-success">

Selesai

</span>

<?php

}

?>

</td>

<td>

<a
href="detail_order.php?id=<?= $d['id']; ?>"
class="btn btn-primary btn-sm">

<i class="bi bi-eye-fill"></i>

</a>

<a
href="edit_status.php?id=<?= $d['id']; ?>"
class="btn btn-warning btn-sm">

<i class="bi bi-pencil-fill"></i>

</a>

<a
href="hapus_order.php?id=<?= $d['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus order ini?')">

<i class="bi bi-trash-fill"></i>

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="7">

Belum ada order.

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</div>

<br>

<div class="row">

<div class="col-md-6">

<div class="card">

<div class="card-body">

<h4 class="text-warning">

📈 Aktivitas Hari Ini

</h4>

<hr>

<div class="d-flex justify-content-between mb-3">

<span>

Order Baru

</span>

<span class="badge bg-primary">

<?= $pending ?>

</span>

</div>

<div class="d-flex justify-content-between mb-3">

<span>

Sedang Diproses

</span>

<span class="badge bg-info">

<?= $diproses ?>

</span>

</div>

<div class="d-flex justify-content-between">

<span>

Order Selesai

</span>

<span class="badge bg-success">

<?= $selesai ?>

</span>

</div>

</div>

</div>

</div>

<div class="col-md-6">

<div class="card">

<div class="card-body">

<h4 class="text-warning">

💬 Chat Customer

</h4>

<hr>

<div class="alert alert-dark">

Belum ada pesan baru.

</div>

<a
href="chat_admin.php"
class="btn btn-warning w-100">

<i class="bi bi-chat-dots-fill"></i>

Buka Chat Customer

</a>

</div>

</div>

</div>

</div>

<br>
<div class="row">

<div class="col-md-6">

<div class="card">

<div class="card-body">

<h4 class="text-warning">

👥 Customer Terbaru

</h4>

<hr>

<?php

$customer=mysqli_query($conn,"SELECT * FROM users WHERE role='customer' ORDER BY id DESC LIMIT 5");

if(mysqli_num_rows($customer)>0){

while($c=mysqli_fetch_assoc($customer)){

?>

<div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">

<div>

<h6 class="mb-0">

<?= $c['username']; ?>

</h6>

<small class="text-secondary">

ID User :
<?= $c['id']; ?>

</small>

</div>

<span class="badge bg-success">

Aktif

</span>

</div>

<?php

}

}else{

?>

<div class="alert alert-secondary">

Belum ada customer.

</div>

<?php

}

?>

</div>

</div>

</div>

<div class="col-md-6">

<div class="card">

<div class="card-body">

<h4 class="text-warning">

🏆 Layanan Terpopuler

</h4>

<hr>

<?php

$boss=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders WHERE jenis_joki='Boss'"));

$dungeon=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders WHERE jenis_joki='Dungeon'"));

$rift=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders WHERE jenis_joki='Rift'"));

?>

<div class="mb-3">

<div class="d-flex justify-content-between">

<span>

👹 Boss

</span>

<b>

<?= $boss ?>

 Order

</b>

</div>

<div class="progress mt-2">

<div class="progress-bar bg-warning" style="width:<?= min($boss*10,100) ?>%"></div>

</div>

</div>

<div class="mb-3">

<div class="d-flex justify-content-between">

<span>

🗝️ Dungeon

</span>

<b>

<?= $dungeon ?>

 Order

</b>

</div>

<div class="progress mt-2">

<div class="progress-bar bg-info" style="width:<?= min($dungeon*10,100) ?>%"></div>

</div>

</div>

<div>

<div class="d-flex justify-content-between">

<span>

🌌 Rift

</span>

<b>

<?= $rift ?>

 Order

</b>

</div>

<div class="progress mt-2">

<div class="progress-bar bg-success" style="width:<?= min($rift*10,100) ?>%"></div>

</div>

</div>

</div>

</div>

</div>

<br>

<div class="card">

<div class="card-body">

<h4 class="text-warning">

⚡ Shortcut Admin

</h4>

<hr>

<div class="row">

<div class="col-md-3">

<a href="data_order.php" class="btn btn-warning w-100 mb-3">

📋

<br>

Order

</a>

</div>

<div class="col-md-3">

<a href="customer.php" class="btn btn-primary w-100 mb-3">

👥

<br>

Customer

</a>

</div>

<div class="col-md-3">

<a href="chat_admin.php" class="btn btn-success w-100 mb-3">

💬

<br>

Chat

</a>

</div>

<div class="col-md-3">

<a href="pengaturan.php" class="btn btn-danger w-100 mb-3">

⚙️

<br>

Setting

</a>

</div>

</div>

</div>

</div>

<br>

<div class="card">

<div class="card-body">

<h4 class="text-warning">

📢 Pengumuman Admin

</h4>

<hr>

<div class="alert alert-warning">

<b>

Server Online

</b>

<br>

Semua layanan Boss, Dungeon dan Rift tersedia.

</div>

<div class="alert alert-info">

Update terakhir :

<?= date("d-m-Y"); ?>

</div>

</div>

</div>

<footer class="text-center mt-5 text-secondary">

<hr>

<p>

© 2026 Catch A Monster Joki

</p>

<p>

Dashboard Admin Version 2.0

</p>

</footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>