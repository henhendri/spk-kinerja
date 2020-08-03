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
            <?php if ($this->session->flashdata('flash')) { ?>
            <div class="alert alert-success alert-dismissable" id="close_alert">
                <h4><?= $this->session->flashdata('flash'); ?></h4>
            </div>
            <?php } ?>
            <!-- <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title"><?= $position ?></h4>
                    </div>
                </div>
            </div>
            <div class="card-body">

            </div> -->
            <h2>Pilih Periode</h2>
            <div class="row">
                <?php
                foreach ($periode as $p) {
                    ?>
                <div class="col-md-2">
                    <div class="card card-info card-round">
                        <div class="card-body text-center">
                            <h2><?= $p['waktu'] ?></h2>
                            <div class="card-detail">
                                <div class="btn btn-light btn-rounded">Lihat</div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

</div>