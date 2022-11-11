<a href="<?= site_url('ajuan/tambah/') ?>" class="btn btn-primary mb-3"> Tambah Data</a>
<?= $this->session->flashdata('message') ?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th style=" text-align: center;  vertical-align: middle;">No.</th>
                        <th style=" text-align: center;  vertical-align: middle;">No. Ajuan</th>
                        <th style=" text-align: center;  vertical-align: middle;">Tgl Ajuan</th>
                        <th style=" text-align: center;  vertical-align: middle;">Jenis</th>
                        <th style=" text-align: center;  vertical-align: middle;">No.Dokumen</th>
                        <th style=" text-align: center;  vertical-align: middle;">Tgl Dokumen</th>
                        <th style=" text-align: center;  vertical-align: middle;">Perihal</th>
                        <th style=" text-align: center;  vertical-align: middle;">Kode Kegiatan</th>
                        <th style=" text-align: center;  vertical-align: middle;">Kode Akun</th>
                        <th style=" text-align: center;  vertical-align: middle;">Jumlah </th>
                        <th style=" text-align: center;  vertical-align: middle;">Status </th>
                        <th style=" text-align: center;  vertical-align: middle;">Pengaju </th>
                        <th style=" text-align: center;  vertical-align: middle;">Opsi </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    $username = $_SESSION['id_peg'];
                    foreach ($data_ajuan as $ajuan) :
                        $catatan = $ajuan['catatan'];
                        $peg_id = $ajuan['peg_id'];
                        $no++;
                        $status_ajuan = "<label style='color: orange;'>Belum Diproses</label>";
                        if ($ajuan['status'] == "Ditolak Loket") $status_ajuan = "<label style='color: red;'>Ditolak Loket</label>";
                        else if ($ajuan['status'] == "Proses SPP/SPBY") $status_ajuan = "<label style='color: blue;'>Proses SPP/SPBY</label>";
                        else if ($ajuan['status'] == "Ditolak Staff PPK") $status_ajuan = "<label style='color: red;'>Ditolak PPK</label>";
                        else if ($ajuan['status'] == "Proses SPM") $status_ajuan = "<label style='color: blue;'>Proses SPM</label>";
                        else if ($ajuan['status'] == "Ditolak PPK") $status_ajuan = "<label style='color: red;'>Ditolak PPK</label>";
                        else if ($ajuan['status'] == "Ditolak Staff PPSPM") $status_ajuan = "<label style='color: red;'>Ditolak PPSPM</label>";
                        else if ($ajuan['status'] == "Ditolak PPSPM") $status_ajuan = "<label style='color: red;'>Ditolak PPSPM</label>";
                        else if ($ajuan['status'] == "Kirim KPPN") $status_ajuan = "<label style='color: red;'>Ditolak PPSPM</label>";
                        else if ($ajuan['status'] == "Proses Bendahara") $status_ajuan = "<label style='color: blue;'>Proses Bendahara</label>";
                        else if ($ajuan['status'] == "Selesai") $status_ajuan = "<label style='color: green;'>Selesai</label>";
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $ajuan['no_ajuan']; ?></td>
                            <td><?= date('d/m/Y   H:i', strtotime($ajuan['tgl_ajuan'])); ?></td>
                            <td><?= $ajuan['nm_jenis']; ?></td>
                            <td><?= $ajuan['no_dok']; ?></td>
                            <td><?= date('d/m/Y', strtotime($ajuan['tgl_dok'])); ?></td>
                            <td><?= $ajuan['perihal']; ?></td>
                            <td><?= $ajuan['kegiatan']; ?></td>
                            <td><?= $ajuan['kroakun']; ?></td>
                            <td style="text-align: right"><?= number_format($ajuan['jml_ajuan'], 0, ',', '.'); ?></td>
                            <td style="text-align: center"><?= $status_ajuan ?></td>
                            <td><?php $get_giat = $this->db->query("SELECT * FROM pegawai WHERE id_peg='$peg_id'")->result();
                                foreach ($get_giat as $giat) {
                                    echo $giat->nm_peg;
                                } ?></td>
                            <td>
                                <?php
                                $check_admin = $this->db->query("SELECT COUNT(id_role) as id_role FROM dtrole WHERE id_peg='$username' AND id_role='1'")->result();
                                foreach ($check_admin as $admin) :
                                    if ($username == $ajuan['peg_id']) { ?>
                                        <a href="#" data-toggle="modal" data-target="#modal-lihat<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Lihat Data"><i class="fa fa-eye" style="color:green"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#modal-download<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Download Data"><i class="fa fa-download" style="color:orange"></i></a>
                                        <a href="<?= site_url('ajuan/update/' . $ajuan['id_ajuan'] . '/' . 'user') ?>"><i class="fa fa-edit" style="color:blue;"></i></a>
                                    <?php } else if ($admin->id_role == 1) { ?>
                                        <a href="#" data-toggle="modal" data-target="#modal-lihat<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Lihat Data"><i class="fa fa-eye" style="color:green"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#modal-download<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Download Data"><i class="fa fa-download" style="color:orange"></i></a>
                                        <a href="<?= site_url('ajuan/update/' . $ajuan['id_ajuan'] . '/' . 'user') ?>"><i class="fa fa-edit" style="color:blue;"></i></a>
                                <?php } else {
                                    }
                                endforeach; ?><br>
                                <?php
                                $check_admin = $this->db->query("SELECT COUNT(id_role) as id_role FROM dtrole WHERE id_peg='$username' AND id_role='1'")->result();
                                foreach ($check_admin as $admin) :
                                    if ($catatan != "" && $admin->id_role != 0) { ?>
                                        <a href="#" data-toggle="modal" data-target="#lihat-alasan<?= $ajuan['id_ajuan']; ?>" data-popup="tooltip" data-placement="top" title="Alasan Ditolak"><i class="fa fa-info" style="color:purple"></i></a>
                                    <?php } else if ($catatan != "" && $username == $ajuan['peg_id']) {
                                    ?>
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
            <form enctype="multipart/form-data" action="<?php echo site_url('ajuan/prosesinput') ?>" method="post">
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= $ajuan['no_ajuan']; ?></td>
                                                <td><?= $ajuan['kota']; ?></td>
                                                <td><?= date('d-M-Y', strtotime($ajuan['tgl_jln'])); ?></td>
                                                <td><?= date('d-M-Y', strtotime($ajuan['tgl_plg'])); ?></td>
                                                <td><?= $interval + 1 ?></td>
                                                <td><?= $ajuan['data_dukung']; ?></td>
                                                <td><?= $ajuan['nm_peg']; ?></td>
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
            </form>
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
            <form enctype="multipart/form-data" action="<?php echo site_url('ajuan/prosesinput') ?>" method="post">
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
                                                <!-- <th>Opsi</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no_files = 1;
                                            $id_ajuan = $ajuan['id_ajuan'];
                                            $get_files = $this->db->query("SELECT * FROM file_dukung WHERE id_ajuan = '$id_ajuan' AND status_file = 'user'")->result_array();
                                            foreach ($get_files as $a) :
                                            ?>
                                                <tr>
                                                    <td><?= $no_files++; ?></td>
                                                    <td><a href="<?= BASEURL ?>assets/file_dukung/<?php echo $a['nama_file']; ?>" target="_blank"><?php echo $a['nama_file']; ?></a></td>
                                                    <!-- <td>
                                                        <a onclick="return confirm('Apakah Anda Ingin Menghapus Data ?');" href="<?= site_url('ajuan/delete_file/' . $a['id_file']) ?>"><i class="fa fa-trash" style="color: red;"></i></a>
                                                    </td> -->
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