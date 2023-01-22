<?php
include "../koneksi.php";
date_default_timezone_set('Asia/Jakarta');
$nama = $_POST['nama']; // Menerima NPM dari JQuery Ajax dari form
$s = mysqli_query($koneksi,"SELECT * from user where nama='$nama'"); // Ambil nama mahasiswa berdasarkan npm yang dikirim dari jquery ajax
while ($data = mysqli_fetch_array($s)) {       
 echo $data["nama"]; // Print nama hasil perolehan dari query database
}
?>