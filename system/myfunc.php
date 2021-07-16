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

function tgljam_indo($tanggal)
{
    if (isset($tanggal)) {
        $bulan = array(
            1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        $pecahkan = explode('-', substr($tanggal, 0, 10));
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}

function namadosen($conn, $nip)
{
    require_once('../system/dbconn.php');
    $qdosen = mysqli_query($conn, "SELECT * FROM pengguna WHERE nip=$nip");
    $ddosen = mysqli_fetch_array($qdosen);
    $nama = $ddosen['nama'];
    return $nama;
}

function semester($tanggal)
{
    $pecahkan = explode('-', $tanggal);
    if ($pecahkan[1] < 7) {
        return "Genap Tahun Akademik " . $pecahkan[0] . "/" . $pecahkan[0];
    } else {
        return "Ganjil Tahun Akademik " . $pecahkan[0] . "/" . $pecahkan[0];
    }
}

?>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 1000);
</script>