<?php

include '../koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM todolist WHERE no_peg='$id'");

header("location:data.php");

?>