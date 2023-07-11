<table class="table table-bordered table-striped" id="scoreTab">
    <thead>
        <tr>
            <th class="align-middle text-center">#</th>
            <th class="align-middle text-center">NIS / NISN</th>
            <th class="align-middle text-center">Nama</th>
            <th class="align-middle text-center">Formatif</th>
            <th class="align-middle text-center">RR Formatif</th>
            <th class="align-middle text-center">Sumatif LM</th>
            <th class="align-middle text-center">RR Sumatif</th>
            <th class="align-middle text-center">Sumatif AS</th>
            <th class="align-middle text-center">NR</th>
        </tr>
    </thead>
    <tbody>
        <?php $a = 0;
        foreach ($score as $s) : $a++ ?>
            <tr id="tr<?= $a ?>">
                <td class="align-middle text-center"><?= $a ?></td>
                <td class="align-middle text-center"><?= $s['nis'] ?> / <?= $s['nisn'] ?></td>
                <td class="align-middle"><?= $s['name'] ?></td>
                <td class="align-middle text-center">
                    <button class="btn btn-outline-primary" data-toggle="modal" id="formatif<?= $a ?>" data-target="#formatif<?= $a ?>" type="button">Open</button>
                </td>
                <div class="modal fade" id="formatif<?= $a ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Pilih Lingkup Materi</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    ×
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="p-2" style="overflow: auto;">
                                    <?php
                                    $nama = $s['name'];
                                    if (strpos($nama, "'") !== false) :
                                        $namanya = str_replace("'", '', $nama);
                                    ?>
                                        <div class="btn-group btn-block" role="group" aria-label="First group">
                                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#formatif_lm1" type="button" onclick="openFormatif('<?= $s['id_student'] ?>', '<?= $namanya ?>', 1, <?= $a ?>)">
                                                1
                                            </button>
                                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#formatif_lm2" type="button" onclick="openFormatif('<?= $s['id_student'] ?>', '<?= $namanya ?>', 2, <?= $a ?>)">
                                                2
                                            </button>
                                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#formatif_lm3" type="button" onclick="openFormatif('<?= $s['id_student'] ?>', '<?= $namanya ?>', 3, <?= $a ?>)">
                                                3
                                            </button>
                                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#formatif_lm4" type="button" onclick="openFormatif('<?= $s['id_student'] ?>', '<?= $namanya ?>', 4, <?= $a ?>)">
                                                4
                                            </button>
                                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#formatif_lm5" type="button" onclick="openFormatif('<?= $s['id_student'] ?>', '<?= $namanya ?>', 5, <?= $a ?>)">
                                                5
                                            </button>
                                        </div>
                                    <?php else : ?>
                                        <div class="btn-group btn-block" role="group" aria-label="First group">
                                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#formatif_lm1" type="button" onclick="openFormatif('<?= $s['id_student'] ?>', '<?= $s['name'] ?>', 1, <?= $a ?>)">
                                                1
                                            </button>
                                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#formatif_lm2" type="button" onclick="openFormatif('<?= $s['id_student'] ?>', '<?= $s['name'] ?>', 2, <?= $a ?>)">
                                                2
                                            </button>
                                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#formatif_lm3" type="button" onclick="openFormatif('<?= $s['id_student'] ?>', '<?= $s['name'] ?>', 3, <?= $a ?>)">
                                                3
                                            </button>
                                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#formatif_lm4" type="button" onclick="openFormatif('<?= $s['id_student'] ?>', '<?= $s['name'] ?>', 4, <?= $a ?>)">
                                                4
                                            </button>
                                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#formatif_lm5" type="button" onclick="openFormatif('<?= $s['id_student'] ?>', '<?= $s['name'] ?>', 5, <?= $a ?>)">
                                                5
                                            </button>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <td class="align-middle text-center"><?= $s['average_for'] == '' ? '-' : $s['average_for'] ?></td>
                <td class="align-middle text-center">
                    <?php
                    $nama = $s['name'];
                    if (strpos($nama, "'") !== false) :
                        $namanya = str_replace("'", '', $nama);
                    ?>
                        <button class="btn btn-outline-primary" type="button" onclick="openSumatif('<?= $s['id_student'] ?>', '<?= $namanya ?>', <?= $a ?>)">Open</button>
                    <?php else : ?>
                        <button class="btn btn-outline-primary" type="button" onclick="openSumatif('<?= $s['id_student'] ?>', '<?= $s['name'] ?>', <?= $a ?>)">Open</button>
                    <?php endif ?>
                </td>
                <td class="align-middle text-center"><?= $s['average_sum'] == '' ? '-' : $s['average_sum'] ?></td>
                <td class="align-middle text-center">
                    <?php
                    $nama = $s['name'];
                    if (strpos($nama, "'") !== false) :
                        $namanya = str_replace("'", '', $nama);
                    ?>
                        <button style="min-height: 44.6px; min-width: 58.31px" class="btn btn-outline-primary" type="button" onclick="openSumatifLast('<?= $s['id_student'] ?>', '<?= $namanya ?>', <?= $a ?>)">
                            <?= $s['sum_last'] == '' ? '-' : $s['sum_last'] ?>
                        </button>
                    <?php else : ?>
                        <button style="min-height: 44.6px; min-width: 58.31px" class="btn btn-outline-primary" type="button" onclick="openSumatifLast('<?= $s['id_student'] ?>', '<?= $s['name'] ?>', <?= $a ?>)">
                            <?= $s['sum_last'] == '' ? '-' : $s['sum_last'] ?>
                        </button>
                    <?php endif ?>
                </td>
                <td class="align-middle text-center"><?= $s['nr'] == '' ? '-' : $s['nr'] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php for ($j = 1; $j <= 5; $j++) : ?>
    <div class="modal fade" id="formatif_lm<?= $j ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Formatif Lingkup Materi <?= $j ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <h5 name="formatifName" class="mb-3 text-primary"></h5>
                    <div class="form-group">
                        <label>TP 1</label>
                        <input class="form-control" type="number" name="lm<?= $j ?>_tp1" id="lm<?= $j ?>_tp1">
                    </div>
                    <div class="form-group">
                        <label>TP 2</label>
                        <input class="form-control" type="number" name="lm<?= $j ?>_tp2" id="lm<?= $j ?>_tp2">
                    </div>
                    <div class="form-group">
                        <label>TP 3</label>
                        <input class="form-control" type="number" name="lm<?= $j ?>_tp3" id="lm<?= $j ?>_tp3">
                    </div>
                    <div class="form-group">
                        <label>TP 4</label>
                        <input class="form-control" type="number" name="lm<?= $j ?>_tp4" id="lm<?= $j ?>_tp4">
                    </div>
                    <button class="btn btn-outline-primary" type="submit" name="btnFormatif" id="btnFormatif" onclick=""><i class="bi bi-send-fill"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
<?php endfor ?>
<div class="modal fade" id="sumatif" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sumatif Lingkup Materi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <h5 name="sumatifName" class="mb-3 text-primary"></h5>
                <div class="form-group">
                    <label>LM 1</label>
                    <input class="form-control" type="number" name="lm1" id="lm1">
                </div>
                <div class="form-group">
                    <label>LM 2</label>
                    <input class="form-control" type="number" name="lm2" id="lm2">
                </div>
                <div class="form-group">
                    <label>LM 3</label>
                    <input class="form-control" type="number" name="lm3" id="lm3">
                </div>
                <div class="form-group">
                    <label>LM 4</label>
                    <input class="form-control" type="number" name="lm4" id="lm4">
                </div>
                <div class="form-group">
                    <label>LM 5</label>
                    <input class="form-control" type="number" name="lm5" id="lm5">
                </div>
                <button class="btn btn-outline-primary" type="submit" name="btnSumatif" id="btnSumatif" onclick=""><i class="bi bi-send-fill"></i> Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="sumatifLast" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sumatif Akhir Semester</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <h5 name="sumatifLastName" class="mb-3 text-primary"></h5>
                <div class="form-group">
                    <label>Nilai</label>
                    <input class="form-control" type="number" name="smLast" id="smLast">
                </div>
                <button class="btn btn-outline-primary" type="submit" id="btnSumatifLast" name="btnSumatifLast" onclick=""><i class="bi bi-send-fill"></i> Save</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('[name="printScore"]').attr('onclick', 'printScore("Merdeka")');
    var loader = '<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>';
    var loaderBtn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
    var btnReset = '<i class="bi bi-send-fill"></i> Save';

    function openFormatif(idStudent, name, lm, a) {
        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        <?php for ($t = 1; $t <= 5; $t++) : ?>
            if (lm == <?= $t ?>) {
                $.ajax({
                    url: "<?= site_url('TeacherController/subjectScoreShowMerdeka') ?>",
                    data: {
                        [csrfToken]: csrfHash,
                        idSubject: '<?= $idSubject ?>',
                        idStudent: idStudent,
                        semester: '<?= $semester ?>',
                    },
                    type: "POST",
                    dataType: "JSON",
                    beforeSend: function(data) {
                        $('#formatif_lm' + lm).modal('show');
                    },
                    success: function(data) {
                        $('[name="lm<?= $t ?>_tp1"]').val(data.lm<?= $t ?>_tp1);
                        $('[name="lm<?= $t ?>_tp2"]').val(data.lm<?= $t ?>_tp2);
                        $('[name="lm<?= $t ?>_tp3"]').val(data.lm<?= $t ?>_tp3);
                        $('[name="lm<?= $t ?>_tp4"]').val(data.lm<?= $t ?>_tp4);
                        $('[name="formatifName"]').text(name);
                        $('[name="btnFormatif"]').attr('onclick', 'updateFormatif("' + idStudent + '",' + lm + ',' + a + ')');
                        $('[name="closeFormatif"]').attr('onclick', 'reload_table("<?= $idSubject ?>", "<?= $semester ?>",' + a + ')');
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
        <?php endfor ?>
    }

    function openSumatif(idStudent, name, a) {
        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        $.ajax({
            url: "<?= site_url('TeacherController/subjectScoreShowMerdeka') ?>",
            data: {
                [csrfToken]: csrfHash,
                idSubject: '<?= $idSubject ?>',
                idStudent: idStudent,
                semester: '<?= $semester ?>',
            },
            type: "POST",
            dataType: "JSON",
            beforeSend: function(data) {
                $('#sumatif').modal('show');
            },
            success: function(data) {
                $('[name="lm1"]').val(data.sum_lm_1);
                $('[name="lm2"]').val(data.sum_lm_2);
                $('[name="lm3"]').val(data.sum_lm_3);
                $('[name="lm4"]').val(data.sum_lm_4);
                $('[name="lm5"]').val(data.sum_lm_5);
                $('[name="sumatifName"]').text(name);
                $('[name="btnSumatif"]').attr('onclick', 'updateSumatif("' + idStudent + '",' + a + ')');
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

    function openSumatifLast(idStudent, name, a) {
        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        $.ajax({
            url: "<?= site_url('TeacherController/subjectScoreShowMerdeka') ?>",
            data: {
                [csrfToken]: csrfHash,
                idSubject: '<?= $idSubject ?>',
                idStudent: idStudent,
                semester: '<?= $semester ?>',
            },
            type: "POST",
            dataType: "JSON",
            beforeSend: function(data) {
                $('#sumatifLast').modal('show');
            },
            success: function(data) {
                $('[name="smLast"]').val(data.sum_last);
                $('[name="sumatifLastName"]').text(name);
                $('[name="btnSumatifLast"]').attr('onclick', 'updateSumatifLast("' + idStudent + '",' + a + ')');
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

    function updateFormatif(idStudent, lm, a) {
        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        <?php for ($t = 1; $t <= 5; $t++) : ?>
            if (lm == <?= $t ?>) {
                $.ajax({
                    url: "<?= site_url('TeacherController/subjectScoreUpdateFormatif') ?>",
                    data: {
                        [csrfToken]: csrfHash,
                        idStudent: idStudent,
                        idSubject: '<?= $idSubject ?>',
                        lm<?= $t ?>_tp1: $("#lm<?= $t ?>_tp1").val(),
                        lm<?= $t ?>_tp2: $("#lm<?= $t ?>_tp2").val(),
                        lm<?= $t ?>_tp3: $("#lm<?= $t ?>_tp3").val(),
                        lm<?= $t ?>_tp4: $("#lm<?= $t ?>_tp4").val(),
                        lm: <?= $t ?>,
                        semester: '<?= $semester ?>',
                    },
                    type: "POST",
                    beforeSend: function(data) {
                        $('#btnFormatif').html(loaderBtn);
                        $("#btnFormatif").attr("disabled", true);
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: 'Data berhasil diupdate!'
                        })
                        $('.modal').each(function() {
                            $(this).modal('hide');
                        });
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        reload_table("<?= $idSubject ?>", "<?= $semester ?>", a);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $('#btnFormatif').html(btnReset);
                        $("#btnFormatif").attr("disabled", false);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: thrownError
                        })
                    }
                });
            }
        <?php endfor ?>
    }

    function updateSumatif(idStudent, a) {
        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        $.ajax({
            url: "<?= site_url('TeacherController/subjectScoreUpdateSumatif') ?>",
            data: {
                [csrfToken]: csrfHash,
                idStudent: idStudent,
                idSubject: '<?= $idSubject ?>',
                lm1: $("#lm1").val(),
                lm2: $("#lm2").val(),
                lm3: $("#lm3").val(),
                lm4: $("#lm4").val(),
                lm5: $("#lm5").val(),
                semester: '<?= $semester ?>',
            },
            type: "POST",
            beforeSend: function(data) {
                $('#btnSumatif').html(loaderBtn);
                $("#btnSumatif").attr("disabled", true);
            },
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: 'Data berhasil diupdate!'
                })
                reload_table("<?= $idSubject ?>", "<?= $semester ?>", a);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('#btnSumatif').html(btnReset);
                $("#btnSumatif").attr("disabled", false);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: thrownError
                })
            }
        });
    }

    function updateSumatifLast(idStudent, a) {
        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        $.ajax({
            url: "<?= site_url('TeacherController/subjectScoreUpdateSumatifLast') ?>",
            data: {
                [csrfToken]: csrfHash,
                idStudent: idStudent,
                idSubject: '<?= $idSubject ?>',
                smLast: $("#smLast").val(),
                semester: '<?= $semester ?>',
            },
            type: "POST",
            beforeSend: function(data) {
                $('#btnSumatifLast').html(loaderBtn);
                $("#btnSumatifLast").attr("disabled", true);
            },
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: 'Data berhasil diupdate!'
                })
                reload_table("<?= $idSubject ?>", "<?= $semester ?>", a);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('#btnSumatifLast').html(btnReset);
                $("#btnSumatifLast").attr("disabled", false);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: thrownError
                })
            }
        });
    }
</script>