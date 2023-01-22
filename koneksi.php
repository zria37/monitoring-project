<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "epiz_24576764_cyberlabs";

$koneksi = mysqli_connect($server, $username, $password, $database);

// Check connection
if (mysqli_connect_errno())
{
    die("Failed to connect to Database: " . mysqli_connect_error());
}
?>