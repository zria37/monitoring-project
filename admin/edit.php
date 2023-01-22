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
	
	<style type="text/css">
      #mybutton {
            position: relative;
            z-index: 1;
            left: 90%;
            top: -30px;
            cursor: pointer;
         }

      </style>
 

	<!-- <link rel="stylesheet" type="text/css" href="../assets/datatables.min.css">
	<script type="text/javascript" src="../assets/datatables.min.js"></script> -->

	<script type="text/javascript" src="../assets/Chart.js"></script>

</head>
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
						<a class="nav-link active" href="todolist.php"><i class="fa fa-users"></i> Tambah user</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="menuMasterData" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-briefcase"></i> Master Data
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown" id="menuMasterData">
							<a class="dropdown-item" href="data.php">Data To Do List</a>
							
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

					<h3>Edit Akun </h3>
					<p class="text-muted">Edit Data Cyberwarior</p>

					<hr>

					<a class="btn btn-primary btn-sm mb-5" href="todolist.php">Kembali</a>

					<?php

					$id = $_GET['id'];
					$wa = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user='$id'");
					while($w = mysqli_fetch_array($wa)){
					?>

					<form action="update.php" method="post">

						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="nama" class="form-control" required="required" value="<?php echo $w['nama'] ?>">
							<input type="hidden" name="id" value="<?php echo $w['id_user'] ?>">
						</div>

						<div class="form-group">
							<label>Jenis Kelamin</label>
							<select name="jk" class="form-control" required="required">
								<option value=""> - Pilih - </option>
								<option <?php if($w['jk']=="Laki-laki"){echo "Selected='selected'";} ?> value="Laki-laki">Laki-laki</option>
								<option <?php if($w['jk']=="Perempuan"){echo "Selected='selected'";} ?> value="Perempuan">Perempuan</option>
							</select>
						</div>

						<div class="form-group">
							<label>Agama</label>
							<select name="agama" class="form-control" required="required">
								<option value="">- Pilih -</option>
								<option <?php if($w['agama']=="Islam"){echo "selected='selected'";} ?> value="Islam">Islam</option>
								<option <?php if($w['agama']=="Kristen"){echo "selected='selected'";} ?> value="Kristen">Kristen</option>
								<option <?php if($w['agama']=="Budha"){echo "selected='selected'";} ?> value="Budha">Budha</option>
								<option <?php if($w['agama']=="Hindu"){echo "selected='selected'";} ?> value="Hindu">Hindu</option>
							</select>
						</div>

						<div class="form-group">
							<label>Pendidikan</label>
							<select name="pendidikan" class="form-control" required="required">
								<option value="">- Pilih -</option>
								<option <?php if($w['pendidikan']=="SD"){echo "selected='selected'";} ?> value="SD">SD</option>
								<option <?php if($w['pendidikan']=="SMP"){echo "selected='selected'";} ?> value="SMP">SMP</option>
								<option <?php if($w['pendidikan']=="SMA"){echo "selected='selected'";} ?> value="SMA">SMA</option>
								<option <?php if($w['pendidikan']=="D3"){echo "selected='selected'";} ?> value="D3">D3</option>
								<option <?php if($w['pendidikan']=="S1"){echo "selected='selected'";} ?> value="S1">S1</option>
								<option <?php if($w['pendidikan']=="S2"){echo "selected='selected'";} ?> value="S2">S2</option>
								<option <?php if($w['pendidikan']=="S3"){echo "selected='selected'";} ?>value="S3">S3</option>
							</select>
						</div>

						<div class="form-group">
							<label>Email</label>
							<input type="text" name="email_user" class="form-control" required="required" value="<?php echo $w['email_user']?>">
						</div>

						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" id="mypass" require="required"class="form-control"placeholder="Masukan Password.....">
							<span id="mybutton" onclick="change()"><i class="fa fa-eye"></i></span>

						<div class="form-group">
							<label>Level Akun</label>
							<select name="level_user" class="form-control" required="required">
								<option value="">- Pilih -</option>
								<option <?php if($w['leverl_user']=="admin"){echo "selected='selected'";} ?> value="admin">admin</option>
								<option <?php if($w['leverl_user']=="user"){echo "selected='selected'";} ?> value="user">user</option>
							</select>
						</div>

						<input type="submit" name="submit" value="Update" class="btn btn-primary btn-sm">

					</form>
					<?php
					}
					?>

				</div>
			</div>
		</div>
	</div>

</div>
</body>
</html>
<script type="text/javascript">
         function change()
         {
            var x = document.getElementById('mypass').type;
 
            if (x == 'password')
            {
               document.getElementById('mypass').type = 'text';
               document.getElementById('mybutton').innerHTML = '<i class="fa fa-eye-slash"></i>';
            }
            else
            {
               document.getElementById('mypass').type = 'password';
               document.getElementById('mybutton').innerHTML = '<i class="fa fa-eye"></i>';
            }
         }
      </script>