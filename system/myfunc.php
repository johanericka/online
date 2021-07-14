<?php
function tgl_indo($tanggal)
{
    if (isset($tanggal)) {
        $bulan = array(
            1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}

function namadosen($conn, $iddosen)
{
    require_once('../system/dbconn.php');
    $qdosen = mysqli_query($conn, "SELECT nama FROM useraccount2 WHERE kode=$iddosen");
    $ddosen = mysqli_fetch_array($qdosen);
    $nama = $ddosen['nama'];
    return $nama;
}


?>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 1000);
</script>