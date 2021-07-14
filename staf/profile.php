<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>SAINTEK Digital Service</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Font Awesome -->
		<link rel="stylesheet" href="../system/plugins/fontawesome-free/css/all.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- icheck bootstrap -->
		<link rel="stylesheet" href="../system/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="../system/dist/css/adminlte.min.css">
		<!-- Google Font: Source Sans Pro -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	</head>
	
	<!-- akses ke database -->
	<?php require_once('../system/dbconn.php'); ?>
	
	
	<!-- cek session -->
	<?php 
		session_start();
		if($_SESSION['role']!="Tenaga Kependidikan"){
			header("location:../index.php?pesan=belum_login");
		}
	?>
	
	<?php
	  $nip = $_SESSION['nip'];
		$iduser= $_SESSION['iduser'];
	?>
	
	<?php
		$query = mysqli_query($dbsurat,"SELECT * FROM pengguna WHERE username='$iduser'");
		$jmldata = mysqli_num_rows($query);
		echo "Jumlah Data = ".$jmldata;
		$data = mysqli_fetch_array($query);
			$nama = $data['nama'];
			$nip = $data['nip'];
			$nohp = $data['nohp'];
			$jurusan = $data['jurusan'];
			$fakultas = $data['fakultas'];
			$username = $data['username'];
			$password = $data['password'];
	?>
	
	<body class="hold-transition register-page">
	<div class="register-box">
		<div class="register-logo">
			<img src="../system/saintek-logo.png" width="100%" />
		</div>

		<div class="card">
			<div class="card-body register-card-body">
				<p class="login-box-msg"><b>Ubah Profile</b></p>

				<form action="profile-edit.php" method="POST">
					<label>Nama</label>
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<label>NIP</label> 
					<div class="input-group mb-3">
						<input type="number" class="form-control" name="nip" value="<?php echo $nip;?>">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="far fa-address-card	"></span>
							</div>
						</div>
					</div>
					<label>No. HP</label> 
					<div class="input-group mb-3">
						<input type="number" class="form-control" name="nohp" value="<?php echo $nohp; ?>">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-mobile-alt"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Jurusan</label>
						<select class="form-control" name="jurusan">
							<?php
								$query = mysqli_query($dbsurat, "select * from jurusan");
								while($data = mysqli_fetch_array($query)){
							?>
									<option value="<?php echo $data['jurusan'];?>"><?php echo $data['jurusan'];?></option>
							<?php
								}
							?>
						</select>
					</div>
					<label>Username</label>
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="username" value="<?php echo $username; ?>" readonly>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user-circle"></span>
							</div>
						</div>
					</div>
					<label>Password</label>
					<div class="input-group mb-3">
						<input type="password" class="form-control" id="myInput" name="password" value="<?php echo $password; ?>" data-toggle="password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<input type="checkbox" onclick="myFunction()"> Tampilkan Password
					<br/>
					<div class="row">
						<!-- /.col -->
						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block">Ubah</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
				<br/>
				<a href="index.php" class="text-center">Kembali ke dashboard</a>
			</div>
			<!-- /.form-box -->
		</div><!-- /.card -->
	</div>
	<!-- /.register-box -->

	<!-- jQuery -->
	<script src="../system/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="../system/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../system/dist/js/adminlte.min.js"></script>
	
	<script>
	function myFunction() {
		var x = document.getElementById("myInput");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
	</script>
	</body>
</html>
