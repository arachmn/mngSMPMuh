<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="align-middle text-center">#</th>
            <th class="align-middle text-center">NIS / NISN</th>
            <th class="align-middle text-center">Name</th>
            <th class="align-middle text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $a = 0;
        foreach ($student as $p) : $a++ ?>
            <tr id="tr<?= $a ?>">
                <td class="align-middle text-center"><?= $a ?></td>
                <td class="align-middle text-center"><?= $p['nis'] ?> / <?= $p['nisn'] ?></td>
                <td class="align-middle"><?= $p['name'] ?></td>
                <td class="align-middle">
                    <div class="d-flex justify-content-center">
                        <button style="width: 50px;" class="btn btn-outline-primary mr-2" onclick="openStudent('<?= $p['id_student'] ?>', <?= $a ?>)"><i class="ion-ios-information" style="font-size: 20px;"></i></button>
                        <button style="width: 50px;" class="btn btn-outline-danger" onclick="deleteStudent('<?= $p['id_student'] ?>', <?= $a ?>)"><i class="ion-trash-b" style="font-size: 20px;"></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div class="modal fade" id="studentDetail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body" style="overflow: auto; max-height: 80vh; margin-bottom: 10px; margin-top: 10px">
                <div class="form-group">
                    <label>NIS</label>
                    <input class="form-control" type="number" name="nis" id="nis">
                </div>
                <div class="form-group">
                    <label>NISN</label>
                    <input class="form-control" type="number" name="nisn" id="nisn">
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" type="text" name="name" id="name">
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <div class="d-flex">
                        <div class="custom-control custom-radio mb-5 mr-20">
                            <input type="radio" id="male" name="gender" class="custom-control-input" value="LAKI-LAKI" />
                            <label class="custom-control-label weight-400" for="male">LAKI-LAKI</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="female" name="gender" class="custom-control-input" value="PEREMPUAN" />
                            <label class="custom-control-label weight-400" for="female">PEREMPUAN</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tahun Ajaran Masuk</label>
                    <input class="form-control" type="text" name="school_year" id="school_year" disabled>
                </div>
                <button class="btn btn-outline-primary" type="submit" id="btnUpStudent" name="btnUpStudent" onclick="">
                    <i class="bi bi-send-fill"></i> Save
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body" style="overflow: auto; max-height: 80vh; margin-bottom: 10px; margin-top: 10px">
                <div id="div_add_nis" class="form-group add_nis">
                    <label>NIS</label>
                    <input class="form-control" type="number" name="nisAdd" id="nisAdd">
                    <div id="add_nis_feedback" class="form-control-feedback">
                    </div>
                </div>
                <div id="div_add_nisn" class="form-group add_nisn">
                    <label>NISN</label>
                    <input class="form-control" type="number" name="nisnAdd" id="nisnAdd">
                    <div id="add_nisn_feedback" class="form-control-feedback">
                    </div>
                </div>
                <div id="div_add_name" class="form-group add_name">
                    <label>Name</label>
                    <input class="form-control" type="text" name="nameAdd" id="nameAdd">
                    <div id="add_name_feedback" class="form-control-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <div class="d-flex">
                        <div class="custom-control custom-radio mb-5 mr-20">
                            <input type="radio" id="maleAdd" name="genderAdd" class="custom-control-input" value="LAKI-LAKI" checked />
                            <label class="custom-control-label weight-400" for="maleAdd">LAKI-LAKI</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="femaleAdd" name="genderAdd" class="custom-control-input" value="PEREMPUAN" />
                            <label class="custom-control-label weight-400" for="femaleAdd">PEREMPUAN</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tahun Ajaran Masuk</label>
                    <input class="form-control" type="text" name="school_yearAdd" id="school_yearAdd" disabled>
                </div>
                <button class="btn btn-outline-primary" type="submit" id="btnAddStudent" name="btnAddStudent" onclick="">
                    <i class="bi bi-send-fill"></i> Save
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var loader = '<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>';
    var loaderBtn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
    var btnReset = '<i class="bi bi-send-fill"></i> Save';

    function openStudent(idStudent, a) {
        $.ajax({
            url: "<?= site_url('AdministrationController/StudentDetail/') ?>" + idStudent,
            dataType: "JSON",
            beforeSend: function(data) {
                $('#studentDetail').modal('show');
            },
            success: function(data) {
                $('[name="nis"]').val(data.nis);
                $('[name="nisn"]').val(data.nisn);
                $('[name="name"]').val(data.name);
                $('[name="school_year"]').val(data.school_year);
                $('[name="btnUpStudent"]').attr('onclick', 'updateStudent("' + idStudent + '",' + a + ')');
                if (data.gender == 'LAKI-LAKI') {
                    $("#male").attr('checked', 'checked');
                } else if (data.gender == 'PEREMPUAN') {
                    $("#female").attr('checked', 'checked');
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

    function updateStudent(idStudent, a) {
        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        $.ajax({
            url: "<?= site_url('AdministrationController/studentDetailIpdate') ?>",
            data: {
                [csrfToken]: csrfHash,
                idStudent: idStudent,
                nis: $("#nis").val(),
                nisn: $("#nisn").val(),
                name: $("#name").val(),
                school_year: $("#school_year").val(),
                gender: $('input[name="gender"]:checked').val()
            },
            type: "POST",
            beforeSend: function(data) {
                $('#btnUpStudent').html(loaderBtn);
                $("#btnUpStudent").attr("disabled", true);
            },
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: 'Data berhasil diupdate!'
                })
                reload_table(a);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('#btnUpStudent').html(btnReset);
                $("#btnUpStudent").attr("disabled", false);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: thrownError
                })
            }
        });
    }

    function deleteStudent(idStudent, a) {
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
                    url: "<?= site_url('AdministrationController/deleteStudent') ?>",
                    data: {
                        [csrfToken]: csrfHash,
                        idClass: '<?= $idClass ?>',
                        idStudent: idStudent,
                    },
                    type: "POST",
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: 'Data berhasil dihapus!'
                        })
                        reload_table(a);
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

    function openAddStudent() {
        $('#addStudent').modal('show');
        $('[name="btnAddStudent"]').attr('onclick', 'saveStudent()');
        $('[name="school_yearAdd"]').val('<?= $year ?>');
    }

    function saveStudent() {
        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        var name = $("#nameAdd").val();
        var nis = $("#nisAdd").val();
        var nisn = $("#nisnAdd").val();
        var valError;
        var textNumber;

        if (name != '') {
            $("#div_add_name").attr("class", "form-group");
            $("#nameAdd").attr("class", "form-control form-control-lg form-control");
            $("#add_name_feedback").html('');
            valError = false;
        }

        if (nisn != '' && $.isNumeric(nisn) == true) {
            $("#div_add_nisn").attr("class", "form-group");
            $("#nisnAdd").attr("class", "form-control form-control-lg form-control");
            $("#add_nisn_feedback").html('');
            valError = false;
        }

        if (nis != '' && $.isNumeric(nis) == true) {
            $("#div_add_nis").attr("class", "form-group");
            $("#nisAdd").attr("class", "form-control form-control-lg form-control");
            $("#add_nis_feedback").html('');
            valError = false;
        }

        if (name == '') {
            $("#div_add_name").attr("class", "form-group has-danger");
            $("#nameAdd").attr("class", "form-control form-control-lg form-control-danger");
            $("#add_name_feedback").html('Name tidak boleh kosong');
            valError = true;
        }

        if (nis != '' && $.isNumeric(nis) == false) {
            $("#div_add_nis").attr("class", "form-group has-danger");
            $("#nisAdd").attr("class", "form-control form-control-lg form-control-danger");
            $("#add_nis_feedback").html('NIS harus berupa angka');
            valError = true;
        }

        if (nis == '') {
            $("#div_add_nis").attr("class", "form-group has-danger");
            $("#nisAdd").attr("class", "form-control form-control-lg form-control-danger");
            $("#add_nis_feedback").html('NIS tidak boleh kosong');
            valError = true;
        }

        if (nisn != '' && $.isNumeric(nisn) == false) {
            $("#div_add_nisn").attr("class", "form-group has-danger");
            $("#nisnAdd").attr("class", "form-control form-control-lg form-control-danger");
            $("#add_nisn_feedback").html('NISN harus berupa angka');
            valError = true;
        }

        if (valError == true) {
            return false;
        }

        $.ajax({
            url: "<?= site_url('AdministrationController/saveStudent') ?>",
            data: {
                [csrfToken]: csrfHash,
                idClass: '<?= $idClass ?>',
                nis: $("#nisAdd").val(),
                nisn: $("#nisnAdd").val(),
                name: $("#nameAdd").val(),
                school_year: $("#school_yearAdd").val(),
                gender: $('input[name="genderAdd"]:checked').val()
            },
            type: "POST",
            beforeSend: function(data) {
                $('#btnAddStudent').html(loaderBtn);
                $("#btnAddStudent").attr("disabled", true);
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
                reload_table(1);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('#btnAddStudent').html(btnReset);
                $("#btnAddStudent").attr("disabled", false);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: thrownError
                })
            }
        });
    }
</script>