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
                        $catatan = $ajuan['catatan'];
                        $no++;
                        $status_ajuan = "<label style='color: orange;'>Belum Diproses</label>";
                        if ($ajuan['status'] == "Ditolak Loket") $status_ajuan = "<label style='color: red;'>Ditolak Loket</label>";
                        else if ($ajuan['status'] == "Proses SPP/SPBY") $status_ajuan = "<label style='color: blue;'>Proses SPP/SPBY</label>";
                        else if ($ajuan['status'] == "Ditolak Staff PPK") $status_ajuan = "<label style='color: red;'>Ditolak PPK</label>";
                        else if ($ajuan['status'] == "Proses SPM") $status_ajuan = "<label style='color: blue;'>Proses PPSPM</label>";
                        else if ($ajuan['status'] == "Ditolak PPK") $status_ajuan = "<label style='color: red;'>Ditolak PPK</label>";
                        else if ($ajuan['status'] == "Ditolak staff PPSPM") $status_ajuan = "<label style='color: red;'>Ditolak PPSPM</label>";
                        else if ($ajuan['status'] == "Ditolak PPSPM") $status_ajuan = "<label style='color: red;'>Ditolak PPSPM</label>";
                        else if ($ajuan['status'] == "Kirim KPPN") $status_ajuan = "<label style='color: red;'>Ditolak PPSPM</label>";
                        else if ($ajuan['status'] == "Proses Bendahara") $status_ajuan = "<label style='color: blue;'>Proses Bendahara</label>";
                        else if ($ajuan['status'] == "Selesai") $status_ajuan = "<label style='color: green;'>Selesai</label>";
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $ajuan['no_ajuan']; ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($ajuan['tgl_ajuan'])); ?></td>
                            <td><?= $ajuan['nm_jenis']; ?></td>
                            <td><?= $ajuan['detail_jns']; ?></td>
                            <td><?= $ajuan['no_dok']; ?></td>
                            <td><?= date('d-m-Y', strtotime($ajuan['tgl_dok'])); ?></td>
                            <td><?= $ajuan['perihal']; ?></td>
                            <td><?= $ajuan['kegiatan']; ?></td>
                            <td><?= $ajuan['kroakun']; ?></td>
                            <td><?= 'Rp ' . number_format($ajuan['jml_ajuan'], 0, ',', '.'); ?></td>
                            <td><?= $status_ajuan ?></td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#modal-lihat<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Lihat Data"><i class="fa fa-eye" style="color:green"></i></a>
                                <a href="#" data-toggle="modal" data-target="#modal-download<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Download Data"><i class="fa fa-download" style="color:orange"></i></a>
                                <!-- <a href="<?= site_url('ajuan/update/' . $ajuan['id_ajuan']) ?>" title="Edit Data"><i class="fa fa-edit" style="color: blue;"></i></a>
                                    <a onclick="return confirm('Apakah Anda Ingin Menghapus Data ?');" href="<?= site_url('ajuan/delete/' . $ajuan['id_ajuan']) ?>"><i class="fa fa-trash" style="color: red;"></i></a> -->
                                <?php $username = $_SESSION['id_peg'];
                                $check_pegawai = $this->db->query("SELECT COUNT(pegawai.id_peg) AS id FROM pegawai INNER JOIN dtrole ON dtrole.id_peg=pegawai.id_peg INNER JOIN role ON role.id_role=dtrole.id_role WHERE pegawai.id_peg='$username' AND role.nm_role='Admin'")->result();
                                foreach ($check_pegawai as $peg) {
                                    if ($ajuan['status'] == "Belum Diproses" or $peg->id == '1') { ?>
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
                                                    <a href="<?= site_url('loket/setujui/' . $ajuan['id_ajuan']) ?>"><button class="btn btn-success">Setujui</button></a>
                                                </center>
                                            </div>
                                        </div>
                                <?php } else {
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

<!-- modal ditolak -->
<?php
$no = 0;
foreach ($data_ajuan as $ajuan) :
    $no++;
?>
    <div class="modal fade" id="modal-ditolak<?= ($ajuan['id_ajuan']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('loket/ditolak') ?>" method="post">
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


<!-- modal diterima -->
<?php
$no = 0;
foreach ($data_ajuan as $ajuan) :
    $giat = $ajuan['kd_giat'];
    $no++;
?>
    <div class="modal fade" id="modal-diterima<?= ($ajuan['id_ajuan']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('loket/diterima') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Pilih Staff PPK</h4>

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
                                                <td>Pilih Staff PPK</td>
                                                <td><input type="hidden" name="idajuan" id="idajuan" value="<?php echo $ajuan['id_ajuan']; ?>">
                                                    <select style="width: 200px" name="id_menu" class="form-control">
                                                        <option value="">--PILIH--</option>

                                                        <?php
                                                        $getgiat = $this->db->query("SELECT * FROM giat 
                                                        WHERE giat.`kd_giat` =  '$giat'");
                                                        foreach ($getgiat->result() as $gtgiat) {

                                                            $list = $this->db->query("SELECT * FROM pegawai INNER JOIN dtrole ON dtrole.`id_peg` = pegawai.`id_peg` 
                                                        INNER JOIN roleppk ON roleppk.`id_role` = dtrole.`id_role`
                                                        INNER JOIN giat ON giat.`id_giat` = roleppk.`id_giat`
                                                        WHERE giat.`id_giat` = '$gtgiat->id_giat' ORDER BY pegawai.`id_peg` ASC");
                                                            foreach ($list->result() as $peg) {
                                                        ?>
                                                                <option value="<?php echo $peg->id_peg ?>"><?php echo $peg->nm_peg ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
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
                    <h4 class="modal-title">Lihat Alasan</h4>
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
                                            <th>Oleh</th>
                                        </tr>
                                        <?php
                                        $get_catatan = $this->db->query("SELECT * FROM catatan WHERE id_ajuan = '$id_ajuan'");
                                        foreach ($get_catatan->result_array() as $cat) {
                                        ?>
                                            <tr>
                                                <th>Alasan Ditolak</th>
                                                <th><?= $cat['isi_catatan']; ?></th>
                                                <th><?= $cat['oleh_role']; ?></th>
                                            </tr>
                                        <?php } ?>
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