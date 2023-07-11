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
                                <h4>Kelas</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('administration/timetable') ?>">Tahun Ajaran</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Kelas
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-20">
                        <div class="pd-20 card-box">
                            <h5 class="h4 text-blue mb-20">List Kelas</h5>
                            <div class="tab">
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#vii" role="tab" aria-selected="true"><strong>VII</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#viii" role="tab" aria-selected="false"><strong>VIII</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#ix" role="tab" aria-selected="false"><strong>IX</strong></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="vii" role="tabpanel">
                                        <div class="pd-20" id="dataVII">

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="viii" role="tabpanel">
                                        <div class="pd-20" id="dataVIII">

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="ix" role="tabpanel">
                                        <div class="pd-20" id="dataIX">

                                        </div>
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

        reload_class_vii();
        reload_class_viii();
        reload_class_ix();

        function reload_class_vii() {
            $.ajax({
                url: "<?= site_url('AdministrationController/timetableClassVIIData/' . $year) ?>",
                beforeSend: function(f) {
                    $('#dataVII').html(loader);
                },
                success: function(data) {
                    $('#dataVII').html(data);
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

        function reload_class_viii() {
            $.ajax({
                url: "<?= site_url('AdministrationController/timetableClassVIIIData/' . $year) ?>",
                beforeSend: function(f) {
                    $('#dataVIII').html(loader);
                },
                success: function(data) {
                    $('#dataVIII').html(data);
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

        function reload_class_ix() {
            $.ajax({
                url: "<?= site_url('AdministrationController/timetableClassIXData/' . $year) ?>",
                beforeSend: function(f) {
                    $('#dataIX').html(loader);
                },
                success: function(data) {
                    $('#dataIX').html(data);
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
</body>

</html>