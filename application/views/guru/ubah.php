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
                        <a href="<?= base_url('guru') ?>">Guru</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="">Ubah <?= $position ?></a>
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
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Name" value="<?= $guru['nama_guru'] ?>">
                            <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" class="form-control" name="nip" placeholder="Name" value="<?= $guru['nip'] ?>">
                            <?= form_error('nip', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Jabatan</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="jabatan">
                                <?php
                                foreach ($jabatan as $j) {
                                    if ($guru['jabatan'] != $j) {
                                        ?>
                                        <option value="<?= $j ?>"><?= $j ?></option>
                                    <?php
                                        } else {
                                            ?>
                                        <option value="<?= $j ?>" selected><?= $j ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="jenis_kelamin">
                                <?php
                                if ($guru['jenis_kelamin'] != 'L') {
                                    ?>
                                    <option value="P" selected>Perempuan</option>
                                    <option value="L">Laki-laki</option>
                                <?php
                                } else {
                                    ?>
                                    <option value="P">Perempuan</option>
                                    <option value="L" selected>Laki-laki</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pendidikan Terakhir</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="pendidikan">
                                <?php
                                foreach ($pendidikan as $p) {
                                    if ($guru['pendidikan_terakhir'] != $p) {
                                        ?>
                                        <option value="<?= $p ?>"><?= $p ?></option>
                                    <?php
                                        } else {
                                            ?>
                                        <option value="<?= $p ?>" selected><?= $p ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label>Mata Pelajaran</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="mapel">
                                <?php
                                foreach ($mapel as $m) {
                                    if ($guru['id_mapel'] != $m['id_mapel']) {
                                        ?>
                                        <option value="<?= $m['id_mapel'] ?>"><?= $m['mata_pelajaran'] ?></option>
                                    <?php
                                        } else {
                                            ?>
                                        <option value="<?= $m['id_mapel'] ?>" selected><?= $m['mata_pelajaran'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <?php
                        if ($admin['akses'] == "Administrator") {
                            ?>
                            <div class="form-group ">
                                <label>Status</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="aktif">
                                    <?php
                                        if ($guru['aktif'] != 'Y') {
                                            ?>
                                        <option value="N" selected>Tidak Aktif</option>
                                        <option value="Y">Aktif</option>
                                    <?php
                                        } else {
                                            ?>
                                        <option value="N">Tidak Aktif</option>
                                        <option value="Y" selected>Aktif</option>
                                    <?php
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="form-group ">
                                <label>Penilai</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="penilai">
                                    <?php
                                        foreach ($penilai as $p) {
                                            if ($guru['id_admin'] != $p['id_admin']) {
                                                ?>
                                            <option value="<?= $p['id_admin'] ?>"><?= $p['nama'] ?></option>
                                        <?php
                                                } else {
                                                    ?>
                                            <option value="<?= $p['id_admin'] ?>" selected><?= $p['nama'] ?></option>
                                    <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </div>
                        <?php } ?>

                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-primary" name="ubah" onclick="return confirm('Are you sure want to edit?')">Ubah</button>
                        <a href=" <?= base_url('guru') ?>" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>