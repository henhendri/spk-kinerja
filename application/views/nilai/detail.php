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
                        <a href="<?= base_url('nilai') ?>">Nilai</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="">Detail <?= $position ?></a>
                    </li>
                </ul>
            </div>
            <?php if ($this->session->flashdata('done')) { ?>
                <div class="alert alert-success alert-dismissable" id="close_alert">
                    <h4><?= $this->session->flashdata('done'); ?></h4>
                </div>
            <?php } else if ($this->session->flashdata('kosong')) { ?>
                <div class="alert alert-danger alert-dismissable">
                    <h4><?= $this->session->flashdata('kosong'); ?> <a href="<?= base_url('nilai') ?>">disini</a></h4>
                </div>
            <?php } else if ($this->session->flashdata('belum')) { ?>
                <div class="alert alert-danger alert-dismissable">
                    <h4><?= $this->session->flashdata('belum'); ?></h4>
                </div>
            <?php } ?>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">
                            Detail <?= $position ?> <?= $guru['0']['nama_guru'] ?>
                        </h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <h2>Nilai Guru</h2>
                        <table class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <?php
                                    foreach ($kriteria as $k) {
                                        ?>
                                        <th><?= $k['nama_kriteria'] ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                <tr>
                                    <?php
                                    foreach ($nilai_guru as $n) {
                                        ?>
                                        <td><?= $n['nilai_guru'] ?></td>
                                    <?php }  ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <?php if ($this->session->flashdata('belum')) { ?>
                    <?php } else { ?>
                        <h2>Hasil Kinerja <?= $guru['0']['nama_guru'] ?> adalah <?= $kinerja['nama_alternatif'] ?></h2>
                    <?php } ?>

                    <p>
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Detail Perhitungan
                        </a>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="table-responsive">
                            <h2>Rating Kinerja</h2>
                            <table id="add" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 6%">No</th>
                                        <th style="width: 10%">Alternatif</th>
                                        <?php
                                        foreach ($kriteria as $k) {
                                            ?>
                                            <th><?= $k['nama_kriteria'] ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $index = 0;
                                    foreach ($alternatif as $a) {
                                        ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $a['nama_alternatif'] ?></td>
                                            <?php
                                                foreach ($kriteria as $k) {
                                                    if ($nilai == null) {
                                                        ?>
                                                    <td>0</td>
                                                <?php } else { ?>
                                                    <td><?= $nilai[$index]['nilai'] ?></td>
                                                <?php } ?>
                                            <?php
                                                    $index = $index + 1;
                                                }
                                                ?>
                                        </tr>
                                    <?php
                                        $no = $no + 1;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <div class="table-responsive">
                            <h2>Nilai Normalisasi</h2>
                            <table id="add" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 6%">No</th>
                                        <th style="width: 10%">Nama</th>
                                        <?php
                                        foreach ($kriteria as $k) {
                                            ?>
                                            <th><?= $k['nama_kriteria'] ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $index = 0;
                                    foreach ($alternatif as $a) {
                                        ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $a['nama_alternatif'] ?></td>
                                            <?php
                                                foreach ($kriteria as $k) {
                                                    if ($nilai == null) {
                                                        ?>
                                                    <td>0</td>
                                                <?php } else { ?>
                                                    <td><?= $nilai[$index]['normalisasi'] ?></td>
                                                <?php } ?>
                                            <?php
                                                    $index = $index + 1;
                                                }
                                                ?>
                                        </tr>
                                    <?php
                                        $no = $no + 1;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <div class="table-responsive">
                            <h2>Nilai Terbobot</h2>
                            <table id="add" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 6%">No</th>
                                        <th style="width: 10%">Nama</th>
                                        <?php
                                        foreach ($kriteria as $k) {
                                            ?>
                                            <th><?= $k['nama_kriteria'] ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $index = 0;
                                    foreach ($alternatif as $a) {
                                        ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $a['nama_alternatif'] ?></td>
                                            <?php
                                                foreach ($kriteria as $k) {
                                                    if ($nilai == null) {
                                                        ?>
                                                    <td>0</td>
                                                <?php } else { ?>
                                                    <td><?= $nilai[$index]['terbobot'] ?></td>
                                                <?php } ?>
                                            <?php
                                                    $index = $index + 1;
                                                }
                                                ?>
                                        </tr>
                                    <?php
                                        $no = $no + 1;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <div class="table-responsive">
                            <h2>Nilai A+</h2>
                            <table class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <?php
                                        foreach ($kriteria as $k) {
                                            ?>
                                            <th><?= $k['nama_kriteria'] ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    <tr>
                                        <?php
                                        foreach ($A_plus as $a) {
                                            ?>
                                            <td><?= $a['nilai_a'] ?></td>
                                        <?php }  ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <div class="table-responsive">
                            <h2>Nilai A-</h2>
                            <table class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <?php
                                        foreach ($kriteria as $k) {
                                            ?>
                                            <th><?= $k['nama_kriteria'] ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    <tr>
                                        <?php
                                        foreach ($A_min as $a) {
                                            ?>
                                            <td><?= $a['nilai_a'] ?></td>
                                        <?php }  ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <div class="table-responsive">
                            <h2>Hasil</h2>
                            <table id="add" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 6%">No</th>
                                        <th style="width: 10%">Nama</th>
                                        <th>Jarak Solisi Ideal Positif (D+)</th>
                                        <th>Jarak Solisi Ideal Negatif (D-)</th>
                                        <th>Nilai Preferensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $index = 0;
                                    foreach ($alternatif as $a) {
                                        ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $a['nama_alternatif'] ?></td>
                                            <td><?= $hasil[$index][0] ?></td>
                                            <td><?= $hasil[$index][1] ?></td>
                                            <td><?= $hasil[$index][2] ?></td>
                                            <?php
                                                $index = $index + 1;
                                                ?>
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

</div>