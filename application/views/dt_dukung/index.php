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
                        <th>Nama Data</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data_dtduk as $dt) :
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $dt['nm_jenis']; ?></td>
                            <td><?= $dt['nm_dt']; ?></td>
                            <td style="width: 70px;">
                                <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo ($dt['id_dtduk']); ?>" data-popup="tooltip" data-placement="top" title="Ubah Data"><i class="fa fa-edit" style="color:blue;"></i></a>
                                <a href="<?= site_url('dtduk/delete/' . $dt['id_dtduk']) ?>"><i class="fa fa-trash" style="color:red;"></i></a>
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
        <form enctype="multipart/form-data" action="<?php echo site_url('dtduk/prosesinput') ?>" method="post">
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
                        <select style="width: 200px" name="id_peg" class="form-control" autocomplete="off">
                            <option value="">--PILIH--</option>
                            <?php
                            $list = $this->db->query("SELECT * FROM jenis ORDER BY id_jenis ASC");
                            foreach ($list->result() as $jns) {
                            ?>
                                <option value="<?php echo $jns->id_jenis ?>"><?php echo $jns->nm_jenis ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ADK</label>
                        <input type="text" class="form-control" placeholder="id ajuan" name="nm_dt">
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
foreach ($data_dtduk as $dt) :
    $no++;
?>
    <div class="modal fade" id="modal-edit<?php echo ($dt['id_dtduk']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('dtduk/prosesupdate') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="id_dtduk" name="id_dtduk" value="<?php echo $dt['id_dtduk'] ?>">
                            <label">Jenis </label>
                                <select class="form-control" name="jenis_id" id="jenis_id">
                                    <option value="">--Pilih--</option>
                                    <?php
                                    $list = $this->db->query("SELECT * FROM jenis ORDER BY id_jenis ASC");
                                    foreach ($list->result() as $jns) {
                                    ?>
                                        <option value="<?= $jns->id_jenis ?>" <?php if ($dt["jenis_id"] == $jns->id_jenis) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $jns->nm_jenis ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>ADK </label>
                            <input type="text" class="form-control" placeholder="Nama Data" name="nm_dt" value="<?php echo $dt['nm_dt'] ?>">
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