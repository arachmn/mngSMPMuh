<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="align-middle text-center">#</th>
            <th class="align-middle text-center">Nama Mapel</th>
            <th class="align-middle text-center">Nama Pengampu</th>
            <th class="align-middle text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $a = 0;
        foreach ($subject as $p) : $a++ ?>
            <tr id="tr<?= $a ?>">
                <td class="align-middle text-center"><?= $a ?></td>
                <td class="align-middle"><?= $p['subject_name'] ?></td>
                <td class="align-middle"><?= $p['name'] ?></td>
                <td class="align-middle">
                    <div class="d-flex justify-content-center">
                        <button style="width: 50px;" class="btn btn-outline-warning mr-2" onclick="openPrint('<?= $p['id_subject'] ?>', <?= $a ?>)"><i class="bi bi-printer-fill" style="font-size: 20px;"></i></button>
                        <button style="width: 50px;" class="btn btn-outline-primary mr-2" onclick="openSubject('<?= $p['id_subject'] ?>', <?= $a ?>)"><i class="ion-ios-information" style="font-size: 20px;"></i></button>
                        <button style="width: 50px;" class="btn btn-outline-danger" onclick="deleteSubject('<?= $p['id_subject'] ?>', <?= $a ?>)"><i class="ion-trash-b" style="font-size: 20px;"></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div class="modal fade" id="printSubject" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="p-3 row">
                    <div class="col-6 text-center">
                        <button name="printPresenceBtn" type="button" class="btn btn-outline-primary btn-lg btn-block">
                            Presence
                        </button>
                    </div>
                    <div class="col-6 text-center">
                        <button name="printScoreBtn" type="button" class="btn btn-outline-primary btn-lg btn-block">
                            Nilai
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="semesterScore" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <button name="gajilScore" type="button" class="btn btn-outline-primary btn-lg btn-block">
                            Ganjil
                        </button>
                    </div>
                    <div class="col-6 text-center">
                        <button name="genapScore" type="button" class="btn btn-outline-primary btn-lg btn-block">
                            Genap
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="subjectDetail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Mata Pelajaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body" style="overflow: auto; max-height: 80vh; margin-bottom: 10px; margin-top: 10px">
                <div id="div_subject" class="form-group">
                    <label>Nama Mata Pelajaran</label>
                    <input class="form-control" type="text" name="subject" id="subject">
                    <div id="subject_feedback" class="form-control-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Pengampu</label>
                    <select class="form-control" data-style="btn-outline-primary" id="teacher" name="teacher">
                    </select>
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <input class="form-control" type="text" name="class" id="class" disabled>
                </div>
                <div class="form-group">
                    <label>Kurikulum</label>
                    <select class="form-control" data-style="btn-outline-primary" id="kurikulum" name="kurikulum">
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah Jam Pelajaran</label>
                    <input class="form-control" type="text" name="lesson" id="lesson" disabled>
                </div>
                <div class="form-group">
                    <label>Tahun Ajaran</label>
                    <input class="form-control" type="text" name="school_year" id="school_year" disabled>
                </div>
                <button class="btn btn-outline-primary" type="submit" id="btnUpSubject" name="btnUpSubject" onclick=""><i class="bi bi-send-fill"></i> Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addSubject" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Mata Pelajaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body" style="overflow: auto; max-height: 80vh; margin-bottom: 10px; margin-top: 10px">
                <div id="div_add_subject" class="form-group">
                    <label>Nama Mata Pelajaran</label>
                    <input class="form-control" type="text" name="subjectAdd" id="subjectAdd">
                    <div id="add_subject_feedback" class="form-control-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Pengampu</label>
                    <select class="selectpicker form-control" data-style="btn-outline-primary" id="teacherAdd" name="teacherAdd">
                        <?php for ($f = 0; $f < count($teacherList); $f++) : ?>
                            <?php if ($f == 0) : ?>
                                <option value="<?= $teacherList[$f]['id_teacher'] ?>" selected><?= $teacherList[$f]['name'] ?></option>
                                <?php array_splice($teacherList, 0, 1) ?>
                            <?php endif ?>
                            <option value="<?= $teacherList[$f]['id_teacher'] ?>"><?= $teacherList[$f]['name'] ?></option>
                        <?php endfor ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kurikulum</label>
                    <select class="selectpicker form-control" data-style="btn-outline-primary" id="kurikulumAdd" name="kurikulumAdd">
                        <option value="Merdeka" selected>Merdeka</option>
                        <option value="K-13">K-13</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <input class="form-control" type="text" name="classAdd" id="classAdd" disabled>
                </div>
                <div class="form-group">
                    <label>Tahun Ajaran Masuk</label>
                    <input class="form-control" type="text" name="school_yearAdd" id="school_yearAdd" disabled>
                </div>
                <button class="btn btn-outline-primary" type="submit" id="btnAddSubject" name="btnAddSubject" onclick=""><i class="bi bi-send-fill"></i> Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="dataPresencePrint" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">

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
                    <label>Semester</label>
                    <select class="selectpicker form-control" data-style="btn-outline-primary" id="semester" name="semester">
                        <option value="Ganjil" selected>Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Metode Presensi</label>
                    <select class="selectpicker form-control" data-style="btn-outline-primary" id="method" name="method">
                        <option value="Simple" selected>Simple</option>
                        <option value="Full">Full</option>
                    </select>
                </div>
                <button class="btn btn-outline-primary" type="submit" id="btnPrintSubjectPresence" name="btnPrintSubjectPresence" onclick="printPresence()"><i class="bi bi-printer-fill" style="font-size: 20px;"></i></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var loader = '<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>';
    var loaderBtn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
    var btnReset = '<i class="bi bi-send-fill"></i> Save';

    function openPrint(idSubject, a) {
        $('#printSubject').modal('show');
        $('[name="printScoreBtn"]').attr('onclick', 'openSemesterScore("' + idSubject + '",' + a + ')');
        $('[name="printPresenceBtn"]').attr('onclick', 'dataPrintPresence("' + idSubject + '",' + a + ')');
    }

    function openSemesterScore(idSubject, a) {
        $('#semesterScore').modal('show');
        $('[name="gajilScore"]').attr('onclick', 'printScore("' + idSubject + '",' + a + ',"Ganjil"' + ')');
        $('[name="genapScore"]').attr('onclick', 'printScore("' + idSubject + '",' + a + ',"Genap"' + ')');
    }

    function dataPrintPresence(idSubject, a) {
        $('#dataPresencePrint').modal('show');
        $('.selectpicker').selectpicker();
        $('[name="btnPrintSubjectPresence"]').attr('onclick', 'printPresence("' + idSubject + '",' + a + ')');
        $.ajax({
            url: "<?= site_url('AdministrationController/getDaySubject/') ?>" + idSubject,
            dataType: "JSON",
            success: function(data) {
                $('#day').find('option').remove().end();
                for (var i = 0; i < data.length; i++) {
                    if (i == 0) {
                        $('#day').append('<option value="' + data[i].day + '" selected >' + data[i].day + '</option>');
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
        });
    }

    function printPresence(idSubject, a) {
        var url;
        var semester = $('#semester').find(":selected").val();
        var day = $('#day').find(":selected").val();
        var method = $('#method').find(":selected").val();
        var week = $('#week').find(":selected").val();

        if (day != undefined) {
            if ($('#method').find(":selected").val() == 'Simple') {
                url = "<?= site_url('AdministrationController/printPresenceSimple/') ?>" + idSubject + '/' + semester + '/' + day + '/' + week;

            } else if ($('#method').find(":selected").val() == 'Full') {
                url = "<?= site_url('AdministrationController/printPresenceFull/') ?>" + idSubject + '/' + semester + '/' + day + '/' + week;
            }
            window.open(
                url,
                '_blank'
            );
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Data tidak lengkap!'
            });
        }
    }

    function printScore(idSubject, a, semester) {
        window.open(
            "<?= site_url('AdministrationController/printScore/') ?>" + idSubject + '/' + semester,
            '_blank'
        );
    }

    function openAddSubject() {
        $('#addSubject').modal('show');
        $('[name="btnAddSubject"]').attr('onclick', 'saveSubject()');
        $('[name="school_yearAdd"]').val('<?= $year ?>');
        $('[name="classAdd"]').val('<?= $class ?>');
        $('.selectpicker').selectpicker();

    }

    function saveSubject() {
        var subject = $("#subjectAdd").val();
        if (subject != '') {
            $("#div_add_subject").attr("class", "form-group");
            $("#subjectAdd").attr("class", "form-control form-control-lg form-control");
            $("#add_subject_feedback").html('');
            valError = false;
        }
        if (subject == '') {
            $("#div_add_subject").attr("class", "form-group has-danger");
            $("#subjectAdd").attr("class", "form-control form-control-lg form-control-danger");
            $("#add_subject_feedback").html('Nama Mata Pelajaran tidak boleh kosong');
            valError = true;
        }

        if (valError == true) {
            return false;
        }

        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        $.ajax({
            url: "<?= site_url('AdministrationController/saveSubject') ?>",
            data: {
                [csrfToken]: csrfHash,
                idClass: '<?= $idClass ?>',
                subject: $("#subjectAdd").val(),
                idTeacher: $('#teacherAdd').find(":selected").val(),
                kurikulum: $('#kurikulumAdd').find(":selected").val(),
                school_year: '<?= $year ?>'
            },
            type: "POST",
            beforeSend: function(data) {
                $('#btnAddSubject').html(loaderBtn);
                $("#btnAddSubject").attr("disabled", true);
            },
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: 'Data berhasil diupdate!'
                })
                reload_data();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('#btnAddSubject').html(btnReset);
                $("#btnAddSubject").attr("disabled", false);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: thrownError
                })
            }
        });
    }

    function openSubject(idSubject, a) {
        $("#div_subject").attr("class", "form-group");
        $("#subject").attr("class", "form-control form-control-lg form-control");
        $("#subject_feedback").html('');
        $.ajax({
            url: "<?= site_url('AdministrationController/SubjectDetail/') ?>" + idSubject,
            dataType: "JSON",
            beforeSend: function(data) {
                $('#subjectDetail').modal('show');
            },
            success: function(data) {
                $('[name="subject"]').val(data.subject_name);
                $('[name="class"]').val(data.class);
                $('[name="lesson"]').val(data.lesson);
                $('[name="school_year"]').val(data.school_year);
                $('[name="lesson"]').val(data.clesson);
                $('[name="btnUpSubject"]').attr('onclick', 'updateSubject("' + idSubject + '",' + a + ')');
                if (data.kurikulum == 'Merdeka') {
                    $('#kurikulum').append('<option value="Merdeka" selected>Merdeka</option>');
                    $('#kurikulum').append('<option value="K-13">K-13</option>');
                } else if (data.kurikulum == 'K-13') {
                    $('#kurikulum').append('<option value="K-13" selected>K-13</option>');
                    $('#kurikulum').append('<option value="Merdeka">Merdeka</option>');
                }
                $.ajax({
                    url: "<?= site_url('AdministrationController/getTeacherSubjectDetail') ?>",
                    dataType: "JSON",
                    success: function(data) {
                        $('#teacher').find('option').remove().end();
                        $.ajax({
                            url: "<?= site_url('AdministrationController/SubjectDetail/') ?>" + idSubject,
                            dataType: "JSON",
                            success: function(data) {
                                $('#teacher').append('<option value="' + data.id_teacher + '" selected>' + data.name + '</option>');
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: thrownError
                                })
                            }
                        });
                        for (var i = 0; i < data.length; i++) {
                            $('#teacher').append('<option value="' + data[i].id_teacher + '">' + data[i].name + '</option>');
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

    function updateSubject(idSubject, a) {
        var subject = $("#subject").val();
        if (subject != '') {
            $("#div_subject").attr("class", "form-group");
            $("#subject").attr("class", "form-control form-control-lg form-control");
            $("#subject_feedback").html('');
            valError = false;
        }
        if (subject == '') {
            $("#div_subject").attr("class", "form-group has-danger");
            $("#subject").attr("class", "form-control form-control-lg form-control-danger");
            $("#subject_feedback").html('Nama Mata Pelajaran tidak boleh kosong');
            valError = true;
        }

        if (valError == true) {
            return false;
        }

        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        $.ajax({
            url: "<?= site_url('AdministrationController/subjectDetailUpdate') ?>",
            data: {
                [csrfToken]: csrfHash,
                idSubject: idSubject,
                idTeacher: $('#teacher').find(":selected").val(),
                kurikulum: $('#kurikulum').find(":selected").val(),
            },
            type: "POST",
            beforeSend: function(data) {
                $('#btnUpSubject').html(loaderBtn);
                $("#btnUpSubject").attr("disabled", true);
            },
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: 'Data berhasil diupdate!'
                })
                reload_data();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('#btnUpSubject').html(btnReset);
                $("#btnUpSubject").attr("disabled", false);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: thrownError + ', Gagal mengupdate mata pelajaran!'
                })
            }
        });
    }

    function deleteSubject(idSubject, a) {
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
                    url: "<?= site_url('AdministrationController/deleteSubject') ?>",
                    data: {
                        [csrfToken]: csrfHash,
                        idClass: '<?= $idClass ?>',
                        idSubject: idSubject,
                    },
                    type: "POST",
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: 'Data berhasil dihapus!'
                        })
                        reload_data();
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
</script>