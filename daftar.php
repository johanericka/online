<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>SAINTEK Digital Service</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Font Awesome -->
		<link rel="stylesheet" href="system/plugins/fontawesome-free/css/all.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- icheck bootstrap -->
		<link rel="stylesheet" href="system/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="system/dist/css/adminlte.min.css">
		<!-- Google Font: Source Sans Pro -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	</head>
	
	<?php include 'system/dbconn.php';?>
	
	<body class="hold-transition register-page">
	<div class="register-box">
		<div class="register-logo">
			<img src="system/saintek-logo.png" width="100%" />
		</div>

		<div class="card">
			<div class="card-body register-card-body">
				<p class="login-box-msg">Pendaftaran pengguna <b>SELAIN Dosen</b></p>

				<form action="reg.php" method="POST">
					<label>Nama</label>
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Nama" name="nama">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<label>NIPT</label> 
					<div class="input-group mb-3">
						<input type="number" class="form-control" placeholder="NIPT" name="nipt">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<label>No. HP</label> 
					<div class="input-group mb-3">
						<input type="number" class="form-control" placeholder="no HP aktif" name="nohp">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
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
						<input type="text" class="form-control" placeholder="user WIFI UIN Malang" name="username">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<label>Password</label>
					<div class="input-group mb-3">
						<input type="password" class="form-control" placeholder="password WIFI UIN Malang" name="password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- /.col -->
						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block">Daftar</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
				<br/>
				<a href="index.php" class="text-center">Kembali ke halaman login</a>
			</div>
			<!-- /.form-box -->
		</div><!-- /.card -->
	</div>
	<!-- /.register-box -->

	<!-- jQuery -->
	<script src="system/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="system/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="system/dist/js/adminlte.min.js"></script>
	</body>
</html>
