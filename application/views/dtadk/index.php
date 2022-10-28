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
                        <th>Jenis</th>
                        <th>ADK</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data_dtadk as $dt) :
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $dt['nm_jenis']; ?></td>
                            <td><?= $dt['nm_adk']; ?></td>
                            <td style="width: 70px;">
                                <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo ($dt['id_dtadk']); ?>" data-popup="tooltip" data-placement="top" title="Ubah Data"><i class="fa fa-edit" style="color:blue;"></i></a>
                                <a href="<?= site_url('dtadk/delete/' . $dt['id_dtadk']) ?>"><i class="fa fa-trash" style="color:red;"></i></a>
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
        <form enctype="multipart/form-data" action="<?php echo site_url('dtadk/prosesinput') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jenis</label>
                        <select style="width: 200px" name="id_jenis" class="form-control">
                            <option value="">--PILIH--</option>
                            <?php
                            $list = $this->db->query("SELECT * FROM jenis ORDER BY id_jenis ASC");
                            foreach ($list->result() as $t) {
                            ?>
                                <option value="<?php echo $t->id_jenis ?>"><?php echo $t->nm_jenis ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ADK</label>
                        <select style="width: 200px" name="id_detadk" class="form-control">
                            <option value="">--PILIH--</option>
                            <?php
                            $list = $this->db->query("SELECT * FROM detadk ORDER BY id_detadk ASC");
                            foreach ($list->result() as $t) {
                            ?>
                                <option value="<?php echo $t->id_detadk ?>"><?php echo $t->nm_adk ?></option>
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
foreach ($data_dtadk as $dt) :
    $no++;
?>
    <div class="modal fade" id="modal-edit<?php echo ($dt['id_dtadk']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('dtadk/prosesupdate') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="id_dtadk" name="id_dtadk" value="<?php echo $dt['id_dtadk'] ?>">
                            <label">Jenis </label>
                                <select class="form-control" name="id_jenis" id="id_jenis">
                                    <option value="">--Pilih--</option>
                                    <?php
                                    $list = $this->db->query("SELECT * FROM jenis ORDER BY id_jenis ASC");
                                    foreach ($list->result() as $jns) {
                                    ?>
                                        <option value="<?= $jns->id_jenis ?>" <?php if ($dt["id_jenis"] == $jns->id_jenis) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $jns->nm_jenis ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>ADK </label>
                            <select class="form-control" name="id_detadk" id="id_detadk">
                                <option value="">--Pilih--</option>
                                <?php
                                $list = $this->db->query("SELECT * FROM detadk ORDER BY id_detadk ASC");
                                foreach ($list->result() as $det) {
                                ?>
                                    <option value="<?= $det->id_detadk ?>" <?php if ($dt["id_detadk"] == $det->id_detadk) {
                                                                                echo 'selected';
                                                                            } ?>><?= $det->nm_adk ?></option>
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