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
                        <th>No. Ajuan</th>
                        <th>Transport</th>
                        <th>Uang Harian</th>
                        <th>Penginapan</th>
                        <th>Jumlah</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data_detajuan as $da) :
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $da['no_ajuan']; ?></td>
                            <td>Rp. <?= number_format($da['transport'], 0, ',', '.'); ?></td>
                            <td>Rp. <?= number_format($da['uang_harian'], 0, ',', '.'); ?></td>
                            <td>Rp. <?= number_format($da['penginapan'], 0, ',', '.'); ?></td>
                            <td>Rp. <?= number_format($da['transport'] + $da['uang_harian'] + $da['penginapan'], 0, ',', '.'); ?></td>
                            <td style="width: 70px;">
                                <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo ($da['id_da']); ?>" data-popup="tooltip" data-placement="top" title="Ubah Data"><i class="fa fa-edit" style="color:blue;"></i></a>
                                <a href="<?= site_url('detajuan/delete/' . $da['id_da']) ?>"><i class="fa fa-trash" style="color:red;"></i></a>
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
        <form enctype="multipart/form-data" action="<?php echo site_url('detajuan/prosesinput') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>No Ajuan</label>
                    <select style="width: 200px" name="id_ajuan" class="form-control" autocomplete="off">
                        <option value="">--PILIH--</option>
                        <?php
                        $list = $this->db->query("SELECT * FROM ajuan ORDER BY id_ajuan ASC");
                        foreach ($list->result() as $ajuan) {
                        ?>
                            <option value="<?php echo $ajuan->id_ajuan ?>"><?php echo $ajuan->no_ajuan ?></option>
                        <?php } ?>
                    </select>
                    <div class="form-group">
                        <label>Transportasi</label>
                        <input type="text" class="form-control" placeholder="transport" name="transport">
                    </div>
                    <div class="form-group">
                        <label>Uang Harian</label>
                        <input type="text" class="form-control" placeholder="uang harian" name="uang_harian">
                    </div>
                    <div class="form-group">
                        <label>Penginapan</label>
                        <input type="text" class="form-control" placeholder="Penginapan" name="penginapan">
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
foreach ($data_detajuan as $da) :
    $no++;
?>
    <div class="modal fade" id="modal-edit<?php echo ($da['id_da']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('detajuan/prosesupdate') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="id_da" name="id_da" value="<?php echo $da['id_da'] ?>">
                            <label">No Ajuan </label>
                                <input type="text" class="form-control" placeholder="No Ajuan" name="no_ajuan" value="<?php echo $da['no_ajuan'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Transport </label>
                            <input type="text" class="form-control" placeholder="Link Akses " name="link_akses" value="<?php echo $da['transport'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Uang Harian </label>
                            <input type="text" class="form-control" placeholder="Uang Harian " name="uang_harian" value="<?php echo $da['uang_harian'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Penginapan </label>
                            <input type="text" class="form-control" placeholder="Uang Harian " name="uang_harian" value="<?php echo $da['penginapan'] ?>">
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