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
                        <th>Kegiatan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data_dtppk as $dt) :
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $dt['nm_peg']; ?></td>
                            <td><?= $dt['kegiatan']; ?></td>
                            <td style="width: 70px;">
                                <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo ($dt['id_dtppk']); ?>" data-popup="tooltip" data-placement="top" title="Ubah Data"><i class="fa fa-edit" style="color:blue;"></i></a>
                                <a href="<?= site_url('dtppk/delete/' . $dt['id_dtppk']) ?>"><i class="fa fa-trash" style="color:red;"></i></a>
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
        <form enctype="multipart/form-data" action="<?php echo site_url('dtppk/prosesinput') ?>" method="post">
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
                        <select style="width: 200px" name="id_peg" class="form-control">
                            <option value="">--PILIH--</option>
                            <?php
                            $list = $this->db->query("SELECT * FROM pegawai JOIN dtrole ON dtrole.id_peg = pegawai.id_peg
                                                                            JOIN role ON role.id_role = dtrole.id_role 
                                                                            WHERE role.`id_role`=9 OR role.`id_role`=10 OR role.`id_role`=11 OR role.`id_role`=12 OR role.`id_role`=13
                                                                            ORDER BY pegawai.id_peg ASC");
                            foreach ($list->result() as $t) {
                            ?>
                                <option value="<?php echo $t->id_peg ?>"><?php echo $t->nm_peg ?></option>
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
foreach ($data_dtppk as $dt) :
    $no++;
?>
    <div class="modal fade" id="modal-edit<?php echo ($dt['id_dtppk']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('dtppk/prosesupdate') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="id_dtppk" name="id_dtppk" value="<?php echo $dt['id_dtppk'] ?>">
                            <label">Pegawai </label>
                                <select class="form-control" name="id_peg" id="id_peg">
                                    <option value="">--Pilih--</option>
                                    <?php
                                    $list = $this->db->query("SELECT * FROM pegawai JOIN dtrole ON dtrole.id_peg = pegawai.id_peg
                                    JOIN role ON role.id_role = dtrole.id_role 
                                    WHERE role.`id_role`=9 OR role.`id_role`=10 OR role.`id_role`=11 OR role.`id_role`=12 OR role.`id_role`=13 ORDER BY pegawai.id_peg ASC");
                                    foreach ($list->result() as $peg) {
                                    ?>
                                        <option value="<?= $peg->id_peg ?>" <?php if ($dt["id_peg"] == $peg->id_peg) {
                                                                                echo 'selected';
                                                                            } ?>><?= $peg->nm_peg ?></option>
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