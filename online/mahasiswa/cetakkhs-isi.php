<?php
session_start();
if ($_SESSION['hakakses'] != "mahasiswa") {
	header("location:../index.php?pesan=noaccess");
}
require('../system/dbconn.php');
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$prodi = mysqli_real_escape_string($dbsurat, $_SESSION['prodi']);
$hakakses = mysqli_real_escape_string($dbsurat, $_SESSION['hakakses']);

//cek kalo sudah mengisi data maka lanjut ke upload lampiran

$statuspengajuan = -1;
$stmt = $dbsurat->prepare("SELECT * FROM ijinlab WHERE nim=? AND statuspengajuan=?");
$stmt->bind_param("si", $nim, $statuspengajuan);
$stmt->execute();
$result = $stmt->get_result();
$jhasil = $result->num_rows;
if ($jhasil > 0) {
	$dhasil = $result->fetch_array();
	$nodata = $dhasil['no'];
	header("location:ijinlab-isi2.php?nodata=$nodata");
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SAINTEK Online</title>
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
	<script type="text/javascript" src="../system/js/jquery.min.js"></script>
	<script type="text/javascript" src="../system/js/jquery.form.js"></script>
</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"> Menu</i></a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php
		include('sidebar.php');
		?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h3>Pengajuan Surat Keterangan Cetak KHS</h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="col-12 col-sm-6 col-lg-12">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Identitas Diri</h3>
								</div>
								<div class="card-body">
									<form role="form" method="post" action="cetakkhs-simpan.php">
										Nama <br />
										<input type="text" class="form-control" name="nama" value="<?= $nama; ?>" readonly /></input>
										NIM <br />
										<input type="text" class="form-control" name="nim" value="<?= $nim; ?>" readonly /></input>
										Program Studi <br />
										<input type="text" class="form-control" name="prodi" value="<?= $prodi; ?>" readonly /></input>
										<br />
										Permohonan untuk cetak ulang Kartu Hasil Studi
										<br />
										<div class="form-group">
											<div class="form-check">
												<input class="form-check-input" type="radio" name="semester" value="1" checked>
												<label class="form-check-label">Semester 1</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="semester" value="2">
												<label class="form-check-label">Semester 2</label>
											</div>
										</div>
										Tahun Akademik
										<?php
										$tahunsekarang = date("Y");
										$tahunawal = date("Y", strtotime("-10 year"));
										?>
										<select id="tahunakademik" name="tahunakademik" class="form-control">
											<?php
											$years = range($tahunsekarang, $tahunawal);
											foreach ($years as $v) {
											?>
												<option value="<?php echo $v; ?>/<?php echo $v + 1; ?>"><?php echo $v; ?>/<?php echo $v + 1; ?></option>
											<?php
											}
											?>
										</select>
										<div class="form-group">
											<br />
											Keperluan
											<input type="text" class="form-control" name="keperluan" required></input>
										</div>
										Alasan <br />
										<div class="form-group">
											<div class="form-check">
												<input class="form-check-input" type="radio" name="alasan" value="hilang" checked>
												<label class="form-check-label">Hilang</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="alasan" value="rusak">
												<label class="form-check-label">Rusak</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="alasan" value="belum diambil">
												<label class="form-check-label">Belum diambil</label>
											</div>
											<div class="form-group">
												<input type="text" class="form-control" placeholder="alasan belum diambil" name="alasanbelumdiambil"></input>
											</div>
										</div>
										<button type="submit" class="btn btn-success btn-block" onclick="return confirm('Dengan ini saya menyatakan bahwa data yang saya isi adalah benar');"> <i class="fa fa-check"></i> Ajukan</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="content">
					<div class="container-fluid">
					</div>
					<!-- /.form group -->



				</div><!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- footer -->
		<?php include '../system/footer.html' ?>
		<!-- /.footer -->

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="../system/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="../system/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../system/dist/js/adminlte.min.js"></script>
</body>
<!-- tanggal indonesia -->
<?php
function tgl_indo($tanggal)
{
	$bulan = array(
		1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>

<!-- alert upload file -->
<?php
if (isset($_GET['error'])) {
	if ($_GET['error'] == 0) {
?>
		<div class="alert alert-info alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Info : </strong> File berhasil di upload.
		</div>
	<?php
	} else if ($_GET['error'] == 1) {
	?>
		<div class="alert alert-danger alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>ERROR : </strong> ukuran file maksimal 1MB.
		</div>
	<?php
	} else if ($_GET['error'] == 2) {
	?>
		<div class="alert alert-danger alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>ERROR : </strong> ketika upload file.
		</div>
	<?php
	} else if ($_GET['error'] == 3) {
	?>
		<div class="alert alert-danger alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>ERROR : </strong> hanya menerima file .JPG / .JPEG.
		</div>
<?php
	}
}
?>
<!-- timer untuk alert -->
<script>
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function() {
			$(this).remove();
		});
	}, 1000);
</script>

<!-- cari dosen -->
<script src="../system/js/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.search-box input[type="text"]').on("keyup input", function() {
			/* Get input value on change */
			var inputVal = $(this).val();
			var resultDropdown = $(this).siblings(".result");
			if (inputVal.length) {
				$.get("cari-proses.php", {
					term: inputVal
				}).done(function(data) {
					// Display the returned data in browser
					resultDropdown.html(data);
				});
			} else {
				resultDropdown.empty();
			}
		});
		// Set search input value on click of result item
		$(document).on("click", ".result p", function() {
			$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
			$(this).parent(".result").empty();
		});
	});
</script>

</html>