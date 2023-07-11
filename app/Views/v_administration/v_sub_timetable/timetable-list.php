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
                                <h4>Jadwal Kelas <?= $class ?> | <?= $year ?></h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('administration/timetable/' . $year) ?>">Kelas</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Jadwal
                                    </li>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h5 class="h4 text-blue mb-20 d-inline">List Jadwal</h5>
                        <div class="d-inline" style="float: right;">
                            <button class="btn btn-outline-primary" id="addSiswa" onclick="openEditTimetable()">
                                <i class="bi bi-pencil-square" style="font-size: 20px;"></i>
                            </button>
                            <div class="modal fade" id="editTimetable" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Jadwal Mata Pelajaran</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                            </button>
                                        </div>
                                        <div class="modal-body" style="overflow: auto; max-height: 80vh; margin-bottom: 10px; margin-top: 10px">
                                            <div class="form-group">
                                                <label>Hari</label>
                                                <select class="selectpicker form-control" data-style="btn-outline-primary" id="dayAdd" name="dayAdd">
                                                    <option value="Senin" selected>Senin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Kamis">Kamis</option>
                                                    <option value="Jumat">Jumat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Jam Pelajaran</label><br>
                                                <select class="form-control" data-style="btn-outline-primary" id="lessonHour" name="lessonHour">
                                                    <option value="2" selected>07.40-08.20</option>
                                                    <option value="3">08.20-09.00</option>
                                                    <option value="4">09.00-09.40</option>
                                                    <option value="5">09.50-10.30</option>
                                                    <option value="6">10.30-11.10</option>
                                                    <option value="7">11.10-11.50</option>
                                                    <option value="8">12.10-12.50</option>
                                                    <option value="9">12.50-13.30</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Mata Pelajaran</label><br>
                                                <select class="form-control" data-style="btn-outline-primary" id="subjectAdd" name="subjectAdd">
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Pengampu</label><br>
                                                <select class="form-control" data-style="btn-outline-primary" id="teacherAdd" name="teacherAdd">
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Kelas</label>
                                                <input class="form-control" type="text" name="classAdd" id="classAdd" value="<?= $class ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun Ajaran Masuk</label>
                                                <input class="form-control" type="text" name="school_yearAdd" id="school_yearAdd" value="<?= $year ?>" disabled>
                                            </div>
                                            <button class="btn btn-outline-primary" type="submit" id="btneditTimetable" name="btneditTimetable" onclick="saveTimetable()"><i class="bi bi-send-fill"></i> Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab mt-3">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#senin" role="tab" aria-selected="true"><strong>Senin</strong></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#selasa" role="tab" aria-selected="false"><strong>Selasa</strong></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#rabu" role="tab" aria-selected="false"><strong>Rabu</strong></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kamis" role="tab" aria-selected="false"><strong>Kamis</strong></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#jumat" role="tab" aria-selected="false"><strong>Jumat</strong></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#sabtu" role="tab" aria-selected="false"><strong>Sabtu</strong></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="senin" role="tabpanel">
                                <div class="" id="dataSenin">

                                </div>
                            </div>
                            <div class="tab-pane fade" id="selasa" role="tabpanel">
                                <div class="" id="dataSelasa">

                                </div>
                            </div>
                            <div class="tab-pane fade" id="rabu" role="tabpanel">
                                <div class="" id="dataRabu">

                                </div>
                            </div>
                            <div class="tab-pane fade" id="kamis" role="tabpanel">
                                <div class="" id="dataKamis">

                                </div>
                            </div>
                            <div class="tab-pane fade" id="jumat" role="tabpanel">
                                <div class="" id="dataJumat">

                                </div>
                            </div>
                            <div class="tab-pane fade" id="sabtu" role="tabpanel">
                                <div class="" id="dataSabtu">

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

        reload_senin();
        reload_selasa();
        reload_rabu();
        reload_kamis();
        reload_jumat();
        reload_sabtu();

        function reload_senin(idClass) {
            $.ajax({
                url: "<?= site_url('AdministrationController/timetableSenin/' . $idClass) ?>",
                beforeSend: function(f) {
                    $('#dataSenin').html(loader);
                },
                success: function(data) {
                    $('#dataSenin').html(data);
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

        function reload_selasa(idClass) {
            $.ajax({
                url: "<?= site_url('AdministrationController/timetableSelasa/' . $idClass) ?>",
                beforeSend: function(f) {
                    $('#dataSelasa').html(loader);
                },
                success: function(data) {
                    $('#dataSelasa').html(data);
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

        function reload_rabu(idClass) {
            $.ajax({
                url: "<?= site_url('AdministrationController/timetableRabu/' . $idClass) ?>",
                beforeSend: function(f) {
                    $('#dataRabu').html(loader);
                },
                success: function(data) {
                    $('#dataRabu').html(data);
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

        function reload_kamis(idClass) {
            $.ajax({
                url: "<?= site_url('AdministrationController/timetableKamis/' . $idClass) ?>",
                beforeSend: function(f) {
                    $('#dataKamis').html(loader);
                },
                success: function(data) {
                    $('#dataKamis').html(data);
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

        function reload_jumat(idClass) {
            $.ajax({
                url: "<?= site_url('AdministrationController/timetableJumat/' . $idClass) ?>",
                beforeSend: function(f) {
                    $('#dataJumat').html(loader);
                },
                success: function(data) {
                    $('#dataJumat').html(data);
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

        function reload_sabtu(idClass) {
            $.ajax({
                url: "<?= site_url('AdministrationController/timetableSabtu/' . $idClass) ?>",
                beforeSend: function(f) {
                    $('#dataSabtu').html(loader);
                },
                success: function(data) {
                    $('#dataSabtu').html(data);
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

        function openEditTimetable() {
            let csrfToken = '<?= csrf_token() ?>';
            let csrfHash = '<?= csrf_hash() ?>';
            $('#editTimetable').modal('show');
            $('[name="school_yearAdd"]').val('<?= $year ?>');
            $('[name="classAdd"]').val('<?= $class ?>');
            $.ajax({
                url: "<?= site_url('AdministrationController/getSubjectTimetable') ?>",
                data: {
                    [csrfToken]: csrfHash,
                    idClass: '<?= $idClass ?>'
                },
                type: "POST",
                dataType: "JSON",
                success: function(dataSubject) {
                    $('#subjectAdd').find('option').remove().end();
                    for (var i = 0; i < dataSubject.length; i++) {
                        if (i == 0) {
                            $('#subjectAdd').append('<option value="' + dataSubject[i].id_subject + '" selected >' + dataSubject[i].subject_name + '</option>');
                            $.ajax({
                                url: "<?= site_url('AdministrationController/getTeacherTimetable') ?>",
                                data: {
                                    [csrfToken]: csrfHash,
                                    idSubject: dataSubject[i].id_subject,
                                },
                                type: "POST",
                                dataType: "JSON",
                                success: function(dataTeacher) {
                                    $('#teacherAdd').find('option').remove().end();
                                    for (var q = 0; q < dataTeacher.length; q++) {
                                        if (q == 0) {
                                            $('#teacherAdd').append('<option value="' + dataTeacher[q].id_teacher + '" selected >' + dataTeacher[q].name + '</option>');
                                            dataTeacher.splice(q, 1);
                                        }
                                        if (dataTeacher.length > 0) {
                                            $('#teacherAdd').append('<option value="' + dataTeacher[q].id_teacher + '">' + dataTeacher[q].name + '</option>');
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
                            dataSubject.splice(i, 1);
                        }
                        if (dataSubject.length > 0) {
                            $('#subjectAdd').append('<option value="' + dataSubject[i].id_subject + '">' + dataSubject[i].subject_name + '</option>');
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
        }

        $('#dayAdd').change(function() {
            if ($(this).find("option:selected").val() == 'Senin') {
                $('#lessonHour').find('option').remove().end();
                $('#lessonHour').append('<option value="2" selected>07.40-08.20</option>');
                $('#lessonHour').append('<option value="3">08.20-09.00</option>');
                $('#lessonHour').append('<option value="4">09.00-09.40</option>');
                $('#lessonHour').append('<option value="5">09.50-10.30</option>');
                $('#lessonHour').append('<option value="6">10.30-11.10</option>');
                $('#lessonHour').append('<option value="7">11.10-11.50</option>');
                $('#lessonHour').append('<option value="8">12.10-12.50</option>');
                $('#lessonHour').append('<option value="9">12.50-13.30</option>');
            }
            if ($(this).find("option:selected").val() == 'Selasa' || $(this).find("option:selected").val() == 'Rabu' || $(this).find("option:selected").val() == 'Kamis') {
                $('#lessonHour').find('option').remove().end();
                $('#lessonHour').append('<option value="1" selected>07.00-07.40</option>');
                $('#lessonHour').append('<option value="2">07.40-08.20</option>');
                $('#lessonHour').append('<option value="3">08.20-09.00</option>');
                $('#lessonHour').append('<option value="4">09.00-09.40</option>');
                $('#lessonHour').append('<option value="5">09.50-10.30</option>');
                $('#lessonHour').append('<option value="6">10.30-11.10</option>');
                $('#lessonHour').append('<option value="7">11.10-11.50</option>');
                $('#lessonHour').append('<option value="8">12.10-12.50</option>');
                $('#lessonHour').append('<option value="9">12.50-13.30</option>');
            }
            if ($(this).find("option:selected").val() == 'Jumat') {
                $('#lessonHour').find('option').remove().end();
                $('#lessonHour').append('<option value="1" selected>07.00-07.30</option>');
                $('#lessonHour').append('<option value="2">07.30-08.30</option>');
                $('#lessonHour').append('<option value="3">08.30-09.00</option>');
                $('#lessonHour').append('<option value="4">09.10-09.40</option>');
                $('#lessonHour').append('<option value="5">09.20-10.50</option>');
            }
            if ($(this).find("option:selected").val() == 'Sabtu') {
                $('#lessonHour').find('option').remove().end();
                $('#lessonHour').append('<option value="1" selected>07.00-07.40</option>');
                $('#lessonHour').append('<option value="2">07.40-08.20</option>');
                $('#lessonHour').append('<option value="3">08.20-09.00</option>');
                $('#lessonHour').append('<option value="4">09.00-09.40</option>');
                $('#lessonHour').append('<option value="5">09.50-10.30</option>');
                $('#lessonHour').append('<option value="6">10.30-11.10</option>');
                $('#lessonHour').append('<option value="7">11.10-11.50</option>');
            }
        });

        $('#subjectAdd').change(function() {
            let csrfToken = '<?= csrf_token() ?>';
            let csrfHash = '<?= csrf_hash() ?>';
            $.ajax({
                url: "<?= site_url('AdministrationController/getTeacherTimetable') ?>",
                data: {
                    [csrfToken]: csrfHash,
                    idSubject: $(this).find("option:selected").val(),
                },
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    $('#teacherAdd').find('option').remove().end();
                    for (var f = 0; f < data.length; f++) {
                        if (f == 0) {
                            $('#teacherAdd').append('<option value="' + data[f].id_teacher + '" selected >' + data[f].name + '</option>');
                            data.splice(0, 1);
                        }
                        if (data.length > 0) {
                            $('#teacherAdd').append('<option value="' + data[f].id_teacher + '">' + data[f].name + '</option>');
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
        });

        function saveTimetable() {
            let csrfToken = '<?= csrf_token() ?>';
            let csrfHash = '<?= csrf_hash() ?>';
            $.ajax({
                url: "<?= site_url('AdministrationController/saveTimetable') ?>",
                data: {
                    [csrfToken]: csrfHash,
                    day: $('#dayAdd').find(":selected").val(),
                    lesson: $('#lessonHour').find(":selected").val(),
                    lessonTime: $('#lessonHour').find(":selected").text(),
                    idSubject: $('#subjectAdd').find(":selected").val(),
                    idTeacher: $('#teacherAdd').find(":selected").val(),
                    idClass: '<?= $idClass ?>'
                },
                type: "POST",
                beforeSend: function(data) {
                    $('#btneditTimetable').html(loaderBtn);
                    $("#btneditTimetable").attr("disabled", true);
                },
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: 'Data berhasil diupdate!'
                    })
                    $('#btneditTimetable').html(btnReset);
                    $("#btneditTimetable").attr("disabled", false);
                    $('.modal').each(function() {
                        $(this).modal('hide');
                    });
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    reload_senin();
                    reload_selasa();
                    reload_rabu();
                    reload_kamis();
                    reload_jumat();
                    reload_sabtu();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('#btneditTimetable').html(btnReset);
                    $("#btneditTimetable").attr("disabled", false);
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