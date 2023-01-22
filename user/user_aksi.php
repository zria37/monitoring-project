<?php

include '../koneksi.php';
session_start();
$date        = $_POST['date']; //tanggal sekarang
$no_project  = $_POST['no_project'];
$nama        = $_SESSION['id_user'];
$todolist    = $_POST['todolist'];
$status      = $_POST['status'];
$progress    = $_POST['progress'];

// INSERT INTO `todolist`(`no_peg`, `no_project`, `no_pegawai`, `date_Selesai`, `id_pegawai`, `nama`, `todolist`, `progress`)
mysqli_query($koneksi, "INSERT INTO todolist(no_project, no_user, date_Selesai, todolist, progress) VALUES ('$no_project','$nama','$date','$todolist','$progress')");

mysqli_query($koneksi, "UPDATE tambah_project SET status = '$status' WHERE tambah_project.no_project = '$no_project';");

//    echo $date."<br>";
    echo  $nama."<br>";
    echo $no_project  =$_POST['no_project'] ."<br>";
    echo $todolist    =$_POST['todolist']."<br>";
    echo $progress    =$_POST['progress']."<br>";



header("location:user.php");
