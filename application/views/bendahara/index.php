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
                        <th>SPP/SPBY </th>
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
                        if ($ajuan['status'] == "Selesai") $status_ajuan = "<label style='color: green;'>Selesai</label>";
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
                            <td><?= $ajuan['mtd_byr']; ?></td>
                            <td><?php echo $status_ajuan; ?></td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#modal-lihat<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Lihat Data"><i class="fa fa-eye" style="color:green"></i></a>
                                <a href="#" data-toggle="modal" data-target="#modal-download<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Download Data"><i class="fa fa-download" style="color:orange"></i></a>
                                <!-- <a href="#" data-toggle="modal" data-target="#modal-edit<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-edit" style="color:blue"></i></a> -->
                                <?php
                                $username = $_SESSION['id_peg'];
                                $get_login = $this->db->query("SELECT COUNT(pegawai.id_peg) AS id FROM pegawai 
                                INNER JOIN dtrole ON dtrole.id_peg=pegawai.id_peg 
                                INNER JOIN role ON role.`id_role`=dtrole.`id_role` 
                                WHERE pegawai.id_peg='$username' 
                                AND role.`nm_role`='Admin'")->result();
                                foreach ($get_login as $log) {
                                    if ($ajuan['status'] == "Proses Bendahara" or $log->id == '1') { ?>
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
                                            <div class="dropdown-menu">
                                                <center>
                                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-bayar<?= ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Bayar">Bayar</a>
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
                                            <th>No. SP2D</th>
                                            <th>Tanggal SP2D</th>
                                            <th>Metode Bayar</th>
                                            <th>Penerima</th>
                                            <th>Tanggal Terima</th>
                                            <th>Jumlah Bayar</th>
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
                                            <td><?= $ajuan['no_sp2d']; ?></td>
                                            <td><?= date('d/m/Y', strtotime($ajuan['tgl_sp2d'])); ?></td>
                                            <td><?= $ajuan['mtd_byr_ben']; ?></td>
                                            <td><?= $ajuan['penerima']; ?></td>
                                            <td><?= date('d/m/Y', strtotime($ajuan['tgl_byr'])); ?></td>
                                            <td><?= 'Rp ' . number_format($ajuan['jml_byr_ben'], 0, ',', '.'); ?></td>
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
<!-- modal setuju -->
<?php
$no = 0;
foreach ($data_ajuan as $ajuan) :
    $no++;
?>
    <div class="modal fade" id="modal-bayar<?= ($ajuan['id_ajuan']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('bendahara/bayar') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Proses Bayar</h4>
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
                                                    <label>Metode Bayar </label>
                                                    <select class="form-control" name="mtd_byr_ben" id="mtd_byr_ben">
                                                        <option value="">--Pilih--</option>
                                                        <option value="langsung">Langsung</option>
                                                        <option value="transfer">Transfer</option>
                                                    </select>
                                                    <label>Tanggal Bayar </label>
                                                    <input type="date" class="form-control" placeholder="Tanggal Bayar" name="tgl_byr" value="<?php echo $ajuan['tgl_byr']; ?>">
                                                    <label>Jumlah Bayar </label>
                                                    <div id="byr<?php echo $ajuan['id_ajuan'] ?>"></div>
                                                    <input type="text" class="form-control" placeholder="Jumlah Bayar" name="jml_byr_ben" id="jml_byr_ben<?php echo $ajuan['id_ajuan'] ?>" onkeyup="ubah_rupiah(<?php echo $ajuan['id_ajuan'] ?>)">
                                                    <label>Penerima </label>
                                                    <input type="text" class="form-control" placeholder="Penerima" name="penerima" value="<?php echo $ajuan['penerima']; ?>">
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

<script>
    function ubah_rupiah(id_ajuan) {
        var jml_byr_ben = $("#jml_byr_ben" + id_ajuan).val();
        if (jml_byr_ben != "") {
            $.ajax({
                url: "<?= base_url() ?>index.php/bendahara/get_rupiah",
                data: "jml_byr_ben=" + jml_byr_ben,
                success: function(html) {
                    $("#byr" + id_ajuan).html(html);
                }
            });
        } else {
            $.ajax({
                url: "<?= base_url() ?>index.php/bendahara/get_rupiah",
                data: "jml_byr_ben=" + 0,
                success: function(html) {
                    $("#byr" + id_ajuan).html(html);
                }
            });
        }
    }
</script>