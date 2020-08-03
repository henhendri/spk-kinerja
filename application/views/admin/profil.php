<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <h4 class="page-title"><?= $position ?></h4>
            <div class="row">
                <div class="col-md-4">
                    <?php if ($this->session->flashdata('done')) { ?>
                    <div class="alert alert-success" role="alert" id="close_alert">
                        <?= $this->session->flashdata('done'); ?>
                    </div>
                    <?php } else if ($this->session->flashdata('fail')) { ?>
                    <div class="alert alert-danger" role="alert" id="close_alert">
                        <?= $this->session->flashdata('fail'); ?>
                    </div>
                    <?php } ?>

                    <div class="card card-profile card-secondary">
                        <div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
                            <div class="profile-picture">
                                <div class="avatar avatar-xl">
                                    <img src="<?= base_url('assets/img/profil/') . $admin['foto']; ?>" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-profile text-center">
                                <div class="name"><?= $admin['nama']; ?></div>
                                <div class="job"><?= $admin['email']; ?></div>
                                <div class="desc"><?= $admin['akses']; ?></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="view-profile mb-2">
                                <a data-toggle="collapse" href="#collapsedata" role="button" aria-expanded="false" class="btn btn-info btn-block">Ubah Data</a>
                            </div>
                            <div class="view-profile mb-2">
                                <a data-toggle="collapse" href="#collapsepassword" role="button" aria-expanded="false" class="btn btn-warning btn-block">Ubah Password</a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Ubah Data -->
                    <div class="collapse" id="collapsedata">
                        <div class="card">
                            <div class="card-header">
                                <h4>Ubah Data</h4>
                            </div>
                            <form method="post" action="<?= base_url('admin/ubah_data') ?>" enctype="multipart/form-data">
                                <div class="card-body col-md-8">
                                    <input type="text" name="idadmin" value="<?= $admin['id_admin'] ?>" hidden>
                                    <div class=" form-group">
                                        <label for="name" class="placeholder"><b>Nama</b></label>
                                        <div class="position-relative">
                                            <input id="name" name="name" type="text" class="form-control" value="<?= $admin['nama'] ?>">
                                        </div>
                                        <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="exampleFormControlFile1">Foto</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1"> -->

                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button type="submit" class="btn btn-primary" name="ubah" onclick="return confirm('Are you sure want to edit?')">Ubah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Ubah Password -->
                    <div class="collapse" id="collapsepassword">
                        <div class="card">
                            <div class="card-header">
                                <h4>Ubah Password</h4>
                            </div>
                            <form method="post" action="<?= base_url('admin/ubah_password') ?>">
                                <div class="card-body col-md-8">
                                    <input type="text" name="idadmin" value="<?= $admin['id_admin'] ?>" hidden>
                                    <div class=" form-group">
                                        <label for="oldpassword" class="placeholder"><b>Password Lama</b></label>
                                        <div class="position-relative">
                                            <input id="oldpassword" name="oldpassword" type="password" class="form-control">
                                        </div>
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
                                        </div>
                                        <?= form_error('newpassword', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button type="submit" class="btn btn-primary" name="ubah" onclick="return confirm('Are you sure want to edit password?')">Ubah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>