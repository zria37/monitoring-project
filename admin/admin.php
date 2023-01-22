<!DOCTYPE html>
<html>

<head>
    <title>To Do List</title>

    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.4.1-web/css/all.css">
    <link href="../assets/css/bootstrap.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/DataTables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/DataTables/Buttons-1.5.1/css/buttons.dataTables.min.css">

    <script type="text/javascript" src="../assets/jquery.js"></script>
    <script type="text/javascript" src="../assets/DataTables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../assets/DataTables/Buttons-1.5.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../assets/DataTables/Buttons-1.5.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="../assets/DataTables/JSZip-2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="../assets/DataTables/pdfmake-0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="../assets/DataTables/pdfmake-0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="../assets/DataTables/Buttons-1.5.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="../assets/DataTables/Buttons-1.5.1/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>


    <!-- <link rel="stylesheet" type="text/css" href="../assets/datatables.min.css">
	<script type="text/javascript" src="../assets/datatables.min.js"></script> -->

    <script type="text/javascript" src="../assets/Chart.js"></script>

</head>

<body>
    <?php
    include '../koneksi.php';
    include "cek_login.php";
    include "../koneksi.php";
    include "header.php";
    date_default_timezone_set('Asia/Jakarta');
    ?>

    <div class="container">
        <div class="card">
            <div class="card-body">

                <h3>DASHBORD</h3>
                <p class="text-muted">Halaman Dashboard Admin</p>
                <div class="col-md-12">
                    <hr>
                    <!-- justify-content-between untuk memisahkan diri -->
                    <div class="row justify-content-between">
                        <div class="col-md-4">
                            <div class="card bg-dark text-white">
                                <div class="card-body">
                                    <a href="todolist.php">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <i class="fa fa-user-plus fa-4x"></i>
                                            </div>
                                            <div class="col-md-8">
                                                <h4>Data Akun</h4>
                                                <?php
                                                $user = mysqli_query($koneksi, "SELECT * FROM user");
                                                $jumlah_user = mysqli_num_rows($user);
                                                ?>
                                                <p><?php echo $jumlah_user; ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <a href="data.php">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <i class="fa fa-file fa-4x"></i>
                                            </div>
                                            <div class="col-md-8">
                                                <h4>Data Monitoring</h4>
                                                <?php
                                                $todolist = mysqli_query($koneksi, "SELECT * FROM todolist");
                                                $jumlah_todolist = mysqli_num_rows($todolist);
                                                ?>
                                                <p><?php echo $jumlah_todolist; ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <br />
                    <br />
                    <center>
                        <h3>Grafik Todolist</h3>
                        <p class="text-muted">Jumlah Data Todolist</p>
                    </center>
                    <br />

                    <div style="width: 100%;height: 700px">
                        <canvas id="myChart"></canvas>
                    </div>

                </div>

            </div>
        </div>
    </div>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $("#table-id").DataTable();


        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [

                    <?php
                    $data = $_GET['data'];
                    $query = 'SELECT tambah_project.`list_project` FROM todolist INNER JOIN tambah_project 
				ON todolist.no_project = tambah_project.no_project ';
                    if ($data != '') {
                        $query .= " where date_selesai='$data'";
                    }
                    $query .= ' group by list_project';
                    $todolist =  mysqli_query($koneksi, $query);
                    while ($do = mysqli_fetch_array($todolist)) {
                    ?> "<?php echo $do['list_project']; ?>",
                    <?php
                    }
                    ?>

                ],
                datasets: [{
                    label: 'To Do List',
                    data: [

                        <?php
                        $query = 'SELECT tambah_project.`list_project`, COUNT(tambah_project.list_project)as jumlah FROM todolist INNER JOIN tambah_project 
					ON todolist.no_project = tambah_project.no_project GROUP BY tambah_project.list_project';
                        
                        $todolist =  mysqli_query($koneksi, $query);
                        while ($d = mysqli_fetch_array($todolist)) {
                            
                        ?> "<?php echo $d['jumlah']; ?>",
                        <?php
                        }
                        ?>

                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>