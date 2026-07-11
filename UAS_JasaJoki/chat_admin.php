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

$user_id=0;

if(isset($_GET['user'])){
    $user_id=(int)$_GET['user'];
}

if(isset($_POST['kirim'])){

    $uid=(int)$_POST['user_id'];
    $pesan=mysqli_real_escape_string($conn,$_POST['pesan']);

    if($pesan!=""){

        mysqli_query($conn,"
        INSERT INTO chat(user_id,sender,pesan)
        VALUES('$uid','admin','$pesan')
        ");

        header("Location:chat_admin.php?user=".$uid);
        exit;

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Chat Customer</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{

background:#0d1117;
color:white;

}

.sidebar{

background:#161b22;
height:100vh;
overflow:auto;
padding:20px;

}

.sidebar a{

display:block;
text-decoration:none;
padding:12px;
margin-bottom:10px;
background:#21262d;
border-radius:12px;
color:white;
transition:.3s;

}

.sidebar a:hover{

background:#ffc107;
color:#000;

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
margin-top:20px;
border-radius:20px;

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

<div class="container-fluid">

<div class="row">

<div class="col-md-3 sidebar">

<h3 class="text-warning text-center">

💬 Customer

</h3>

<hr>

<?php

$list=mysqli_query($conn,"
SELECT DISTINCT users.id,users.username
FROM users
JOIN chat ON users.id=chat.user_id
WHERE users.role='customer'
ORDER BY users.username
");

while($u=mysqli_fetch_assoc($list)){

?>

<a href="chat_admin.php?user=<?= $u['id']; ?>">

👤

<?= $u['username']; ?>

</a>

<?php

}

?>

</div>

<div class="col-md-9">

<h3 class="mt-3 text-warning">

Chat Customer

</h3>

<hr>

<div class="chat-box">

<?php

if($user_id!=0){

$chat=mysqli_query($conn,"
SELECT *
FROM chat
WHERE user_id='$user_id'
ORDER BY created_at ASC
");

if(mysqli_num_rows($chat)>0){

while($c=mysqli_fetch_assoc($chat)){

if($c['sender']=="customer"){

?>

<div class="text-end">

<div class="customer d-inline-block text-start">

<b>👤 Customer</b>

<br>

<?= nl2br(htmlspecialchars($c['pesan'])) ?>

<br>

<small>

<?= date("d/m/Y H:i",strtotime($c['created_at'])) ?>

</small>

</div>

</div>

<?php

}else{

?>

<div class="text-start">

<div class="admin d-inline-block">

<b>🎮 Admin</b>

<br>

<?= nl2br(htmlspecialchars($c['pesan'])) ?>

<br>

<small>

<?= date("d/m/Y H:i",strtotime($c['created_at'])) ?>

</small>

</div>

</div>

<?php

}

}

}else{

?>

<div class="alert alert-dark">

Belum ada chat.

</div>

<?php

}

}else{

?>

<div class="text-center mt-5">

<h2>💬</h2>

<h4>

Pilih Customer di sebelah kiri

</h4>

<p class="text-secondary">

Klik nama customer untuk mulai membalas chat.

</p>

</div>

<?php

}

?>

</div>

<?php

if($user_id!=0){

?>

<div class="input-chat">

<form method="POST">

<input
type="hidden"
name="user_id"
value="<?= $user_id ?>">

<div class="input-group">

<textarea

name="pesan"

class="form-control"

rows="2"

placeholder="Balas pesan customer..."

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

<?php

}

?>

</div>

</div>

</div>

<script>

let box=document.querySelector(".chat-box");

if(box){

box.scrollTop=box.scrollHeight;

}

setInterval(function(){

location.reload();

},10000);

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>