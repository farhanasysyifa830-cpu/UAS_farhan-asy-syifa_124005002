<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location:login.php");
    exit;
}

$id=$_SESSION['id'];

$total=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders WHERE user_id='$id'"));

$pending=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders WHERE user_id='$id' AND status='Pending'"));

$diproses=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders WHERE user_id='$id' AND status='Diproses'"));

$selesai=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders WHERE user_id='$id' AND status='Selesai'"));

$setting=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM pengaturan WHERE id='1'"));
?>
<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?= $setting['nama_website']; ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
background:#0d1117;
color:white;
}

.navbar{
background:#111827;
}

.banner{
background:linear-gradient(135deg,#ffc107,#ff9800);
border-radius:25px;
padding:35px;
color:#000;
margin-top:30px;
box-shadow:0 0 25px rgba(255,193,7,.4);
}

.card{
background:#161b22;
border:none;
border-radius:20px;
color:white;
transition:.3s;
}

.card:hover{
transform:translateY(-8px);
box-shadow:0 0 20px rgba(255,193,7,.4);
}

.stat{
font-size:35px;
font-weight:bold;
color:#ffc107;
}

.quick-btn{
padding:18px;
font-size:18px;
font-weight:bold;
border-radius:15px;
}

.list-group-item{
background:#21262d;
color:white;
border:none;
}

</style>

</head>

<body>

<nav class="navbar navbar-dark">

<div class="container">

<a class="navbar-brand text-warning fw-bold">

🎮 <?= $setting['nama_website']; ?>

</a>

<div>

<a href="order.php" class="btn btn-warning">

<i class="bi bi-cart-plus"></i>

Order

</a>

<a href="riwayat.php" class="btn btn-primary">

<i class="bi bi-clock-history"></i>

Riwayat

</a>

<a href="chat_customer.php" class="btn btn-success">

<i class="bi bi-chat-dots-fill"></i>

Chat

</a>

<a href="setting_customer.php" class="btn btn-info text-white">

<i class="bi bi-person-fill"></i>

Profil

</a>

<a href="logout.php" class="btn btn-danger">

Logout

</a>

</div>

</div>

</nav>

<div class="container">

<div class="banner">

<div class="row align-items-center">

<div class="col-md-8">

<h2>

Halo,

<?= $_SESSION['username']; ?>

👋

</h2>

<p>

Selamat datang kembali di dashboard customer.
Silakan buat order baru, lihat riwayat, atau chat dengan admin.

</p>

</div>

<div class="col-md-4 text-center">

<h1 style="font-size:90px">

🎮

</h1>

</div>

</div>

</div>

<br>
<h3 class="text-warning mb-4">

📊 Statistik Order Kamu

</h3>

<div class="row">

<div class="col-md-3 mb-4">

<div class="card">

<div class="card-body text-center">

<h6>Total Order</h6>

<div class="stat">

<?= $total ?>

</div>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card">

<div class="card-body text-center">

<h6>Pending</h6>

<div class="stat text-warning">

<?= $pending ?>

</div>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card">

<div class="card-body text-center">

<h6>Diproses</h6>

<div class="stat text-info">

<?= $diproses ?>

</div>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card">

<div class="card-body text-center">

<h6>Selesai</h6>

<div class="stat text-success">

<?= $selesai ?>

</div>

</div>

</div>

</div>

</div>

<h3 class="text-warning mt-4 mb-4">

⚡ Menu Cepat

</h3>

<div class="row">

<div class="col-md-3 mb-4">

<div class="card">

<div class="card-body text-center">

<h1>📝</h1>

<h5>Buat Order</h5>

<p>Buat pesanan joki baru.</p>

<a href="order.php" class="btn btn-warning quick-btn w-100">

Order Sekarang

</a>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card">

<div class="card-body text-center">

<h1>📜</h1>

<h5>Riwayat</h5>

<p>Lihat semua order yang pernah dibuat.</p>

<a href="riwayat.php" class="btn btn-primary quick-btn w-100">

Lihat Riwayat

</a>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card">

<div class="card-body text-center">

<h1>💬</h1>

<h5>Chat Admin</h5>

<p>Hubungi admin kapan saja.</p>

<a href="chat_customer.php" class="btn btn-success quick-btn w-100">

Buka Chat

</a>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card">

<div class="card-body text-center">

<h1>👤</h1>

<h5>Profil Saya</h5>

<p>Ubah data akun customer.</p>

<a href="setting_customer.php" class="btn btn-info text-white quick-btn w-100">

Profil

</a>

</div>

</div>

</div>

</div>

<div class="row mt-4">

<div class="col-md-6 mb-4">

<div class="card">

<div class="card-body">

<h3 class="text-warning">

🎮 Harga Layanan

</h3>

<hr>

<div class="d-flex justify-content-between">

<span>👹 Boss</span>

<b class="text-warning">

Rp <?= number_format($setting['harga_boss'],0,",","."); ?>

</b>

</div>

<hr>

<div class="d-flex justify-content-between">

<span>🗝️ Dungeon</span>

<b class="text-warning">

Rp <?= number_format($setting['harga_dungeon'],0,",","."); ?>

</b>

</div>

<hr>

<div class="d-flex justify-content-between">

<span>🌌 Rift</span>

<b class="text-warning">

Rp <?= number_format($setting['harga_rift'],0,",","."); ?>

</b>

</div>

</div>

</div>

</div>

<div class="col-md-6 mb-4">

<div class="card">

<div class="card-body">

<h3 class="text-warning">

👤 Informasi Customer

</h3>

<hr>

<p>

<b>Username</b>

<br>

<?= $_SESSION['username']; ?>

</p>

<p>

<b>Status Akun</b>

<br>

<span class="badge bg-success">

Aktif

</span>

</p>

<p>

<b>WhatsApp Admin</b>

<br>

<?= $setting['wa_admin']; ?>

</p>

</div>

</div>

</div>

</div>

<br>
<div class="row">

<div class="col-md-7 mb-4">

<div class="card">

<div class="card-body">

<h3 class="text-warning">

📦 Order Terbaru

</h3>

<hr>

<?php

$order=mysqli_query($conn,"
SELECT *
FROM orders
WHERE user_id='$id'
ORDER BY id DESC
LIMIT 5
");

if(mysqli_num_rows($order)>0){

?>

<div class="table-responsive">

<table class="table table-dark table-hover align-middle">

<thead>

<tr>

<th>#</th>

<th>Layanan</th>

<th>Jumlah</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php

while($o=mysqli_fetch_assoc($order)){

?>

<tr>

<td><?= $o['id']; ?></td>

<td><?= $o['jenis_joki']; ?></td>

<td><?= $o['jumlah']; ?></td>

<td>

<?php

if($o['status']=="Pending"){

echo '<span class="badge bg-warning">Pending</span>';

}elseif($o['status']=="Diproses"){

echo '<span class="badge bg-info">Diproses</span>';

}else{

echo '<span class="badge bg-success">Selesai</span>';

}

?>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

<?php

}else{

?>

<div class="alert alert-secondary">

Belum ada order.

</div>

<?php

}

?>

</div>

</div>

</div>

<div class="col-md-5 mb-4">

<div class="card">

<div class="card-body">

<h3 class="text-warning">

📢 Informasi

</h3>

<hr>

<div class="alert alert-warning">

👹 Boss :
Rp <?= number_format($setting['harga_boss'],0,",","."); ?>

</div>

<div class="alert alert-info">

🗝️ Dungeon :
Rp <?= number_format($setting['harga_dungeon'],0,",","."); ?>

</div>

<div class="alert alert-success">

🌌 Rift :
Rp <?= number_format($setting['harga_rift'],0,",","."); ?>

</div>

<div class="alert alert-dark">

💬 Jika mengalami kendala silakan gunakan menu
<b>Chat Admin</b>.

</div>

</div>

</div>

</div>

</div>

<div class="card mb-4">

<div class="card-body">

<h3 class="text-warning">

💡 Tips Customer

</h3>

<hr>

<ul class="list-group">

<li class="list-group-item">

✅ Pastikan username game sudah benar sebelum order.

</li>

<li class="list-group-item">

✅ Chat admin jika ingin konfirmasi progress.

</li>

<li class="list-group-item">

✅ Cek riwayat order secara berkala.

</li>

<li class="list-group-item">

✅ Harga mengikuti pengaturan admin secara otomatis.

</li>

</ul>

</div>

</div>

<footer class="text-center text-secondary mt-5 mb-4">

<hr>

<p>

© 2026 <?= $setting['nama_website']; ?>

</p>

<p>

Dashboard Customer v2.0

</p>

</footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>