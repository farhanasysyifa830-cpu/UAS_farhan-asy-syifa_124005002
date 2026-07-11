<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location:login.php");
    exit;
}

$user_id = $_POST['user_id'];
$nama_customer = mysqli_real_escape_string($conn,$_POST['nama_customer']);
$wa = mysqli_real_escape_string($conn,$_POST['wa']);
$nickname = mysqli_real_escape_string($conn,$_POST['nickname']);
$uid = mysqli_real_escape_string($conn,$_POST['uid']);
$jenis_joki = mysqli_real_escape_string($conn,$_POST['jenis_joki']);
$jumlah = $_POST['jumlah'];
$catatan = mysqli_real_escape_string($conn,$_POST['catatan']);

if($jenis_joki=="Boss"){
    $harga = 2000;
}elseif($jenis_joki=="Dungeon"){
    $harga = 2000;
}else{
    $harga = 5000;
}

$total = $harga * $jumlah;

$simpan = mysqli_query($conn,"INSERT INTO orders
(
user_id,
nama_customer,
wa,
nickname,
uid,
jenis_joki,
jumlah,
harga,
total,
catatan
)
VALUES
(
'$user_id',
'$nama_customer',
'$wa',
'$nickname',
'$uid',
'$jenis_joki',
'$jumlah',
'$harga',
'$total',
'$catatan'
)");

if($simpan){

    echo "
    <script>

    alert('Order Berhasil Dikirim!');

    window.location='riwayat.php';

    </script>
    ";

}else{

    echo "
    <script>

    alert('Order Gagal!');

    history.back();

    </script>
    ";

}
?>