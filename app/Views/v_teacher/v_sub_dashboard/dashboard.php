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
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/src/plugins/datatables/css/responsive.bootstrap4.min.css" />
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
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4">
						<img src="<?= base_url() ?>/assets/vendors/images/banner-img.png" alt="" />
					</div>
					<div class="col-md-8">
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Selamat Datang Kembali
							<div class="weight-600 font-30 text-blue"><?= $teacher->name ?></div>
						</h4>
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Anda Masuk Sebagai
							<div class="weight-600 font-30 text-blue"><?= $user['role'] ?></div>
						</h4>
						<p class="font-18 max-width-600">

						</p>
					</div>
				</div>
			</div>
			<div class="card-box pd-20 mb-30">
				<h4 class="mb-3">Jadwal Pembelajaran Hari Ini</h4>
				<div id="timetable">

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
		reload_timetable();

		function reload_timetable() {
			$.ajax({
				url: "<?= site_url('TeacherController/indexTimetable/' . $idTeacher) ?>",
				beforeSend: function(f) {
					$('#timetable').html(loader);
				},
				success: function(data) {
					$('#timetable').html(data);
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