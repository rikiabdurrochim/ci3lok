<div class="card card-primary align-center" style=" display:flex; justify-content:center;">
    <div class="card-header">
        <h3 class="card-title">Tambah Data Ajuan</h3>
        <a href="<?= BASEURL ?>ajuan" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </a>
    </div>

    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url('ajuan/prosesinput') ?>" method="post">
        <div class="card-body row">
            <div class="form-group col-6">
                <label>No Ajuan </label>
                <input type="text" class="form-control" placeholder="No Ajuan" name="no_ajuan" value="No ajuan didapat setelah data disimpan" style="color: red;" readonly>
            </div>
            <div class="form-group col-6">
                <label>Tanggal Ajuan </label>
                <input type="datetime" class="form-control" placeholder="tgl ajuan" name="tgl_ajuan" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                                                            echo date("Y-m-d H:i"); ?>" readonly>
            </div>
            <hr>
            <div class="form-group col-4">
                <label>Jenis Ajuan </label>
                <select class="form-control" name="jns_ajuan" id="jns_ajuan" onchange="get_dt_dukung()" required>
                    <option value="">--Pilih--</option>
                    <?php $get_ajuan = $this->db->query("SELECT * FROM jenis")->result();
                    foreach ($get_ajuan as $ajuan) {
                    ?>
                        <option value="<?= $ajuan->id_jenis ?>"><?= $ajuan->nm_jenis ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-4" id="dt_jenis">
                <label>Detail Jenis </label>
                <select class="form-control" name="dtjenis_id" id="dtjenis_id">
                    <option value="">--Pilih--</option>
                    <option value="">Pilih Jenis Terlebih Dahulu</option>
                </select>
            </div>
            <div class="form-group col-4">
                <label>No Dok </label>
                <input type="text" class="form-control" id="no_dok" onkeydown="setTimeout(cek_dokumen, 500);" minlength="5" placeholder="No Dok" name="no_dok" required>
            </div>
            <div class="form-group col-4">
                <label>Tanggal Dok </label>
                <input type="date" class="form-control" placeholder="tanggal dokumen" name="tgl_dok" required>
            </div>
            <div class="form-group col-12">
                <label>Perihal </label>
                <textarea class="form-control" name="perihal" id="perihal" placeholder="Perihal" rows="2" required></textarea>
                <!-- <input type="text" class="form-control" placeholder="Perihal" name="perihal"> -->
            </div>
            <div class="form-group col-5">
                <label>Kode Kegiatan </label>
                <?php $username = $_SESSION['id_peg'];
                $check_pegawai = $this->db->query("SELECT COUNT(pegawai.id_peg) AS id FROM pegawai INNER JOIN dtrole ON dtrole.id_peg=pegawai.id_peg INNER JOIN role ON role.id_role=dtrole.id_role WHERE pegawai.id_peg='$username' AND role.nm_role='Admin'")->result();
                foreach ($check_pegawai as $peg) {
                    if ($peg->id == 0) {
                ?>
                        <select class="form-control" name="kd_giat" id="kd_giat" onchange="get_akun()" required>
                            <option value="">--Pilih--</option>
                            <?php
                            $check_giat = $this->db->query("SELECT * FROM pegawai WHERE id_peg='$username'")->result();
                            foreach ($check_giat as $giat) {
                                $get_giat = $this->db->query("SELECT * FROM unitgiat INNER JOIN giat ON giat.id_giat=unitgiat.id_giat WHERE unitgiat.id_unit='$giat->unit'")->result();
                                foreach ($get_giat as $giat) {
                            ?> <option value="<?= $giat->id_giat ?>"><?= $giat->kegiatan ?></option>
                            <?php }
                            } ?>
                        </select>
                    <?php } else { ?>
                        <select class="form-control" name="kd_giat" id="kd_giat" onchange="get_akun()" required>
                            <option value="">--Pilih--</option>
                            <?php
                            $get_giat = $this->db->query("SELECT * FROM giat")->result();
                            foreach ($get_giat as $giat) {
                            ?> <option value="<?= $giat->id_giat ?>"><?= $giat->kegiatan ?></option>
                            <?php } ?>
                        </select>
                <?php }
                } ?>
            </div>
            <div class="form-group col-7" id="akun">
                <label>Kd Akun </label>
                <select class="form-control" name="kd_akun" required>
                    <option value="">--Pilih--</option>
                    <option value="">Pilih Kegiatan Terlebih Dahulu</option>
                </select>
            </div>
            <div class="form-group col-4">
                <label> Kota</label>
                <input type="text" class="form-control" placeholder="Kota" name="kota" required>
            </div>
            <div class="form-group col-4">
                <label> Tanggal Mulai</label>
                <input type="date" class="form-control" name="tgl_jln" required>
            </div>
            <div class="form-group col-4">
                <label> Tanggal Selesai</label>
                <input type="date" class="form-control" name="tgl_plg" required>
            </div>
            <div class="form-group col-12" id="jenis">
                <label> Data Dukung</label><br>
                <div class="checkbox">
                    <?php
                    $get_dukung = $this->db->query("SELECT * FROM dt_dukung");
                    foreach ($get_dukung->result() as $dt_dukung) {
                    ?>
                        <label><input type="checkbox" name="data_dukung[]" value="<?= $dt_dukung->nm_dt ?>" disabled> <?= $dt_dukung->nm_dt ?> | </label>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group col-6">
                <label> Jumlah Ajuan</label>/
                <label id="format_rupiah"></label>
                <input type="text" class="form-control" placeholder="Jumlah Ajuan" name="jml_ajuan" id="jml_ajuan" onkeyup="document.getElementById('format_rupiah').innerHTML = formatCurrency(this.value);" required>
            </div>
            <div class="form-group col-6">
                <label> Upload Data</label>
                <input type="file" class="form-control" id="nama_file" name="nama_file[]" multiple accept=".pdf, .xls, .xlsx" onchange="check_file()" required>
                <small>File type : pdf, .xls, .xlsx<br>Max size : 2MB</small>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary "> Simpan Data</button>
        </div>
    </form>
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
        get_dt_jenis();
        $.ajax({
            url: "<?= base_url() ?>index.php/ajuan/get_dt_dukung",
            data: "jns_ajuan=" + jns_ajuan,
            success: function(html) {
                $("#jenis").html(html);
            }
        });
    }

    function get_dt_jenis() {
        var jns_ajuan = $("#jns_ajuan").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/ajuan/get_dt_jenis",
            data: "jns_ajuan=" + jns_ajuan,
            success: function(html) {
                $("#dt_jenis").html(html);
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

    function cek_dokumen() {
        var no_dok = $("#no_dok").val();
        $.ajax({
            url: "<?php echo base_url() ?>index.php/ajuan/ck_dokumen",
            data: "no_dok=" + no_dok,
            method: 'post',
            dataType: 'json',
            success: function(data) {
                if (data.ada_tidak == 1) {
                    alert("Nomor dokumen sudah ada!");
                    $("#no_dok").val('');
                } else {

                }
            }
        });
    }
</script>