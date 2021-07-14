<?php
	include 'system/dbconn.php';
	
	//get list of lab name
	$sql_namalab = mysqli_query($dbsurat,"select namalab, kapasitas, diijinkan from laboratorium");
	while($data = mysqli_fetch_array($sql_namalab)){
		$namalab = $data['namalab'];
		$kapasitas = $data['kapasitas'];
		$diijinkan = $data['diijinkan'];
		$sql_mhsaktif = mysqli_query($dbsurat,"select * from ijinlab where status=1 and namalab='".$namalab."'");
			$mhsaktif = mysqli_num_rows($sql_mhsaktif);
		$kosong = $diijinkan - $mhsaktif;
		$sql_mhsaktif = mysqli_query($dbsurat,"update laboratorium set kapasitas = '".$kosong."' where namalab='".$namalab."'");
		echo $namalab;
		echo " kapasitas = ".$kapasitas;
		echo " diijinkan = ".$diijinkan;
		echo " mhs. aktif = ".$mhsaktif;
		echo " kosong = ".$kosong;
		echo "<br/>";
	}
?>