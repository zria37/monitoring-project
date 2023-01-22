<?php
include 'koneksi.php';
			
		session_start();
		$username = $_POST['uname'];
		// var_dump($username);
		$password = md5($_POST['pass']);
		$query = mysqli_query($koneksi,"SELECT*FROM user where email_user = '$username' and pwd_user='$password'");
		$jumlah = mysqli_num_rows($query);

		if($jumlah > 0){
			$_SESSION['status']="berhasil";
			$get = mysqli_fetch_array($query);
			$level = $get['leverl_user'];

			$dbusername = $get["username"];
			$dbpassword = $get["pass"];
			$dbname = $get["nama"];
			$dbid = $get["id_user"];

				$_SESSION['username'] = $username;
				$_SESSION['id_user'] = $dbid;
				$_SESSION['nama'] = $dbname ;	
			
		
			//session tambahan
			$_SESSION['email'] = $_POST['uname'];
			if($level=="admin"){
				header("location:admin/admin.php");
			}elseif($level=="user"){
			
			//echo $dbname;
					header("location:user/user.php");
			}
		}else{
			header("location:index.php?pesan=gagal");
		}

?>