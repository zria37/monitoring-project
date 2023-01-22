<?php
include '../koneksi.php';

session_start();
$email=$_SESSION['email'];
$password = md5($_POST['password']);

mysqli_query($koneksi,"UPDATE user SET pwd_user='$password' where email_user='$email'");

header("location:password.php?pesan=password");

?>