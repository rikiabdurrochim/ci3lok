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
                        <th>Role</th>
                        <th>Kegiatan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data_roleppk as $rp) :
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $rp['nm_role']; ?></td>
                            <td><?= $rp['kegiatan']; ?></td>
                            <td style="width: 70px;">
                                <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo ($rp['id_roleppk']); ?>" data-popup="tooltip" data-placement="top" title="Ubah Data"><i class="fa fa-edit" style="color:blue;"></i></a>
                                <a href="<?= site_url('roleppk/delete/' . $rp['id_roleppk']) ?>"><i class="fa fa-trash" style="color:red;"></i></a>
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
        <form enctype="multipart/form-data" action="<?= site_url('roleppk/prosesinput') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Role</label>
                        <select style="width: 400px" name="id_role" class="form-control">
                            <option value="">--PILIH--</option>
                            <?php
                            $list = $this->db->query("SELECT * FROM role WHERE id_role = 3 OR id_role = 4 OR id_role = 5 OR id_role = 7 OR id_role = 8 ORDER BY id_role ASC");
                            foreach ($list->result() as $r) {
                            ?>
                                <option value="<?= $r->id_role ?>"><?= $r->nm_role ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kegiatan</label>
                        <select style="width: 700px" name="id_giat" class="form-control">
                            <option value="">--PILIH--</option>
                            <?php
                            $list = $this->db->query("SELECT * FROM giat ORDER BY id_giat ASC");
                            foreach ($list->result() as $g) {
                            ?>
                                <option value="<?php echo $g->id_giat ?>"><?php echo $g->kegiatan ?></option>
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
foreach ($data_roleppk as $dt) :
    $no++;
?>
    <div class="modal fade" id="modal-edit<?= ($dt['id_roleppk']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?= site_url('roleppk/prosesupdate') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="id_roleppk" name="id_roleppk" value="<?= $dt['id_roleppk'] ?>">
                            <label>Role </label>
                            <select class="form-control" name="id_role" id="id_role">
                                <option value="">--Pilih--</option>
                                <?php
                                $list = $this->db->query("SELECT * FROM role WHERE id_role = 3 OR id_role = 4 OR id_role = 5 OR id_role = 7 OR id_role = 8 ORDER BY id_role ASC");
                                foreach ($list->result() as $r) {
                                ?>
                                    <option value="<?= $r->id_role ?>" <?php if ($dt["id_role"] == $r->id_role) {
                                                                            echo 'selected';
                                                                        } ?>><?= $r->nm_role ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kegiatan </label>
                            <select class="form-control" name="id_giat" id="id_giat">
                                <option value="">--Pilih--</option>
                                <?php
                                $list = $this->db->query("SELECT * FROM giat ORDER BY id_giat ASC");
                                foreach ($list->result() as $giat) {
                                ?>
                                    <option value="<?= $giat->id_giat ?>" <?php if ($dt["id_giat"] == $giat->id_giat) {
                                                                                echo 'selected';
                                                                            } ?>><?= $giat->kegiatan ?></option>
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