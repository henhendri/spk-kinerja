<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <!-- <h4 class="page-title"><?= $position ?></h4> -->
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
                        <a href="<?= base_url('admin/pengguna') ?>">Pengguna</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href=""><?= $position ?></a>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title"><?= $position ?></h4>
                    </div>
                </div>
                <form method="post" action="">
                    <div class="card-body col-md-6">
                        <input type="text" name="idadmin" value="<?= $pengguna['id_admin'] ?>" hidden>
                        <div class="form-group">
                            <label class="control-label">
                                Nama
                            </label>
                            <p class="form-control-static"><?= $pengguna['nama'] ?></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">
                                Email
                            </label>
                            <p class="form-control-static"><?= $pengguna['email'] ?></p>
                        </div>
                        <div class=" form-group">
                            <label for="newpassword" class="placeholder"><b>Password Baru</b></label>
                            <div class="position-relative">
                                <input id="newpassword" name="newpassword" type="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword" class="placeholder"><b>Konfirmasi Password</b></label>
                            <div class="position-relative">
                                <input id="confirmpassword" name="confirmpassword" type="password" class="form-control">
                                <?= form_error('newpassword', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-primary" name="reset" onclick="return confirm('Are you sure want to reset password?')">Reset</button>
                        <a href=" <?= base_url('admin/pengguna') ?>" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>