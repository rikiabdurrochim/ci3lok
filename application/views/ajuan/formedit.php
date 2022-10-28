<div class="card card-primary align-center" style=" display:flex; justify-content:center;">
    <div class="card-header">
        <h3 class="card-title">Update Data Ajuan</h3>
        <a href="<?= BASEURL ?>ajuan" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </a>
    </div>
    <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url('ajuan/prosesupdate') ?>" method="post">
        <div class="card-body col-md">
            <div class="form-group row">
                <input type="hidden" class="form-control" placeholder="id_ajuan" name="id_ajuan" value="<?php echo $id_ajuan ?>">
                <label>No Ajuan </label>
                <input type="text" class="form-control" placeholder="No Ajuan" name="no_ajuan" value="<?php echo $no_ajuan ?>" readonly>
            </div>
            <div class="form-group row">
                <label>Tanggal Ajuan </label>
                <input type="datetime" class="form-control" placeholder="tgl ajuan" name="tgl_ajuan" value="<?php echo $tgl_ajuan ?>" readonly>
            </div>
            <div class="form-group row">
                <label>Jenis Ajuan </label>
                <select class="form-control" name="jns_ajuan" id="jns_ajuan" onchange="get_dt_dukung()">
                    <option value="">--Pilih--</option>
                    <?php $get_ajuan = $this->db->query("SELECT * FROM jenis")->result();
                    foreach ($get_ajuan as $ajuan) {
                    ?>
                        <option value="<?= $ajuan->id_jenis ?>" <?php if ($jns_ajuan == $ajuan->id_jenis) {
                                                                    echo 'selected';
                                                                } ?>><?= $ajuan->nm_jenis ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group row">
                <label>No Dok </label>
                <input type="text" class="form-control" placeholder="No Dok" name="no_dok" value="<?php echo $no_dok ?>">
            </div>
            <div class="form-group row">
                <label>Tanggal Dok </label>
                <input type="date" class="form-control" placeholder="tanggal dokumen" name="tgl_dok" value="<?php echo $tgl_dok ?>">
            </div>
            <div class="form-group row">
                <label>Perihal </label>
                <input type="text" class="form-control" placeholder="Perihal" name="perihal" value="<?php echo $perihal ?>">
            </div>
            <div class="form-group row">
                <label>Kode Kegiatan </label>
                <select class="form-control" name="kd_giat" id="kd_giat" onchange="get_akun()">
                    <option value="">--Pilih--</option>
                    <?php $get_giat = $this->db->query("SELECT * FROM giat")->result();
                    foreach ($get_giat as $giat) {
                    ?> <option value="<?= $giat->id_giat ?>" <?php if ($kd_giat == $giat->id_giat) {
                                                                    echo 'selected';
                                                                } ?>><?= $giat->kegiatan ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group row" id="akun">
                <label>Kd Akun </label>
                <select class="form-control" name="kd_akun">
                    <option value="">--Pilih--</option>
                    <?php $get_akun = $this->db->query("SELECT * FROM akun")->result();
                    foreach ($get_akun as $akun) {
                    ?> <option value="<?= $akun->id_akun ?>" <?php if ($kd_akun == $akun->id_akun) {
                                                                    echo 'selected';
                                                                } ?>><?= $akun->kroakun ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group row">
                <label> Kota</label>
                <input type="text" class="form-control" placeholder="Kota" name="kota" value="<?php echo $kota ?>">
            </div>
            <div class="form-group row">
                <label> Tanggal Mulai</label>
                <input type="date" class="form-control" name="tgl_jln" value="<?php echo $tgl_jln ?>">
            </div>
            <div class="form-group row">
                <label> Tanggal Selesai</label>
                <input type="date" class="form-control" name="tgl_plg" value="<?php echo $tgl_plg ?>">
            </div>
            <div class="form-group row" id="jenis">
                <label> Data Dukung</label>
                <hr>
                <div class="checkbox">
                    <?php
                    $get_dukung = $this->db->query("SELECT * FROM dt_dukung WHERE jenis_id = '$jns_ajuan' ");
                    foreach ($get_dukung->result() as $dt_dukung) {
                    ?>
                        <label>
                            <input type="checkbox" name="data_dukung[]" value="<?=
                                                                                $dt_dukung->nm_dt ?>" <?php if (in_array($dt_dukung->nm_dt, $data_dukung)) echo 'checked="checked"'; ?>> <?= $dt_dukung->nm_dt ?> | </label>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group row">
                <label> Jumlah Ajuan</label>/
                <label id="format_rupiah"></label>
                <input type="text" class="form-control" placeholder="Jumlah Ajuan" name="jml_ajuan" id="jml_ajuan" onkeyup="document.getElementById('format_rupiah').innerHTML = formatCurrency(this.value);" value="<?php echo $jml_ajuan ?>">
            </div>
            <div class="form-group row">
                <label> Upload Data </label>
                <div class="input-group">
                    <input type="file" class="form-control" id="nama_file" name="nama_file[]" multiple accept=".pdf" onchange="check_file()">
                    <div class="input-group-btn">
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-download<?= $id_ajuan ?>" data-popup="tooltip" data-placement="top" title="Download Data">Lihat File </a>
                    </div>
                </div>
                <small>File type : pdf<br>Max size : 2MB</small>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary "> Update Data</button>
        </div>
    </form>
</div>

<div class="modal fade" id="modal-download<?= $id_ajuan ?>">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="#" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Lihat File</h4>
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
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no_files = 1;
                                        $get_files = $this->db->query("SELECT * FROM file_dukung WHERE id_ajuan = '$id_ajuan'")->result_array();
                                        foreach ($get_files as $a) :
                                        ?>
                                            <tr>
                                                <td><?= $no_files++; ?></td>
                                                <td><a href="<?= BASEURL ?>assets/file_dukung/<?php echo $a['nama_file']; ?>" target="_blank"><?php echo $a['nama_file']; ?></a></td>
                                                <td>
                                                    <a onclick="return confirm('Apakah Anda Ingin Menghapus Data ?');" href="<?= site_url('ajuan/delete_file_edit/' . $a['id_file'] . '/' . $id_ajuan) ?>"><i class="fa fa-trash" style="color: red;"></i></a>
                                                </td>
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

<script type="text/javascript">
    function get_akun() {
        var kd_giat = $("#kd_giat").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/ajuan/get_giat",
            data: "kd_giat=" + kd_giat,
            success: function(html) {
                $("#akun").html(html);
            }
        });
    }

    function get_dt_dukung() {
        var jns_ajuan = $("#jns_ajuan").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/ajuan/get_dt_dukung",
            data: "jns_ajuan=" + jns_ajuan,
            success: function(html) {
                $("#jenis").html(html);
            }
        });
    }

    function formatCurrency(jml_ajuan) {
        jml_ajuan = jml_ajuan.toString().replace(/\$|\,/g, '');
        if (isNaN(jml_ajuan))
            jml_ajuan = "0";
        sign = (jml_ajuan == (jml_ajuan = Math.abs(jml_ajuan)));
        jml_ajuan = Math.floor(jml_ajuan * 100 + 0.50000000001);
        cents = jml_ajuan % 100;
        jml_ajuan = Math.floor(jml_ajuan / 100).toString();
        if (cents < 10)
            cents = "0" + cents;
        for (var i = 0; i < Math.floor((jml_ajuan.length - (1 + i)) / 3); i++)
            jml_ajuan = jml_ajuan.substring(0, jml_ajuan.length - (4 * i + 3)) + '.' +
            jml_ajuan.substring(jml_ajuan.length - (4 * i + 3));
        return (((sign) ? '' : '-') + 'Rp.' + jml_ajuan);
    }

    function check_file() {
        var file_nama = document.getElementById('nama_file');
        var file_count = file_nama.files.length;
        for (var i = 0; i < file_count; i++) {
            var fileSize = file_nama.files[i].size;
            var fileNama = file_nama.files[i].name;
            if (fileSize > 2000000) { // 2 MB
                alert(fileNama + ': File terlalu besar!');
                alert("Maksimal size 2MB, Silahkan pilih ulang!");
                $("#nama_file").val('');
            } else {}
        }
    }
</script>