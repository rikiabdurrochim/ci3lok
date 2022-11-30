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
                        <th>Unit</th>
                        <th>Kegiatan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data_unitgiat as $ug) :
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $ug['nm_unit']; ?></td>
                            <td><?= $ug['kegiatan']; ?></td>
                            <td style="width: 70px;">
                                <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo ($ug['id_unitgiat']); ?>" data-popup="tooltip" data-placement="top" title="Ubah Data"><i class="fa fa-edit" style="color:blue;"></i></a>
                                <a href="<?= site_url('unitgiat/delete/' . $ug['id_unitgiat']) ?>"><i class="fa fa-trash" style="color:red;"></i></a>
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
        <form enctype="multipart/form-data" action="<?= site_url('unitgiat/prosesinput') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Unit</label>
                        <select style="width: 500px" name="id_unit" class="form-control">
                            <option value="">--PILIH--</option>
                            <?php
                            $list = $this->db->query("SELECT * FROM unit ORDER BY id_unit ASC");
                            foreach ($list->result() as $u) {
                            ?>
                                <option value="<?= $u->id_unit ?>"><?= $u->nm_unit ?></option>
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
                                <option value="<?= $g->id_giat ?>"><?= $g->kegiatan ?></option>
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
foreach ($data_unitgiat as $ug) :
    $no++;
?>
    <div class="modal fade" id="modal-edit<?= ($ug['id_unitgiat']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?= site_url('unitgiat/prosesupdate') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="id_unitgiat" name="id_unitgiat" value="<?= $ug['id_unitgiat'] ?>">
                            <label>Unit </label>
                            <select class="form-control" name="id_unit" id="id_unit">
                                <option value="">--Pilih--</option>
                                <?php
                                $list = $this->db->query("SELECT * FROM unit ORDER BY id_unit ASC");
                                foreach ($list->result() as $u) {
                                ?>
                                    <option value="<?= $u->id_unit ?>" <?php if ($ug["id_unit"] == $u->id_unit) {
                                                                            echo 'selected';
                                                                        } ?>><?= $u->nm_unit ?></option>
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
                                    <option value="<?= $giat->id_giat ?>" <?php if ($ug["id_giat"] == $giat->id_giat) {
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