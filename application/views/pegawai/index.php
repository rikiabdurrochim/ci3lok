<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#input">
    Tambah Data
</button>
<?= $this->session->flashdata('message') ?>
<div class="card">
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Pangkat</th>
                        <th>Gol</th>
                        <th>Jabatan</th>
                        <th>Unit</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Foto</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data_pegawai as $pegawai) :
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $pegawai['username']; ?></td>
                            <td><?= $pegawai['nm_peg']; ?></td>
                            <td><?= $pegawai['nik']; ?></td>
                            <td><?= $pegawai['pangkat']; ?></td>
                            <td><?= $pegawai['gol']; ?></td>
                            <td><?= $pegawai['jabatan']; ?></td>
                            <td><?= $pegawai['nm_unit']; ?></td>
                            <td><?= $pegawai['alamat_peg']; ?></td>
                            <td><?= $pegawai['jk']; ?></td>
                            <td><img src="<?php echo base_url() ?>assets/img/<?php echo ($pegawai['foto']); ?>" width="50" height="50" alt="<?php echo $pegawai['foto'] ?>"></td>
                            <td style="width: 70px;">
                                <a href="#" data-toggle="modal" data-target="#modal-lihat<?php echo ($pegawai['id_peg']); ?>" data-popup="tooltip" data-placement="top" title="Lihat Data"><i class="fa fa-eye" style="color:green;"></i></a>
                                <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo ($pegawai['id_peg']); ?>" data-popup="tooltip" data-placement="top" title="Ubah Data"><i class="fa fa-edit" style="color:blue;"></i></a>
                                <a href="<?= site_url('pegawai/delete/' . $pegawai['id_peg']) ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data ?');"><i class="fa fa-trash" style="color:red;"></i></a>
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
        <form enctype="multipart/form-data" action="<?php echo site_url('pegawai/prosesinput') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data Pegawai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="username" name="username">
                    </div>
                    <div class="form-group">
                        <label>Password </label>
                        <input type="text" class="form-control" placeholder="password" name="password">
                    </div>
                    <div class="form-group">
                        <label>Email </label>
                        <input type="email" class="form-control" placeholder="email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Nama </label>
                        <input type="text" class="form-control" placeholder="Nama" name="nm_peg">
                    </div>
                    <div class="form-group">
                        <label>Alamat </label>
                        <textarea class="form-control" rows="2" name="alamat_peg" placeholder="Alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label>NIK </label>
                        <input type="text" maxlength="8" minlength="8" class="form-control" placeholder="NIK" name="nik">
                    </div>
                    <div class="form-group">
                        <label>Pangkat </label>
                        <input type="text" class="form-control" placeholder="Pangkat" name="pangkat">
                    </div>
                    <div class="form-group">
                        <label>Gol </label>
                        <input type="text" class="form-control" placeholder="Gol" name="gol">
                    </div>
                    <div class="form-group">
                        <label>Jabatan </label>
                        <input type="text" class="form-control" placeholder="Jabatan" name="jabatan">
                    </div>
                    <div class="form-group">
                        <label>Unit </label>
                        <select class="form-control" name="unit" id="unit">
                            <option value="">--Pilih--</option>
                            <?php
                            $unit = $this->db->query("SELECT * FROM unit ")->result();
                            foreach ($unit as $u) {
                            ?> <option value="<?= $u->id_unit ?>"><?= $u->nm_unit ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin </label>
                        <select class="form-control" name="jk">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Upload Foto </label>
                        <input type="file" id="foto" name="foto" class="foto" placeholder="foto">
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
foreach ($data_pegawai as $pegawai) :
    $no++;
?>
    <div class="modal fade" id="modal-edit<?php echo ($pegawai['id_peg']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('pegawai/prosesupdate') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Ubah Data Pegawai</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="id_peg" name="id_peg" value="<?php echo $pegawai['id_peg'] ?>">
                            <label">Username </label>
                                <input type="text" class="form-control" placeholder="username" name="username" value="<?php echo $pegawai['username'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Password </label>
                            <input type="text" class="form-control" placeholder="password" name="password" value="<?php echo $pegawai['password'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Email </label>
                            <input type="text" class="form-control" placeholder="email" name="email" value="<?php echo $pegawai['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama </label>
                            <input type="text" class="form-control" placeholder="Nama" name="nm_peg" value="<?php echo $pegawai['nm_peg'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat </label>
                            <textarea class="form-control" rows="2" name="alamat_peg" placeholder="Alamat"><?php echo $pegawai['alamat_peg'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>NIK </label>
                            <input type="text" class="form-control" maxlength="8" placeholder="NIK" name="nik" value="<?php echo $pegawai['nik'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Pangkat </label>
                            <input type="text" class="form-control" placeholder="Pangkat" name="pangkat" value="<?php echo $pegawai['pangkat'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Gol </label>
                            <input type="text" class="form-control" placeholder="Gol" name="gol" value="<?php echo $pegawai['gol'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Jabatan </label>
                            <input type="text" class="form-control" placeholder="Jabatan" name="jabatan" value="<?php echo $pegawai['jabatan'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Unit </label>
                            <select class="form-control" name="unit" id="unit">
                                <option value="">--Pilih--</option>
                                <?php
                                $unit = $this->db->query("SELECT * FROM unit ")->result();
                                foreach ($unit as $u) {
                                ?> <option value="<?= $u->id_unit ?>" <?php if ($pegawai['unit'] == $u->id_unit) {
                                                                            echo 'selected';
                                                                        } ?>>
                                        <?= $u->nm_unit ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin </label>
                            <select class="form-control" name="jk">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" <?php if ($pegawai['jk'] == 'Laki-laki') {
                                                                echo 'selected';
                                                            } ?>>Laki-Laki</option>
                                <option value="Perempuan" <?php if ($pegawai['jk'] == 'Perempuan') {
                                                                echo 'selected';
                                                            } ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Upload Foto </label>
                            <input type="file" id="foto_edit" name="foto" class="foto" placeholder="foto">
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

<!-- lihat modal -->
<?php
$no = 0;
foreach ($data_pegawai as $pegawai) :
    $no++;
?>
    <div class="modal fade" id="modal-lihat<?php echo ($pegawai['id_peg']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('pegawai/prosesinput') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Lihat Data Pegawai</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= $pegawai['username']; ?></td>
                                                <td><?= $pegawai['email']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>

<script>
    var tambah_foto = document.getElementById("foto");
    tambah_foto.onchange = function() {
        if (this.files[0].size > 1000000) { // for 150 kb 
            alert("File terlalu besar!");
            alert("Maksimal size 1Mb, Silahkan pilih ulang!");
            $("#foto").val('');
        };
    };
    var edit_foto = document.getElementById("foto_edit");
    edit_foto.onchange = function() {
        if (this.files[0].size > 1000000) { // for 150 kb 
            alert("File terlalu besar!");
            alert("Maksimal size 1Mb, Silahkan pilih ulang!");
            this.value = "";
        };
    };
</script>