<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?= $title ?></title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?= base_url(); ?>assets/img/icon.ico" type="image/x-icon" />

	<!-- Fonts and icons -->
	<script src="<?= base_url(); ?>assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Open+Sans:300,400,600,700"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
				urls: ['<?= base_url(); ?>assets/css/fonts.css']
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/azzara.min.css">
</head>

<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center">Sign In To Admin</h3>
			<?php if ($this->session->flashdata('done')) { ?>
				<div class="alert alert-success" role="alert" id="close_alert">
					<?= $this->session->flashdata('done'); ?>
				</div>
			<?php } else if ($this->session->flashdata('fail')) { ?>
				<div class="alert alert-danger" role="alert" id="close_alert">
					<?= $this->session->flashdata('fail'); ?>
				</div>
			<?php } ?>
			<div class="login-form">
				<form action="<?= base_url(); ?>" method="post">
					<div class="form-group">
						<label for="username" class="placeholder"><b>Email</b></label>
						<input id="username" name="email" type="text" class="form-control" placeholder="Email" value="<?= set_value('email'); ?>">
						<?= form_error('email', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
						<label for="password" class="placeholder"><b>Password</b></label>
						<div class="position-relative">
							<input id="password" name="password" type="password" class="form-control" placeholder="Password">
							<div class=" show-password">
								<i class="flaticon-interface"></i>
							</div>
						</div>
						<?= form_error('password', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-action mb-3">
						<button class="btn btn-primary btn-rounded btn-login">Sign In</button>
					</div>
					<!-- <div class="login-account">
						<span class="msg">Don't have an account yet ?</span>
						<a href="<?= base_url('auth/register'); ?>" class="link">Sign Up</a>
					</div> -->
				</form>
			</div>
		</div>
	</div>
	<script src="<?= base_url(); ?>assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/core/popper.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/core/bootstrap.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/ready.js"></script>
	<script>
		window.setTimeout(function() {
			$("#close_alert").fadeTo(500, 0).slideUp(500, function() {
				$(this).remove();
			});
		}, 3000);
	</script>
</body>

</html>