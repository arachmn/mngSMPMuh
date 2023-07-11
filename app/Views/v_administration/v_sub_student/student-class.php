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
                                    <li class="breadcrumb-item"><a href="<?= site_url('administration/student') ?>">Tahun Ajaran</a></li>
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
                            <h5 class="h4 text-blue mb-20 d-inline">List Kelas</h5>
                            <div class="d-inline" style="float: right;">
                                <button class="btn btn-outline-primary" id="addSiswa" onclick="openAddClass()">
                                    <i class="bi bi-pencil-square" style="font-size: 20px;"></i>
                                </button>
                            </div>
                            <div class="modal fade" id="addClass" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Kelas</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                            </button>
                                        </div>
                                        <div class="modal-body" style="overflow: auto; max-height: 80vh; margin-bottom: 10px; margin-top: 10px">
                                            <div class="form-group">
                                                <label>Kelas</label>
                                                <select class="selectpicker form-control" data-style="btn-outline-primary" id="kelas" name="kelas">
                                                    <option value="VII">VII</option>
                                                    <option value="VIII">VIII</option>
                                                    <option value="IX">IX</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Wali Kelas</label>
                                                <select class="selectpicker form-control" data-style="btn-outline-primary" id="teacherNew" name="teacherNew">
                                                    <?php foreach ($teacher as $t) : ?>
                                                        <option value="<?= $t['id_teacher'] ?>"><?= $t['name'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun Ajaran</label>
                                                <input class="form-control" type="text" name="school_yearAdd" id="school_yearAdd" disabled>
                                            </div>
                                            <button class="btn btn-outline-primary" type="submit" id="btnAddClass" name="btnAddClass" onclick="saveClass()">
                                                <i class="bi bi-send-fill"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="detailClass" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Detail Kelas</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                            </button>
                                        </div>
                                        <div class="modal-body" style="overflow: auto; max-height: 80vh; margin-bottom: 10px; margin-top: 10px">
                                            <div class="form-group">
                                                <label>Kelas</label>
                                                <input class="form-control" type="text" name="className" id="className" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Wali Kelas</label>
                                                <select class="form-control" data-style="btn-outline-primary" id="teacherName" name="teacherName">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah Siswa</label>
                                                <input class="form-control" type="text" name="students" id="students" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun Ajaran</label>
                                                <input class="form-control" type="text" name="school_year" id="school_year" disabled>
                                            </div>
                                            <button class="btn btn-outline-primary" type="submit" id="btnDetailClass" name="btnDetailClass">
                                                <i class="bi bi-send-fill"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab mt-3">
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
                                        <div class="mt-2 mb-2">
                                            <div id="dataVII" style="overflow: auto;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="viii" role="tabpanel">
                                        <div class="mt-2 mb-2">
                                            <div id="dataVIII" style="overflow: auto;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="ix" role="tabpanel">
                                        <div class="mt-2 mb-2">
                                            <div id="dataIX" style="overflow: auto;">
                                            </div>
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
        var loaderBtn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        var btnReset = '<i class="bi bi-send-fill"></i> Save';

        reload_class_vii();
        reload_class_viii();
        reload_class_ix();

        function reload_class_vii() {
            $.ajax({
                url: "<?= site_url('AdministrationController/studentClassVIIData/' . $year) ?>",
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
                url: "<?= site_url('AdministrationController/studentClassVIIIData/' . $year) ?>",
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
                url: "<?= site_url('AdministrationController/studentClassIXData/' . $year) ?>",
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

        function openClass(idClass) {
            $.ajax({
                url: "<?= site_url('AdministrationController/classModal/') ?>" + idClass,
                dataType: "JSON",
                beforeSend: function(data) {
                    $('#detailClass').modal('show');
                },
                success: function(data) {
                    $('[name="school_year"]').val(data.school_year);
                    $('[name="students"]').val(data.students);
                    $('[name="className"]').val(data.class);
                    $('[name="btnDetailClass"]').attr('onclick', 'updateClass("' + idClass + '")');
                    $('#teacherName').find('option').remove().end();
                    $('#teacherName').append('<option value="' + data.id_teacher + '" selected >' + data.name + '</option>');
                    $.ajax({
                        url: "<?= site_url('AdministrationController/teacherClass/') ?>",
                        dataType: "JSON",
                        success: function(data) {
                            for (var q = 0; q < data.length; q++) {
                                if (data.length > 0) {
                                    $('#teacherName').append('<option value="' + data[q].id_teacher + '">' + data[q].name + '</option>');
                                }
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

        function updateClass(idClass) {
            let csrfToken = '<?= csrf_token() ?>';
            let csrfHash = '<?= csrf_hash() ?>';
            $.ajax({
                url: "<?= site_url('AdministrationController/updateClass') ?>",
                data: {
                    [csrfToken]: csrfHash,
                    idTeacher: $('#teacherName').find(":selected").val(),
                    idClass: idClass
                },
                type: "POST",
                beforeSend: function(data) {
                    $('#btnDetailClass').html(loaderBtn);
                    $("#btnDetailClass").attr("disabled", true);
                },
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: 'Data berhasil disimpan!'
                    });
                    $('.modal').each(function() {
                        $(this).modal('hide');
                    });
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('#btnDetailClass').html(btnReset);
                    $("#btnDetailClass").attr("disabled", false);
                    reload_class_vii();
                    reload_class_viii();
                    reload_class_ix();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('#btnDetailClass').html(btnReset);
                    $("#btnDetailClass").attr("disabled", false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: thrownError
                    })
                }
            });
        }

        function openAddClass() {
            $('#addClass').modal('show');
            $('[name="school_yearAdd"]').val('<?= $year ?>');
        }

        function deleteClass(idClass, a) {
            let csrfToken = '<?= csrf_token() ?>';
            let csrfHash = '<?= csrf_hash() ?>';
            Swal.fire({
                icon: 'warning',
                title: 'Hapus Data',
                text: 'Apakah anda yakin',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= site_url('AdministrationController/deleteClass') ?>",
                        data: {
                            [csrfToken]: csrfHash,
                            idClass: idClass,
                        },
                        type: "POST",
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: 'Data berhasil dihapus!'
                            })
                            reload_class_vii();
                            reload_class_viii();
                            reload_class_ix();
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
            })
        }

        function saveClass() {
            let csrfToken = '<?= csrf_token() ?>';
            let csrfHash = '<?= csrf_hash() ?>';
            $.ajax({
                url: "<?= site_url('AdministrationController/saveClass') ?>",
                data: {
                    [csrfToken]: csrfHash,
                    idTeacher: $('#teacherNew').find(":selected").val(),
                    class: $('#kelas').find(":selected").val(),
                    school_year: $("#school_yearAdd").val(),
                },
                type: "POST",
                beforeSend: function(data) {
                    $('#btnAddClass').html(loaderBtn);
                    $("#btnAddClass").attr("disabled", true);
                },
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: 'Data berhasil disimpan!'
                    });
                    $('.modal').each(function() {
                        $(this).modal('hide');
                    });
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('#btnAddClass').html(btnReset);
                    $("#btnAddClass").attr("disabled", false);
                    reload_class_vii();
                    reload_class_viii();
                    reload_class_ix();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('#btnAddClass').html(btnReset);
                    $("#btnAddClass").attr("disabled", false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: thrownError
                    })
                }
            });
        }
    </script>
</body>

</html>