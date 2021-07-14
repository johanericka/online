<?php
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="../system/uin-malang-logo.png" alt="UIN Malang" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">UIN Malang</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional)-->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block"><?= $nama; ?></a>
                <a href="#" class="d-block">NIM : <?= $nim; ?></a>
                <a href="#" class="d-block">Prodi : <?= $jurusan; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-envelope"></i>
                        <p>
                            Pengajuan Surat
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- ijin penggunaan lab -->
                        <?php
                        $query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE nim='$nim' AND keterangan IS NULL");
                        $cekdata = mysqli_num_rows($query);
                        if ($cekdata == 0) {
                        ?>
                            <li class="nav-item">
                                <a href="ijinlab-isi.php" class="nav-link">
                                    <i class="nav-icon fas fa-flask"></i>
                                    <p>
                                        Ijin Penggunaan Lab.
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                        <!-- surat keterangan -->
                        <?php
                        $query = mysqli_query($dbsurat, "SELECT * FROM suket WHERE nim='$nim' AND keterangan IS NULL");
                        $cekdata = mysqli_num_rows($query);
                        if ($cekdata == 0) {
                        ?>
                            <li class="nav-item">
                                <a href="suket-isi.php" class="nav-link">
                                    <i class="nav-icon fas fa-id-card"></i>
                                    <p>
                                        Surat Keterangan
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                        <!-- surat pengantar PKL -->
                        <?php
                        $qpkl = mysqli_query($dbsurat, "SELECT * FROM pklanggota WHERE nimanggota='$nim'");
                        $dpkl = mysqli_fetch_array($qpkl);
                        $nimketua = $dpkl['nimketua'];

                        $qpkl2 = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE nim='$nimketua' AND validasifakultas=0");
                        $jpkl2 = mysqli_num_rows($qpkl2);
                        if ($jpkl2 == 0) {
                        ?>
                            <li class="nav-item">
                                <a href="pkl-isilampiran.php" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Surat Pengantar PKL
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>

                        <!-- surat permohonan cetak KHS -->
                        <?php
                        $query = mysqli_query($dbsurat, "SELECT * FROM cetakkhs WHERE nim='$nim' AND keterangan IS NULL");
                        $cekdata = mysqli_num_rows($query);
                        if ($cekdata == 0) {
                        ?>
                            <li class="nav-item">
                                <a href="cetakkhs-isi.php" class="nav-link">
                                    <i class="nav-icon fa fa-file"></i>
                                    <p>
                                        Surat Keterangan Cetak KHS
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>

                        <!-- surat ijin penelitian -->
                        <?php
                        $query = mysqli_query($dbsurat, "SELECT * FROM ijinpenelitian WHERE nim='$nim' AND keterangan IS NULL");
                        $cekdata = mysqli_num_rows($query);
                        if ($cekdata == 0) {
                        ?>
                            <li class="nav-item">
                                <a href="ijinpenelitian-isi.php" class="nav-link">
                                    <i class="nav-icon fa fa-search"></i>
                                    <p>
                                        Ijin Penelitian
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>

                        <!-- surat ijin observasi -->
                        <?php
                        $query = mysqli_query($dbsurat, "SELECT * FROM observasianggota WHERE nimanggota='$nim'");
                        $cekdata = mysqli_num_rows($query);
                        if ($cekdata > 0) {
                            $dobservasi = mysqli_fetch_array($query);
                            $nimketua = $dobservasi['nimketua'];

                            $qobservasi = mysqli_query($dbsurat, "SELECT * FROM observasi WHERE nim='$nimketua' AND validasifakultas=0");
                            $jobservasi = mysqli_num_rows($qobservasi);
                            if ($jobservasi == 0) {
                        ?>
                                <li class="nav-item">
                                    <a href="observasi-isi.php" class="nav-link">
                                        <i class="nav-icon fa fa-edit"></i>
                                        <p>
                                            Ijin Observasi
                                            <span class="right badge badge-danger"></span>
                                        </p>
                                    </a>
                                </li>
                            <?php
                            }
                        } else {
                            ?>
                            <li class="nav-item">
                                <a href="observasi-isi.php" class="nav-link">
                                    <i class="nav-icon fa fa-edit"></i>
                                    <p>
                                        Ijin Observasi
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>

                        <!-- permohonan peminjaman alat -->
                        <?php
                        $query = mysqli_query($dbsurat, "SELECT * FROM peminjamanalat WHERE nim='$nim' AND keterangan IS NULL");
                        $cekdata = mysqli_num_rows($query);
                        if ($cekdata == 0) {
                        ?>
                            <li class="nav-item">
                                <a href="peminjamanalat-isi.php" class="nav-link">
                                    <i class="nav-icon fa fa-wrench"></i>
                                    <p>
                                        Peminjaman Alat
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>

                        <!-- permohonan pengambilan data -->
                        <?php
                        $query = mysqli_query($dbsurat, "SELECT * FROM pengambilandata WHERE nim='$nim' AND keterangan IS NULL");
                        $cekdata = mysqli_num_rows($query);
                        if ($cekdata == 0) {
                        ?>
                            <li class="nav-item">
                                <a href="pengambilandata-isi.php" class="nav-link">
                                    <i class="nav-icon fa fa-table"></i>
                                    <p>
                                        Pengambilan Data
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>

                        <!-- permohonan SKPI -->
                        <?php
                        $query = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE nim='$nim' AND verifikasi3=0 ");
                        $cekdata = mysqli_num_rows($query);
                        if ($cekdata == 0) {
                        ?>
                            <li class="nav-item">
                                <a href="skpi-isi.php" class="nav-link">
                                    <i class="nav-icon fas fa-graduation-cap"></i>
                                    <p>
                                        Pengajuan SKPI
                                    </p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>

                    </ul>
                </li>

                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-file-pdf"></i>
                        <p>
                            Dokumen
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!--
								<li class="nav-item">
									<a href="https://saintek.uin-malang.ac.id/wfh/doc/SOPIjinLayananLaboratorium.pdf" target="_blank" class="nav-link">
										<i class="far fa-file-pdf"></i>
										<p>SOP Ijin Layanan Lab.</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="https://saintek.uin-malang.ac.id/wfh/doc/PemberitahuanKegiatanPKL.pdf" target="_blank" class="nav-link">
										<i class="far fa-file-pdf"></i>
										<p>Pemberitahuan Kegiatan PKL</p>
									</a>
								</li>
								-->
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="notifikasi-isi.php" class="nav-link">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Kirim Notifikasi
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="mailto:saintekonline@gmail.com" class="nav-link">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            Bantuan
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../logout.php" class="nav-link">
                        <i class="nav-icon fas fa-window-close"></i>
                        <p>
                            Keluar
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>