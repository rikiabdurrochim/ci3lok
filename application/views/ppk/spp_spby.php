<?php
$get_ajuan = $this->db->query($sql)->result_array();
foreach ($get_ajuan as $ajuan) {
    $id_giat = $ajuan['kd_giat'];
?>
    <div class="body">

        <body onload="tampilkan_metode()"></body>
        <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url('staffppk/setuju') ?>" method="post">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No. Ajuan</th>
                                    <th><?= $ajuan['no_ajuan']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pilih Metode</td>
                                    <td><input type="hidden" name="idajuan" id="idajuan" value="<?php echo $ajuan['id_ajuan']; ?>" readonly>
                                        <input type="hidden" name="status" id="status" value="<?php echo $ajuan['status']; ?>" readonly>
                                        <select class="form-control" name="metode" id="metode" onchange="tampilkan_metode()">
                                            <option value="">--Pilih--</option>
                                            <option value="SPP" <?php if ($ajuan['mtd_byr'] == "SPP") {
                                                                    echo 'selected';
                                                                } ?>>SPP</option>
                                            <option value="SPBY" <?php if ($ajuan['mtd_byr'] == "SPBY") {
                                                                        echo 'selected';
                                                                    } ?>>SPBY</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Upload File
                                    </td>
                                    <td>
                                        <input type="file" class="form-control" id="nama_file" name="nama_file[]" multiple accept=".pdf,.xls,.xlsx" onchange="check_file()">
                                        <small>File type : pdf, xls, xlsx<br>Max size : 2MB</small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" id="m_spj" style="display: none"><b>METODE PEMBAYARAN SPP</b></h3>
                    <h3 class="card-title" id="m_um" style="display: none"><b>METODE PEMBAYARAN SPBY</b></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <div id="form-input" style="display: none">
                                <p style="margin-left: 50px;">NO SPP</p>
                                <p style="margin-left: 50px;">
                                    <input type="text" class="form-control" minlength="6" maxlength="6" style="width: 250px" name="no_spp" id="no_spp" placeholder="NO SPP" value="<?php echo $ajuan['no_spp']; ?>" />
                                </p>
                                <br>
                                <p style="margin-left: 50px;">TGL SPP</p>
                                <p style="margin-left: 50px;">
                                    <input type="date" class="form-control" style="width: 250px" name="tgl_spp" id="tgl_spp" placeholder="TGL SPP" value="<?php echo $ajuan['tgl_spp']; ?>" />
                                </p>
                                <br>
                                <p style="margin-left: 50px;">Jumlah SPP</p>
                                <p style="margin-left: 50px;">
                                    <span id="spp"></span><input type="text" class="form-control" style="width: 250px" name="jml_spp" id="jml_spp" value="<?php echo $ajuan['jml_spp']; ?>" placeholder="Jumlah SPP" onkeyup="document.getElementById('spp').innerHTML = formatCurrency(this.value);" />
                                </p>
                                <br>
                            </div>

                            <div id="form-input1" style="display: none">
                                <p style="margin-left: 50px;">NO SPBY</p>
                                <p style="margin-left: 50px;">
                                    <input type="text" class="form-control" minlength="6" maxlength="6" style="width: 250px" name="no_spby" id="no_spby" placeholder="NO SPBY" value="<?php echo $ajuan['no_spby']; ?>" />
                                </p>
                                <br>
                                <p style="margin-left: 50px;">TGL SPBY</p>
                                <p style="margin-left: 50px;">
                                    <span id="pajak"></span><input type="date" class="form-control" style="width: 250px" name="tgl_spby" id="tgl_spby" placeholder="TGL SPBY" value="<?php echo $ajuan['tgl_spby']; ?>" />
                                </p>
                                <br>
                                <p style="margin-left: 50px;">Jumlah SPBY</p>
                                <p style="margin-left: 50px;">
                                    <span id="spm"></span><input type="text" class="form-control" style="width: 250px" name="jml_spby" id="jml_spby" placeholder="Jumlah SPBY" onkeyup="document.getElementById('spm').innerHTML = formatCurrency(this.value);" value="<?php echo $ajuan['jml_spby']; ?>" />
                                </p>
                            </div>

                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-info">Simpan</button>
                    <?php if ($dari == "staffppk") {
                    ?>
                        <a class="btn btn-danger" href="<?php echo site_url('staffPpk') ?>">Close</a>
                    <?php } else if ($dari == "ppk") {
                    ?>
                        <a class="btn btn-danger" href="<?php echo site_url('Ppk') ?>">Close</a>
                    <?php } else {
                    } ?>
                </div>
            </div>
        </form>
    </div>
<?php } ?>


<script type="text/javascript">
    function tampilkan_metode() {
        var metode = $("#metode").val();

        if (metode == "SPP") {
            $("#form-input1").css("display", "none");
            $("#m_um").css("display", "none");
            $("#form-input").css("display", "block");
            $("#m_spj").css("display", "block");
            $("#no_spby").val('');
            $("#tgl_spby").val('');
            $("#jml_spby").val('');
        } else if (metode == "SPBY") {
            $("#form-input").css("display", "none");
            $("#m_spj").css("display", "none");
            $("#form-input1").css("display", "block");
            $("#m_um").css("display", "block");
            $("#no_spp").val('');
            $("#tgl_spp").val('');
            $("#jml_spp").val('');
        } else {}
    }

    function formatCurrency(nilai) {
        nilai = nilai.toString().replace(/\$|\,/g, '');
        if (isNaN(nilai))
            nilai = "0";
        nilai
        sign = (nilai == (nilai = Math.abs(nilai)));
        nilai = Math.floor(nilai * 100 + 0.50000000001);
        cents = nilai % 100;
        nilai = Math.floor(nilai / 100).toString();
        if (cents < 10)
            cents = "0" + cents;
        for (var i = 0; i < Math.floor((nilai.length - (1 + i)) / 3); i++)
            nilai = nilai.substring(0, nilai.length - (4 * i + 3)) + '.' +
            nilai.substring(nilai.length - (4 * i + 3));
        return (((sign) ? '' : '-') + 'Rp.' + nilai + ',' + cents);
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