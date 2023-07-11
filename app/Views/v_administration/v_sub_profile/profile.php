<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8" />
	<title><?= $title ?></title>

	<!-- Site favicon -->
	<link href='https://www.smpmuhmoga.sch.id/favicon.ico' rel='icon' type='image/x-icon' />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/vendors/styles/core.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/vendors/styles/icon-font.min.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/src/plugins/cropperjs/dist/cropper.css" />
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

<body>
	<?= $this->include('layout/header'); ?>

	<?= $this->include('layout/right-side-bar'); ?>

	<?= $this->include('layout/left-side-bar'); ?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Profile</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= site_url('administration') ?>">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">
										Profile
									</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p" id="profile_info">

						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#setting" role="tab">Settings</a>
										</li>
									</ul>
									<div class="tab-content">
										<!-- Setting Tab start -->
										<div class="tab-pane fade show active" id="setting" role="tabpanel">
											<div class="profile-setting">

											</div>
										</div>
										<!-- Setting Tab End -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?= $this->include('layout/footer'); ?>
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
		var loader = '<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>';
		var loaderBtn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
		var btnReset = '<i class="bi bi-send-fill"></i> Save';
		reload_form();
		reload_profile();

		function isEmail(email) {
			var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!regex.test(email)) {
				return false;
			} else {
				return true;
			}
		}

		function reload_profile() {
			$.ajax({
				url: "<?= site_url('AdministrationController/profileInfo/' . $administration->id_administration) ?>",
				beforeSend: function(f) {
					$('#profile_info').html(loader);
				},
				success: function(data) {
					$('#profile_info').html(data);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: thrownError
					})
				}
			})
		}

		function reload_form() {
			$.ajax({
				url: "<?= site_url('AdministrationController/profileSetting/' . $administration->id_administration) ?>",
				beforeSend: function(f) {
					$('.profile-setting').html(loader);
				},
				success: function(data) {
					$('.profile-setting').html(data);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: thrownError
					})
				}
			})
		}

		function updateProfile() {
			let csrfToken = '<?= csrf_token() ?>';
			let csrfHash = '<?= csrf_hash() ?>';
			var name = $("#name").val();
			var email = $("#email").val();
			var phone_number = $("#phone_number").val();
			var valError = '';
			var textNumber = '';

			if (name != '') {
				$("#div_name").attr("class", "form-group");
				$("#name").attr("class", "form-control form-control-lg");
				$("#name_feedback").html('');
				valError = false;
			}

			if (email == '') {
				$("#div_email").attr("class", "form-group");
				$("#email").attr("class", "form-control form-control-lg");
				$("#email_feedback").html('');
				valError = false;
			}

			if (email != '' && isEmail(email) == true) {
				$("#div_email").attr("class", "form-group");
				$("#email").attr("class", "form-control form-control-lg");
				$("#email_feedback").html('');
				valError = false;
			}

			if (phone_number == '') {
				$("#div_phone_number").attr("class", "form-group");
				$("#phone_number").attr("class", "form-control form-control-lg");
				$("#phone_number_feedback").html('');
				valError = false;
			}

			if (phone_number != '' && $.isNumeric(phone_number) == true) {
				$("#div_phone_number").attr("class", "form-group");
				$("#phone_number").attr("class", "form-control form-control-lg");
				$("#phone_number_feedback").html('');
				valError = false;
			}

			if (name == '') {
				$("#div_name").attr("class", "form-group has-danger");
				$("#name").attr("class", "form-control form-control-lg form-control-danger");
				$("#name_feedback").html('Nama lengkap tidak boleh kosong');
				valError = true;
			}

			if (phone_number != '' && $.isNumeric(phone_number) == false) {
				$("#div_phone_number").attr("class", "form-group has-danger");
				$("#phone_number").attr("class", "form-control form-control-lg form-control-danger");
				$("#phone_number_feedback").html('Nomer telepon harus berupa angka');
				valError = true;
			}

			if (phone_number != '' && $.isNumeric(phone_number) == true && phone_number.toString().length < 7) {
				$("#div_phone_number").attr("class", "form-group has-danger");
				$("#phone_number").attr("class", "form-control form-control-lg form-control-danger");
				$("#phone_number_feedback").html('Nomer telepon minimal 7 digit angka');
				valError = true;
			}

			if (email != '' && isEmail(email) == false) {
				$("#div_email").attr("class", "form-group has-danger");
				$("#email").attr("class", "form-control form-control-lg form-control-danger");
				$("#email_feedback").html('Format email tidak benar');
				valError = true;
			}

			if (valError == true) {
				return false;
			} else {
				$.ajax({
					url: "<?= site_url('AdministrationController/getEmail') ?>",
					data: {
						[csrfToken]: csrfHash,
						email: email,
					},
					dataType: "JSON",
					type: "POST",
					success: function(data) {
						if (data == undefined || email == '') {
							$("#div_email").attr("class", "form-group");
							$("#email").attr("class", "form-control form-control-lg");
							$("#email_feedback").html('');

							$.ajax({
								url: "<?= site_url('AdministrationController/updateProfile') ?>",
								type: 'POST',
								data: {
									[csrfToken]: csrfHash,
									id: $("#id").val(),
									name: name,
									email: email,
									gender: $('input[name="gender"]:checked').val(),
									phone_number: phone_number,
									address: $("#address").val()
								},
								beforeSend: function(f) {
									$('#kirim').html(loaderBtn);
									$("#kirim").attr("disabled", true);
								},
								success: function(data) {
									Swal.fire({
										icon: 'success',
										title: 'Sukses!',
										text: 'Data berhasil diupdate!'
									})
									reload_form();
									reload_profile();
								},
								error: function(xhr, ajaxOptions, thrownError) {
									Swal.fire({
										icon: 'error',
										title: 'Error!',
										text: thrownError
									})
									$('#kirim').html(btnReset);
									$("#kirim").attr("disabled", false);
								}
							});
						} else {
							$("#div_email").attr("class", "form-group has-danger");
							$("#email").attr("class", "form-control form-control-lg form-control-danger");
							$("#email_feedback").html('Email sudah dipakai');
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						Swal.fire({
							icon: 'error',
							title: 'Error!',
							text: thrownError
						})
					}
				});
			}


		}
	</script>
	<script>
		$(document).ready(function() {
			$('#password1').on('keyup', function(event) {
				if ($('#password1').val().length > 15) {
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: 'Password terlalu panjang!',
					})
					$('#password1').val('');
				}
			});

			$('#password2').on('keyup', function(event) {
				if ($('#password2').val().length > 15) {
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: 'Password terlalu panjang!',
					})
					$('#password2').val('');
				}
			});

		});
	</script>
</body>

</html>