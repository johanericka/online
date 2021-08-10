<?php
  require_once('../system/dbconn.php');
	require_once('../system/phpmailer/sendmail.php');
	
  $iduser = mysqli_real_escape_string($dbsurat,$_POST['iduser']);
	$nim = mysqli_real_escape_string($dbsurat,$_POST['nim']);
	$nama = mysqli_real_escape_string($dbsurat,$_POST['nama']);
	$jurusan = mysqli_real_escape_string($dbsurat,$_POST['jurusan']);
	$dosen = mysqli_real_escape_string($dbsurat,$_POST['dosen']);
	$kemampuankerja = $_POST['kemampuankerja'];
	$penguasaanpengetahuan = $_POST['penguasaanpengetahuan'];
	$sikapkhusus = $_POST['SikapKhusus'];
	$opsicpl = $_POST['cpl'];
	$kemampuantambahan_ind = mysqli_real_escape_string($dbsurat,$_POST['kemampuantambahan_ind']);
	$kemampuantambahan_eng = mysqli_real_escape_string($dbsurat,$_POST['kemampuantambahan_eng']);
	$tgl = date('y-m-d', strtotime(now));

	echo "ID User = ".$iduser."<br/>";
	echo "NIM = ".$nim."<br/>";
	echo "Nama = ".$nama."<br/>";
	echo "Jurusan = ".$jurusan."<br/>";
	echo "Dosen = ".$dosen."<br/>";
	echo "Sikap Khusus = ".$sikapkhusus."<br/>";
	echo "Opsi CPL = ".$opsicpl."<br/>";
	echo "Tanggal = ".$tgl."<br/>";

	//dosen pembimbing
	$kddosen = $dosen;
	echo "Kode Dosen = ".$kddosen."<br/>";
	
	//cari kajur
	$sql2 = mysqli_query($dbsurat,"select iddosen from pejabat where level = 5 and jurusan = '$jurusan'"); 
	$row2 = mysqli_fetch_row($sql2); 
	$kdkajur = $row2[0];
	echo "Kode Kajur = ".$kdkajur."<br/>";
	
	//cari wd1
	$sql = mysqli_query($dbsurat,"select iddosen from pejabat where level = 2 and jurusan = 'SAINTEK'"); 
	$data = mysqli_fetch_row($sql); 
	$kdwd = $data[0];
	echo "Kode WD = ".$kdwd."<br/>";

	echo "Kemampuan kerja = ".$kemampuankerja."<br/>";
	foreach ($kemampuankerja as $kerja) {
		$qcpl = mysqli_query($dbsurat,"SELECT * FROM skpi_cpl WHERE no='".$kerja."' ");
		$data = mysqli_fetch_array($qcpl);
			$cpl = $data[2];
			$indonesia = $data[3];
			$english = $data[4];
		$qsimpan = mysqli_query($dbsurat,"INSERT INTO skpi (nim,nama,jurusan,cpl,indonesia,english,verifikasi1,verifikator1,tglverifikasi1,verifikator2,verifikator3) VALUES 
																			('$nim','$nama','$jurusan','$cpl','$indonesia','$english',1,'$kddosen','$tgl','$kdkajur','$kdwd')");
  }
	
	echo "penguasaanpengetahuan = ".$penguasaanpengetahuan."<br/>";
	foreach ($penguasaanpengetahuan as $pengetahuan) {
		$qcpl2 = mysqli_query($dbsurat,"SELECT * FROM skpi_cpl WHERE no='".$pengetahuan."' ");
		$data2 = mysqli_fetch_array($qcpl2);
			$cpl = $data2[2];
			$indonesia = $data2[3];
			$english = $data2[4];	
		$qsimpan2 = mysqli_query($dbsurat,"INSERT INTO skpi (nim,nama,jurusan,cpl,indonesia,english,verifikasi1,verifikator1,tglverifikasi1,verifikator2,verifikator3) VALUES 
																			('$nim','$nama','$jurusan','$cpl','$indonesia','$english',1,'$kddosen','$tgl','$kdkajur','$kdwd')");
  }
	
	echo "SikapKhusus = ".$SikapKhusus."<br/>";
	foreach ($SikapKhusus as $khusus) {
    $qcpl3 = mysqli_query($dbsurat,"SELECT * FROM skpi_cpl WHERE no='".$khusus."' ");
		$data3 = mysqli_fetch_array($qcpl3);
			$cpl = $data3[2];
			$indonesia = $data3[3];
			$english = $data3[4];
		$qsimpan3 = mysqli_query($dbsurat,"INSERT INTO skpi (nim,nama,jurusan,cpl,indonesia,english,verifikasi1,verifikator1,tglverifikasi1,verifikator2,verifikator3) VALUES 
																			('$nim','$nama','$jurusan','$cpl','$indonesia','$english',1,'$kddosen','$tgl','$kdkajur','$kdwd')");
   }
	 
	//kemampuan tambahan
	echo "Kemampuan tambahan Ind = ".$kemampuantambahan_ind."<br/>";
	echo "Kemampuan tambahan Eng = ".$kemampuantambahan_eng."<br/>";
	if (!empty($kemampuantambahan_ind)){
		$qsimpan4 = mysqli_query($dbsurat,"INSERT INTO skpi (nim,nama,jurusan,cpl,indonesia,english,verifikasi1,verifikator1,tglverifikasi1,verifikator2,verifikator3) VALUES 
																				('$nim','$nama','$jurusan','$cpl','$kemampuantambahan_ind','$kemampuantambahan_eng',1,'$kddosen','$tgl','$kdkajur','$kdwd')");
	}
																
	//setujui sertifikat
	$qsimpan5 = mysqli_query($dbsurat,"UPDATE skpi_prestasipenghargaan 
																		SET verifikasi1=1,
																				tglverifikasi1='$tgl'
																		WHERE nim='$nim'");
	
	//kembali ke dashboard
	header("location:index.php");
?>

<!-- tanggal indonesia -->
	<?php
    function tgl_indo($tanggal){
        $bulan = array (
        1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
	?>