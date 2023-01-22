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
					<li class="nav-item">
						<a class="nav-link" href="todolist.php"><i class="fa fa-users"></i> Tambah user</a>
					</li>
					<li class="nav-item dropdown active">
						<a class="nav-link dropdown-toggle" href="menuMasterData" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-briefcase"></i> Master Data
						</a>
						<?php
						$id = '';
						if ($_SERVER['QUERY_STRING']) {
							$id = '?' . $_SERVER['QUERY_STRING'];
						}
						?>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown" id="menuMasterData">
							<a class="dropdown-item active" href="data.php">Data To Do List</a>

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


	<div class="container-fluid">

		<div class="card">
			<div class="card-body">

				<h3>TO DO LIST</h3>
				<p class="text-muted">Semua Data TO DO LIST</p>

				<hr>

				<div class="row">
					<div class="col-md-4 mx-auto">
						<div class="card bg-info">
							<div class="card-body">
								<form method="get" action="data_filter.php">
									<div class="form-group">
										<label>Filter</label>
										<input name="date_selesai" class="form-control" type="date" required="required">
										<option value=""> - Pilih - </option>
										<?php

										$todolist = mysqli_query($koneksi, "SELECT * FROM todolist");
										while ($d = mysqli_fetch_array($todolist)) {
											if (isset($_GET['date_selesai'])) {
												$id = $_GET['date_selesai'];
												$sql = mysqli_query($koneksi, "SELECT no_peg, tambah_project.`list_project`,tambah_project.`date_out`, user.`nama`, `date_Selesai`,
												nama, todolist FROM todolist INNER JOIN tambah_project 
												ON todolist.no_project = tambah_project.no_project
												INNER JOIN user ON todolist. no_user = user.id_user where date_selesai ='$id'");
											} else {
												$sql = mysqli_query($koneksi, "SELECT * FROM todolist");
											}
										}
										?>

									</div>
									<input type="submit" value="Tampilkan Data" class="btn btn-secondary btn-sm">
								</form>
							</div>

						</div>
					</div>
				</div>


				<a class="btn btn-primary btn-sm mb-3" href="tambah_project.php"><i class="fa fa-user-plus"></i> Tambah Project</a>

				<a class="btn btn-success btn-sm mb-3 float-right" href="data_cetak.php" target="_blank"><i class="fa fa-file"></i> Cetak</a>


				<table class="table table-bordered table-hover table-striped table-saya" id="table_id">
					<thead>
						<tr>
							<th>No</th>
							<th>Date in</th>
							<th>Date out</th>
							<th>Nama</th>
							<th>Project</th>
							<th>To Do List</th>
							<th>Progress</th>
							<th>Opsi</th>
						</tr>
					</thead>

					<tbody>
						<?php
						$no = 1;
						$data = $_GET['date_selesai'];
						$query = mysqli_query($koneksi, "SELECT no_peg, tambah_project.`list_project`,tambah_project.`date_out`, user.`nama`, `date_Selesai`,nama, todolist, progress FROM todolist INNER JOIN tambah_project ON todolist.no_project = tambah_project.no_project INNER JOIN user ON todolist. no_user = user.id_user WHERE todolist.date_Selesai like '%$data%' group by tambah_project.no_project order by todolist.no_peg DESC");
						while ($to = mysqli_fetch_array($sql)) {
						?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $to['date_Selesai']; ?></td>
								<td><?php echo $to['date_out']; ?></td>
								<td><?php echo $to['nama']; ?></td>
								<td><?php echo $to['list_project']; ?></td>
								<td><?php echo $to['todolist']; ?></td>
								<td><?php echo $to['progress']; ?></td>
								<td width="150px">
                                <a href="detail_project.php?id=<?php echo $to['no_project']; ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a>
								<a href="hapus_data.php?id=<?php echo $to['no_peg']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>

				</table>

			</div>
		</div>

	</div>
	<!-- <script>
  $(document).ready( function () {
$('#table_id').DataTable();
} );
  
</script> -->
	<script>
		$(document).ready(function() {
			$('#table_id').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});
		});
	</script>
	<?php
	include 'footer.php';
	?>