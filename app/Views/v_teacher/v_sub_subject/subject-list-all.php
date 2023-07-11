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
                                <h4>Mata Pelajaran | <?= $year ?></h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('teacher/subject') ?>">Tahun Ajaran</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Mata Pelajaran
                                    </li>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="pd-20 card-box mb-30">
                    <h5 class="h4 text-blue mb-20 d-inline">List Mata Pelajaran</h5>
                    <div class="d-inline" style="float: right;">
                        <a class="btn btn-primary" id="teacherMaster" name="teacherMaster" href="<?= site_url('teacher/subject/' . $year) ?>">
                            <i class="fa fa-exchange" style="font-size: 20px;"></i>
                        </a>
                    </div>

                    <div class="tab mt-3">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#classVII" role="tab" aria-selected="true">VII</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#classVIII" role="tab" aria-selected="false">VIII</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#classIX" role="tab" aria-selected="false">IX</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="classVII" role="tabpanel">
                                <div class="pd-20">
                                    <div id="tableSubjectVII" style="overflow: auto;">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="classVIII" role="tabpanel">
                                <div class="pd-20">
                                    <div id="tableSubjectVIII" style="overflow: auto;">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="classIX" role="tabpanel">
                                <div class="pd-20">
                                    <div id="tableSubjectIX" style="overflow: auto;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="subjectOpen" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Manajemen Siswa</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    ×
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <div class="p-3 row">
                                    <div class="col-6 text-center">
                                        <button name="subjectPresence" type="button" class="btn btn-outline-primary btn-lg btn-block">
                                            Presence
                                        </button>
                                    </div>
                                    <div class="col-6 text-center">
                                        <button name="subjectScore" type="button" class="btn btn-outline-primary btn-lg btn-block">
                                            Score
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="scoreModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Pilih Semester</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    ×
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <div class="p-3 row">
                                    <div class="col-6 text-center">
                                        <a name="scoreGanjil" class="btn btn-outline-primary btn-lg btn-block">
                                            Ganjil
                                        </a>
                                    </div>
                                    <div class="col-6 text-center">
                                        <a name="scoreGenap" class="btn btn-outline-primary btn-lg btn-block">
                                            Genap
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="presenceModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Pilih Data</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    ×
                                </button>
                            </div>
                            <div class="modal-body" style="overflow: auto; max-height: 80vh; margin-bottom: 10px; margin-top: 10px">
                                <input type="hidden" name="idSubject" id="idSubject" value="">
                                <div class="form-group">
                                    <label>Nama Mata Pelajaran</label>
                                    <input class="form-control" type="text" name="subjectName" id="subjectName" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Semester</label>
                                    <select class="selectpicker form-control" data-style="btn-outline-primary" id="semesterPresence" name="semesterPresence">
                                        <option value="Ganjil" selected>Ganjil</option>
                                        <option value="Genap">Genap</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pekan</label>
                                    <select class="selectpicker form-control" data-style="btn-outline-primary" id="week" name="week">
                                        <option value="week-1" selected>Pekan 1</option>
                                        <option value="week-2">Pekan 2</option>
                                        <option value="week-3">Pekan 3</option>
                                        <option value="week-4">Pekan 4</option>
                                        <option value="week-5">Pekan 5</option>
                                        <option value="week-6">Pekan 6</option>
                                        <option value="week-7">Pekan 7</option>
                                        <option value="week-8">Pekan 8</option>
                                        <option value="week-9">Pekan 9</option>
                                        <option value="week-10">Pekan 10</option>
                                        <option value="week-11">Pekan 11</option>
                                        <option value="week-12">Pekan 12</option>
                                        <option value="week-13">Pekan 13</option>
                                        <option value="week-14">Pekan 14</option>
                                        <option value="week-15">Pekan 15</option>
                                        <option value="week-16">Pekan 16</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Hari</label>
                                    <select class="form-control" id="day" name="day">

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Metode Presensi</label>
                                    <select class="selectpicker form-control" data-style="btn-outline-primary" id="method" name="method">
                                        <option value="simple" selected>Simple</option>
                                        <option value="full">Full</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Rekap</label>
                                    <select class="selectpicker form-control" data-style="btn-outline-primary" id="presen" name="presen">
                                        <option value="hadir" selected>Hadir</option>
                                        <option value="izin">Izin</option>
                                        <option value="sakit">Sakit</option>
                                        <option value="alpa">Alpa</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input class="form-control" type="text" name="countPres" id="countPres" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Aktifitas Terakhir</label>
                                    <input class="form-control" type="text" name="dataActivity" id="dataActivity" value="" disabled>
                                </div>

                                <button class="btn btn-outline-primary" type="submit" id="btnPresence" name="btnPresence" onclick=""> <i class="bi bi-send-fill"></i> Open</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="subjectDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Detail Mata Pelajaran</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    ×
                                </button>
                            </div>
                            <div class="modal-body" style="overflow: auto; max-height: 80vh; margin-bottom: 10px; margin-top: 10px">
                                <div class="form-group">
                                    <label>Nama Mata Pelajaran</label>
                                    <input class="form-control" type="text" name="subjectName" id="subjectName" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <input class="form-control" type="text" name="classSubject" id="classSubject" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Nama Pengampu</label>
                                    <input class="form-control" type="text" name="subjectTeacher" id="subjectTeacher" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Kurikulum</label>
                                    <input class="form-control" type="text" name="kurikulum" id="kurikulum" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Jam Pelajaran</label>
                                    <input class="form-control" type="text" name="lesson" id="lesson" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Tahun Ajaran</label>
                                    <input class="form-control" type="text" name="schoolYear" id="schoolYear" disabled>
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

        reload_VII();
        reload_VIII();
        reload_IX();

        function reload_VII() {
            $.ajax({
                url: "<?= site_url('TeacherController/subjectListDataAllVII/' . $year) ?>",
                beforeSend: function(f) {
                    $('#tableSubjectVII').html(loader);
                },
                success: function(data) {
                    $('#tableSubjectVII').html(data);
                    $('.modal').each(function() {
                        $(this).modal('hide');
                    });
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
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

        function reload_VIII() {
            $.ajax({
                url: "<?= site_url('TeacherController/subjectListDataAllVIII/' . $year) ?>",
                beforeSend: function(f) {
                    $('#tableSubjectVIII').html(loader);
                },
                success: function(data) {
                    $('#tableSubjectVIII').html(data);
                    $('.modal').each(function() {
                        $(this).modal('hide');
                    });
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
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

        function reload_IX() {
            $.ajax({
                url: "<?= site_url('TeacherController/subjectListDataAllIX/' . $year) ?>",
                beforeSend: function(f) {
                    $('#tableSubjectIX').html(loader);
                },
                success: function(data) {
                    $('#tableSubjectIX').html(data);
                    $('.modal').each(function() {
                        $(this).modal('hide');
                    });
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
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

        function openSubject(idSubject) {
            $('#subjectOpen').modal('show');
            $('[name="subjectPresence"]').attr('onclick', 'openModalPresence("' + idSubject + '")');
            $('[name="subjectScore"]').attr('onclick', 'openModalScore("' + idSubject + '")');
        }

        function openModalScore(idSubject) {
            var url;
            $.ajax({
                url: "<?= site_url('TeacherController/subjectDetailModal/') ?>" + idSubject,
                dataType: "JSON",
                beforeSend: function(data) {
                    $('#scoreModal').modal('show');
                },
                success: function(data) {
                    urlGanjil = "<?= site_url('teacher/subject/' . $year . '/') ?>" + idSubject + '/Ganjil/score/' + data.kurikulum;
                    urlGenap = "<?= site_url('teacher/subject/' . $year . '/') ?>" + idSubject + '/Genap/score/' + data.kurikulum;
                    $('[name="scoreGanjil"]').attr('href', urlGanjil)
                    $('[name="scoreGenap"]').attr('href', urlGenap)
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

        function subjectDetailModal(idSubject) {
            $('.selectpicker').selectpicker();
            var semester = $('#semesterPresence').find("option:selected").val();
            var week = $('#week').find("option:selected").val();

            $.ajax({
                url: "<?= site_url('TeacherController/subjectDetailModal/') ?>" + idSubject,
                dataType: "JSON",
                beforeSend: function(data) {
                    $('#subjectDetailModal').modal('show');
                },
                success: function(data) {
                    $('[name="subjectName"]').val(data.subject_name);
                    $('[name="classSubject"]').val(data.class);
                    $('[name="subjectTeacher"]').val(data.name);
                    $('[name="kurikulum"]').val(data.kurikulum);
                    $('[name="schoolYear"]').val(data.school_year);
                    $('[name="lesson"]').val(data.clesson);
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

        function openModalPresence(idSubject) {
            $('.selectpicker').selectpicker();
            var semester = $('#semesterPresence').find("option:selected").val();
            var week = $('#week').find("option:selected").val();
            var rekap = $('#presen').val();

            $('[name="btnPresence"]').attr('onclick', 'openPresenceData("' + idSubject + '")');
            $.ajax({
                url: "<?= site_url('TeacherController/openSubjectPresenceModal/') ?>" + idSubject,
                dataType: "JSON",
                beforeSend: function(data) {
                    $('#presenceModal').modal('show');
                },
                success: function(data) {
                    $('[name="subjectName"]').val(data.subject_name);
                    $('[name="classSubject"]').val(data.class);
                    $('[name="subjectTeacher"]').val(data.name);
                    $('[name="idSubject"]').val(data.id_subject);

                    $.ajax({
                        url: "<?= site_url('TeacherController/subjectPresenceModal/') ?>" + idSubject,
                        dataType: "JSON",
                        success: function(data) {
                            $('#day').find('option').remove().end();
                            for (var i = 0; i < data.length; i++) {
                                if (i == 0) {
                                    $('#day').append('<option value="' + data[i].day + '" selected >' + data[i].day + '</option>');
                                    $.ajax({
                                        url: "<?= site_url('TeacherController/getLastActifity/') ?>" + idSubject + '/' + semester + '/' + week + '/' + $('#day').find("option:selected").val(),
                                        dataType: "JSON",
                                        success: function(data) {
                                            $('#dataActivity').val(data.lastActivity);
                                            if (rekap == 'hadir') {
                                                $('#countPres').val(data.hadir);
                                            } else if (rekap == 'izin') {
                                                $('#countPres').val(data.izin);
                                            } else if (rekap == 'sakit') {
                                                $('#countPres').val(data.sakit);
                                            } else if (rekap == 'alpa') {
                                                $('#countPres').val(data.alpa);
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
                                    data.splice(i, 1);
                                }
                                if (data.length != 0) {
                                    $('#day').append('<option value="' + data[i].day + '">' + data[i].day + '</option>');
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
                    })
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

        function openPresenceData(idSubject) {
            var url;
            var semester = $('#semesterPresence').find(":selected").val();
            var day = $('#day').find(":selected").val();
            var method = $('#method').find(":selected").val();
            var week = $('#week').find(":selected").val();

            url = "<?= site_url('teacher/subject/' . $year . '/') ?>" + idSubject + '/' + semester + '/presence/' + week + '/' + day + '/' + method;

            window.location.href = url;
        }

        $('#week').change(function() {
            var week = $('#week').find("option:selected").val();
            var day = $('#day').find("option:selected").val();
            var idSubject = $('#idSubject').val();
            var semester = $('#semesterPresence').val();
            var rekap = $('#presen').val();

            $.ajax({
                url: "<?= site_url('TeacherController/getLastActifity/') ?>" + idSubject + '/' + semester + '/' + week + '/' + day,
                dataType: "JSON",
                success: function(data) {
                    $('#dataActivity').val(data.lastActivity);
                    if (rekap == 'hadir') {
                        $('#countPres').val(data.hadir);
                    } else if (rekap == 'izin') {
                        $('#countPres').val(data.izin);
                    } else if (rekap == 'sakit') {
                        $('#countPres').val(data.sakit);
                    } else if (rekap == 'alpa') {
                        $('#countPres').val(data.alpa);
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

        $('#day').change(function() {
            var week = $('#week').find("option:selected").val();
            var day = $('#day').find("option:selected").val();
            var idSubject = $('#idSubject').val();
            var semester = $('#semesterPresence').val();
            var rekap = $('#presen').val();
            $.ajax({
                url: "<?= site_url('TeacherController/getLastActifity/') ?>" + idSubject + '/' + semester + '/' + week + '/' + day,
                dataType: "JSON",
                success: function(data) {
                    $('#dataActivity').val(data.lastActivity);
                    if (rekap == 'hadir') {
                        $('#countPres').val(data.hadir);
                    } else if (rekap == 'izin') {
                        $('#countPres').val(data.izin);
                    } else if (rekap == 'sakit') {
                        $('#countPres').val(data.sakit);
                    } else if (rekap == 'alpa') {
                        $('#countPres').val(data.alpa);
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

        $('#semesterPresence').change(function() {
            var week = $('#week').find("option:selected").val();
            var day = $('#day').find("option:selected").val();
            var idSubject = $('#idSubject').val();
            var semester = $('#semesterPresence').val();
            var rekap = $('#presen').val();

            $.ajax({
                url: "<?= site_url('TeacherController/getLastActifity/') ?>" + idSubject + '/' + semester + '/' + week + '/' + day,
                dataType: "JSON",
                success: function(data) {
                    $('#dataActivity').val(data.lastActivity);
                    if (rekap == 'hadir') {
                        $('#countPres').val(data.hadir);
                    } else if (rekap == 'izin') {
                        $('#countPres').val(data.izin);
                    } else if (rekap == 'sakit') {
                        $('#countPres').val(data.sakit);
                    } else if (rekap == 'alpa') {
                        $('#countPres').val(data.alpa);
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

        $('#presen').change(function() {
            var week = $('#week').find("option:selected").val();
            var day = $('#day').find("option:selected").val();
            var idSubject = $('#idSubject').val();
            var semester = $('#semesterPresence').val();
            var rekap = $('#presen').val();

            $.ajax({
                url: "<?= site_url('TeacherController/getLastActifity/') ?>" + idSubject + '/' + semester + '/' + week + '/' + day,
                dataType: "JSON",
                success: function(data) {
                    $('#dataActivity').val(data.lastActivity);
                    if (rekap == 'hadir') {
                        $('#countPres').val(data.hadir);
                    } else if (rekap == 'izin') {
                        $('#countPres').val(data.izin);
                    } else if (rekap == 'sakit') {
                        $('#countPres').val(data.sakit);
                    } else if (rekap == 'alpa') {
                        $('#countPres').val(data.alpa);
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
    </script>
</body>

</html>