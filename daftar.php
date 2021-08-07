<?php
require('system/dbconn.php');
require('system/myfunc.php');
?>

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

<body class="hold-transition register-page">
	<div class="register-box">
		<div class="register-logo">
			<img src="system/saintek-logo.png" width="100%" />
		</div>

		<div class="card">
			<div class="card-body register-card-body">
				<p class="login-box-msg">Pendaftaran Pengguna Baru</p>
				<?php
				if (isset($_GET['pesan'])) {
					if ($_GET['pesan'] == "registered") {
				?>
						<div class="alert alert-danger alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>ERROR!</strong> NIM / NIP / NIPT / EMail / UserID telah terdaftar
						</div>
				<?php
					}
				}
				?>
				<form action="daftar-reg.php" method="POST">
					<label>Nama</label>
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Nama" name="nama" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<label>NIM / NIP / NIPT</label>
					<div class="input-group mb-3">
						<input type="number" class="form-control" placeholder="NIM / NIP / NIPT" name="nip" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<label>No. HP / WhatsApp</label>
					<div class="input-group mb-3">
						<input type="number" class="form-control" placeholder="no HP aktif" name="nohp" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-phone"></span>
							</div>
						</div>
					</div>
					<label>e-Mail</label>
					<div class="input-group mb-3">
						<input type="email" class="form-control" placeholder="e-Mail" name="email" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<label>Program Studi</label>
					<div class="form-group">
						<select class="form-control" name="prodi" required>
							<?php
							$query = mysqli_query($dbsurat, "SELECT distinct(namaprodi) FROM prodi");
							while ($data = mysqli_fetch_array($query)) {
							?>
								<option value="<?= $data['namaprodi']; ?>"><?= $data['namaprodi']; ?></option>
							<?php
							}
							?>
						</select>
						<small style="color:red">KHUSUS staf fakultas pilih SAINTEK</small>
					</div>
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
						<input type="password" class="form-control" placeholder="password" name="password" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<?php
						$angka1 = rand(1, 5);
						$angka2 = rand(1, 5);
						$kunci = $angka1 + $angka2;
						?>
						Berapakah <b><?= $angka1; ?> ditambah <?= $angka2; ?> </b>
						<input type="hidden" name="kunci" value="<?= $kunci; ?>">
						<input type="number" class="form-control" placeholder="" name="jawaban" required>


						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-question"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- /.col -->
						<div class="col-12">
							<button type="submit" class="btn btn-primary btn-block">Daftar</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
				<br />
				<p class="mb-0" align="center">
					<small><a href="index.php" class="text-center">Kembali ke halaman login</a></small>
				</p>
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