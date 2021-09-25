<?php
require('../system/dbconn.php');
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
                <a href="#" class="d-block">NIP : <?= $nip; ?></a>
                <!--<a href="#" class="d-block">Jabatan : <?= strtoupper($jabatan); ?></a> -->
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">
                        <i class="nav-icon fas fa-tv"></i>
                        <p>
                            Dashboard
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                <?php
                $qmenu = mysqli_query($dbsurat, "SELECT * FROM jenissurat WHERE namasurat='Mhs. Bimbingan'");
                $dmenu = mysqli_fetch_array($qmenu);
                $statussurat = $dmenu['status'];
                if ($statussurat == 1) {
                ?>
                    <li class="nav-item">
                        <a href="bimbingan-tampil.php" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Mhs. Bimbingan
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                <?php
                }
                ?>
                <?php
                $qmenu = mysqli_query($dbsurat, "SELECT * FROM jenissurat WHERE namasurat='Riwayat Surat'");
                $dmenu = mysqli_fetch_array($qmenu);
                $statussurat = $dmenu['status'];
                if ($statussurat == 1) {
                ?>
                    <li class="nav-item">
                        <a href="datasurat-tampil.php" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Riwayat Surat
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                <?php
                }
                ?>
                <?php
                $qmenu = mysqli_query($dbsurat, "SELECT * FROM jenissurat WHERE namasurat='Pengguna Lab.'");
                $dmenu = mysqli_fetch_array($qmenu);
                $statussurat = $dmenu['status'];
                if ($statussurat == 1) {
                    $sql = mysqli_query($dbsurat, "SELECT * FROM laboratorium WHERE kalab='$nip'");
                    $jsql = mysqli_num_rows($sql);
                    if ($jsql > 0) {
                ?>
                        <li class="nav-item">
                            <a href="ijinlab-kalab-penggunalab-tampil.php" class="nav-link">
                                <i class="nav-icon fas fa-search"></i>
                                <p>
                                    Pengguna Lab.
                                    <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                        </li>
                <?php
                    }
                }
                ?>
                <!-- cek kapasitas lab-->
                <li class="nav-item">
                    <a href="lab-cekkapasitas.php" class="nav-link">
                        <i class="nav-icon fas fa-search"></i>
                        <p>
                            Kapasitas Lab.
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                <?php
                $qmenu = mysqli_query($dbsurat, "SELECT * FROM jenissurat WHERE namasurat='Pengajuan WFH'");
                $dmenu = mysqli_fetch_array($qmenu);
                $statussurat = $dmenu['status'];
                if ($statussurat == 1) {
                ?>
                    <li class="nav-item">
                        <a href="wfh-isi.php" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Pengajuan WFH
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                <?php
                }
                ?>
                <?php
                $qoperator = mysqli_query($dbsurat, "SELECT * FROM skpi_operator WHERE kode='$nip'");
                $jmldata = mysqli_num_rows($qoperator);
                if ($jmldata == 1) {

                ?>
                    <li class="nav-item has-treeview menu-close">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-graduation-cap"></i>
                            <p>
                                SKPI
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php
                            $qmenu = mysqli_query($dbsurat, "SELECT * FROM jenissurat WHERE namasurat='Rekap Pengajuan SKPI'");
                            $dmenu = mysqli_fetch_array($qmenu);
                            $statussurat = $dmenu['status'];
                            if ($statussurat == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="skpi-rekap.php" class="nav-link">
                                        <i class="nav-icon fas fa-graduation-cap"></i>
                                        <p>
                                            Rekap Pengajuan SKPI
                                            <!--<span class="right badge badge-danger">BARU</span>-->
                                        </p>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <ul class="nav nav-treeview">
                            <?php
                            $qmenu = mysqli_query($dbsurat, "SELECT * FROM jenissurat WHERE namasurat='Isi data SKPI'");
                            $dmenu = mysqli_fetch_array($qmenu);
                            $statussurat = $dmenu['status'];
                            if ($statussurat == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="skpi-isi.php" class="nav-link">
                                        <i class="nav-icon fas fa-graduation-cap"></i>
                                        <p>
                                            Isi data SKPI
                                        </p>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                <?php
                }
                ?>
                <?php
                if ($nip == '198312132019031004') {
                ?>
                    <li class="nav-item has-treeview menu-close">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-lock"></i>
                            <p>
                                Menu admin
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pejabat-tampil.php" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Manajemen Pejabat
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="lab-cekkapasitas2.php" class="nav-link">
                                    <i class="nav-icon fas fa-flask"></i>
                                    <p>
                                        Kontrol Kapasitas Lab.
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="kontrolmenu-tampil.php" class="nav-link">
                                    <i class="nav-icon fas fa-envelope"></i>
                                    <p>
                                        Menu Persuratan
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="loginas.php" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Login As
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                }
                ?>
                <!--
                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-file"></i>
                        <p>
                            Dokumen
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../doc/se276-2021.pdf" target="_blank" class="nav-link">
                                <i class="far fa-file-pdf"></i>
                                <p>SE Rektor UIN Malang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../doc/panduandosen.pdf" target="_blank" class="nav-link">
                                <i class="far fa-file-pdf"></i>
                                <p>Panduan Pengajuan WFH</p>
                            </a>
                        </li>
                        <?php if ($user == '62007') { ?>
                            <li class="nav-item">
                                <a href="../doc/panduankajur.pdf" target="_blank" class="nav-link">
                                    <i class="far fa-file-pdf"></i>
                                    <p>Panduan Verifikasi WFH</p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                    -->
                <li class="nav-item">
                    <a href="userprofile-tampil.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile User
                            <span class="right badge badge-danger"><small>baru</small></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://wa.me/6281234302099" class="nav-link">
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