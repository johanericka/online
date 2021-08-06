<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SAINTEK Online | Log in</title>
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

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="#"><img src="system/saintek-logo.png"></img></a>
		</div>
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg">User Login</p>
				<?php
				if (isset($_GET['pesan'])) {
					if ($_GET['pesan'] == "gagal") {
				?>
						<div class="alert alert-danger alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>ERROR!</strong> ID / Password salah!!
						</div>
					<?php
					} else if ($_GET['pesan'] == "logout") {
					?>
						<div class="alert alert-info alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Info : </strong> Anda telah logout.
						</div>
					<?php
					} else if ($_GET['pesan'] == "belum_login") {
					?>
						<div class="alert alert-danger alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>ERROR!</strong> Anda belum login!!
						</div>
					<?php
					} else if ($_GET['pesan'] == "registered") {
					?>
						<div class="alert alert-danger alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>ERROR!</strong> Anda telah terdaftar<br />
							Klik Lupa Password apabila anda lupa password
						</div>
					<?php
					} else if ($_GET['pesan'] == "success") {
					?>
						<div class="alert alert-info alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Info : </strong> pendaftaran berhasil.
						</div>
					<?php
					} else if ($_GET['pesan'] == "noaccess") {
					?>
						<div class="alert alert-danger alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>ERROR! </strong> Anda tidak memiliki akses
						</div>
					<?php
					} else if ($_GET['pesan'] == "antibot") {
					?>
						<div class="alert alert-danger alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>ERROR! </strong> penjumlahan salah
						</div>
					<?php
					} else if ($_GET['pesan'] == "email") {
					?>
						<div class="alert alert-success alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>CEK EMAIL ANDA </strong> untuk mereset password
						</div>
					<?php
					} else if ($_GET['pesan'] == "token") {
					?>
						<div class="alert alert-error alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>ERROR!! </strong> token expired. silahkan klik lupa password
						</div>
					<?php
					} else if ($_GET['pesan'] == "resetok") {
					?>
						<div class="alert alert-success alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>RESET PASSWORD BERHASIL </strong> silahkan login dengan password baru anda
						</div>
				<?php
					}
				}
				?>
				<form action="auth.php" method="post">
					<label>ID SIAKAD</label>
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="ID SIAKAD" name="username" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<label>Password</label>
					<div class="input-group mb-3">
						<input type="password" id="myInput" class="form-control" placeholder="Password" name="password" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<!--<input type="checkbox" onclick="myFunction()"> Tampilkan Password-->
					<?php
					$angka1 = rand(1, 5);
					$angka2 = rand(1, 5);
					$kunci = $angka1 + $angka2;
					?>
					<div class="input-group mb-3">
						Berapakah <b><?= $angka1; ?> ditambah <?= $angka2; ?> </b> ?
						<input type="hidden" name="kunci" value="<?= $kunci; ?>">
						<input type="number" id="myInput" class="form-control" placeholder="" name="antibot" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-question"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- /.col -->
						<div class="col-12">
							<button type="submit" class="btn btn-primary btn-block">Masuk</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
				<br />
				<p class="mb-0" align="center">
					<a href="daftar.php" class="text-center"> DAFTAR PENGGUNA BARU DISINI </a>
				</p>
				<p class="mb-0" align="center">
					<small><a href="lupa.php" class="text-center">Lupa Password ? Klik disini</a></small>
				</p>

			</div>
			<!-- /.login-card-body -->
		</div>
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src="system/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="system/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="system/dist/js/adminlte.min.js"></script>
	<!-- auto close alert -->
	<script>
		window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function() {
				$(this).remove();
			});
		}, 1000);
	</script>

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