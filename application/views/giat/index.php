<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#input">
    Tambah Data
</button>

<div class="card">
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Kegiatan</th>
                    <th>Nama Kegiatan</th>
                    <th>Kegiatan</th>
                    <th>Unit</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data_kegiatan as $giat) :
                    $no++;
                ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $giat['kd_giat']; ?></td>
                        <td><?= $giat['nm_giat']; ?></td>
                        <td><?= $giat['kegiatan']; ?></td>
                        <td><?= $giat['unit']; ?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo ($giat['id_giat']); ?>" data-popup="tooltip" data-placement="top" title="Ubah Data"><i class="fa fa-edit" style="color:blue;"></i></a>
                            <a href="<?= site_url('giat/delete/' . $giat['id_giat']) ?>"><i class="fa fa-trash" style="color:red;"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- input modal -->
<div class="modal fade" id="input">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="<?php echo site_url('giat/prosesinput') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data Kegiatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Kegiatan </label>
                        <input type="text" class="form-control" placeholder="Kode Kegiatan" name="kd_giat">
                    </div>
                    <div class="form-group">
                        <label>Nama Kegiatan </label>
                        <input type="text" class="form-control" placeholder="Nama Kegiatan" name="nm_giat">
                    </div>
                    <div class="form-group">
                        <label>Kegiatan </label>
                        <input type="text" class="form-control" placeholder="Kegiatan" name="kegiatan">
                    </div>
                    <div class="form-group">
                        <label>Unit </label>
                        <input type="text" class="form-control" placeholder="Unit" name="unit">
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
foreach ($data_kegiatan as $giat) :
    $no++;
?>
    <div class="modal fade" id="modal-edit<?php echo ($giat['id_giat']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('giat/prosesupdate') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="id_giat" name="id_giat" value="<?php echo $giat['id_giat'] ?>">
                            <label">Kode Kegiatan </label>
                                <input type="text" class="form-control" placeholder="Kode Kegiatan" name="kd_giat" value="<?php echo $giat['kd_giat'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Kegiatan </label>
                            <input type="text" class="form-control" placeholder="Nama Kegiatan" name="nm_giat" value="<?php echo $giat['nm_giat'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Kegiatan </label>
                            <input type="text" class="form-control" placeholder="Kegiatan" name="kegiatan" value="<?= $giat['kegiatan'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Unit </label>
                            <input type="text" class="form-control" placeholder="Unit" name="unit" value="<?= $giat['unit'] ?>">
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