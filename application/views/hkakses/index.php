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
                        <th>ID Role</th>
                        <th>ID Menu</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data_hkakses as $hk) :
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $hk['nm_role']; ?></td>
                            <td><?= $hk['nm_menu']; ?></td>
                            <td style="width: 70px;">
                                <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo ($hk['id_hkakses']); ?>" data-popup="tooltip" data-placement="top" title="Ubah Data"><i class="fa fa-edit" style="color:blue;"></i></a>
                                <a href="<?= site_url('hkakses/delete/' . $hk['id_hkakses']) ?>"><i class="fa fa-trash" style="color:red;"></i></a>
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
        <form enctype="multipart/form-data" action="<?php echo site_url('hkakses/prosesinput') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>ID Role </label>
                        <select style="width: 200px" name="id_role" class="form-control">
                            <option value="">--PILIH--</option>
                            <?php
                            $list = $this->db->query("SELECT * FROM role ORDER BY id_role ASC");
                            foreach ($list->result() as $t) {
                            ?>
                                <option value="<?php echo $t->id_role ?>"><?php echo $t->nm_role ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ID Menu </label>
                        <select style="width: 200px" name="id_menu" class="form-control">
                            <option value="">--PILIH--</option>
                            <?php
                            $list = $this->db->query("SELECT * FROM menu ORDER BY id_menu ASC");
                            foreach ($list->result() as $m) {
                            ?>
                                <option value="<?php echo $m->id_menu ?>"><?php echo $m->nm_menu ?></option>
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
foreach ($data_hkakses as $hk) :
    $no++;
?>
    <div class="modal fade" id="modal-edit<?php echo ($hk['id_hkakses']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('hkakses/prosesupdate') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="id_hkakses" name="id_hkakses" value="<?php echo $hk['id_hkakses'] ?>">
                            <label">ID Role </label>
                                <input type="text" class="form-control" placeholder="id Role" name="id_role" value="<?php echo $hk['id_role'] ?>">
                        </div>
                        <div class="form-group">
                            <label>ID Menu </label>
                            <input type="text" class="form-control" placeholder="id menu" name="id_menu" value="<?php echo $hk['id_menu'] ?>">
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