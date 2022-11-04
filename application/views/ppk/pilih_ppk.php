<?php
$get_ajuan = $this->db->query($sql)->result_array();
foreach ($get_ajuan as $ajuan) {
    $id_giat = $ajuan['kd_giat'];
?>
    <div class="body">
        <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url('ppk/setujui') ?>" method="post">
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
                                    <td>Staff PPK</td>
                                    <td><input type="hidden" name="idajuan" id="idajuan" value="<?php echo $ajuan['id_ajuan']; ?>">
                                        <div class="input-group">
                                            <select class="form-control" name="id_staffppk" id="id_staffppk<?php echo $ajuan['id_ajuan']; ?>" onchange="add_data(<?php echo $ajuan['id_ajuan']; ?>)">
                                                <option value="">--Pilih--</option>
                                                <?php $get_ppk = $this->db->query("SELECT * FROM pegawai INNER JOIN dtrole ON dtrole.`id_peg`=pegawai.`id_peg` INNER JOIN roleppk ON roleppk.`id_role`=dtrole.`id_role` INNER JOIN giat ON giat.`id_giat`=roleppk.`id_giat` WHERE giat.`id_giat`='$id_giat'")->result();
                                                foreach ($get_ppk as $ppk) {
                                                ?>
                                                    <option value="<?= $ppk->id_peg ?>"><?= $ppk->nm_peg ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="input-btn-group">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Metode Pembayaran</td>
                                    <td>
                                        <select class="form-control" name="metode" id="metode">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="data_ppk">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <input type="hidden" name="nomor" id="nomor" placeholder="0" class="form-control" readonly value="0">
                                        <th>Staf PPK</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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
    function add_data(idajuan) {
        var id_staffppk = $("#id_staffppk" + idajuan).val();
        var no = $("#nomor").val();
        $.ajax({
            url: "<?php echo base_url() ?>index.php/ppk/tampilkan_ppk",
            data: "&id_staffppk=" + id_staffppk + "&no=" + no,
            success: function(html) {
                $("#data_ppk").append(html);
                reset_form_input(idajuan);
                $('#nomor').val(no * 1 + 1 * 1);
            }
        });

    }

    function reset_form_input(idajuan) {
        var id_staffppk = $('#id_staffppk' + idajuan).val('');
    }

    function hapus(id_staffppk) {
        $('.row-keranjang' + id_staffppk).closest('.row-keranjang' + id_staffppk).remove();
    }
</script>