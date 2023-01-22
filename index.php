<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="assets/css/bootstrap.css"type="text/css">
	<link rel="stylesheet" href="assets/css/css.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="assets/fontawesome-free-5.4.1-web/css/all.css">
	<link rel="stylesheet" type="text/css" href="assets/DataTables/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="assets/DataTables/Buttons-1.5.1/css/buttons.dataTables.min.css">
	
	<script type="text/javascript" src="assets/jquery.js"></script>
	<script type="text/javascript" src="assets/DataTables/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/DataTables/Buttons-1.5.1/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="assets/DataTables/Buttons-1.5.1/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="assets/DataTables/JSZip-2.5.0/jszip.min.js"></script>
	<script type="text/javascript" src="assets/DataTables/pdfmake-0.1.32/pdfmake.min.js"></script>
	<script type="text/javascript" src="assets/DataTables/pdfmake-0.1.32/vfs_fonts.js"></script>
	<script type="text/javascript" src="assets/DataTables/Buttons-1.5.1/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="assets/DataTables/Buttons-1.5.1/js/buttons.print.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>

	<style type="text/css">
         #mybutton {
            position: relative;
            z-index: 1;
            left: 90%;
            top: -30px;
            cursor: pointer;
         }

      </style>
 
	<title> CyberLabs</title>
</head>
<body >
<div class="container-fluid mt-5">
		<h1 class="text-center mb-5"style="color:white">CyberLabs Login</h1>
			<div class="row">
				<div class="col-md4 mx-auto">
					<?php
						if(isset($_GET['pesan'])){
							if(($_GET['pesan']=="gagal")){
								echo"<div class='alert alert-danger text-center'>Maaf! Periksa Username Dan Password Anda!!!</div>"; 
							}elseif($_GET['pesan']=="logout"){
								echo"<div class='alert alert-danger text-center'>Akun Anda Sudah Logout!</div>"; 
							}elseif($_GET['pesan']=="belumlogin"){
								echo"<div class='alert alert-danger text-center'>Login Terlebih dahulu!!</div>";
							}
						}
						?>
				</div>
			
			</div>

			<div class="row">
				<div class="col-md-3 mx-auto">
					<div class="card mt-4 bg-light">
						<div class="card-body">
							<form action="aksi_login.php" method="post">
								<div class="form-group">
									<label ><b>Username</b></label>
									<input type="text" name="uname" require="required" class="form-control"placeholder="Masukan Username.....">
								</div>

								<div class="form-group">
									<label><b>Password</b></label>
									<input type="password" name="pass" id="mypass" require="required"class="form-control"placeholder="Masukan Password.....">
									<span id="mybutton" onclick="change()"><i class="fa fa-eye"></i></span>
								</div>
									<input type="submit" name="submit" value="Login" class="btn btn-primary btn-block mb-3">
							</form> 
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