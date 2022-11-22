<?= $this->session->flashdata('message') ?>
<div class="card">
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No. Ajuan</th>
                        <th>Tgl Ajuan</th>
                        <th>Jenis</th>
                        <th>Detail Jenis</th>
                        <th>No.Dokumen</th>
                        <th>Tgl Dokumen</th>
                        <th>Perihal</th>
                        <th>Kode Kegiatan</th>
                        <th>Kode Akun</th>
                        <th>Jumlah </th>
                        <th>Status </th>
                        <th>Opsi </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    $username = $_SESSION['id_peg'];
                    foreach ($data_ajuan as $ajuan) :
                        $no_ajuan = $ajuan['id_ajuan'];
                        $catatan = $ajuan['catatan'];
                        $no++;
                        $status_ajuan = "<label style='color: orange;'>Belum Diproses</label>";
                        if ($ajuan['status'] == "Proses SPM" && $ajuan['no_spm'] != "") $status_ajuan = "<label style='color: blue;'>Proses SPM</label>";
                        else if ($ajuan['status'] == "Ditolak Staff PPSPM" && $ajuan['no_spm'] == "") $status_ajuan = "<label style='color: red;'>Ditolak PPSPM</label>";
                        else if ($ajuan['status'] == "Ditolak PPSPM" && $ajuan['no_spm'] != "") $status_ajuan = "<label style='color: red;'>Ditolak PPSPM</label>";
                        else if ($ajuan['status'] == "Kirim KPPN" && $ajuan['no_spm'] != "") $status_ajuan = "<label style='color: blue;'>Kirim KPPN</label>";
                        else if ($ajuan['status'] == "Proses Bendahara" && $ajuan['no_spm'] != "") $status_ajuan = "<label style='color: blue;'>Proses Bendahara</label>";
                        else if ($ajuan['status'] == "Selesai" && $ajuan['no_spm'] != "") $status_ajuan = "<label style='color: green;'>Selesai</label>";
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $ajuan['no_ajuan']; ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($ajuan['tgl_ajuan'])); ?></td>
                            <td><?= $ajuan['nm_jenis']; ?></td>
                            <td><?= $ajuan['detail_jns']; ?></td>
                            <td><?= $ajuan['no_dok']; ?></td>
                            <td><?= date('d/m/Y', strtotime($ajuan['tgl_dok'])); ?></td>
                            <td><?= $ajuan['perihal']; ?></td>
                            <td><?= $ajuan['kegiatan']; ?></td>
                            <td><?= $ajuan['kroakun']; ?></td>
                            <td><?= 'Rp ' . number_format($ajuan['jml_ajuan'], 0, ',', '.'); ?></td>
                            <td><?php echo $status_ajuan; ?></td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#modal-lihat<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Lihat Data"><i class="fa fa-eye" style="color:green"></i></a>
                                <a href="#" data-toggle="modal" data-target="#modal-download<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Download Data"><i class="fa fa-download" style="color:orange"></i></a>
                                <?php $username = $_SESSION['id_peg'];
                                $check_pegawai = $this->db->query("SELECT COUNT(pegawai.id_peg) AS id FROM pegawai INNER JOIN dtrole ON dtrole.id_peg=pegawai.id_peg INNER JOIN role ON role.id_role=dtrole.id_role WHERE pegawai.id_peg='$username' AND role.nm_role='Admin'")->result();
                                foreach ($check_pegawai as $peg) {
                                    if ($peg->id == 1) { ?>
                                        <div class=" ml-auto text-left">
                                            <div class="btn-link" data-toggle="dropdown">
                                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                        <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                        <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                <center>
                                                    <a href="#" data-toggle="modal" data-target="#modal-ditolak<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Alasan ditolak" class="btn btn-danger">Tolak</a>
                                                    <a href="#" data-toggle="modal" data-target="#modal-diterima<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Diterima" class="btn btn-primary">Terima</a>
                                                </center>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <?php if ($ajuan['status'] == "Proses SPM" && $ajuan['no_spm'] == "") { ?>
                                            <div class=" ml-auto text-left">
                                                <div class="btn-link" data-toggle="dropdown">
                                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                            <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                            <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-left">
                                                    <center>
                                                        <a href="#" data-toggle="modal" data-target="#modal-ditolak<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Alasan ditolak" class="btn btn-danger">Tolak</a>
                                                        <a href="#" data-toggle="modal" data-target="#modal-diterima<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Diterima" class="btn btn-primary">Terima</a>
                                                    </center>
                                                </div>
                                            </div>
                                        <?php } else if ($ajuan['status'] == "Kirim KPPN" && $ajuan['no_spm'] != "") { ?>
                                            <div class=" ml-auto text-left">
                                                <div class="btn-link" data-toggle="dropdown">
                                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                            <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                            <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-left">
                                                    <center>
                                                        <a href="#" data-toggle="modal" data-target="#modal-sp2d<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="sp2d" class="btn btn-primary">Input SP2D</a>
                                                    </center>
                                                </div>
                                            </div>
                                        <?php } else if ($ajuan['status'] == "Ditolak PPSPM" && $ajuan['no_spm'] != "") { ?>
                                            <div class=" ml-auto text-left">
                                                <div class="btn-link" data-toggle="dropdown">
                                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                            <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                            <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-left">
                                                    <center>
                                                        <a href="#" data-toggle="modal" data-target="#modal-diterima<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Diterima" class="btn btn-primary">Edit SPM</a>
                                                    </center>
                                                </div>
                                            </div>
                                <?php } else {
                                        }
                                    }
                                } ?>
                                <br>
                                <?php
                                $check_admin = $this->db->query("SELECT COUNT(id_role) as id_role FROM dtrole WHERE id_peg='$username' AND id_role='1'")->result();
                                foreach ($check_admin as $admin) :
                                    if ($catatan != "") { ?>
                                        <a href="#" data-toggle="modal" data-target="#lihat-alasan<?= $ajuan['id_ajuan']; ?>" data-popup="tooltip" data-placement="top" title="Alasan Ditolak"><i class="fa fa-info" style="color:purple"></i></a>
                                <?php
                                    } else {
                                    }
                                endforeach; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- lihat modal -->
<?php
$no = 0;
foreach ($data_ajuan as $ajuan) :
    $no++;
    $tgl_jln = strtotime($ajuan['tgl_jln']);
    $tgl_plg = strtotime($ajuan['tgl_plg']);
    $hitung = $tgl_plg - $tgl_jln;
    $interval = $hitung / 60 / 60 / 24;
?>
    <div class="modal fade" id="modal-lihat<?= ($ajuan['id_ajuan']); ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Lihat Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No. Ajuan</th>
                                            <th>Kota</th>
                                            <th>Tgl Jalan</th>
                                            <th>Tgl Pulang</th>
                                            <th>Hari</th>
                                            <th>Data Dukung</th>
                                            <th>Oleh </th>
                                            <?php if ($ajuan['mtd_byr'] == 'SPP') {
                                                echo "<th>No SPP</th>
                                                <th>TGL SPP</th>
                                                <th>Jumlah SPP</th>";
                                            } else {
                                                echo "<th>No SPBY</th>
                                                <th>TGL SPBY</th>
                                                <th>Jumlah SPBY</th>";
                                            } ?>
                                            <th>No. SPM</th>
                                            <th>Tanggal SPM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $ajuan['no_ajuan']; ?></td>
                                            <td><?= $ajuan['kota']; ?></td>
                                            <td><?= date('d/m/Y', strtotime($ajuan['tgl_jln'])); ?></td>
                                            <td><?= date('d/m/Y', strtotime($ajuan['tgl_plg'])); ?></td>
                                            <td><?= $interval + 1 ?></td>
                                            <td><?= $ajuan['data_dukung']; ?></td>
                                            <td><?= $ajuan['nm_peg']; ?></td>
                                            <?php if ($ajuan['mtd_byr'] == 'SPP') {
                                            ?>
                                                <td><?= $ajuan['no_spp']; ?></td>
                                                <td><?= date('d/m/Y', strtotime($ajuan['tgl_spp'])); ?></td>
                                                <td><?= 'Rp ' . number_format($ajuan['jml_spp'], 0, ',', '.'); ?></td>
                                            <?php } else { ?>
                                                <td><?= $ajuan['no_spby']; ?></td>
                                                <td><?= date('d/m/Y', strtotime($ajuan['tgl_spby'])); ?></td>
                                                <td><?= 'Rp ' . number_format($ajuan['jml_spby'], 0, ',', '.'); ?></td>
                                            <?php } ?>
                                            <td><?= $ajuan['no_spm']; ?></td>
                                            <td><?= date('d/m/Y', strtotime($ajuan['tgl_spm'])); ?></td>
                                        </tr>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>


<!-- Download modal -->
<?php
$no = 0;
foreach ($data_ajuan as $ajuan) :
    $no++;
?>
    <div class="modal fade" id="modal-download<?= ($ajuan['id_ajuan']); ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Download Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no_files = 1;
                                        $id_ajuan = $ajuan['id_ajuan'];
                                        $get_files = $this->db->query("SELECT * FROM file_dukung WHERE id_ajuan = '$id_ajuan'")->result_array();
                                        foreach ($get_files as $a) :
                                        ?>
                                            <tr>
                                                <td><?= $no_files++; ?></td>
                                                <td><a href="<?= BASEURL ?>assets/file_dukung/<?php echo $a['nama_file']; ?>" target="_blank"><?php echo $a['nama_file']; ?></a></td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>

<!-- modal ditolak -->
<?php
$no = 0;
foreach ($data_ajuan as $ajuan) :
    $no++;
?>
    <div class="modal fade" id="modal-ditolak<?= ($ajuan['id_ajuan']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('staffPpspm/ditolak') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Masukan Alasan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No. Ajuan</th>
                                                <th><?= $ajuan['no_ajuan']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Alasan</td>
                                                <td><input type="hidden" name="idajuan" id="idajuan" value="<?php echo $ajuan['id_ajuan']; ?>">
                                                    <textarea id="alasan" name="alasan" class="form-control" placeholder="Berikan Alasan!" rows="4" required></textarea>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>

<?php
$no = 0;
foreach ($data_ajuan as $ajuan) :
    $id_ajuan = $ajuan['id_ajuan'];
    $no++;
?>
    <div class="modal fade" id="lihat-alasan<?php echo $id_ajuan; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Alasan Ditolak</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No Ajuan</th>
                                            <th><?php echo $ajuan['no_ajuan']; ?></th>
                                        </tr>
                                        <tr>
                                            <th>Alasan Ditolak</th>
                                            <th><?php echo $ajuan['catatan']; ?></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>


<!-- modal setuju -->
<?php
$no = 0;
foreach ($data_ajuan as $ajuan) :
    $no++;
?>
    <div class="modal fade" id="modal-diterima<?= ($ajuan['id_ajuan']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('staffPpspm/terima') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Diterima</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No. Ajuan : <?= $ajuan['no_ajuan']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="idajuan" id="idajuan" value="<?php echo $ajuan['id_ajuan']; ?>">
                                                    <input type="hidden" name="statusAjuan" id="statusAjuan" value="<?php echo $ajuan['status']; ?>">
                                                    <label>No. SPM </label>
                                                    <input type="text" class="form-control" placeholder="No. SPM" name="no_spm" value="<?php echo $ajuan['no_spm']; ?>">
                                                    <label>Tanggal SPM </label>
                                                    <input type="date" class="form-control" placeholder="Tanggal SPM" name="tgl_spm" value="<?php echo $ajuan['tgl_spm']; ?>">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>


<!-- modal sp2d -->
<?php
$no = 0;
foreach ($data_ajuan as $ajuan) :
    $no++;
?>
    <div class="modal fade" id="modal-sp2d<?= ($ajuan['id_ajuan']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('staffPpspm/sp2d') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">SP2D</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No. Ajuan : <?= $ajuan['no_ajuan']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="idajuan" id="idajuan" value="<?php echo $ajuan['id_ajuan']; ?>">
                                                    <label>No. SP2D </label>
                                                    <input type="text" class="form-control" placeholder="No. SP2D" name="no_sp2d" value="<?php echo $ajuan['no_sp2d']; ?>">
                                                    <label>Tanggal SP2D </label>
                                                    <input type="date" class="form-control" placeholder="Tanggal SP2D" name="tgl_sp2d" value="<?php echo $ajuan['tgl_sp2d']; ?>">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>