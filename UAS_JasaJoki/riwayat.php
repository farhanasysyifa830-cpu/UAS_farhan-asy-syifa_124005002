<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location:login.php");
    exit;
}

$id = $_SESSION['id'];

$query = mysqli_query($conn,"SELECT * FROM orders WHERE user_id='$id' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Riwayat Order</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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

.table{
    color:white;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-body">

<h2 class="text-warning text-center">

📄 RIWAYAT ORDER

</h2>

<hr>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>

<th>Jenis</th>

<th>Jumlah</th>

<th>Total</th>

<th>Status</th>

<th>Tanggal</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($d=mysqli_fetch_array($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['jenis_joki']; ?></td>

<td><?= $d['jumlah']; ?></td>

<td>Rp <?= number_format($d['total'],0,',','.'); ?></td>

<td>

<?php

if($d['status']=="Pending"){

echo "<span class='badge bg-warning'>Pending</span>";

}elseif($d['status']=="Diproses"){

echo "<span class='badge bg-primary'>Diproses</span>";

}else{

echo "<span class='badge bg-success'>Selesai</span>";

}

?>

</td>

<td><?= $d['tanggal']; ?></td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

<a href="dashboard.php" class="btn btn-secondary mt-3">

Kembali

</a>

</div>

</div>

</div>

</body>

</html>