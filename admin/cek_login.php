<?php
   session_start();
    if(empty($_SESSION['status'])){
        header("location:../index.php?pesan=belumlogin");
    }
?>