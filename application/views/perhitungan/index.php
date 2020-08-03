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
                        <h4 class="card-title"><?= $position ?> Tahun <?= $periode['waktu'] ?></h4>
                        <?php if ($admin['akses'] == "Administrator") { ?>
                            <a href="<?= base_url('perhitungan/hitung') ?>" class="btn btn-primary btn-round ml-auto" onclick="return confirm('Yakin kinerja akan dihitung?')">
                                <i class="fa fa-plus"></i>
                                Hitung
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <h2>Nilai Guru</h2>
                        <table id="add-row" class="display table table-striped table-hover">
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
                                foreach ($guru as $g) {
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $g['nama_guru'] ?></td>
                                        <?php
                                            foreach ($kriteria as $k) {
                                                ?>
                                            <td><?= $nilai[$index]['nilai'] ?></td>
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
                        <table id="add-row2" class="display table table-striped table-hover">
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
                                foreach ($guru as $g) {
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $g['nama_guru'] ?></td>
                                        <?php
                                            foreach ($kriteria as $k) {
                                                ?>
                                            <td><?= $nilai[$index]['normalisasi'] ?></td>
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
                        <table id="add-row3" class="display table table-striped table-hover">
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
                                foreach ($guru as $g) {
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $g['nama_guru'] ?></td>
                                        <?php
                                            foreach ($kriteria as $k) {
                                                ?>
                                            <td><?= $nilai[$index]['terbobot'] ?></td>
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
                        <table id="add-row4" class="display table table-striped table-hover">
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
                                foreach ($guru as $g) {
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $g['nama_guru'] ?></td>
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