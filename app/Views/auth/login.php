<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8" />
	<title>SIM | SMP Muhammadiyah Terpadu Moga</title>

	<!-- Site favicon -->
	<link href='https://www.smpmuhmoga.sch.id/favicon.ico' rel='icon' type='image/x-icon' />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/vendors/styles/core.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/vendors/styles/icon-font.min.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/vendors/styles/style.css" />
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag("js", new Date());

		gtag("config", "G-GBZ3SGGX85");
	</script>
	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				"gtm.start": new Date().getTime(),
				event: "gtm.js"
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != "dataLayer" ? "&l=" + l : "";
			j.async = true;
			j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
	</script>
	<!-- End Google Tag Manager -->
</head>

<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="<?= site_url() ?>">
					<img alt="SMP Muhammadiyah Terpadu Moga" src="https://1.bp.blogspot.com/-aSEIz8QUj5E/YVgTCy-K4AI/AAAAAAAAAco/6Wnsukqv2UUrOay4c0HmPALgzpdCI24dACLcBGAsYHQ/s418/fix.png">
				</a>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="align-items-center">
				<div class="login-box bg-white box-shadow border-radius-10">
					<div class="login-title">
						<h2 class="text-center text-primary">Login</h2>
					</div>
					<!-- <form method="POST" action="<?= site_url('Auth/loginProcess') ?>"> -->
					<?= csrf_field() ?>
					<div class="input-group custom">
						<input id="username" type="text" class="form-control form-control-lg" placeholder="Username" name="username" />
						<div class="input-group-append custom">
							<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
						</div>
					</div>
					<div class="input-group custom">
						<input id="password" type="password" class="form-control form-control-lg" placeholder="**********" name="password" />
						<div class="input-group-append custom">
							<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
						</div>
					</div>
					<div class="row pb-30">
						<div class="col-6">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="ckpw" />
								<label class="custom-control-label" for="ckpw">Show Password</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="input-group mb-0">
								<button id="kirim" class="btn btn-outline-primary btn-lg btn-block" type="submit" onclick="login()">Sign In</button>
							</div>
						</div>
					</div>
					<!-- </form> -->
				</div>
			</div>
		</div>
	</div>
	<!-- welcome modal start -->
	<?= $this->include('layout/welcome-modal'); ?>
	<!-- welcome modal end -->
	<!-- js -->
	<script src="<?= base_url() ?>/assets/vendors/scripts/core.js"></script>
	<script src="<?= base_url() ?>/assets/vendors/scripts/script.min.js"></script>
	<script src="<?= base_url() ?>/assets/vendors/scripts/process.js"></script>
	<script src="<?= base_url() ?>/assets/vendors/scripts/layout-settings.js"></script>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#password').on('keyup', function(event) {
				if ($('#password').val().length > 15) {
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: 'Password terlalu panjang!',
					})
					$('#password').val('');
				}
			});

			$('#ckpw').on('click', function() {
				if ($('#ckpw').is(':checked')) {
					$('#password').attr('type', 'text');
				} else {
					$('#password').attr('type', 'password');
				}

			});
		});

		$('#username').keypress(function(e) {
			var key = e.which;
			if (key == 13) {
				if ($('#username').val() == '') {
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: 'Username harus diisi!',
					})
					return false;
				}
				if ($('#password').val() == '') {
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: 'Password harus diisi!',
					})
					return false;
				}
				var loader = '<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>';
				var loaderBtn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
				var resetBtn = 'Sign In';
				let csrfToken = '<?= csrf_token() ?>';
				let csrfHash = '<?= csrf_hash() ?>';
				$.ajax({
					url: "<?= site_url('Auth/loginProcess') ?>",
					data: {
						[csrfToken]: csrfHash,
						username: $('#username').val(),
						password: $('#password').val()
					},
					type: "POST",
					dataType: "text",
					beforeSend: function(f) {
						$('#kirim').html(loaderBtn);
						$("#kirim").attr("disabled", true);
					},
					success: function(data) {
						$('#kirim').html(resetBtn);
						$("#kirim").attr("disabled", false);
						if (data == 'success') {
							window.location.href = "<?= site_url() ?>";
						} else if (data == 'error username') {
							Swal.fire({
								icon: 'error',
								title: 'Error!',
								text: 'Username tidak ditemukan!'
							})
						} else if (data == 'error password') {
							Swal.fire({
								icon: 'error',
								title: 'Error!',
								text: 'Password tidak sesuai!'
							})
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						$('#kirim').html(resetBtn);
						$("#kirim").attr("disabled", false);
						Swal.fire({
							icon: 'error',
							title: 'Error!',
							text: thrownError
						})
					}
				})
			}
		});

		$('#password').keypress(function(e) {
			var key = e.which;
			if (key == 13) {
				if ($('#username').val() == '') {
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: 'Username harus diisi!',
					})
					return false;
				}
				if ($('#password').val() == '') {
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: 'Password harus diisi!',
					})
					return false;
				}
				var loader = '<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>';
				var loaderBtn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
				var resetBtn = 'Sign In';
				let csrfToken = '<?= csrf_token() ?>';
				let csrfHash = '<?= csrf_hash() ?>';
				$.ajax({
					url: "<?= site_url('Auth/loginProcess') ?>",
					data: {
						[csrfToken]: csrfHash,
						username: $('#username').val(),
						password: $('#password').val()
					},
					type: "POST",
					dataType: "text",
					beforeSend: function(f) {
						$('#kirim').html(loaderBtn);
						$("#kirim").attr("disabled", true);
					},
					success: function(data) {
						$('#kirim').html(resetBtn);
						$("#kirim").attr("disabled", false);
						if (data == 'success') {
							window.location.href = "<?= site_url() ?>";
						} else if (data == 'error username') {
							Swal.fire({
								icon: 'error',
								title: 'Error!',
								text: 'Username tidak ditemukan!'
							})
						} else if (data == 'error password') {
							Swal.fire({
								icon: 'error',
								title: 'Error!',
								text: 'Password tidak sesuai!'
							})
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						$('#kirim').html(resetBtn);
						$("#kirim").attr("disabled", false);
						Swal.fire({
							icon: 'error',
							title: 'Error!',
							text: thrownError
						})
					}
				})
			}
		});

		function login() {
			if ($('#username').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Error!',
					text: 'Username harus diisi!',
				})
				return false;
			}
			if ($('#password').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Error!',
					text: 'Password harus diisi!',
				})
				return false;
			}
			var loader = '<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>';
			var loaderBtn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
			var resetBtn = 'Sign In';
			let csrfToken = '<?= csrf_token() ?>';
			let csrfHash = '<?= csrf_hash() ?>';
			$.ajax({
				url: "<?= site_url('Auth/loginProcess') ?>",
				data: {
					[csrfToken]: csrfHash,
					username: $('#username').val(),
					password: $('#password').val()
				},
				type: "POST",
				dataType: "text",
				beforeSend: function(f) {
					$('#kirim').html(loaderBtn);
					$("#kirim").attr("disabled", true);
				},
				success: function(data) {
					$('#kirim').html(resetBtn);
					$("#kirim").attr("disabled", false);
					if (data == 'success') {
						window.location.href = "<?= site_url() ?>";
					} else if (data == 'error username') {
						Swal.fire({
							icon: 'error',
							title: 'Error!',
							text: 'Username tidak ditemukan!'
						})
					} else if (data == 'error password') {
						Swal.fire({
							icon: 'error',
							title: 'Error!',
							text: 'Password tidak sesuai!'
						})
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					$('#kirim').html(resetBtn);
					$("#kirim").attr("disabled", false);
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: thrownError
					})
				}
			})
		}
	</script>
</body>

</html>