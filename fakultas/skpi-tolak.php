<?php
require_once('../system/dbconn.php');
require_once('../system/phpmailer/sendmail.php');

$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$iduser = mysqli_real_escape_string($dbsurat, $_POST['iduser']);
$nosurat = mysqli_real_escape_string($dbsurat, $_POST['nosurat']);
$keterangan = mysqli_real_escape_string($dbsurat, $_POST['keterangan']);
$tglvaldos = date('y-m-d');

if (empty($keterangan)) {
    header("location:skpi-tampil2.php?nim=$nim&respon=kosong");
} else {
    //dapatkan nama mahasiswa
    $query = mysqli_query($dbsurat, "SELECT * FROM skpi WHERE nim='$nim'");
    $data = mysqli_fetch_array($query);
    $namamhs = $data['nama'];
    echo "No data" . $nosurat . "<br>";
    echo "NIM = " . $nim . "<br/>";
    echo "Nama = " . $namamhs . "<br/>";
    echo "Keterangan = " . $keterangan . "<br/>";
    echo "Tgl Validasi = " . $tglvaldos . "<br/>";

    $sql = mysqli_query($dbsurat, "UPDATE skpi
						SET verifikasi1 = '2', 
							tglverifikasi1 = '$tglvaldos',
							keterangan = '$keterangan'
						WHERE nim = '$nim'");

    $sql2 = mysqli_query($dbsurat, "UPDATE skpi_prestasipenghargaan
									SET verifikasi1 = '2', 
										tglverifikasi1 = '$tglvaldos',
										keterangan = '$keterangan'
									WHERE nim = '$nim'");


    /*
		//cari email user
		$sql4 = mysqli_query($dbsurat,"SELECT * FROM notifikasi WHERE iduser = '$nim'");
		$ceksql4 = mysqli_num_rows($sql4);
		//apabila ada email user
		if ($ceksql4 > 0){ 
			$data4 = mysqli_fetch_array($sql4);
				$emailuser = $data4['email'];
				$kirimemailuser = $data4['kirimemail'];
				if($kirimemailuser > 0){
					$subject = "Notifikasi Pengajuan Surat Peminjaman Alat";
					$pesan = "Yth. ".$namamhs."
										<br/>
										<br/>
										Mohon maaf, pengajuan Surat Peminjaman Alat anda ditolak oleh dosen pembimbing dengan alasan ".$keterangan.".
										<br/>
										<br/>
										<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada sistem <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
					sendmail($emailuser,$namamhs,$subject,$pesan);
				}			
		}
		*/

    header("location:index.php");
}
