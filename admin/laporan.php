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
  
	date_default_timezone_set('Asia/Jakarta');
	?>

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
		<div class="container">
			<a class="navbar-brand" href="#"><img src="../img/bg_1.png" height="40"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item ">
						<a class="nav-link" href="admin.php"><i class="fa fa-home"></i> Dashboard <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item ">
						<a class="nav-link" href="todolist.php"><i class="fa fa-users"></i> Tambah user</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="menuMasterData" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-briefcase"></i> Master Data
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown" id="menuMasterData">
							<a class="dropdown-item" href="data.php">Data Monitoring</a>
							<a class="dropdown-item active" href="laporan.php">Laporan</a>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="password.php"><i class="fa fa-lock"></i> Ganti Password</a>
					</li>
				</ul>

				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="../logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
					</li>
				</ul>
			</div>

		</div>
    </nav>

        <div class="container">
            <div class="card">
                <div class="card-body">

                    <h3>Laporan Grafik</h3> 

                    <div class="col-md-12">

                        <br/>
                        <br/>
                        <center>
                            <h3>Grafik Todolist</h3>
                            <p class="text-muted">Jumlah Data Todolist Berdasarkan Tanggal</p>
                        </center>
                        <br/>

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
	$(document).ready(function(){
		$("#table-id").DataTable();


		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: [

				<?php
                    $data =@$_GET['data'];
				$query='SELECT tambah_project.`list_project` FROM todolist INNER JOIN tambah_project 
				ON todolist.no_project = tambah_project.no_project ';
				if($data!=''){
					$query.=" where date_selesai='$data'";
				}
				$query.=' group by list_project';
				$todolist =  mysqli_query($koneksi,$query);
				while($do=mysqli_fetch_array($todolist)){
				?>
				"<?php echo $do['list_project']; ?>", 
				<?php
				}
				?>

				],
				datasets: [{
					label: 'To Do List',
					data: [

					<?php
					$query='SELECT tambah_project.`list_project` FROM todolist INNER JOIN tambah_project 
					ON todolist.no_project = tambah_project.no_project ';
					if($data!=''){
                        $query.=" where date_selesai='$data'";
					}
					$query.=' group by list_project';
					$todolist =  mysqli_query($koneksi,$query);
					while($d=mysqli_fetch_array($todolist)){
						$id_list = $d['list_project'];
						$w = mysqli_query($koneksi,"SELECT `no_project`, `list_project`, `date_out` FROM `tambah_project` WHERE list_project='$id_list'");
						$ww = mysqli_num_rows($w);
						?>
						"<?php echo $ww; ?>", 
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
							beginAtZero:true
						}
					}]
				}
			}
		});
	});
</script>