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
                            <button class="btn btn-primary bootstrap-touchspin-up" type="button" name="cekPass1" id="cekPass1" onclick="hidePass()"><i name="eyePass1" class="bi bi-eye-slash"></i></button>
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
                            <button class="btn btn-primary bootstrap-touchspin-up" type="button" name="cekPass2" id="cekPass2" onclick="hidePass()"><i name="eyePass2" class="bi bi-eye-slash"></i></button>
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