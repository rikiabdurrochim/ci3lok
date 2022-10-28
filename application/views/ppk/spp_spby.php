<?php
$get_ajuan = $this->db->query($sql)->result_array();
foreach ($get_ajuan as $ajuan) {
    $id_giat = $ajuan['kd_giat'];
?>
    <div class="body">
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
                                    <td><input type="hidden" name="idajuan" id="idajuan" value="<?php echo $ajuan['id_ajuan']; ?>">
                                        <select class="form-control" name="metode" id="metode" onchange="tampilkan_metode()">
                                            <option value="">--Pilih--</option>
                                            <option value="SPP">SPP</option>
                                            <option value="SPBY">SPBY</option>
                                        </select>
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
                                    <input type="text" class="form-control" style="width: 250px" name="no_spp" id="no_spp" placeholder="NO SPP" />
                                </p>
                                <br>
                                <p style="margin-left: 50px;">TGL SPP</p>
                                <p style="margin-left: 50px;">
                                    <input type="date" class="form-control" style="width: 250px" name="tgl_spp" id="tgl_spp" placeholder="TGL SPP" />
                                </p>
                                <br>
                                <p style="margin-left: 50px;">Jumlah SPP</p>
                                <p style="margin-left: 50px;">
                                    <span id="spp"></span><input type="text" class="form-control" style="width: 250px" name="jml_spp" id="jml_spp" placeholder="Jumlah SPP" onkeyup="document.getElementById('spp').innerHTML = formatCurrency(this.value);" />
                                </p>
                                <br>
                            </div>

                            <div id="form-input1" style="display: none">
                                <p style="margin-left: 50px;">NO SPBY</p>
                                <p style="margin-left: 50px;">
                                    <input type="text" class="form-control" style="width: 250px" name="no_spby" id="no_spby" placeholder="NO SPBY" />
                                </p>
                                <br>
                                <p style="margin-left: 50px;">TGL SPBY</p>
                                <p style="margin-left: 50px;">
                                    <span id="pajak"></span><input type="date" class="form-control" style="width: 250px" name="tgl_spby" id="tgl_spby" placeholder="TGL SPBY" />
                                </p>
                                <br>
                                <p style="margin-left: 50px;">Jumlah SPBY</p>
                                <p style="margin-left: 50px;">
                                    <span id="spm"></span><input type="text" class="form-control" style="width: 250px" name="jml_spby" id="jml_spby" placeholder="Jumlah SPBY" onkeyup="document.getElementById('spm').innerHTML = formatCurrency(this.value);" />
                                </p>
                            </div>
                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-info">Simpan</button>
                    <a class="btn btn-danger" href="<?php echo site_url('loket') ?>">Close</a>
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
        } else {
            $("#form-input").css("display", "none");
            $("#m_spj").css("display", "none");
            $("#form-input1").css("display", "block");
            $("#m_um").css("display", "block");
            $("#no_spp").val('');
            $("#tgl_spp").val('');
            $("#jml_spp").val('');
        }
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
</script>