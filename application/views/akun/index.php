<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#input">
    Tambah Data
</button>

<div class="card">
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Kode Kegiatan</th>
                    <th>Kode Akun</th>
                    <th>Nama Akun</th>
                    <th>KRO</th>
                    <th>KROAKUN</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data_akun as $akun) :
                    $no++;
                ?>
                    <tr class="text-center">
                        <td><?= $no; ?></td>
                        <td><?= $akun['kd_giat']; ?></td>
                        <td><?= $akun['kd_akun']; ?></td>
                        <td><?= $akun['nm_akun']; ?></td>
                        <td><?= $akun['kro']; ?></td>
                        <td><?= $akun['kroakun']; ?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo ($akun['id_akun']); ?>" data-popup="tooltip" data-placement="top" title="Ubah Data"><i class="fa fa-edit" style="color:blue;"></i></a>
                            <a href="<?= site_url('akun/delete/' . $akun['id_akun']) ?>"><i class="fa fa-trash" style="color:red;"></i></a>
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
        <form enctype="multipart/form-data" action="<?php echo site_url('akun/prosesinput') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data Akun</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Kegiatan </label>
                        <select class="form-control" name="kd_giat" id="kd_giat" required>
                            <option value="">--Pilih--</option>
                            <?php
                            $get_giat = $this->db->query("SELECT * FROM giat")->result();
                            foreach ($get_giat as $giat) {
                            ?> <option value="<?= $giat->id_giat ?>"><?= $giat->kegiatan ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kode Akun </label>
                        <input type="text" class="form-control" placeholder="Kode Akun" name="kd_akun">
                    </div>
                    <div class="form-group">
                        <label>Nama Akun </label>
                        <input type="text" class="form-control" placeholder="Nama Akun" name="nm_akun">
                    </div>
                    <div class="form-group">
                        <label>KRO </label>
                        <input type="text" class="form-control" placeholder="KRO" name="kro">
                    </div>
                    <div class="form-group">
                        <label>KROAKUN </label>
                        <input type="text" class="form-control" placeholder="KROAKUN" name="kroakun">
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
foreach ($data_akun as $akun) :
    $no++;
?>
    <div class="modal fade" id="modal-edit<?php echo ($akun['id_akun']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('akun/prosesupdate') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Edit Data Akun</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="id_akun" name="id_akun" value="<?php echo $akun['id_akun'] ?>">
                            <label">Kode Kegiatan </label>
                                <select class="form-control" name="kd_giat" id="kd_giat" required>
                                    <option value="">--Pilih--</option>
                                    <?php
                                    $get_giat = $this->db->query("SELECT * FROM giat")->result();
                                    foreach ($get_giat as $giat) {
                                    ?> <option value="<?= $giat->id_giat ?>" <?php if ($giat->id_giat == $akun['kd_giat']) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $giat->kegiatan ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Kode Akun </label>
                            <input type="text" class="form-control" placeholder="Kode Akun" name="kd_akun" value="<?php echo $akun['kd_akun'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Akun </label>
                            <input type="text" class="form-control" placeholder="Nama Akun" name="nm_akun" value="<?php echo $akun['nm_akun'] ?>">
                        </div>
                        <div class="form-group">
                            <label>KRO </label>
                            <input type="text" class="form-control" placeholder="KRO" name="kro" value="<?php echo $akun['kro'] ?>">
                        </div>
                        <div class="form-group">
                            <label>KROAKUN </label>
                            <input type="text" class="form-control" placeholder="KROAKUN" name="kroakun" value="<?php echo $akun['kroakun'] ?>">
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