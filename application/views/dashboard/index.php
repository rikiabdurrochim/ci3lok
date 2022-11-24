<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pengajuan</span>
                <span class="info-box-number">
                    10
                    <small>%</small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">SPP</span>
                <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">SPBY</span>
                <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Ditolak</span>
                <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>

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
                        <th style=" text-align: center;  vertical-align: middle;">Monitoring </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    $data_ajuan = $this->db->query("SELECT * FROM ajuan 
                    INNER JOIN jenis on jenis.id_jenis = ajuan.jns_ajuan 
                    INNER JOIN giat on giat.id_giat = ajuan.kd_giat 
                    INNER JOIN akun on akun.id_akun = ajuan.kd_akun 
                    INNER JOIN pegawai on pegawai.id_peg = ajuan.peg_id 
                    ORDER BY id_ajuan DESC")->result_array();
                    foreach ($data_ajuan as $ajuan) :
                        $catatan = $ajuan['catatan'];
                        $no++;
                        $status_ajuan = "<label style='color: orange;'>Belum Diproses</label>";
                        if ($ajuan['status'] == "Ditolak Loket") $status_ajuan = "<label style='color: red;'>Ditolak Loket</label>";
                        else if ($ajuan['status'] == "Proses SPP/SPBY") $status_ajuan = "<label style='color: blue;'>Persetujuan SPP/SPBY</label>";
                        else if ($ajuan['status'] == "Ditolak Staff PPK") $status_ajuan = "<label style='color: red;'>Ditolak PPK</label>";
                        else if ($ajuan['status'] == "Proses SPM") $status_ajuan = "<label style='color: blue;'>Persetujuan PPSPM</label>";
                        else if ($ajuan['status'] == "Ditolak PPK") $status_ajuan = "<label style='color: red;'>Ditolak PPK</label>";
                        else if ($ajuan['status'] == "Ditolak staff PPSPM") $status_ajuan = "<label style='color: red;'>Ditolak PPSPM</label>";
                        else if ($ajuan['status'] == "Ditolak PPSPM") $status_ajuan = "<label style='color: red;'>Ditolak PPSPM</label>";
                        else if ($ajuan['status'] == "Kirim KPPN") $status_ajuan = "<label style='color: blue;'>Ditolak PPSPM</label>";
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
                            <td style="text-align: center"><a href="#" data-toggle="modal" data-target="#modal-monitor<?php echo ($ajuan['id_ajuan']); ?>" data-popup="tooltip" data-placement="top" title="Monitoring"><i class="fa fa-history" style="color:blue;"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
foreach ($data_ajuan as $ajuan) :
    $idajuan = $ajuan['id_ajuan'];
?>
    <div class="modal fade" id="modal-monitor<?php echo ($ajuan['id_ajuan']); ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Monitoring Ajuan : <?php echo ($ajuan['no_ajuan']); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="example1" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Posisi</th>
                                <th>Oleh</th>
                            </tr>
                        </thead>
                        <?php
                        $no = 0;
                        $get_monitor = $this->db->query("SELECT monitoring.tgl_monitor, monitoring.status, pegawai.nm_peg FROM monitoring INNER JOIN ajuan ON ajuan.id_ajuan = monitoring.id_ajuan
                        INNER JOIN pegawai ON pegawai.id_peg = monitoring.id_peg
                        WHERE monitoring.id_ajuan='$idajuan' ORDER BY monitoring.id_monitoring ASC")->result();
                        foreach ($get_monitor as $monitor) :
                            $no++;
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= date('d/M/Y H:i:s', strtotime($monitor->tgl_monitor)); ?></td>
                                <td><?= $monitor->status ?></td>
                                <td><?= $monitor->nm_peg ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="modal-footer justify-content-between">
                </div>

            </div>

            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>