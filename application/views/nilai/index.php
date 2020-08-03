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
            <?php } else if ($this->session->flashdata('kosong')) { ?>
                <div class="alert alert-danger alert-dismissable">
                    <h4><?= $this->session->flashdata('kosong'); ?>
                        <!--<a href="<?= base_url('nilai') ?>">disini</a>-->
                    </h4>
                </div>
            <?php } ?>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title"><?= $position ?> Tahun <?= $periode['waktu'] ?></h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 6%">No</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
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
                                        <td>
                                            <div class="form-button-action">
                                                <a href="<?= base_url('nilai/detail/') . $g['id_guru'] ?>" class="btn btn-link btn-warning">
                                                    <i class="fas fa-clipboard-list">Detail</i>
                                                </a>
                                                <a href="<?= base_url('nilai/hitung/') . $g['id_guru'] ?>" class="btn btn-link btn-success" onclick="return confirm('Are you sure want to calculate?')">
                                                    <i class="fas fa-calculator">Hitung</i>
                                                </a>
                                                <a href="<?= base_url('nilai/ubah/') . $g['id_guru'] ?>" class="btn btn-link btn-primary">
                                                    <i class="fas fa-edit">Ubah</i>
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