<!DOCTYPE html>
<html>
<head>
	<title>To Do List</title>

	<link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.4.1-web/css/all.css">
	<link href="../assets/css/bootstrap.css" type="text/css" rel="stylesheet">
	
	<script type="text/javascript" src="../assets/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>


	<link rel="stylesheet" type="text/css" href="../assets/datatables.min.css">
	<script type="text/javascript" src="../assets/datatables.min.js"></script>

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
					<li class="nav-item">
						<a class="nav-link" href="todolist.php"><i class="fa fa-users"></i> Tambah user</a>
					</li>
					<li class="nav-item dropdown active">
						<a class="nav-link dropdown-toggle" href="menuMasterData" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-briefcase"></i> Master Data
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown" id="menuMasterData">
							<a class="dropdown-item active" href="data.php">Data Monitoring</a>
							
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

	<div class="row">
		<div class="col-md-6 mx-auto">
			<div class="card mb-5">
				<div class="card-body">

					<h3>CyberProject</h3>
					<p class="text-muted">Tambah Project</p>

					<hr>

					<a class="btn btn-primary btn-sm mb-5" href="data.php">Kembali</a>

					<form action="tambah_project_aksi.php" method="get" >

						<div class="form-group">
							<label> Project </label>
							<input type="text" name="list_project" class="form-control" required="required" >
						</div>
                        
                        <script>
		function setTodayDate() {
		var date = new Date();
		var day = ("0" + date.getDate()).slice(-2);
		var month = ("0" + (date.getMonth() + 1)).slice(-2);

		var today = date.getFullYear() + "-" + (month) + "-" + (day);
		$('#date').val(today);
	}
</script>

                        	<div class="form-group">
							<label> Tanggal Mulai </label>
							<input type="date" name="date" id="date" class="form-control"required="required">
						</div>

						<div class="form-group">
							<label> Tanggal Selesai </label>
							<input type="date" name="date_out" class="form-control"required="required">
						</div>
                        <div class="form-group">
                        <label> Pilih user untuk masuk tim project </label>
                            <select name="tim[]" class="form-control" multiple="multiple" required>
                                <?php
                                $result = mysqli_query($koneksi,"SELECT * FROM user order by nama");
                                $i=0;
                                while($stack = mysqli_fetch_array($result)) {
                                ?>
                                    <option value="<?= $stack['id_user'];?>"><?= $stack["nama"];?></option>
                                <?php
                                $i++;
                                }
                                ?>
                            </select>
                        </div>
						<input type="submit" name="submit" value="Simpan" class="btn btn-primary btn-sm">

					</form>


				</div>
			</div>
		</div>
	</div>

</div>
</body>
</html>
