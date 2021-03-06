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
                <a href="#" class="d-block">NIP : <?= $nip; ?></a>
                <!--<a href="#" class="d-block">Tempat Tugas : <?= $prodi; ?></a>
                <a href="#" class="d-block">Jabatan : <?= strtoupper($jabatan); ?></a>-->
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
                            <li class="nav-item">
                                <a href="skpi-rekap.php" class="nav-link">
                                    <i class="nav-icon fas fa-graduation-cap"></i>
                                    <p>
                                        Rekap Pengajuan SKPI
                                        <!--<span class="right badge badge-danger">BARU</span>-->
                                    </p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="skpi-isi.php" class="nav-link">
                                    <i class="nav-icon fas fa-graduation-cap"></i>
                                    <p>
                                        Isi data CPL
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                }
                ?>

                <!-- menu khusus kasubag akademik -->
                <?php
                if ($jabatan == 'kasubag-akademik') {
                ?>
                    <li class="nav-item">
                        <a href="lab-cekkapasitas.php" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Cek Kapasitas Lab.
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="datasurat-tampil.php" class="nav-link">
                            <i class="nav-icon fas fa-envelope-open"></i>
                            <p>
                                Rekap. Surat
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="kontrolmenu-tampil.php" class="nav-link">
                            <i class="nav-icon fas fa-envelope-open"></i>
                            <p>
                                Menu Persuratan
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                <?php
                }
                ?>



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
                            <a href="http://saintek.uin-malang.ac.id/online/doc/se276-2021.pdf" target="_blank" class="nav-link">
                                <i class="far fa-file-pdf"></i>
                                <p>SE Rektor UIN Malang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://saintek.uin-malang.ac.id/online/doc/panduandosen.pdf" target="_blank" class="nav-link">
                                <i class="far fa-file-pdf"></i>
                                <p>Panduan Pengajuan WFH</p>
                            </a>
                        </li>
                        <?php if ($iduser == '62007') { ?>
                            <li class="nav-item">
                                <a href="http://saintek.uin-malang.ac.id/online/doc/panduankajur.pdf" target="_blank" class="nav-link">
                                    <i class="far fa-file-pdf"></i>
                                    <p>Panduan Verifikasi WFH</p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="userprofile-tampil.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Ubah Profile
                            <span class="right badge badge-danger"></span>
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