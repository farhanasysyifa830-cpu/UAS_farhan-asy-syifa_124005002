<?php

$host="localhost";

$user="root";

$pass="";

$db="db_joki";

$conn=mysqli_connect($host,$user,$pass,$db);

if(!$conn){

die("Koneksi Gagal");

}

?>