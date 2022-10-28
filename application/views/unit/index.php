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
                        <th>Nama Unit</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data_unit as $unit) :
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $unit['nm_unit']; ?></td>
                            <td style="width: 70px;">
                                <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo ($unit['id_unit']); ?>" data-popup="tooltip" data-placement="top" title="Ubah Data"><i class="fa fa-edit" style="color:blue;"></i></a>
                                <a href="<?= site_url('unit/delete/' . $unit['id_unit']) ?>"><i class="fa fa-trash" style="color:red;"></i></a>
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
        <form enctype="multipart/form-data" action="<?php echo site_url('unit/prosesinput') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama unit</label>
                        <input type="text" class="form-control" placeholder="nama unit" name="nm_unit">
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
foreach ($data_unit as $unit) :
    $no++;
?>
    <div class="modal fade" id="modal-edit<?php echo ($unit['id_unit']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('unit/prosesupdate') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="id_unit" name="id_unit" value="<?php echo $unit['id_unit'] ?>">

                            <label>Nama unit </label>
                            <input type="text" class="form-control" placeholder="Nama unit" name="nm_unit" value="<?php echo $unit['nm_unit'] ?>">
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