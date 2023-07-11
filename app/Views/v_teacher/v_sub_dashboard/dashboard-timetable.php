<?php if (!empty($timetable)) : ?>
    <div class="mb-2">
        <h5><?= $day ?></h5>
    </div>
    <div class="profile-timeline-list">
        <ul>
            <?php foreach ($timetable as $t) : ?>
                <?php
                if ($t['lesson_hours'] == 1) {
                    if ($day == 'Jumat') {
                        $time = "07.00-07.30";
                    } else {
                        $time = "07.00-07.40";
                    }
                } elseif ($t['lesson_hours'] == 2) {
                    if ($day == 'Jumat') {
                        $time = "07.30-08.00";
                    } else {
                        $time = "07.40-08.20";
                    }
                } elseif ($t['lesson_hours'] == 3) {
                    if ($day == 'Jumat') {
                        $time = "08.00-08.30";
                    } else {
                        $time = "08.20-09.00";
                    }
                } elseif ($t['lesson_hours'] == 4) {
                    if ($day == 'Jumat') {
                        $time = "08.30-09.00";
                    } else {
                        $time = "09.00-09.40";
                    }
                } elseif ($t['lesson_hours'] == 5) {
                    if ($day == 'Jumat') {
                        $time = "09.10-09.40";
                    } else {
                        $time = "09.50-10.30";
                    }
                } elseif ($t['lesson_hours'] == 6) {
                    if ($day == 'Jumat') {
                        $time = "09.40-10.10";
                    } else {
                        $time = "10.30-11.10";
                    }
                } elseif ($t['lesson_hours'] == 7) {
                    if ($day == 'Jumat') {
                        $time = "10.10-10.40";
                    } else {
                        $time = "11.10-11.50";
                    }
                } elseif ($t['lesson_hours'] == 8) {
                    $time = "12.10-12.50";
                } elseif ($t['lesson_hours'] == 9) {
                    $time = "12.50-13.30";
                }
                ?>
                <li>
                    <div class="date"><?= $time ?></div>
                    <div class="task-name">
                        <i class="ion-ios-clock ml-3"></i>&emsp;<?= $t['class'] ?>
                    </div>
                    <div class="task-time ml-3">
                        <a href="#" onclick="openSubject('<?= $t['id_subject'] ?>')"> <?= $t['subject_name'] ?></a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php else : ?>
    <div class="mb-2">
        <h5>No Data</h5>
    </div>
<?php endif ?>
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
<script>
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
                    text: thrownError + ', Gagal meload data!'
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
                    text: thrownError + ', Gagal meload data!'
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
                    text: thrownError + ', Gagal meload data!'
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
                    text: thrownError + ', Gagal meload data!'
                })
            }
        });
    });
</script>