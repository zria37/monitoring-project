<?php
include '../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$jk = $_POST['jk'];
$status = $_POST['status'];
$agama = $_POST['agama'];
$pendidikan = $_POST['pendidikan'];
$pangkat = $_POST['pangkat'];
$email_user = $_POST['email_user'];
$pwd_user = md5 ($_POST['pwd_user']);
$leverl_user = $_POST['leverl_user'];
//UPDATE `user` SET `id_user`=[value-1],`nama`=[value-2],`jk`=[value-3],`agama`=[value-4],`pendidikan`=[value-5],`status`=[value-6],`pangkat`=[value-7],`email_user`=[value-8],`pwd_user`=[value-9],`leverl_user`=[value-10] WHERE 1
 mysqli_query($koneksi,"UPDATE user SET nama='$nama', jk='$jk', agama='$agama', pendidikan='$pendidikan', email_user ='$email_user', pwd_user = '$pwd_user', leverl_user = '$leverl_user'  WHERE id_user='$id'");
// echo "<br>";
// echo $id = $_POST['id'];
// echo "<br>";
// echo $nama = $_POST['nama'];
// echo "<br>";
// echo $jk = $_POST['jk'];
// echo "<br>";
// echo $agama = $_POST['agama'];
// echo "<br>";
// echo $pendidikan = $_POST['pendidikan'];
// echo "<br>";
// echo $email_user = $_POST['email_user'];
// echo "<br>";
// echo $pwd_user = md5 ($_POST['pwd_user']);
// echo "<br>";
// echo $leverl_user = $_POST['leverl_user'];
header("location:todolist.php");
?>