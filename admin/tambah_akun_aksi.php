<?php
include '../koneksi.php';
date_default_timezone_set('asia/jakarta');

$nama = $_POST['nama'];
$jk = $_POST['jk'];
$agama = $_POST['agama'];
$pendidikan = $_POST['pendidikan'];
$email_user = $_POST['email_user'];
$pwd_user = md5 ($_POST['pwd_user']);
$leverl_akun = $_POST['leverl_akun'];
$result = mysqli_query($koneksi,"SELECT `id_user`, `nama`, `jk`, `agama`, `pendidikan`, `status`, `email_user`, `pwd_user`, `leverl_user` FROM `user` WHERE `email_user`='$email_user'");
if (mysqli_num_rows($result) > 0) {
    header("location:tambah_akun.php?pesan=Gagal");
}else{
    mysqli_query($koneksi,"INSERT INTO user VALUES(null,'$nama','$jk','$agama','$pendidikan','$email_user','$pwd_user','$leverl_akun')");

    header("location:todolist.php?pesan=berhasil");
}
?>