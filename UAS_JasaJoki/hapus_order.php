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

$hapus = mysqli_query($conn,"DELETE FROM orders WHERE id='$id'");

if($hapus){

    echo "
    <script>

    alert('Order berhasil dihapus!');

    window.location='data_order.php';

    </script>
    ";

}else{

    echo "
    <script>

    alert('Order gagal dihapus!');

    history.back();

    </script>
    ";

}
?>