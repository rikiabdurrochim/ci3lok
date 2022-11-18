<?php
$get_ajuan = $this->db->query($sql)->result_array();
foreach ($get_ajuan as $ajuan) {
    $id_giat = $ajuan['kd_giat'];
?>
    <div class="body">
        <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url('ppspm/setujui') ?>" method="post">
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
                                    <td>Staff PPSPM</td>
                                    <td><input type="hidden" name="idajuan" id="idajuan" value="<?php echo $ajuan['id_ajuan']; ?>">
                                        <div class="input-group">
                                            <select class="form-control" name="id_staffppspm" id="id_staffppspm<?php echo $ajuan['id_ajuan']; ?>" onchange="add_data(<?php echo $ajuan['id_ajuan']; ?>)">
                                                <option value="">--Pilih--</option>
                                                <?php $get_ppspm = $this->db->query("SELECT * FROM pegawai 
                                                INNER JOIN dtrole ON dtrole.`id_peg`= pegawai.`id_peg` 
                                                INNER JOIN role ON role.`id_role` = dtrole.`id_role`
                                                WHERE role.`id_role` = '14'")->result();
                                                foreach ($get_ppspm as $ppspm) {
                                                ?>
                                                    <option value="<?= $ppspm->id_peg ?>"><?= $ppspm->nm_peg ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="input-btn-group">
                                            </div>
                                        </div>
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
                        <div id="data_ppspm">
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
                    <a class="btn btn-danger" href="<?php echo site_url('ppspm') ?>">Close</a>
                </div>
            </div>
        </form>
    </div>
<?php } ?>


<script type="text/javascript">
    function add_data(idajuan) {
        var id_staffppspm = $("#id_staffppspm" + idajuan).val();
        var no = $("#nomor").val();
        $.ajax({
            url: "<?php echo base_url() ?>index.php/ppspm/tampilkan_ppspm",
            data: "&id_staffppspm=" + id_staffppspm + "&no=" + no,
            success: function(html) {
                $("#data_ppspm").append(html);
                reset_form_input(idajuan);
                $('#nomor').val(no * 1 + 1 * 1);
            }
        });

    }

    function reset_form_input(idajuan) {
        var id_staffppspm = $('#id_staffppspm' + idajuan).val('');
    }

    function hapus(id_staffppspm) {
        $('.row-keranjang' + id_staffppspm).closest('.row-keranjang' + id_staffppspm).remove();
    }
</script>