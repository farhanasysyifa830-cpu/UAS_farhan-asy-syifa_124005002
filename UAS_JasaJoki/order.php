<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Order Joki</title>

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

}

.navbar{

background:#000;

}

.card{

background:#161b22;
border:none;
border-radius:20px;
color:white;
box-shadow:0 0 20px rgba(255,193,7,.15);

}

.form-control,
.form-select{

background:#21262d;
border:none;
color:white;

}

.form-control:focus,
.form-select:focus{

background:#21262d;
color:white;
box-shadow:0 0 10px #ffc107;

}

.info-box{

background:#21262d;
padding:20px;
border-radius:15px;

}

.btn-warning{

font-weight:bold;
border-radius:12px;

}

.price-box{

background:#000;
border:2px solid #ffc107;
border-radius:15px;
padding:20px;
text-align:center;

}

.total{

font-size:35px;
font-weight:bold;
color:#ffc107;

}

</style>

</head>

<body>

<nav class="navbar navbar-dark">

<div class="container">

<a class="navbar-brand text-warning fw-bold">

🎮 Catch A Monster Joki

</a>

<div>

<a href="dashboard.php" class="btn btn-outline-light">

Dashboard

</a>

<a href="logout.php" class="btn btn-danger">

Logout

</a>

</div>

</div>

</nav>

<div class="container mt-5">

<div class="row">

<div class="col-lg-8">

<div class="card">

<div class="card-body">

<h2 class="text-warning">

📝 Form Order

</h2>

<p>

Halo,

<b>

<?= $_SESSION['username']; ?>

</b>

👋

Silakan isi data di bawah ini.

</p>

<hr>

<form action="simpan_order.php" method="POST">

<input type="hidden" name="user_id" value="<?= $_SESSION['id']; ?>">

<div class="mb-3">

<label>

👤 Nama Panggilan

</label>

<input
type="text"
name="nama_customer"
class="form-control"
placeholder="Contoh : Yaps"
required>

</div>

<div class="mb-3">

<label>

📱 No WhatsApp

</label>

<input
type="text"
name="wa"
class="form-control"
placeholder="081234567890"
required>

</div>

<div class="mb-3">

<label>

🎮 USN

</label>

<input
type="text"
name="nickname"
class="form-control"
placeholder="Masukkan USN Game"
required>

</div>

<div class="mb-3">

<label>

🎯 Pilih Layanan

</label>

<select
name="jenis_joki"
id="jenis"
class="form-select"
onchange="hitungTotal()">

<option value="Boss">👹 Boss</option>

<option value="Dungeon">🗝️ Dungeon</option>

<option value="Rift">🌌 Rift</option>

</select>

</div>
<div class="row">

<div class="col-md-6">

<label>

📦 Jumlah Bahan

</label>

<div class="input-group">

<button
type="button"
class="btn btn-outline-warning"
onclick="kurang()">

<i class="bi bi-dash-lg"></i>

</button>

<input
type="number"
name="jumlah"
id="jumlah"
class="form-control text-center"
value="1"
min="1"
readonly>

<button
type="button"
class="btn btn-warning"
onclick="tambah()">

<i class="bi bi-plus-lg"></i>

</button>

</div>

</div>

<div class="col-md-6">

<label>

💰 Harga / Bahan

</label>

<input
type="text"
id="harga"
class="form-control"
value="Rp 2.000"
readonly>

</div>

</div>

<div class="mt-4">

<label>

📝 Catatan

</label>

<textarea
name="catatan"
class="form-control"
rows="4"
placeholder="Contoh : Kerjakan malam ini, jangan ganti nickname."></textarea>

</div>

<div class="form-check mt-4">

<input
class="form-check-input"
type="checkbox"
id="cek"
onclick="cekOrder()">

<label
class="form-check-label"
for="cek">

Saya sudah memastikan semua data yang diisi benar.

</label>

</div>

</div>

</div>

</div>

<div class="col-lg-4">

<div class="price-box">

<h4 class="text-warning">

💳 Ringkasan Order

</h4>

<hr>

<p>

Layanan

</p>

<h3 id="layanan">

👹 Boss

</h3>

<hr>

<p>

Jumlah

</p>

<h3 id="jumlahView">

1

</h3>

<hr>

<p>

Total Bayar

</p>

<div class="total" id="total">

Rp2.000

</div>

<hr>

<div class="info-box">

<h5 class="text-warning">

📢 Informasi Harga

</h5>

<p>

👹 Boss = Rp2.000 / Boss

</p>

<p>

🗝️ Dungeon = Rp2.000 / Key

</p>

<p>

🌌 Rift = Harga Menyesuaikan Event

</p>

</div>

<button
type="submit"
id="btnOrder"
class="btn btn-warning btn-lg w-100 mt-4"
disabled>

🚀 KIRIM ORDER

</button>

</div>

</div>

</div>

</form>

</div>

</div>
<script>

function hitungTotal(){

    let jenis=document.getElementById("jenis").value;

    let harga=2000;

    if(jenis=="Boss"){
        harga=2000;
        document.getElementById("layanan").innerHTML="👹 Boss";
    }

    if(jenis=="Dungeon"){
        harga=2000;
        document.getElementById("layanan").innerHTML="🗝️ Dungeon";
    }

    if(jenis=="Rift"){
        harga=5000;
        document.getElementById("layanan").innerHTML="🌌 Rift";
    }

    document.getElementById("harga").value=
    "Rp "+harga.toLocaleString('id-ID');

    let jumlah=parseInt(document.getElementById("jumlah").value);

    let total=harga*jumlah;

    document.getElementById("jumlahView").innerHTML=jumlah;

    document.getElementById("total").innerHTML=
    "Rp"+total.toLocaleString('id-ID');

}

function tambah(){

    let jumlah=document.getElementById("jumlah");

    jumlah.value=parseInt(jumlah.value)+1;

    hitungTotal();

}

function kurang(){

    let jumlah=document.getElementById("jumlah");

    if(parseInt(jumlah.value)>1){

        jumlah.value=parseInt(jumlah.value)-1;

    }

    hitungTotal();

}

function cekOrder(){

    document.getElementById("btnOrder").disabled=
    !document.getElementById("cek").checked;

}

window.onload=function(){

    hitungTotal();

}

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>