<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location:login.php");
    exit;
}

$id=$_SESSION['id'];

if(isset($_POST['kirim'])){

    $pesan=mysqli_real_escape_string($conn,$_POST['pesan']);

    if($pesan!=""){

        mysqli_query($conn,"INSERT INTO chat(user_id,sender,pesan)
        VALUES('$id','customer','$pesan')");

        header("Location:chat_customer.php");
        exit;

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Chat Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{

background:#0d1117;
color:white;

}

.navbar{

background:#000;

}

.chat-box{

height:500px;
overflow-y:auto;
background:#161b22;
padding:20px;
border-radius:20px;

}

.customer{

background:#ffc107;
color:#000;
padding:12px;
border-radius:15px 15px 0 15px;
margin-bottom:15px;
max-width:70%;
margin-left:auto;

}

.admin{

background:#2d333b;
padding:12px;
border-radius:15px 15px 15px 0;
margin-bottom:15px;
max-width:70%;

}

.input-chat{

background:#161b22;
padding:20px;
border-radius:20px;
margin-top:20px;

}

.form-control{

background:#21262d;
border:none;
color:white;

}

.form-control:focus{

background:#21262d;
color:white;
box-shadow:none;

}

</style>

</head>

<body>

<nav class="navbar navbar-dark">

<div class="container">

<a class="navbar-brand text-warning fw-bold">

💬 Chat Admin

</a>

<div>

<a href="dashboard.php" class="btn btn-warning">

Dashboard

</a>

<a href="logout.php" class="btn btn-danger">

Logout

</a>

</div>

</div>

</nav>

<div class="container mt-4">

<div class="chat-box">

<?php

$chat=mysqli_query($conn,"
SELECT * FROM chat
WHERE user_id='$id'
ORDER BY created_at ASC
");

if(mysqli_num_rows($chat)>0){

while($c=mysqli_fetch_assoc($chat)){

if($c['sender']=="customer"){

?>

<div class="text-end">

<div class="customer d-inline-block text-start">

<b>

Saya

</b>

<br>

<?= nl2br(htmlspecialchars($c['pesan'])) ?>

<br>

<small>

<?= date("H:i",strtotime($c['created_at'])) ?>

</small>

</div>

</div>

<?php

}else{

?>

<div class="text-start">

<div class="admin d-inline-block">

<b>

👨‍💼 Admin

</b>

<br>

<?= nl2br(htmlspecialchars($c['pesan'])) ?>

<br>

<small>

<?= date("H:i",strtotime($c['created_at'])) ?>

</small>

</div>

</div>

<?php

}

}

}else{

?>

<div class="text-center mt-5">

<i class="bi bi-chat-dots" style="font-size:60px;color:#ffc107;"></i>

<h4 class="mt-3">

Belum ada percakapan

</h4>

<p class="text-secondary">

Silakan kirim pesan ke admin.

</p>

</div>

<?php

}

?>

</div>

<div class="input-chat">

<form method="POST">

<div class="input-group">

<textarea

name="pesan"

class="form-control"

rows="2"

placeholder="Tulis pesan ke admin..."

required

></textarea>

<button

type="submit"

name="kirim"

class="btn btn-warning"

>

<i class="bi bi-send-fill"></i>

Kirim

</button>

</div>

</form>

</div>

</div>

<script>

let box=document.querySelector(".chat-box");

box.scrollTop=box.scrollHeight;

setInterval(function(){

location.reload();

},10000);

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>