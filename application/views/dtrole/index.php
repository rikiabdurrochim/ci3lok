<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#input">
    Tambah Data
</button>
<?= $this->session->flashdata('message') ?>
<div class="card">
    <!-- /.card-header -->

    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pegawai</th>
                        <th>Role</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data_dtrole as $dtr) :
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $dtr['nm_peg']; ?></td>
                            <td><?= $dtr['nm_role']; ?></td>
                            <td style="width: 70px;">
                                <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo ($dtr['id_dtrole']); ?>" data-popup="tooltip" data-placement="top" title="Ubah Data"><i class="fa fa-edit" style="color:blue;"></i></a>
                                <a href="<?= site_url('dtrole/delete/' . $dtr['id_dtrole']) ?>"><i class="fa fa-trash" style="color:red;"></i></a>
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
        <form enctype="multipart/form-data" action="<?php echo site_url('dtrole/prosesinput') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pegawai</label>
                        <select style="width: 200px" name="id_peg" class="form-control" autocomplete="off">
                            <option value="">--PILIH--</option>
                            <?php
                            $list = $this->db->query("SELECT * FROM pegawai ORDER BY id_peg ASC");
                            foreach ($list->result() as $peg) {
                            ?>
                                <option value="<?php echo $peg->id_peg ?>"><?php echo $peg->nm_peg ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select style="width: 200px" name="id_role" class="form-control" autocomplete="off">
                            <option value="">--PILIH--</option>
                            <?php
                            $list = $this->db->query("SELECT * FROM role ORDER BY id_role ASC");
                            foreach ($list->result() as $role) {
                            ?>
                                <option value="<?php echo $role->id_role ?>"><?php echo $role->nm_role ?></option>
                            <?php } ?>
                        </select>
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
foreach ($data_dtrole as $dtr) :
    $no++;
?>
    <div class="modal fade" id="modal-edit<?php echo ($dtr['id_dtrole']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('dtrole/prosesupdate') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="id_dtrole" name="id_dtrole" value="<?php echo $dtr['id_dtrole'] ?>">
                            <label">Pegawai </label>
                                <select class="form-control" name="id_peg" id="id_peg">
                                    <option value="">--Pilih--</option>
                                    <?php
                                    $list = $this->db->query("SELECT * FROM pegawai ORDER BY id_peg ASC");
                                    foreach ($list->result() as $peg) {
                                    ?>
                                        <option value="<?= $peg->id_peg ?>" <?php if ($dtr["id_peg"] == $peg->id_peg) {
                                                                                echo 'selected';
                                                                            } ?>><?= $peg->nm_peg ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label">Role </label>
                                <select class="form-control" name="id_role" id="id_role">
                                    <option value="">--Pilih--</option>
                                    <?php
                                    $list = $this->db->query("SELECT * FROM role ORDER BY id_role ASC");
                                    foreach ($list->result() as $role) {
                                    ?>
                                        <option value="<?= $role->id_role ?>" <?php if ($dtr["id_role"] == $role->id_role) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $role->nm_role ?></option>
                                    <?php } ?>
                                </select>
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
<?php endforeach; ?>