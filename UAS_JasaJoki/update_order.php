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

$id = $_POST['id'];
$harga = $_POST['harga'];
$status = $_POST['status'];

// Ambil jumlah order
$data = mysqli_query($conn,"SELECT jumlah FROM orders WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

$jumlah = $row['jumlah'];

// Hitung ulang total
$total = $jumlah * $harga;

// Update database
$update = mysqli_query($conn,"UPDATE orders SET

harga='$harga',
total='$total',
status='$status'

WHERE id='$id'");

if($update){

    echo "
    <script>

    alert('Order berhasil diupdate!');

    window.location='data_order.php';

    </script>
    ";

}else{

    echo "
    <script>

    alert('Gagal update order!');

    history.back();

    </script>
    ";

}
?>