<body class="hold-transition sidebar-mini" oncontextmenu="return false;">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> -->
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-sm-inline-block">
                    <?php $username = $_SESSION['id_peg'];
                    $get_unit = $this->db->query("SELECT * FROM pegawai 
                    JOIN unit ON unit.id_unit = pegawai.unit WHERE id_peg='$username'")->result();
                    foreach ($get_unit as $unit) {
                    ?>
                        <h5 style="margin-top: 8px; color: gray;"><?= $unit->nm_unit; ?></h5>
                    <?php } ?>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <?php $username = $_SESSION['id_peg'];
                        $get_rl = $this->db->query("SELECT * FROM pegawai 
                    JOIN dtrole ON dtrole.id_peg = pegawai.id_peg
                    JOIN role ON role.id_role =  dtrole.id_role
                    WHERE pegawai.id_peg='$username'")->result();
                        foreach ($get_rl as $rl) {
                            if ($rl->nm_role == 'Loket') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                        WHERE status_ajuan='Belum Diproses'")->result();
                                foreach ($jml_notif as $jn) {
                                    if ($jn->total_notif != "0") { ?>
                                        <span class="badge badge-warning navbar-badge"><?= $jn->total_notif ?></span>
                                    <?php } else {
                                    }
                                    ?>
                                    <?php }
                            } elseif ($rl->nm_role == 'User') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                                WHERE (status_ajuan='Ditolak Loket' 
                            OR status_ajuan='Ditolak Staff PPK' 
                            OR status_ajuan='Ditolak PPK' 
                            OR status_ajuan='Ditolak Staff PPSPM' 
                            OR status_ajuan='Ditolak PPSPM' 
                            OR status_ajuan='Selesai')
                            AND status_notif='0'")->result();
                                foreach ($jml_notif as $jn) {
                                    if ($jn->total_notif != "0") { ?>
                                        <span class="badge badge-warning navbar-badge"><?= $jn->total_notif ?></span>
                                    <?php } else {
                                    }
                                    ?>
                                    <?php }
                            } elseif ($rl->nm_role == 'Bendahara') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                                WHERE status_ajuan='Proses Bendahara'")->result();
                                foreach ($jml_notif as $jn) {
                                    if ($jn->total_notif != "0") { ?>
                                        <span class="badge badge-warning navbar-badge"><?= $jn->total_notif ?></span>
                                    <?php } else {
                                    }
                                    ?>
                                    <?php }
                            } elseif ($rl->nm_role == 'PPK 1') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                                WHERE status_ajuan='Proses SPP/SPBY' AND notif_penerima = 'PPK 1'")->result();
                                foreach ($jml_notif as $jn) {
                                    if ($jn->total_notif != "0") { ?>
                                        <span class="badge badge-warning navbar-badge"><?= $jn->total_notif ?></span>
                                    <?php } else {
                                    }
                                    ?>
                                    <?php }
                            } elseif ($rl->nm_role == 'PPK 2') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                                WHERE status_ajuan='Proses SPP/SPBY' AND notif_penerima = 'PPK 2'")->result();
                                foreach ($jml_notif as $jn) {
                                    if ($jn->total_notif != "0") { ?>
                                        <span class="badge badge-warning navbar-badge"><?= $jn->total_notif ?></span>
                                    <?php } else {
                                    }
                                    ?>
                                    <?php }
                            } elseif ($rl->nm_role == 'PPK 3') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                                WHERE status_ajuan='Proses SPP/SPBY' AND notif_penerima = 'PPK 3'")->result();
                                foreach ($jml_notif as $jn) {
                                    if ($jn->total_notif != "0") { ?>
                                        <span class="badge badge-warning navbar-badge"><?= $jn->total_notif ?></span>
                                    <?php } else {
                                    }
                                    ?>
                                    <?php }
                            } elseif ($rl->nm_role == 'PPK 4') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                                WHERE status_ajuan='Proses SPP/SPBY' AND notif_penerima = 'PPK 4'")->result();
                                foreach ($jml_notif as $jn) {
                                    if ($jn->total_notif != "0") { ?>
                                        <span class="badge badge-warning navbar-badge"><?= $jn->total_notif ?></span>
                                    <?php } else {
                                    }
                                    ?>
                                    <?php }
                            } elseif ($rl->nm_role == 'PPK 5') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                                WHERE status_ajuan='Proses SPP/SPBY' AND notif_penerima = 'PPK 5'")->result();
                                foreach ($jml_notif as $jn) {
                                    if ($jn->total_notif != "0") { ?>
                                        <span class="badge badge-warning navbar-badge"><?= $jn->total_notif ?></span>
                                    <?php } else {
                                    }
                                    ?>
                                    <?php }
                            } elseif (
                                $rl->nm_role == 'Staf PPK 1' or $rl->nm_role == 'Staf PPK 2'
                                or $rl->nm_role == 'Staf PPK 3' or $rl->nm_role == 'Staf PPK 4'
                                or $rl->nm_role == 'Staf PPK 5'
                            ) {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                                WHERE status_ajuan='Diterima PPK' AND notif_penerima = '$username'")->result();
                                foreach ($jml_notif as $jn) {
                                    if ($jn->total_notif != "0") { ?>
                                        <span class="badge badge-warning navbar-badge"><?= $jn->total_notif ?></span>
                                    <?php } else {
                                    }
                                    ?>
                        <?php }
                            }
                        } ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" style="width: 400px;">
                        <?php $username = $_SESSION['id_peg'];
                        $get_rl = $this->db->query("SELECT * FROM pegawai 
                    JOIN dtrole ON dtrole.id_peg = pegawai.id_peg
                    JOIN role ON role.id_role =  dtrole.id_role
                    WHERE pegawai.id_peg='$username'")->result();
                        foreach ($get_rl as $rl) {
                            if ($rl->nm_role == 'Loket') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                    WHERE status_ajuan='Belum Diproses'")->result();
                                foreach ($jml_notif as $jn) {
                        ?>
                                    <span class="dropdown-header"><?= $jn->total_notif ?> Notifications</span>
                                    <div class="dropdown-divider"></div>
                                    <?php $select_notif = $this->db->query("SELECT * FROM notif_ajuan 
                                    JOIN ajuan ON ajuan.id_ajuan = notif_ajuan.id_ajuan 
                    WHERE status_ajuan='Belum Diproses'")->result();
                                    foreach ($select_notif as $sn) { ?>
                                        <a href="<?= BASEURL ?>loket" class="dropdown-item">
                                            <i class="fas fa-envelope mr-2"></i> <?= $sn->no_ajuan ?>, Harap Segera Diproses! <br>
                                            <span class="text-muted text-sm"><?= $sn->tgl_notif ?></span>
                                        </a>
                                    <?php }
                                }
                            } elseif ($rl->nm_role == 'User') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                            WHERE (status_ajuan='Ditolak Loket' 
                            OR status_ajuan='Ditolak Staff PPK' 
                            OR status_ajuan='Ditolak PPK' 
                            OR status_ajuan='Ditolak Staff PPSPM' 
                            OR status_ajuan='Ditolak PPSPM' 
                            OR status_ajuan='Selesai')
                            AND status_notif='0'")->result();
                                foreach ($jml_notif as $jn) {
                                    ?>
                                    <span class="dropdown-header"><?= $jn->total_notif ?> Notifications</span>
                                    <div class="dropdown-divider"></div>
                                    <?php $select_notif = $this->db->query("SELECT * FROM notif_ajuan JOIN ajuan ON ajuan.id_ajuan = notif_ajuan.id_ajuan 
                            WHERE (status_ajuan='Ditolak Loket' 
                            OR status_ajuan='Ditolak Staff PPK' 
                            OR status_ajuan='Ditolak PPK' 
                            OR status_ajuan='Ditolak Staff PPSPM' 
                            OR status_ajuan='Ditolak PPSPM' 
                            OR status_ajuan='Selesai')
                            AND status_notif='0'")->result();
                                    foreach ($select_notif as $sn) { ?>
                                        <a onclick="hapus_badge(<?= $sn->id_notif ?> )" class="dropdown-item">
                                            <i class="fas fa-envelope mr-2"></i> <?= $sn->no_ajuan ?>, Status Diperbaharui <br>
                                            <span class="text-muted text-sm"><?= $sn->tgl_notif ?></span>
                                        </a>
                                    <?php }
                                }
                            } elseif ($rl->nm_role == 'Bendahara') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                            WHERE status_ajuan='Proses Bendahara'")->result();
                                foreach ($jml_notif as $jn) {
                                    ?>
                                    <span class="dropdown-header"><?= $jn->total_notif ?> Notifications</span>
                                    <div class="dropdown-divider"></div>
                                    <?php $select_notif = $this->db->query("SELECT * FROM notif_ajuan JOIN ajuan ON ajuan.id_ajuan = notif_ajuan.id_ajuan 
                            WHERE status_ajuan='Proses Bendahara'")->result();
                                    foreach ($select_notif as $sn) { ?>
                                        <a href="<?= BASEURL ?>bendahara" class="dropdown-item">
                                            <i class="fas fa-envelope mr-2"></i> <?= $sn->no_ajuan ?>, Harap segera diproses<br>
                                            <span class="text-muted text-sm"><?= $sn->tgl_notif ?></span>
                                        </a>
                                    <?php }
                                }
                            } elseif ($rl->nm_role == 'PPK 1') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                            WHERE status_ajuan='Proses SPP/SPBY' AND notif_penerima = 'PPK 1'")->result();
                                foreach ($jml_notif as $jn) {
                                    ?>
                                    <span class="dropdown-header"><?= $jn->total_notif ?> Notifications</span>
                                    <div class="dropdown-divider"></div>
                                    <?php $select_notif = $this->db->query("SELECT * FROM notif_ajuan JOIN ajuan ON ajuan.id_ajuan = notif_ajuan.id_ajuan 
                            WHERE status_ajuan='Proses SPP/SPBY' AND notif_penerima = 'PPK 1'")->result();
                                    foreach ($select_notif as $sn) { ?>
                                        <a href="<?= BASEURL ?>ppk" class="dropdown-item">
                                            <i class="fas fa-envelope mr-2"></i> <?= $sn->no_ajuan ?>, Harap segera diproses<br>
                                            <span class="text-muted text-sm"><?= $sn->tgl_notif ?></span>
                                        </a>
                                    <?php }
                                }
                            } elseif ($rl->nm_role == 'PPK 2') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                            WHERE status_ajuan='Proses SPP/SPBY' AND notif_penerima = 'PPK 2'")->result();
                                foreach ($jml_notif as $jn) {
                                    ?>
                                    <span class="dropdown-header"><?= $jn->total_notif ?> Notifications</span>
                                    <div class="dropdown-divider"></div>
                                    <?php $select_notif = $this->db->query("SELECT * FROM notif_ajuan JOIN ajuan ON ajuan.id_ajuan = notif_ajuan.id_ajuan 
                            WHERE status_ajuan='Proses SPP/SPBY' AND notif_penerima = 'PPK 2'")->result();
                                    foreach ($select_notif as $sn) { ?>
                                        <a href="<?= BASEURL ?>ppk" class="dropdown-item">
                                            <i class="fas fa-envelope mr-2"></i> <?= $sn->no_ajuan ?>, Harap segera diproses<br>
                                            <span class="text-muted text-sm"><?= $sn->tgl_notif ?></span>
                                        </a>
                                    <?php }
                                }
                            } elseif ($rl->nm_role == 'PPK 3') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                            WHERE status_ajuan='Proses SPP/SPBY' AND notif_penerima = 'PPK 3'")->result();
                                foreach ($jml_notif as $jn) {
                                    ?>
                                    <span class="dropdown-header"><?= $jn->total_notif ?> Notifications</span>
                                    <div class="dropdown-divider"></div>
                                    <?php $select_notif = $this->db->query("SELECT * FROM notif_ajuan JOIN ajuan ON ajuan.id_ajuan = notif_ajuan.id_ajuan 
                            WHERE status_ajuan='Proses SPP/SPBY' AND notif_penerima = 'PPK 3'")->result();
                                    foreach ($select_notif as $sn) { ?>
                                        <a href="<?= BASEURL ?>ppk" class="dropdown-item">
                                            <i class="fas fa-envelope mr-2"></i> <?= $sn->no_ajuan ?>, Harap segera diproses<br>
                                            <span class="text-muted text-sm"><?= $sn->tgl_notif ?></span>
                                        </a>
                                    <?php }
                                }
                            } elseif ($rl->nm_role == 'PPK 4') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                            WHERE status_ajuan='Proses SPP/SPBY' AND notif_penerima = 'PPK 4'")->result();
                                foreach ($jml_notif as $jn) {
                                    ?>
                                    <span class="dropdown-header"><?= $jn->total_notif ?> Notifications</span>
                                    <div class="dropdown-divider"></div>
                                    <?php $select_notif = $this->db->query("SELECT * FROM notif_ajuan JOIN ajuan ON ajuan.id_ajuan = notif_ajuan.id_ajuan 
                            WHERE status_ajuan='Proses SPP/SPBY' AND notif_penerima = 'PPK 4'")->result();
                                    foreach ($select_notif as $sn) { ?>
                                        <a href="<?= BASEURL ?>ppk" class="dropdown-item">
                                            <i class="fas fa-envelope mr-2"></i> <?= $sn->no_ajuan ?>, Harap segera diproses<br>
                                            <span class="text-muted text-sm"><?= $sn->tgl_notif ?></span>
                                        </a>
                                    <?php }
                                }
                            } elseif ($rl->nm_role == 'PPK 5') {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                            WHERE status_ajuan='Proses SPP/SPBY' AND notif_penerima = 'PPK 5'")->result();
                                foreach ($jml_notif as $jn) {
                                    ?>
                                    <span class="dropdown-header"><?= $jn->total_notif ?> Notifications</span>
                                    <div class="dropdown-divider"></div>
                                    <?php $select_notif = $this->db->query("SELECT * FROM notif_ajuan JOIN ajuan ON ajuan.id_ajuan = notif_ajuan.id_ajuan 
                            WHERE status_ajuan='Proses SPP/SPBY' AND notif_penerima = 'PPK 5'")->result();
                                    foreach ($select_notif as $sn) { ?>
                                        <a href="<?= BASEURL ?>ppk" class="dropdown-item">
                                            <i class="fas fa-envelope mr-2"></i> <?= $sn->no_ajuan ?>, Harap segera diproses<br>
                                            <span class="text-muted text-sm"><?= $sn->tgl_notif ?></span>
                                        </a>
                                    <?php }
                                }
                            } elseif (
                                $rl->nm_role == 'Staf PPK 1' or $rl->nm_role == 'Staf PPK 2'
                                or $rl->nm_role == 'Staf PPK 3' or $rl->nm_role == 'Staf PPK 4'
                                or $rl->nm_role == 'Staf PPK 5'
                            ) {
                                $jml_notif = $this->db->query("SELECT COUNT(id_notif) AS total_notif FROM notif_ajuan 
                            WHERE status_ajuan='Diterima PPK' AND notif_penerima = '$username'")->result();
                                foreach ($jml_notif as $jn) {
                                    ?>
                                    <span class="dropdown-header"><?= $jn->total_notif ?> Notifications</span>
                                    <div class="dropdown-divider"></div>
                                    <?php $select_notif = $this->db->query("SELECT * FROM notif_ajuan JOIN ajuan ON ajuan.id_ajuan = notif_ajuan.id_ajuan 
                            WHERE status_ajuan='Diterima PPK' AND notif_penerima = '$username'")->result();
                                    foreach ($select_notif as $sn) { ?>
                                        <a href="<?= BASEURL ?>staffppk" class="dropdown-item">
                                            <i class="fas fa-envelope mr-2"></i> <?= $sn->no_ajuan ?>, Harap segera diproses<br>
                                            <span class="text-muted text-sm"><?= $sn->tgl_notif ?></span>
                                        </a>
                        <?php }
                                }
                            }
                        } ?>

                </li>
                <li class="nav-item nav-profile dropdown">
                    <?php $username = $_SESSION['id_peg'];
                    $get_foto = $this->db->query("SELECT * FROM pegawai WHERE id_peg='$username'")->result();
                    foreach ($get_foto as $foto) {
                    ?>
                        <a class="nav-link dropdown-toggle" href="#" title="<?= $foto->nm_peg ?>" data-toggle="dropdown" id="profileDropdown">
                            <!-- <img src="<?= base_url() ?>assets/img/<?= $foto->foto ?>" style="width:30px; height:30px; border-radius: 50px;" /> -->
                            <img class="img-profile rounded-circle" src="<?= base_url() ?>assets/img/<?= $foto->foto ?>" style="width:30px; height:30px; border-radius: 50px;" />
                            <b> <?= $foto->nm_peg; ?></b>
                        <?php } ?>
                        </a>
                        <!--  dropdown-menu-right navbar-dropdown preview-list card card-primary  -->
                        <div class="dropdown-menu card-primary" aria-labelledby="notificationDropdown">
                            <div class="card-body box-profile">
                                <?php $username = $_SESSION['id_peg'];
                                $get_foto = $this->db->query("SELECT * FROM pegawai WHERE id_peg='$username'")->result();
                                foreach ($get_foto as $foto) {
                                ?>
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>assets/img/<?= $foto->foto ?>" alt="User profile picture">
                                    </div>
                                    <h3 class="profile-username text-center">
                                        <?= $foto->nm_peg ?></h3>
                                    <p class="text-center">
                                        NIK : <?= $foto->nik; ?>
                                        <br>
                                        Role :
                                        <?php $username = $_SESSION['id_peg'];
                                        $koma = 1;
                                        $get_role = $this->db->query("SELECT * FROM pegawai 
                                    INNER JOIN dtrole ON pegawai.id_peg = dtrole.id_peg
                                    INNER JOIN role ON dtrole.id_role = role.id_role 
                                    WHERE pegawai.id_peg='$username'")->result();
                                        foreach ($get_role as $role) {
                                        ?>
                                            <br> <?= $koma++ . ". " ?>
                                            <?= $role->nm_role  ?>
                                        <?php } ?>
                                    </p>
                                    <!-- <p class="text-muted text-center"></p> -->
                                <?php } ?>

                                <a href="<?= site_url('log/logout') ?>" class="btn btn-primary btn-block" onclick="return confirm('apakah anda ingin logout ?')"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                            </div>
                            <!-- </div> -->
                        </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= BASEURL ?>Dashboard" class="brand-link">
                <!-- <img src="<?= BASEURL ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
                <center><span class="brand-text font-weight-light">Aplikasi LOKET </span></center>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= BASEURL ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div> -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= BASEURL ?>Dashboard" class="nav-link">
                                <i class="nav-icon fas fa-fw fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <!-- get menu tanpa treeview -->
                        <?php $username = $_SESSION['id_peg'];
                        $menu_tnp_tree = $this->db->query("SELECT * FROM aksesmn 
                        INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
                        INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg`
                        INNER JOIN treeview ON treeview.`id_treeview`=menu.`id_treeview`
                        WHERE pegawai.id_peg='$username' AND treeview.`id_treeview`='1' AND menu.status_mn = 'sidebar'")->result();
                        foreach ($menu_tnp_tree as $tnp_tree) { ?>
                            <li class="nav-item">
                                <a href="<?= $tnp_tree->link_akses ?>" class="nav-link">
                                    <i class="nav-icon fas fa-fw <?= $tnp_tree->icon_menu ?>"></i>
                                    <p><?= $tnp_tree->nm_menu ?></p>
                                </a>
                            </li>
                        <?php } ?>
                        <!-- get treeview -->
                        <?php $username = $_SESSION['id_peg'];
                        $get_treeview = $this->db->query("SELECT * FROM akses_treeview 
                        INNER JOIN treeview ON treeview.`id_treeview`=akses_treeview.`id_treeview`
                        INNER JOIN pegawai ON pegawai.`id_peg`=akses_treeview.`id_peg`
                        WHERE pegawai.id_peg='$username'")->result();
                        foreach ($get_treeview as $tree) { ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="<?= $tree->treeview_icon ?>"></i>
                                    <p>
                                        <?= $tree->nama_treeview ?>
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php $username = $_SESSION['id_peg'];
                                    $mn_dgn_tree = $this->db->query("SELECT * FROM aksesmn 
                                    INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
                                    INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg`
                                    INNER JOIN treeview ON treeview.`id_treeview`=menu.`id_treeview`
                                    WHERE pegawai.id_peg='$username' AND treeview.`id_treeview`='$tree->id_treeview' AND menu.status_mn = 'sidebar'")->result();
                                    foreach ($mn_dgn_tree as $dgn_tree) { ?>
                                        <li class="nav-item">
                                            <a href="<?= $dgn_tree->link_akses ?>" class="nav-link">
                                                <i class="nav-icon fas fa-fw <?= $dgn_tree->icon_menu ?>"></i>
                                                <p><?= $dgn_tree->nm_menu ?></p>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $title ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= BASEURL ?>Dashboard">Home</a></li>
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <script>
                        function hapus_badge(id_notif) {
                            $.ajax({
                                url: "<?= base_url() ?>index.php/notif/status_notif",
                                data: "id_notif=" + id_notif,
                                success: function(html) {
                                    window.location.href = "ajuan";
                                }
                            });
                        }
                    </script>