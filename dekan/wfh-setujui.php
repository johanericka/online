<?php
	require_once('../system/dbconn.php');
	$nodata = $_POST['nodata']; 	
	$jabatan = $_POST['jabatan'];
	echo "NO Data = ".$nodata;
	echo "Jabatan = ".$jabatan;
	$tgl = date('Y-m-d',strtotime(now));
	$bulan = date('m', strtotime(now));
	$tahun = date('Y', strtotime(now));
	$nosurat = $nodata.".O/FST.2/KP.01.4/".$bulan."/".$tahun."";
	
	if ($jabatan == "Ketua Program Studi" or $jabatan="Kepala Bagian"){
		$sql = "update wfh
					set tglverifikasifakultas = '".$tgl."', 
					tglverifikasijurusan = '".$tgl."', 
					verifikasifakultas = '1',
					verifikasijurusan = '1',
					keterangan = '".$nosurat."'
					where no = '".$nodata."'";
	}
	
	if (mysqli_query($dbsurat,$sql)) {
		echo "data terupdate";
	}else {
		"error ".$mysqli_error($dbsurat);
	}
		
	mysqli_close($dbsurat);
	header("location:index.php");
?>