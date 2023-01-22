<?php
include '../koneksi.php';
echo $list_project = $_GET['list_project'];
echo $date_in = $_GET['date'];
echo $date_out = $_GET['date_out'];
$tim = $_GET['tim'];
$no_project = 0;
//INSERT INTO `tambah_project`(`no_project`, `list_project`, `date_out`) VALUES ([value-1],[value-2],[value-3])

  $query = 'SELECT no_project FROM tambah_project order by no_project DESC LIMIT 1';          
        $dt =  mysqli_query($koneksi, $query);
        while ($d = mysqli_fetch_array($dt)) {
        $no_project= $d['no_project']+1; 
        echo $no_project;               
        }
mysqli_query($koneksi,"INSERT INTO tambah_project (`no_project`, `list_project`, `date_out`,`date`) VALUES('$no_project','$list_project','$date_out','$date_in')");


foreach($tim as $h_tim){
        mysqli_query($koneksi,"INSERT INTO tim_project (id_tim, no_user, no_project) VALUES (NULL, $h_tim, $no_project);");
        echo "<br>".$h_tim;  
}


    header("location:tambah_project.php");
?>