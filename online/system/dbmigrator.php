<?php
$dbsurat = mysqli_connect("127.0.0.1", "onlinev2", "tanyaADM1N@)@!", "onlinev2");
$dbold = mysqli_connect("127.0.0.1", "surat", "surat2020", "surat");
include('myfunc.php');

$qdata = mysqli_query($dbold, "SELECT * FROM wfh");
$hdata = mysqli_num_rows($qdata);
$totaldata = $hdata;

//pindah data WFH

//kosongkan tabel wfh dosurat
$qsql = mysqli_query($dbsurat, "DELETE FROM wfh");

//baca isi data tabel wfh lama
$nodata = 1;
$qsql2 = mysqli_query($dbold, "SELECT * FROM wfh");
while ($dsql2 = mysqli_fetch_array($qsql2)) {
    $no = $dsql2['no'];
    $fakultas = $dsql2['fakultas'];
    $jurusan = $dsql2['jurusan'];
    $tglsurat = $dsql2['tglsurat'];
    $iduser = $dsql2['iduser'];
    $iduser2 = nipdosen($dbsurat, $iduser);
    $nip = $dsql2['nip'];
    $nama = $dsql2['nama'];
    $jabatan = $dsql2['jabatan'];
    $tglwfh1 = $dsql2['tglwfh1'];
    $kegiatan1 = $dsql2['kegiatan1'];
    $tglwfh2 = $dsql2['tglwfh2'];
    $kegiatan2 = $dsql2['kegiatan2'];
    $tglwfh3 = $dsql2['tglwfh3'];
    $kegiatan3 = $dsql2['kegiatan3'];
    $tglwfh4 = $dsql2['tglwfh4'];
    $kegiatan4 = $dsql2['kegiatan4'];
    $tglwfh5 = $dsql2['tglwfh5'];
    $kegiatan5 = $dsql2['kegiatan5'];
    $verifikatorjurusan = $dsql2['verifikatorjurusan'];
    $verifikatorjurusan2 = nipdosen($dbsurat, $verifikatorjurusan);
    $verifikasijurusan = $dsql2['verifikasijurusan'];
    $tglverifikasijurusan = $dsql2['tglverifikasijurusan'];
    $verifikatorfakultas = $dsql2['verifikatorfakultas'];
    $verifikatorfakultas2 = nipdosen($dbsurat, $verifikatorfakultas);
    $verifikasifakultas = $dsql2['verifikasifakultas'];
    $tglverifikasifakultas = $dsql2['tglverifikasifakultas'];
    $keterangan = $dsql2['keterangan'];

    $sql = "INSERT INTO wfh (no, fakultas,prodi,tglsurat,iduser,nip,nama,jabatan,tglwfh1,kegiatan1,tglwfh2,kegiatan2,tglwfh3,kegiatan3,tglwfh4,kegiatan4,tglwfh5,kegiatan5,verifikatorprodi,verifikasiprodi,tglverifikasiprodi,verifikatorfakultas,verifikasifakultas,tglverifikasifakultas,keterangan) 
            VALUES('$no','$fakultas','$jurusan','$tglsurat','$iduser2','$nip','$nama','$jabatan','$tglwfh1','$kegiatan1','$tglwfh2','$kegiatan2','$tglwfh3','$kegiatan3','$tglwfh4','$kegiatan4','$tglwfh5','$kegiatan5','$verifikatorjurusan2','$verifikasijurusan','$tglverifikasijurusan','$verifikatorfakultas2','$verifikasifakultas','$tglverifikasifakultas','$keterangan')";
    $qwfhbaru = mysqli_query($dbsurat, $sql);
    if (!$qwfhbaru) {
        echo mysqli_error($qwfhbaru);
    }

    echo "Inserting data " . $nama . "<br/>";
}
