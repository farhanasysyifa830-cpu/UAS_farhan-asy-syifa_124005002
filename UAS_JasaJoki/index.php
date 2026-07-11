<?php
session_start();

if(isset($_SESSION['login'])){
    if($_SESSION['role']=="admin"){
        header("Location:dashboard_admin.php");
    }else{
        header("Location:dashboard.php");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Catch A Monster Joki</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
scroll-behavior:smooth;
font-family:Arial,Helvetica,sans-serif;
}

body{
background:#0d1117;
color:white;
}

.navbar{
background:#000;
box-shadow:0 0 15px rgba(0,0,0,.5);
}

.navbar-brand{
font-size:28px;
font-weight:bold;
color:#ffc107 !important;
}

.nav-link{
color:white !important;
margin-right:10px;
transition:.3s;
}

.nav-link:hover{
color:#ffc107 !important;
}

.hero{
padding:90px 0;
}

.hero h1{
font-size:58px;
font-weight:bold;
}

.hero span{
color:#ffc107;
}

.hero p{
margin-top:20px;
font-size:18px;
color:#d1d1d1;
line-height:30px;
}

.btn-warning{
border-radius:12px;
font-weight:bold;
padding:12px 30px;
}

.btn-outline-light{
border-radius:12px;
padding:12px 30px;
}

.hero img{
max-width:100%;
border-radius:20px;
animation:float 3s ease-in-out infinite;
}

@keyframes float{

0%{
transform:translateY(0px);
}

50%{
transform:translateY(-12px);
}

100%{
transform:translateY(0px);
}

}

.card{
background:#161b22;
border:none;
border-radius:20px;
transition:.3s;
color:white;
}

.card:hover{
transform:translateY(-8px);
box-shadow:0 0 20px rgba(255,193,7,.5);
}

.icon{
font-size:60px;
}

section{
padding:70px 0;
}

footer{
background:#000;
padding:25px;
text-align:center;
color:#999;
margin-top:60px;
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">

<div class="container">

<a class="navbar-brand" href="index.php">

🎮 Catch A Monster Joki

</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="#home">Home</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#layanan">Layanan</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#tentang">Tentang</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#kontak">Kontak</a>
</li>

<li class="nav-item ms-2">
<a href="login.php" class="btn btn-warning">Login</a>
</li>

<li class="nav-item ms-2">
<a href="register.php" class="btn btn-outline-light">Register</a>
</li>

</ul>

</div>

</div>

</nav>

<section id="home" class="hero">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-6">

<h1>

Jasa Joki

<span>

Catch A Monster

</span>

</h1>

<p>

Selamat datang di website resmi Catch A Monster Joki.
Kami melayani jasa Boss, Dungeon dan Rift dengan proses cepat,
aman, terpercaya serta dikerjakan oleh player berpengalaman.

</p>

<div class="mt-4">

<a href="register.php" class="btn btn-warning btn-lg">

Pesan Sekarang

</a>

<a href="login.php" class="btn btn-outline-light btn-lg">

Login

</a>

</div>

</div>

<div class="col-lg-6 text-center">

<img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=900"
class="img-fluid">

</div>

</div>

</div>

</section>
<!-- LAYANAN -->

<section id="layanan">

<div class="container">

<h2 class="text-center text-warning fw-bold mb-5">

Layanan Kami

</h2>

<div class="row g-4">

<div class="col-md-4">

<div class="card h-100 text-center p-4">

<div class="icon">

👹

</div>

<h3 class="mt-3">

Boss

</h3>

<p class="mt-3">

Jasa farming Boss dengan proses cepat.

Harga mulai

<b class="text-warning">

Rp2.000 / Boss

</b>

</p>

</div>

</div>

<div class="col-md-4">

<div class="card h-100 text-center p-4">

<div class="icon">

🗝️

</div>

<h3 class="mt-3">

Dungeon

</h3>

<p class="mt-3">

Jasa Dungeon untuk semua level.

Harga mulai

<b class="text-warning">

Rp2.000 / Key

</b>

</p>

</div>

</div>

<div class="col-md-4">

<div class="card h-100 text-center p-4">

<div class="icon">

🌌

</div>

<h3 class="mt-3">

Rift

</h3>

<p class="mt-3">

Harga mengikuti event yang sedang berlangsung.

<b class="text-warning">

Hubungi Admin

</b>

</p>

</div>

</div>

</div>

</div>

</section>

<!-- TENTANG -->

<section id="tentang">

<div class="container">

<h2 class="text-center text-warning fw-bold mb-5">

Kenapa Memilih Kami?

</h2>

<div class="row g-4">

<div class="col-md-4">

<div class="card text-center p-4 h-100">

<h1>

⚡

</h1>

<h4 class="mt-3">

Proses Cepat

</h4>

<p>

Order diproses dengan cepat sesuai antrian.

</p>

</div>

</div>

<div class="col-md-4">

<div class="card text-center p-4 h-100">

<h1>

🔒

</h1>

<h4 class="mt-3">

Aman

</h4>

<p>

Akun customer dijaga dan tidak disalahgunakan.

</p>

</div>

</div>

<div class="col-md-4">

<div class="card text-center p-4 h-100">

<h1>

💬

</h1>

<h4 class="mt-3">

Fast Response

</h4>

<p>

Admin siap membantu selama proses order.

</p>

</div>

</div>

</div>

</div>

</section>

<!-- STATISTIK -->

<section>

<div class="container">

<h2 class="text-center text-warning fw-bold mb-5">

Statistik

</h2>

<div class="row g-4">

<div class="col-md-4">

<div class="card text-center p-4">

<h1 class="text-warning">

100+

</h1>

<h5>

Customer

</h5>

</div>

</div>

<div class="col-md-4">

<div class="card text-center p-4">

<h1 class="text-warning">

500+

</h1>

<h5>

Order Selesai

</h5>

</div>

</div>

<div class="col-md-4">

<div class="card text-center p-4">

<h1 class="text-warning">

★★★★★

</h1>

<h5>

Rating Pelayanan

</h5>

</div>

</div>

</div>

</div>

</section>
<!-- KONTAK -->

<section id="kontak">

<div class="container">

<h2 class="text-center text-warning fw-bold mb-5">

Hubungi Kami

</h2>

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card p-5 text-center">

<h3 class="mb-4">

📞 Customer Service

</h3>

<p>

Jika ada pertanyaan atau ingin melakukan pemesanan,
silakan hubungi kami melalui kontak berikut.

</p>

<hr>

<div class="row mt-4">

<div class="col-md-4">

<h4>📱 WhatsApp</h4>

<p>0812-3456-7890</p>

</div>

<div class="col-md-4">

<h4>📷 Instagram</h4>

<p>@catchamonster_joki</p>

</div>

<div class="col-md-4">

<h4>📧 Email</h4>

<p>admin@catchamonster.com</p>

</div>

</div>

<div class="mt-4">

<a href="login.php" class="btn btn-warning btn-lg">

Login Sekarang

</a>

<a href="register.php" class="btn btn-outline-light btn-lg">

Daftar

</a>

</div>

</div>

</div>

</div>

</div>

</section>

<!-- FOOTER -->

<footer>

<div class="container">

<div class="row">

<div class="col-md-6 text-md-start text-center">

<h5 class="text-warning">

🎮 Catch A Monster Joki

</h5>

<p>

Website Jasa Joki Catch A Monster berbasis PHP & MySQL.

</p>

</div>

<div class="col-md-6 text-md-end text-center">

<p>

© 2026 Catch A Monster Joki

</p>

<p>

All Rights Reserved

</p>

</div>

</div>

</div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>