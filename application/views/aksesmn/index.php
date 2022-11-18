<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#input">
    Tambah Data
</button>
<?= $this->session->flashdata('message') ?>
<div class="card col-md">
    <!-- /.card-header -->
    <div class="card-body col-md-6">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Pegawai</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data_aksesmn as $am) :
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $am['nm_peg']; ?></td>
                            <td style="width: 70px;">
                                <a href="#" data-toggle="modal" data-target="#modal-lihat<?php echo ($am['id_peg']); ?>" data-popup="tooltip" data-placement="top" title="Lihat Data"><i class="fa fa-eye" style="color:blue;"></i></a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- input modal -->
<div class="modal fade" id="input">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="<?php echo site_url('aksesmn/prosesinput') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Pegawai</label>
                        <select style="width: 200px" name="id_peg" id="id_peg" class="form-control" autocomplete="off" onchange="get_role(); get_menu();">
                            <option value="">--PILIH--</option>
                            <?php
                            $list_peg = $this->db->query("SELECT * FROM pegawai ORDER BY id_peg ASC");
                            foreach ($list_peg->result() as $peg) {
                            ?>
                                <option value="<?php echo $peg->id_peg ?>"><?php echo $peg->nm_peg ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" id="get_role">
                        <!--  <label>Pilih Role</label><br>
                            <?php
                            $list_role = $this->db->query("SELECT * FROM role ORDER BY id_role ASC");
                            foreach ($list_role->result() as $t) {
                            ?>
                                <input type="checkbox" name="id_role[]" id="id_role[]" class="roles" value="<?php echo $t->id_role ?>" />
                  <label><?php echo $t->nm_role ?></label><br>
                            <?php } ?> -->

                    </div>
                    <div class="form-group" id="get_menu">
                        <!--  <label>Pilih Menu </label><br>
                       
                            <?php
                            $list_menu = $this->db->query("SELECT * FROM menu ORDER BY id_menu ASC");
                            foreach ($list_menu->result() as $m) {
                            ?>
                              <input type="checkbox" name="id_menu[]" id="id_menu[]" class="roles" value="<?php echo $m->id_menu ?>" />
                  <label><?php echo $m->nm_menu ?></label><br>
                            <?php } ?> -->
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- edit modal -->
<?php
$no = 0;
foreach ($data_aksesmn as $am) :
    $id_peg = $am['id_peg'];
    $no++;
?>
    <div class="modal fade" id="modal-lihat<?php echo ($am['id_peg']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('aksesmn/prosesupdate') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Lihat Akses Menu/Role</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <tr>

                                <th>Nama Pegawai </th>
                                <th><?php echo ($am['nm_peg']); ?></th>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <th>
                                    <?php $get_role = $this->db->query("SELECT dtrole.id_role, role.nm_role, pegawai.id_peg FROM dtrole INNER JOIN role ON role.`id_role`=dtrole.`id_role` INNER JOIN pegawai ON pegawai.`id_peg`=dtrole.`id_peg` WHERE dtrole.`id_peg`='$id_peg'");
                                    foreach ($get_role->result() as $r_role) {
                                    ?>

                                        - <?php echo $r_role->nm_role; ?><br>
                                    <?php } ?>
                                </th>
                            </tr>
                            <tr>
                                <th>Menu</th>
                                <th>
                                    <?php
                                    $get_menu = $this->db->query("SELECT * FROM menu
                        INNER JOIN aksesmn ON aksesmn.`id_menu`=menu.`id_menu`
                        INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg` 
                        WHERE aksesmn.`id_peg`='$id_peg'");
                                    foreach ($get_menu->result() as $r_menu) {
                                    ?>
                                        - <?php echo $r_menu->nm_menu; ?><br>
                                    <?php } ?>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>

<script type="text/javascript">
    function get_role() {
        var id_peg = $("#id_peg").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/aksesmn/data_role",
            data: "id_peg=" + id_peg,
            success: function(data) {
                $("#get_role").html(data);
            }
        });
    }

    function get_menu() {
        var id_peg = $("#id_peg").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/aksesmn/data_menu",
            data: "id_peg=" + id_peg,
            success: function(data) {
                $("#get_menu").html(data);
            }
        });
    }

    function delete_menu(id_peg, id_menu) {
        $.ajax({
            url: "<?= base_url() ?>index.php/aksesmn/delete_mn",
            data: "id_peg=" + id_peg + "&id_menu=" + id_menu,
            success: function(data) {
                get_menu();
            }
        });
    }

    function delete_role(id_peg, id_role) {
        $.ajax({
            url: "<?= base_url() ?>index.php/aksesmn/delete_rl",
            data: "id_peg=" + id_peg + "&id_role=" + id_role,
            success: function(data) {
                get_role();
            }
        });
    }
</script>