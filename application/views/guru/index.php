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
                        <?php if ($admin['akses'] == "Administrator") { ?>
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                <i class="fa fa-plus"></i>
                                Tambah <?= $position ?>
                            </button>
                        <?php } ?>
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
                                                    <input id="addTime" name="nama" type="text" class="form-control" placeholder="Nama Guru">
                                                </div>
                                                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                                <div class="form-group form-group-default">
                                                    <label>NIP</label>
                                                    <input id="addTime" name="nip" type="text" class="form-control" placeholder="NIP">
                                                </div>
                                                <?= form_error('nip', '<small class="text-danger">', '</small>'); ?>
                                                <div class="form-group form-group-default">
                                                    <label>Jabatan</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" name="jabatan">
                                                        <?php
                                                        foreach ($jabatan as $p) {
                                                            ?>
                                                            <option value="<?= $p ?>"><?= $p ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group form-group-default">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" name="jenis_kelamin">
                                                        <option value="L">Laki-Laki</option>
                                                        <option value="P">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group form-group-default">
                                                    <label>Pendidikan Terakhir</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" name="pendidikan">
                                                        <?php
                                                        foreach ($pendidikan as $p) {
                                                            ?>
                                                            <option value="<?= $p ?>"><?= $p ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group form-group-default">
                                                    <label>Mata Pelajaran</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" name="mapel">
                                                        <?php
                                                        foreach ($mapel as $m) {
                                                            ?>
                                                            <option value="<?= $m['id_mapel'] ?>"><?= $m['mata_pelajaran'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group form-group-default">
                                                    <label>Penilai</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" name="penilai">
                                                        <?php
                                                        foreach ($penilai as $p) {
                                                            ?>
                                                            <option value="<?= $p['id_admin'] ?>"><?= $p['nama'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
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
                                    <th>Nama Guru</th>
                                    <th>NIP</th>
                                    <th>Jabatan</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Penilai</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($guru as $g) {
                                    ?>
                                    <tr>

                                        <td><?= $no ?></td>
                                        <td><?= $g['nama_guru'] ?></td>
                                        <td><?= $g['nip'] ?></td>
                                        <td><?= $g['jabatan'] ?></td>
                                        <td><?= $g['mata_pelajaran'] ?></td>
                                        <td><?= $g['nama'] ?></td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="<?= base_url('guru/detail/') . $g['id_guru'] ?>" class="btn btn-link btn-warning">
                                                    <i class="fas fa-clipboard-list">Detail</i>
                                                </a>
                                                <a href="<?= base_url('guru/ubah/') . $g['id_guru'] ?>" class="btn btn-link btn-primary">
                                                    <i class="fas fa-edit">Ubah</i>
                                                </a>
                                                </a>
                                                <a href="<?= base_url('guru/hapus/') . $g['id_guru'] ?>" class="btn btn-link btn-danger" onclick="return confirm('Are you sure want to delete?')">
                                                    <i class="fas fa-times">Hapus</i>
                                                </a>
                                            </div>
                                        </td>
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