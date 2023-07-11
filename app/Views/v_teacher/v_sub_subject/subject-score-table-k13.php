<style>
    #scoreTab tr:nth-child(4n+1),
    #scoreTab tr:nth-child(4n+2) {
        background-color: #f2f2f2;
    }
</style>
<table class="table table-bordered" id="scoreTab">
    <thead>
        <tr>
            <td class="align-middle text-center bg-light">#</td>
            <td class="align-middle text-center bg-light">NIS / NISN</td>
            <td class="align-middle text-center bg-light">Nama</td>
        </tr>
    </thead>
    <tbody>
        <?php $a = 0;
        foreach ($score as $s) : $a++ ?>
            <tr id="tr<?= $a ?>">
                <td rowspan="2" class="align-middle text-center">
                    <?= $a ?>
                </td>
                <td class="align-middle text-center"><?= $s['nis'] ?> / <?= $s['nisn'] ?></td>
                <td class="align-middle"><?= $s['name'] ?></td>
            </tr>
            <tr>
                <td colspan="2" class="align-middle text-center">
                    <?php
                    $nama = $s['name'];
                    if (strpos($nama, "'") !== false) :
                        $namanya = str_replace("'", '', $nama);
                    ?>
                        <div class="btn-group btn-block mb-2" role="group" aria-label="First group">
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="openPH('<?= $s['id_student'] ?>', '<?= $namanya ?>', <?= $a ?>, 1)">
                                1
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="openPH('<?= $s['id_student'] ?>', '<?= $namanya ?>', <?= $a ?>, 2)">
                                2
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="openPH('<?= $s['id_student'] ?>', '<?= $namanya ?>', <?= $a ?>, 3)">
                                3
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="openPH('<?= $s['id_student'] ?>', '<?= $namanya ?>', <?= $a ?>, 4)">
                                4
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="openPH('<?= $s['id_student'] ?>', '<?= $namanya ?>', <?= $a ?>, 5)">
                                5
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="openPH('<?= $s['id_student'] ?>', '<?= $namanya ?>', <?= $a ?>, 6)">
                                6
                            </button>
                        </div>
                    <?php else :  ?>
                        <div class="btn-group btn-block mb-2" role="group" aria-label="First group">
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="openPH('<?= $s['id_student'] ?>', '<?= $s['name'] ?>', <?= $a ?>, 1)">
                                1
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="openPH('<?= $s['id_student'] ?>', '<?= $s['name'] ?>', <?= $a ?>, 2)">
                                2
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="openPH('<?= $s['id_student'] ?>', '<?= $s['name'] ?>', <?= $a ?>, 3)">
                                3
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="openPH('<?= $s['id_student'] ?>', '<?= $s['name'] ?>', <?= $a ?>, 4)">
                                4
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="openPH('<?= $s['id_student'] ?>', '<?= $s['name'] ?>', <?= $a ?>, 5)">
                                5
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="ini_6_<?= $a ?>" onclick="openPH('<?= $s['id_student'] ?>', '<?= $s['name'] ?>', <?= $a ?>, 6)">
                                6
                            </button>
                        </div>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php for ($k = 1; $k <= 6; $k++) : ?>
    <div class="modal fade" id="ph<?= $k ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Penilaian Harian <?= $k ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body" style="overflow: auto; max-height: 80vh; margin-bottom: 10px; margin-top: 10px">
                    <h5 name="hName" class="mb-3 text-primary"></h5>
                    <div class="form-group">
                        <label>Kinerja 1</label>
                        <input class="form-control" type="number" name="ph<?= $k ?>_k1" id="ph<?= $k ?>_k1">
                    </div>
                    <div class="form-group">
                        <label>Kinerja 2</label>
                        <input class="form-control" type="number" name="ph<?= $k ?>_k2" id="ph<?= $k ?>_k2">
                    </div>
                    <div class="form-group">
                        <label>Optimum</label>
                        <input class="form-control" type="number" name="ph<?= $k ?>_opti" id="ph<?= $k ?>_opti">
                    </div>
                    <div class="form-group">
                        <label>Proyek 1</label>
                        <input class="form-control" type="number" name="ph<?= $k ?>_pro1" id="ph<?= $k ?>_pro1">
                    </div>
                    <div class="form-group">
                        <label>Proyek 2</label>
                        <input class="form-control" type="number" name="ph<?= $k ?>_pro2" id="ph<?= $k ?>_pro2">
                    </div>
                    <div class="form-group">
                        <label>Opyimum</label>
                        <input class="form-control" type="number" name="ph<?= $k ?>_opyi" id="ph<?= $k ?>_opyi">
                    </div>
                    <div class="form-group">
                        <label>Sekor</label>
                        <input class="form-control" type="number" name="ph<?= $k ?>_sekor" id="ph<?= $k ?>_sekor">
                    </div>
                    <button class="btn btn-outline-primary" type="submit" id="btnPH" name="btnPH" onclick=""><i class="bi bi-send-fill"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
<?php endfor ?>

<script type="text/javascript">
    $('[name="printScore"]').attr('onclick', 'printScore("K-13")');
    var loader = '<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>';
    var loaderBtn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
    var btnReset = '<i class="bi bi-send-fill"></i> Save';

    function openPH(idStudent, name, a, k) {
        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        <?php for ($n = 1; $n <= 6; $n++) : ?>
            if (k == <?= $n ?>) {
                $.ajax({
                    url: "<?= site_url('TeacherController/subjectScoreShowK13') ?>",
                    data: {
                        [csrfToken]: csrfHash,
                        idSubject: '<?= $idSubject ?>',
                        idStudent: idStudent,
                        semester: '<?= $semester ?>',
                    },
                    type: "POST",
                    dataType: "JSON",
                    beforeSend: function(data) {
                        $('#ph' + k).modal('show');
                    },
                    success: function(data) {
                        $('[name="ph<?= $n ?>_k1"]').val(data.ph<?= $n ?>_kinerja1);
                        $('[name="ph<?= $n ?>_k2"]').val(data.ph<?= $n ?>_kinerja2);
                        $('[name="ph<?= $n ?>_opti"]').val(data.ph<?= $n ?>_optimum);
                        $('[name="ph<?= $n ?>_pro1"]').val(data.ph<?= $n ?>_proyek1);
                        $('[name="ph<?= $n ?>_pro2"]').val(data.ph<?= $n ?>_proyek2);
                        $('[name="ph<?= $n ?>_opyi"]').val(data.ph<?= $n ?>_opyimum);
                        $('[name="ph<?= $n ?>_sekor"]').val(data.ph<?= $n ?>_sekor);
                        $('[name="hName"]').text(name);
                        $('[name="btnPH"]').attr('onclick', 'updatePH("' + idStudent + '",' + a + ',' + k + ')');
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

    function updatePH(idStudent, a, k) {
        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        <?php for ($h = 1; $h <= 6; $h++) : ?>
            if (k == <?= $h ?>) {
                $.ajax({
                    url: "<?= site_url('TeacherController/subjectScoreUpdateK13') ?>",
                    data: {
                        [csrfToken]: csrfHash,
                        idStudent: idStudent,
                        idSubject: '<?= $idSubject ?>',
                        semester: '<?= $semester ?>',
                        k1: $("#ph<?= $h ?>_k1").val(),
                        k2: $("#ph<?= $h ?>_k2").val(),
                        opt: $("#ph<?= $h ?>_opti").val(),
                        pro1: $("#ph<?= $h ?>_pro1").val(),
                        pro2: $("#ph<?= $h ?>_pro2").val(),
                        opy: $("#ph<?= $h ?>_opyi").val(),
                        sekor: $("#ph<?= $h ?>_sekor").val(),
                        pos: <?= $h ?>
                    },
                    type: "POST",
                    beforeSend: function(data) {
                        $('#btnPH').html(loaderBtn);
                        $("#btnPH").attr("disabled", true);
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
                        $('#btnPH').html(btnReset);
                        $("#btnPH").attr("disabled", false);
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
</script>