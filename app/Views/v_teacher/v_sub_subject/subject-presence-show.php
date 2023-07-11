<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Presensi <?= $title ?></title>

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
    <?php
    $db = \Config\Database::Connect();

    if (session('role') == 'admin') {
        $tb = 'tb_admin';
    } elseif (session('role') == 'administration') {
        $tb = 'tb_administration';
    } elseif (session('role') == 'teacher') {
        $tb = 'tb_teacher';
    }

    $idUser = session('id_user');
    $query = $db->query("SELECT * FROM $tb WHERE id_user = '$idUser'");
    $user = $query->getRow();
    ?>
    <div class="header">
        <div class="header-left">
            <div class="menu-icon bi bi-list"></div>

        </div>
        <div class="header-right">
            <div class="dashboard-setting user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                        <i class="dw dw-settings2"></i>
                    </a>
                </div>
            </div>
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="<?= base_url() ?>/img/<?= $user->photo ?>" alt="" />
                        </span>
                        <span class="user-name"><?= $user->name ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <button class="dropdown-item" type="button" onclick="profileSetting()"><i class="dw dw-settings2"></i> Setting</button>
                        <button class="dropdown-item" type="button" onclick="logout()"><i class="dw dw-logout"></i> Log Out</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="settingProfile" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body" style="overflow: auto; max-height: 80vh; margin-bottom: 10px; margin-top: 10px">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="text" name="username" id="username" disabled>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <input class="form-control" type="text" name="role" id="role" disabled>
                    </div>
                    <div id="div_password1" class="form-group">
                        <label>Password</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                            <input id="password1" class="form-control form-control-lg" type="text" name="password1" />
                            <span class="input-group-btn input-group-append">
                                <button class="btn btn-primary bootstrap-touchspin-up" type="button" name="cekPass1" id="cekPass1" onclick="showPass()"><i name="eyePass1" class="bi bi-eye"></i></button>
                            </span>
                        </div>
                        <div id="password1_feedback" class="form-control-feedback">
                        </div>
                    </div>
                    <div id="div_password2" class="form-group">
                        <label>Confirm Password</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                            <input id="password2" class="form-control form-control-lg" type="text" name="password2" />
                            <span class="input-group-btn input-group-append">
                                <button class="btn btn-primary bootstrap-touchspin-up" type="button" name="cekPass2" id="cekPass2" onclick="showPass()"><i name="eyePass2" class="bi bi-eye"></i></button>
                            </span>
                        </div>
                        <div id="password2_feedback" class="form-control-feedback">
                        </div>
                    </div>
                    <button class="btn btn-outline-primary" type="submit" id="btnUpdate" name="btnUpdate">
                        <i class="bi bi-send-fill"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var loader = '<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>';
        var loaderBtn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        var btnReset = 'Update';

        function showPass() {
            $('#password1').attr('type', 'text');
            $('#password2').attr('type', 'text');
            $('[name="cekPass1"]').attr('onclick', 'hidePass()');
            $('[name="cekPass2"]').attr('onclick', 'hidePass()');
            $('[name="eyePass1"]').addClass('bi bi-eye-slash').removeClass('bi bi-eye');
            $('[name="eyePass2"]').addClass('bi bi-eye-slash').removeClass('bi bi-eye');
        }

        function hidePass() {
            $('#password1').attr('type', 'password');
            $('#password2').attr('type', 'password');
            $('[name="cekPass1"]').attr('onclick', 'showPass()');
            $('[name="cekPass2"]').attr('onclick', 'showPass()');
            $('[name="eyePass1"]').addClass('bi bi-eye').removeClass('bi bi-eye-slash');
            $('[name="eyePass2"]').addClass('bi bi-eye').removeClass('bi bi-eye-slash');
        }

        function logout() {
            Swal.fire({
                icon: 'question',
                title: 'Logout',
                text: 'Are you sure?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url() ?>/Auth/logout";
                }
            })
        }

        function profileSetting() {
            $("#div_password2").attr("class", "form-group");
            $("#password2").attr("class", "form-control form-control-lg");
            $("#password2_feedback").html('');
            $("#password2_feedback").css('margin-top', '0')
            $("#div_password1").attr("class", "form-group");
            $("#password1").attr("class", "form-control form-control-lg");
            $("#password1_feedback").html('');
            $("#password1_feedback").css('margin-top', '0')

            $.ajax({
                url: "<?= site_url('UserController/openSetting') ?>",
                dataType: "JSON",
                beforeSend: function(data) {
                    $('#settingProfile').modal('show');
                },
                success: function(data) {
                    $('[name="username"]').val(data.username);
                    $('[name="role"]').val(data.role);
                    $('[name="btnUpdate"]').attr('onclick', 'updateProfile()');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: thrownError + ', Gagal meload data profile!'
                    })
                }
            });
        }

        function updateProfile() {
            let csrfToken = '<?= csrf_token() ?>';
            let csrfHash = '<?= csrf_hash() ?>';
            var password1 = $('#password1').val();
            var password2 = $('#password2').val();
            var cekError;

            if (password1 != '') {
                $("#div_password1").attr("class", "form-group");
                $("#password1").attr("class", "form-control form-control-lg");
                $("#password1_feedback").html('');
                $("#password1_feedback").css('margin-top', '0')
                cekError = false;
            }

            if (password2 != '') {
                $("#div_password2").attr("class", "form-group");
                $("#password2").attr("class", "form-control form-control-lg");
                $("#password2_feedback").html('');
                $("#password2_feedback").css('margin-top', '0')
                cekError = false;
            }

            if (password1 != password2 && password1 != '' && password2 != '') {
                $("#div_password2").attr("class", "form-group has-danger");
                $("#password2").attr("class", "form-control form-control-lg form-control-danger");
                $("#password2_feedback").html('Konfirmasi password tidak sesuai');
                $("#password2_feedback").css('margin-top', '-5%')
                cekError = true;
            }

            if (password1 == '') {
                $("#div_password1").attr("class", "form-group has-danger");
                $("#password1").attr("class", "form-control form-control-lg form-control-danger");
                $("#password1_feedback").html('Password tidak boleh kosong!');
                $("#password1_feedback").css('margin-top', '-5%')
                cekError = true;
            }

            if (password2 == '') {
                $("#div_password2").attr("class", "form-group has-danger");
                $("#password2").attr("class", "form-control form-control-lg form-control-danger");
                $("#password2_feedback").html('Konfirmasi password tidak boleh kosong!');
                $("#password2_feedback").css('margin-top', '-5%')
                cekError = true;
            }

            if (cekError == true) {
                return false;
            }

            $.ajax({
                url: "<?= site_url('UserController/updateUser') ?>",
                data: {
                    [csrfToken]: csrfHash,
                    password: $('#password1').val(),
                },
                type: "POST",
                beforeSend: function(data) {
                    $('#btnUpdate').html(loaderBtn);
                    $("#btnUpdate").attr("disabled", true);
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
                    $('#btnUpdate').html(btnReset);
                    $("#btnUpdate").attr("disabled", false);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('#btnUpdate').html(btnReset);
                    $("#btnUpdate").attr("disabled", false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: thrownError + ', Gagal menyimpan data!'
                    })
                }
            });
        }
    </script>

    <?= $this->include('layout/right-side-bar'); ?>

    <?= $this->include('layout/left-side-bar'); ?>

    <div class="mobile-menu-overlay"></div>

    <div class="main-container" id="meme">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Presensi <?= $pekan ?> | <?= $day ?></h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('teacher/subject/' . $subject['school_year']) ?>">Mata Pelajaran</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Presensi
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4 d-inline">List Siswa</h4>
                        <div class="d-inline" style="float: right;">
                            <button class="btn btn-outline-primary" onclick="printPresence()">
                                <i class="bi bi-printer-fill" style="font-size: 20px;"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mt-3" id="presence_table" style="overflow: auto;">
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
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

    <script type="text/javascript">
        var loader = '<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>';
        var choice = '<?= $choice ?>';

        reload_table("<?= $id ?>", "<?= $semester ?>", "<?= $week ?>", "<?= $day ?>", '', '');

        $(document).ready(function() {

            // Search all columns
            $('#cari').keyup(function() {
                // Search Text
                var search = $(this).val();

                // Hide all table tbody rows
                $('table tbody tr').hide();

                // Count total search result
                var len = $('table tbody tr:not(.notfound) td:contains("' + search + '")').length;

                if (len > 0) {
                    // Searching text in columns and show match row
                    $('table tbody tr:not(.notfound) td:contains("' + search + '")').each(function() {
                        $(this).closest('tr').show();
                    });
                } else {
                    $('.notfound').show();
                }

            });

            // Search on name column only
            $('#txt_name').keyup(function() {
                // Search Text
                var search = $(this).val();

                // Hide all table tbody rows
                $('table tbody tr').hide();

                // Count total search result
                var len = $('table tbody tr:not(.notfound) td:nth-child(2):contains("' + search + '")').length;

                if (len > 0) {
                    // Searching text in columns and show match row
                    $('table tbody tr:not(.notfound) td:contains("' + search + '")').each(function() {
                        $(this).closest('tr').show();
                    });
                } else {
                    $('.notfound').show();
                }

            });

        });

        // Case-insensitive searching (Note - remove the below script for Case sensitive search )
        $.expr[":"].contains = $.expr.createPseudo(function(arg) {
            return function(elem) {
                return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
            };
        })

        function reload_table(id, semester, week, day, lesson, colapse) {
            var url = '';
            if (choice == 'full') {
                url = "<?= site_url('TeacherController/subjectPresenceTableFull/') ?>" + id + '/' + semester + '/' + week +
                    '/' + day;
            } else if (choice == 'simple') {
                url = "<?= site_url('TeacherController/subjectPresenceTableSimple/') ?>" + id + '/' + semester + '/' + week +
                    '/' + day;
            }
            $.ajax({
                url: url,
                beforeSend: function(f) {
                    $('#presence_table').html(loader);
                },
                success: function(data) {
                    $('#presence_table').html(data);
                    if (colapse != '' && colapse != 1) {
                        if (choice == 'full') {
                            $("#press" + colapse).attr("class", "collapse show");
                            $("#bt" + colapse).attr("class", "btn btn-block collapsed");
                            $([document.documentElement, document.body]).animate({
                                scrollTop: $("#td" + (colapse - 1)).offset().top
                            }, 100);
                        } else if (choice == 'simple') {
                            $([document.documentElement, document.body]).animate({
                                scrollTop: $("#td" + (colapse - 1)).offset().top
                            }, 100);
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
        }

        function updateAct(id, presence, tab, lesson, colapse) {
            var url = '';
            if (choice == 'full') {
                url = "<?= site_url('TeacherController/subjectPresenceUpdateFull') ?>";
            } else if (choice == 'simple') {
                url = "<?= site_url('TeacherController/subjectPresenceUpdateSimple') ?>";
            }
            let csrfToken = '<?= csrf_token() ?>';
            let csrfHash = '<?= csrf_hash() ?>';
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    [csrfToken]: csrfHash,
                    id: id,
                    presence: presence,
                    tab: tab,
                    lesson: lesson,
                    idSubject: '<?= $id ?>',
                    day: '<?= $day ?>'
                },
                beforeSend: function(f) {
                    $('#presence_table').html(loader);
                },
                success: function(data) {
                    reload_table("<?= $id ?>", "<?= $semester ?>", "<?= $week ?>", "<?= $day ?>", lesson, colapse);
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

        function printPresence() {
            var method = '<?= $choice ?>';
            if (method == 'simple') {
                url = "<?= site_url('TeacherController/printPresenceSimple/' . $id . '/' . $semester . '/' . $week . '/' . $day) ?>";

            } else if (method == 'full') {
                url = "<?= site_url('TeacherController/printPresenceFull/' . $id . '/' . $semester . '/' . $week . '/' . $day) ?>";
            }
            window.open(
                url,
                '_blank'
            );
        }
    </script>
</body>

</html>