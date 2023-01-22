<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');
session_start();
if (isset($_SESSION['id_user'])) {
	$userId = $_SESSION['id_user'];
	$username = $_SESSION['username'];
	$email = $_SESSION['email'];
	$nama_user = $_SESSION['nama'];
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Data</title>

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


	<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
		<div class="container">
			<a class="navbar-brand" href="#"><img src="../img/bg_1.png" height="40"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item ">
						<a class="nav-link" href="user.php"><i class="fa fa-home"></i> Monitoring <span class="sr-only">(current)</span></a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="data.php"><i class="fa fa-book"></i> Data</a>
					</li>

					<li class="nav-item ">
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

		<div class="row">
			<div class="col-md-12 mx-auto">
				<div class="card mb-12">
					<div class="card-body">

						<h3>Monitoring Project</h3>
						<p class="text-muted">Semua Data Monitoring Project</p>
                        <a href="?" class="btn btn-primary">Todo</a>
                        <a href="?page=doing" class="btn btn-info">Doing</a>
                        <a href="?page=done" class="btn btn-success">Done</a>

                        <?php if(!isset($_GET["page"])){?>
						<hr>
						<table class="table table-bordered table-hover table-striped " id="table_id">
							<thead>
								<tr>
									<th>No</th>
									<th>Date in</th>
									<th>Date out</th>
									<th>Nama</th>
									<th>Project</th>
									<th>To Do List</th>
									<!-- <th>Progress</th> -->
									<th>Opsi</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$no = 1;
								$todolist = mysqli_query($koneksi, "
					SELECT no_peg, tambah_project.`list_project`,tambah_project.`date_out`, user.`nama`, `date_Selesai`,
					nama, todolist FROM todolist INNER JOIN tambah_project 
					ON todolist.no_project = tambah_project.no_project
					INNER JOIN user ON todolist. no_user = user.id_user where user.id_user = '{$userId}' AND tambah_project.status=0");
								while ($to = mysqli_fetch_array($todolist)) {
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $to['date_Selesai']; ?></td>
										<td><?php echo $to['date_out']; ?></td>
										<td><?php echo $to['nama']; ?></td>
										<td><?php echo $to['list_project']; ?></td>
										<td><?php echo $to['todolist']; ?></td>
										<!-- <td><?php echo $to['progress']; ?></td> -->
										<td>
											<a href="hapus_data.php?id=<?php echo $to['no_peg']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php
								}
								?>
							</tbody>

						</table>
                    <?php }else{
                        if($_GET["page"]=="doing"){?>
                        <hr>
						<table class="table table-bordered table-hover table-striped " id="table_id">
							<thead>
								<tr>
									<th>No</th>
									<th>Date in</th>
									<th>Date out</th>
									<th>Nama</th>
									<th>Project</th>
									<th>To Do List</th>
									<!-- <th>Progress</th> -->
									<th>Opsi</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$no = 1;
								$todolist = mysqli_query($koneksi, "
					SELECT no_peg, tambah_project.`list_project`,tambah_project.`date_out`, user.`nama`, `date_Selesai`,
					nama, todolist FROM todolist INNER JOIN tambah_project 
					ON todolist.no_project = tambah_project.no_project
					INNER JOIN user ON todolist. no_user = user.id_user where user.id_user = '{$userId}' AND tambah_project.status=1");
								while ($to = mysqli_fetch_array($todolist)) {
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $to['date_Selesai']; ?></td>
										<td><?php echo $to['date_out']; ?></td>
										<td><?php echo $to['nama']; ?></td>
										<td><?php echo $to['list_project']; ?></td>
										<td><?php echo $to['todolist']; ?></td>
										<!-- <td><?php echo $to['progress']; ?></td> -->
										<td>
											<a href="hapus_data.php?id=<?php echo $to['no_peg']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php
								}
								?>
							</tbody>

						</table>
                        
                        <?php 
                        }elseif($_GET["page"]=="done"){?>
                        <hr>
						<table class="table table-bordered table-hover table-striped " id="table_id">
							<thead>
								<tr>
									<th>No</th>
									<th>Date in</th>
									<th>Date out</th>
									<th>Nama</th>
									<th>Project</th>
									<th>To Do List</th>
									<!-- <th>Progress</th> -->
									<th>Opsi</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$no = 1;
								$todolist = mysqli_query($koneksi, "
					SELECT no_peg, tambah_project.`list_project`,tambah_project.`date_out`, user.`nama`, `date_Selesai`,
					nama, todolist FROM todolist INNER JOIN tambah_project 
					ON todolist.no_project = tambah_project.no_project
					INNER JOIN user ON todolist. no_user = user.id_user where user.id_user = '{$userId}' AND tambah_project.status=2");
								while ($to = mysqli_fetch_array($todolist)) {
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $to['date_Selesai']; ?></td>
										<td><?php echo $to['date_out']; ?></td>
										<td><?php echo $to['nama']; ?></td>
										<td><?php echo $to['list_project']; ?></td>
										<td><?php echo $to['todolist']; ?></td>
										<!-- <td><?php echo $to['progress']; ?></td> -->
										<td>
											<a href="hapus_data.php?id=<?php echo $to['no_peg']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php
								}
								?>
							</tbody>

						</table>

                    <?php }}?>

					</div>
				</div>
			</div>
		</div>

	</div>
	<script>
		$(document).ready(function() {
			$('#table_id').DataTable();
		});
	</script>

</body>

</html>