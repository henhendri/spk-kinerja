		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title"><?= $position ?></h4>
					</div>
					<?php if ($this->session->flashdata('done')) { ?>
						<div class="alert alert-success alert-dismissable" id="close_alert">
							<h4><?= $this->session->flashdata('done'); ?></h4>
						</div>
					<?php } ?>
					<div class="row">
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-info bubble-shadow-small">
												<i class="far fa-clock"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Periode Aktif</p>
												<h4 class="card-title"><?= $aktif['waktu'] ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-primary bubble-shadow-small">
												<i class="far fa-id-card"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Jumlah Guru</p>
												<h4 class="card-title"><?= $guru ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-secondary bubble-shadow-small">
												<i class="far fa-folder-open"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Mata Pelajaran</p>
												<h4 class="card-title"><?= $mapel ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-warning bubble-shadow-small">
												<i class="far fa-user-circle"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Jumlah Penilai</p>
												<h4 class="card-title"><?= $penilai['jumlah'] ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-7">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Persentase Alternatif</div>
									</div>
								</div>
								<div class="card-body">
									<div class="card-body">
										<div class="chart-container">
											<canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-5">
							<div class="card card-stats<?php if ($status['0'] == "Perhitungan Selesai") { ?> card-success bg-success-gradient <?php } else {  ?> card-danger bg-danger-gradient <?php } ?>card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<?php
											if ($status['0'] == "Perhitungan Selesai") {
												?>
												<div class="icon-big text-center">
													<i class="flaticon-success"></i>
												</div>
											<?php } else { ?>
												<div class="icon-big text-center">
													<i class="flaticon-error"></i>
												</div>
											<?php } ?>
										</div>
										<div class="col col-stats">
											<div class="numbers">
												<p class="card-category">Status Penilaian</p>
												<h4 class="card-title"><?= $status['0'] ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="card card-info bg-info-gradient">
								<div class="card-body">
									<h4 class="mb-1 fw-bold">Data Dihitung</h4>
									<div id="task-complete" class="chart-circle mt-4 mb-3"></div>
									<div class="card-desc">
										<h3><?= $status['1'] . " / " . $status['2'] . " Guru" ?></h3>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Hasil Kinerja Guru</div>
										<div class="card-tools">
											<?php if ($admin['akses'] == "Administrator") { ?>
												<?php if ($status['0'] == "Perhitungan Selesai") { ?>
													<a href="<?= base_url('admin/cetak') ?>" class="btn btn-info btn-border btn-round btn-sm">
														<span class="btn-label">
															<i class="fa fa-print"></i>
														</span>
														Print
													</a>
												<?php } ?>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="card-body">
										<div class="table-responsive">
											<table id="add-row" class="display table table-striped table-hover">
												<thead>
													<tr>
														<th style="width: 6%">No</th>
														<th>Nama</th>
														<th>NIP</th>
														<th>Hasil</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$no = 1;
													foreach ($hasil as $h) {
														?>
														<tr>
															<td><?= $no ?></td>
															<td><?= $h['nama_guru'] ?></td>
															<td><?= $h['nip'] ?></td>
															<td><?= $h['alternatif'] ?></td>
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
			</div>
		</div>