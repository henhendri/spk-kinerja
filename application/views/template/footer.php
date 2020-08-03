	</div>
	<!--   Core JS Files   -->
	<script src="<?= base_url(); ?>assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/core/popper.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="<?= base_url(); ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="<?= base_url(); ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

	<!-- Moment JS -->
	<script src="<?= base_url(); ?>assets/js/plugin/moment/moment.min.js"></script>

	<!-- Chart JS -->
	<script src="<?= base_url(); ?>assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="<?= base_url(); ?>assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	<script src="<?= base_url(); ?>assets/js/plugin/chart-circle/circles.min.js"></script>

	<!-- Datatables -->
	<script src="<?= base_url(); ?>assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Bootstrap Notify -->
	<script src="<?= base_url(); ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- Bootstrap Toggle -->
	<script src="<?= base_url(); ?>assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

	<!-- jQuery Vector Maps -->
	<script src="<?= base_url(); ?>assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Google Maps Plugin -->
	<script src="<?= base_url(); ?>assets/js/plugin/gmaps/gmaps.js"></script>

	<!-- Sweet Alert -->
	<script src="<?= base_url(); ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Azzara JS -->
	<script src="<?= base_url(); ?>assets/js/ready.min.js"></script>

	<!-- Custom JS Asal -->
	<script>
		window.setTimeout(function() {
			$("#close_alert").fadeTo(500, 0).slideUp(500, function() {
				$(this).remove();
			});
		}, 3000);

		$('#add-row').DataTable({
			"pageLength": 10,
		});

		$('#add-row2').DataTable({
			"pageLength": 10,
		});

		$('#add-row3').DataTable({
			"pageLength": 10,
		});

		$('#add-row4').DataTable({
			"pageLength": 10,
		});

		$('.custom-file-input').on('change', function() {
			let fileName = $(this).val().split('\\').pop();
			$(this).next('.custom-file-label').addClass("selected").html(fileName);
		});
	</script>

	<script>
		var pieChart = document.getElementById('pieChart').getContext('2d');

		var myPieChart = new Chart(pieChart, {
			type: 'pie',
			data: {
				datasets: [{
					data: [<?php
							foreach ($jumlah as $j) {
								echo $j . ",";
							}
							?>],
					backgroundColor: ["#59d05d", "#1d7af3", "#716aca", "#fdaf4b", "#f3545d"],
					borderWidth: 0
				}],
				labels: [<?php
							foreach ($alternatif as $a) {
								echo "'" . $a['nama_alternatif'] . "',";
							}
							?>]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					position: 'bottom',
					labels: {
						fontColor: 'rgb(154, 154, 154)',
						fontSize: 11,
						usePointStyle: true,
						padding: 20
					}
				},
				pieceLabel: {
					render: 'percentage',
					fontColor: 'white',
					fontSize: 14,
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		})
	</script>
	</body>

	</html>