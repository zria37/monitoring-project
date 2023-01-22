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

if(isset($_GET['no_project'])){
    
    $query = mysqli_query($koneksi,"SELECT tambah_project.no_project, tambah_project.status, todolist.progress FROM tambah_project inner join todolist where tambah_project.no_project = todolist.no_project AND tambah_project.no_project = {$_GET['no_project']}  order by todolist.no_peg DESC LIMIT 1");
	$get = mysqli_fetch_array($query);
    
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Monitoring Project</title>

	<link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.4.1-web/css/all.css">
	<link href="../assets/css/bootstrap.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="../assets/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>

	<link rel="stylesheet" type="text/css" href="../assets/datatables.min.css">
	<script type="text/javascript" src="../assets/datatables.min.js"></script>

	<script type="text/javascript" src="../assets/Chart.js"></script>
	<style>
		.slidecontainer {
			width: 100%;
		}

		.slider {
			-webkit-appearance: none;
			width: 100%;
			height: 25px;
			background: #d3d3d3;
			outline: none;
			opacity: 0.7;
			-webkit-transition: .2s;
			transition: opacity .2s;
		}

		.slider:hover {
			opacity: 1;
		}

		.slider::-webkit-slider-thumb {
			-webkit-appearance: none;
			appearance: none;
			width: 25px;
			height: 25px;
			background: #007bff;
			cursor: pointer;
		}

		.slider::-moz-range-thumb {
			width: 25px;
			height: 25px;
			background: #007bff;
			cursor: pointer;
		}
	</style>
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
					<li class="nav-item active">
						<a class="nav-link" href="user.php"><i class="fa fa-home"></i> Monitoring <span class="sr-only">(current)</span></a>
					</li>

					<li class="nav-item ">
						<a class="nav-link" href="data.php"><i class="fa fa-book"></i> Data</a>
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
</body>

</html>
<script src="../assets/js/jquery-3.4.1.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<link href="../assets/dist/summernote-bs4.css" rel="stylesheet">
<script src="../assets/dist/summernote-bs4.js"></script>

<div class="container">

	<div class="row">
		<div class="col-md-6 mx-auto">
			<div class="card mb-5">
				<div class="card-body">

					<h3>CyberWarrior</h3>
					<p class="text-muted">Monitoring </p>

					<hr>
                    <form action="" method="get">
						<div class="form-group">
							<label>Project</label>
							<select name="no_project" id="no_project" class="form-control"  onchange="this.form.submit()">
								<option value="" selected disabled> - Pilih - </option>
								<?php

								$project = mysqli_query($koneksi, 'SELECT tambah_project.list_project, tim_project.no_project , tim_project.no_user FROM tambah_project inner join tim_project where tim_project.no_project = tambah_project.no_project');
								while ($pro = mysqli_fetch_array($project)) {
                                    if($userId==$pro['no_user']){
                                        
								?>
									<option value="<?php echo $pro['no_project']; ?>" <?php 
                                    if(isset($_GET['no_project'])){
                                        if($_GET['no_project']==$pro['no_project']){
                                            echo"selected";
                                            }
                                    }?>><?php echo $pro['list_project']; ?></option>
								<?php
                                        }
								}
								?>
							</select>

						</div>
                    </form>
					<form action="user_aksi.php" method="post">
                                     <?php 
                                    if(isset($_GET['no_project'])){
                                        ?>
                                        <input type="text" name="no_project" class="form-control" style="Display:none" value="<?= $_GET['no_project']?>" required="required" readOnly>
                                        <?php
                                    }?>
						<div class="form-group">
							<label>Tanggal Sekarang</label>
							<input type="date" name="date" class="form-control" id="date" required="required" readOnly>
						</div>



						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="nama" id="nama" class="form-control" required="required" value="<?= $nama_user ?>" readOnly>
						</div>


                        
						<div class="form-group">
							<label>Status Project</label>
							<select name="status" id="status" class="form-control">
								<option value="" selected disabled> - Pilih - </option>
								<option value="0" <?php 
                                    if(isset($_GET['no_project'])){
                                        if($get['status']==0){echo"selected";}
                                    }?>> Todo </option>
								<option value="1" <?php 
                                    if(isset($_GET['no_project'])){
                                        if($get['status']==1){echo"selected";}
                                    }?>> Doing </option>
								<option value="2" <?php 
                                    if(isset($_GET['no_project'])){
                                        if($get['status']==2){echo"selected";}
                                    }?>> Done </option>
								
							</select>

						</div>



						<div class="form-group">
							<label>To Do List</label>
							<textarea name="todolist" id="summernote" cols="40" rows="20" class="form-control"></textarea>
						</div>

						<div class="form-group">
							<label>Progress</label><?= $get["progress"];?>
							<input name="progress" type="range" min="1" max="100" value="<?php 
                                    if(isset($_GET['no_project'])){
                                        if($get['progress']== 0){
                                                echo"0";
                                            }else{
                                                echo $get["progress"];
                                            }
                                    }else{
                                        echo"0";
                                    }?>" class="slider" id="myRange">
                                    <label id="demo"> %</label>
						</div>
				</div>
			</div>

			<input type="submit" name="submit" value="Simpan" class="btn btn-primary btn-sm">

			</form>


		</div>
	</div>
</div>

<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value+"%"; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
slider.oninput = function() {
  output.innerHTML = this.value+"%";
}


	$('#summernote').summernote({
		placeholder: '******',
		tabsize: 2,
		height: 300
	});

	function setTodayDate() {
		var date = new Date();
		var day = ("0" + date.getDate()).slice(-2);
		var month = ("0" + (date.getMonth() + 1)).slice(-2);

		var today = date.getFullYear() + "-" + (month) + "-" + (day);
		$('#date').val(today);
	}
</script>

<script>
	$(document).ready(function() {

		setTodayDate();

		$('#no_project').change(function() { // KETIKA ISI DARI FIEL 'no_project' BERUBAH MAKA ......
			var npmfromfield = $('#no_project').val(); // AMBIL isi dari fiel NPM masukkan variabel 'npmfromfield'
			$.ajax({ // Memulai ajax
					method: "POST",
					url: "ajax_cek.php", // file PHP yang akan merespon ajax
					data: {
						no_project: npmfromfield
					} // data POST yang akan dikirim
				})
				.done(function(hasilajax) { // KETIKA PROSES Ajax Request Selesai
					$('#date_out').val(hasilajax); // Isikan hasil dari ajak ke field 'nama' 
				});
		})
	});
</script>