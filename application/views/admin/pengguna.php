<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <!-- <h4 class="page-title">Data <?= $position ?></h4> -->
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="<?= base_url('admin') ?>">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href=""><?= $position ?></a>
                    </li>
                </ul>
            </div>
            <?php if ($this->session->flashdata('done')) { ?>
                <div class="alert alert-success alert-dismissable" id="close_alert">
                    <h4><?= $this->session->flashdata('done'); ?></h4>
                </div>
            <?php } ?>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title"><?= $position ?></h4>
                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Tambah <?= $position ?>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Modal -->
                    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">
                                            Tambah <?= $position; ?> Baru
                                        </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nama</label>
                                                    <input id="addTime" name="nama" type="text" class="form-control" placeholder="Nama Lengkap">
                                                </div>
                                                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                                <div class="form-group form-group-default">
                                                    <label>Email</label>
                                                    <input id="addTime" name="email" type="text" class="form-control" placeholder="Email">
                                                </div>
                                                <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                                <div class="form-group form-group-default">
                                                    <label>Password</label>
                                                    <input id="addTime" name="password" type="password" class="form-control" placeholder="Password">
                                                </div>
                                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                                <div class="form-group form-group-default">
                                                    <label>Konfirmasi Password</label>
                                                    <input id="addTime" name="confirmpassword" type="password" class="form-control" placeholder="Konfirmasi Password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer no-bd">
                                        <button type="submit" id="addRowButton" class="btn btn-primary">Tambah</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 6%">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Akses</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($pengguna as $p) {
                                    ?>
                                    <tr>
                                        <form action="<?= base_url('admin/ubah/' . $p['id_admin']) ?>" method="post">
                                            <td><?= $no ?></td>
                                            <td><?= $p['nama'] ?></td>
                                            <td><?= $p['email'] ?></td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control" id="exampleFormControlSelect1" name="akses">
                                                        <?php
                                                            foreach ($akses as $a) {
                                                                if ($p['akses'] != $a) {
                                                                    ?>
                                                                <option value="<?= $a ?>"><?= $a ?></option>
                                                            <?php
                                                                    } else {
                                                                        ?>
                                                                <option value="<?= $a ?>" selected><?= $a ?></option>
                                                        <?php
                                                                }
                                                            }
                                                            ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="submit" class="btn btn-link btn-primary" onclick="return confirm('Are you sure want to update akses?')">
                                                        <i class="fas fa-edit">Ubah</i>
                                                    </button>
                                                    <a href="<?= base_url('admin/reset/' . $p['id_admin']) ?>" class="btn btn-link btn-warning">
                                                        <i class="fas fa-unlock-alt">Reset</i>
                                                    </a>
                                                    <a href="<?= base_url('admin/hapus/' . $p['id_admin']) ?>" class="btn btn-link btn-danger" onclick="return confirm('Are you sure want to delete?')">
                                                        <i class="fas fa-times">Hapus</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php
                                    $no = $no + 1;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>