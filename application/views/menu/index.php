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
                        <th>Nama Menu</th>
                        <th>Link Akses</th>
                        <th>Icon Menu</th>
                        <th>Status Menu</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data_menu as $menu) :
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $menu['nm_menu']; ?></td>
                            <td><?= $menu['link_akses']; ?></td>
                            <td><?= $menu['icon_menu']; ?></td>
                            <td><?= $menu['status_mn']; ?></td>
                            <td style="width: 70px;">
                                <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo ($menu['id_menu']); ?>" data-popup="tooltip" data-placement="top" title="Ubah Data"><i class="fa fa-edit" style="color:blue;"></i></a>
                                <a href="<?= site_url('menu/delete/' . $menu['id_menu']) ?>"><i class="fa fa-trash" style="color:red;"></i></a>
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
        <form enctype="multipart/form-data" action="<?php echo site_url('menu/prosesinput') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Treeview</label>
                        <select class="form-control" name="id_treeview" id="id_treeview">
                            <option value="">--Pilih--</option>
                            <?php
                            $get_treeview = $this->db->query("SELECT * FROM treeview")->result();
                            foreach ($get_treeview as $treeview) { ?>
                                <option value="<?= $treeview->id_treeview ?>"><?= $treeview->nama_treeview ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Menu</label>
                        <input type="text" class="form-control" placeholder="nama menu" name="nm_menu">
                    </div>
                    <div class="form-group">
                        <label>Link Akses</label>
                        <input type="text" class="form-control" placeholder="link akses" name="link_akses">
                    </div>
                    <div class="form-group">
                        <label>Icon Menu</label>
                        <input type="text" class="form-control" placeholder="icon menu" name="icon_menu">
                    </div>
                    <div class="form-group">
                        <label>Status Menu</label>
                        <select class="form-control" name="status_mn" id="status_mn">
                            <option value="">--Pilih--</option>
                            <option value="sidebar">SIDEBAR</option>
                            <option value="aksi">AKSI</option>
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
foreach ($data_menu as $menu) :
    $id_treeview = $menu['id_treeview'];
    $status_mn = $menu['status_mn'];
    $no++;
?>
    <div class="modal fade" id="modal-edit<?php echo ($menu['id_menu']); ?>">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" action="<?php echo site_url('menu/prosesupdate') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_menu" id="id_menu" value="<?php echo $menu['id_menu']; ?>">
                        <div class="form-group">
                            <label>Treeview</label>
                            <select class="form-control" name="id_treeview" id="id_treeview">
                                <option value="">--Pilih--</option>
                                <?php
                                $get_treeview = $this->db->query("SELECT * FROM treeview")->result();
                                foreach ($get_treeview as $treeview) { ?>
                                    <option value="<?= $treeview->id_treeview ?>" <?php if ($id_treeview == $treeview->id_treeview) {
                                                                                        echo 'selected';
                                                                                    } ?>><?= $treeview->nama_treeview ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label">Nama Menu </label>
                                <input type="text" class="form-control" placeholder="Nama Menu" name="nm_menu" value="<?php echo $menu['nm_menu'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Link Akses </label>
                            <input type="text" class="form-control" placeholder="Link Akses " name="link_akses" value="<?php echo $menu['link_akses'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Icon Menu </label>
                            <input type="text" class="form-control" placeholder="Icon Menu " name="icon_menu" value="<?php echo $menu['icon_menu'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Status Menu</label>
                            <select class="form-control" name="status_mn" id="status_mn">
                                <option value="">--Pilih--</option>
                                <option value="sidebar" <?php if ($status_mn == 'sidebar') {
                                                            echo 'selected';
                                                        } ?>>SIDEBAR</option>
                                <option value="aksi" <?php if ($status_mn == 'aksi') {
                                                            echo 'selected';
                                                        } ?>>AKSI</option>
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