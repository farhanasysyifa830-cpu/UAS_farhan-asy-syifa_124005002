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

$query = mysqli_query($conn,"SELECT * FROM orders ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Data Order</title>

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

.table thead{
background:#ffc107;
color:black;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-body">

<h2 class="text-warning text-center">

📋 DATA ORDER CUSTOMER

</h2>

<hr>

<div class="table-responsive">

<table class="table table-bordered table-hover align-middle">

<thead>

<tr>

<th>No</th>

<th>Customer</th>

<th>WA</th>

<th>Nickname</th>

<th>UID</th>

<th>Joki</th>

<th>Jumlah</th>

<th>Total</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($d=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['nama_customer']; ?></td>

<td><?= $d['wa']; ?></td>

<td><?= $d['nickname']; ?></td>

<td><?= $d['uid']; ?></td>

<td><?= $d['jenis_joki']; ?></td>

<td><?= $d['jumlah']; ?></td>

<td>

Rp <?= number_format($d['total'],0,',','.'); ?>

</td>

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

<td width="180">

<a
href="edit_order.php?id=<?= $d['id']; ?>"
class="btn btn-warning btn-sm">

<i class="bi bi-pencil-square"></i>

Edit

</a>

<a
href="hapus_order.php?id=<?= $d['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus Order Ini?')">

<i class="bi bi-trash"></i>

Hapus

</a>

</td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

<div class="mt-3">

<a
href="dashboard_admin.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

Kembali

</a>

</div>

</div>

</div>

</div>

</body>

</html>