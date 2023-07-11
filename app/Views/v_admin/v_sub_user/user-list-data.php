<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="align-middle text-center">#</th>
            <th class="align-middle text-center">Username</th>
            <th class="align-middle text-center">Name</th>
            <th class="align-middle text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $a = 0;
        foreach ($user as $p) : $a++ ?>
            <tr id="tr<?= $a ?>">
                <td class="align-middle text-center"><?= $a ?></td>
                <td class="align-middle"><?= $p['username'] ?></td>
                <td class="align-middle"><?= $p['name'] ?></td>
                <td class="align-middle">
                    <div class="d-flex justify-content-center">
                        <button style="width: 50px;" class="btn btn-outline-primary mr-2" onclick="openUser('<?= $p['id_user'] ?>', <?= $a ?>)"><i class="ion-ios-information" style="font-size: 20px;"></i></button>
                        <?php if ($p['id_user'] != 'US-000001') : ?>
                            <button style="width: 50px;" class="btn btn-outline-danger" onclick="deleteUser('<?= $p['id_user'] ?>', <?= $a ?>)"><i class="ion-trash-b" style="font-size: 20px;"></i></button>
                        <?php endif ?>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div class="modal fade" id="userDetail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body" style="overflow: auto; max-height: 80vh; margin-bottom: 10px; margin-top: 10px">
                <div class="form-group" id="div_username">
                    <label>Username</label>
                    <input class="form-control" type="text" name="usernameOld" id="usernameOld">
                    <div id="username_feedback" class="form-control-feedback">
                    </div>
                </div>
                <div class="form-group" id="div_name">
                    <label>Name</label>
                    <input class="form-control" type="text" name="name" id="name">
                    <div id="name_feedback" class="form-control-feedback">
                    </div>
                </div>
                <div class="form-group" id="div_email">
                    <label>Email</label>
                    <input class="form-control" type="text" name="email" id="email">
                    <div id="email_feedback" class="form-control-feedback">
                    </div>
                </div>
                <div class="form-group" id="div_password">
                    <label>Password</label>
                    <input class="form-control" type="text" name="password" id="password">
                    <div id="password_feedback" class="form-control-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <input class="form-control" type="text" name="role" id="role" disabled>
                </div>
                <button class="btn btn-outline-primary" type="submit" id="btnUpUser" name="btnUpUser" onclick="">
                    <i class="bi bi-send-fill"></i> Save
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body" style="overflow: auto; max-height: 80vh; margin-bottom: 10px; margin-top: 10px">
                <div id="div_add_username" class="form-group add_name">
                    <label>Username</label>
                    <input class="form-control" type="text" name="usernameAdd" id="usernameAdd">
                    <div id="add_username_feedback" class="form-control-feedback">
                    </div>
                </div>
                <div id="div_add_name" class="form-group add_name">
                    <label>Name</label>
                    <input class="form-control" type="text" name="nameAdd" id="nameAdd">
                    <div id="add_name_feedback" class="form-control-feedback">
                    </div>
                </div>
                <div id="div_add_email" class="form-group add_name">
                    <label>Email</label>
                    <input class="form-control" type="text" name="emailAdd" id="emailAdd">
                    <div id="add_email_feedback" class="form-control-feedback">
                    </div>
                </div>
                <div id="div_add_password" class="form-group add_name">
                    <label>Password</label>
                    <input class="form-control" type="text" name="passwordAdd" id="passwordAdd">
                    <div id="add_password_feedback" class="form-control-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <input class="form-control" type="text" name="roleAdd" id="roleAdd" disabled>
                </div>
                <button class="btn btn-outline-primary" type="submit" id="btnAddUser" name="btnAddUser" onclick="">
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

    function openUser(idUser, a) {
        $("#div_password").attr("class", "form-group");
        $("#password").attr("class", "form-control form-control-lg form-control");
        $("#password_feedback").html('');

        $("#div_email").attr("class", "form-group");
        $("#email").attr("class", "form-control form-control-lg form-control");
        $("#email_feedback").html('');

        $("#div_username").attr("class", "form-group");
        $("#usernameOld").attr("class", "form-control form-control-lg form-control");
        $("#username_feedback").html('');

        $("#div_name").attr("class", "form-group");
        $("#name").attr("class", "form-control form-control-lg form-control");
        $("#name_feedback").html('');
        $.ajax({
            url: "<?= site_url('AdminController/userDetail/') ?>" + idUser,
            dataType: "JSON",
            beforeSend: function(data) {
                $('#userDetail').modal('show');
            },
            success: function(data) {
                $('[name="usernameOld"]').val(data.username);
                $('[name="name"]').val(data.name);
                $('[name="email"]').val(data.email);
                $('[name="password"]').val(data.password);
                $('[name="role"]').val(data.role);
                $('[name="btnUpUser"]').attr('onclick', 'updateUser("' + idUser + '",' + a + ')');
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

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    }

    function updateUser(idUser, a) {
        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        var username = $('[name="usernameOld"]').val();
        var email = $("#email").val();
        var password = $("#password").val();
        var name = $("#name").val();
        var valError;

        if (password != '') {
            $("#div_password").attr("class", "form-group");
            $("#password").attr("class", "form-control form-control-lg form-control");
            $("#password_feedback").html('');
            valError = false;
        }

        if (name != '') {
            $("#div_name").attr("class", "form-group");
            $("#name").attr("class", "form-control form-control-lg form-control");
            $("#name_feedback").html('');
            valError = false;
        }

        if (username != '') {
            $("#div_username").attr("class", "form-group");
            $("#username").attr("class", "form-control form-control-lg form-control");
            $("#username_feedback").html('');
            valError = false;
        }

        if (email != '' && isEmail(email) == true) {
            $("#div_email").attr("class", "form-group");
            $("#email").attr("class", "form-control form-control-lg form-control");
            $("#email_feedback").html('');
            valError = false;
        }

        if (email == '') {
            $("#div_email").attr("class", "form-group");
            $("#email").attr("class", "form-control form-control-lg form-control");
            $("#email_feedback").html('');
            valError = false;
        }

        if (username == '') {
            $("#div_username").attr("class", "form-group has-danger");
            $("#username").attr("class", "form-control form-control-lg form-control-danger");
            $("#username_feedback").html('Username tidak boleh kosong');
            valError = true;
        }

        if (email != '' && isEmail(email) == false) {
            $("#div_email").attr("class", "form-group has-danger");
            $("#email").attr("class", "form-control form-control-lg form-control-danger");
            $("#email_feedback").html('Format email tidak benar');
            valError = true;
        }

        if (password == '') {
            $("#div_password").attr("class", "form-group has-danger");
            $("#password").attr("class", "form-control form-control-lg form-control-danger");
            $("#password_feedback").html('Password tidak boleh kosong');
            valError = true;
        }

        if (name == '') {
            $("#div_name").attr("class", "form-group has-danger");
            $("#name").attr("class", "form-control form-control-lg form-control-danger");
            $("#name_feedback").html('Name tidak boleh kosong');
            valError = true;
        }

        if (valError == true) {
            return false;
        } else {
            $.ajax({
                url: "<?= site_url('AdminController/getUsername') ?>",
                data: {
                    [csrfToken]: csrfHash,
                    username: username,
                    idUser: idUser
                },
                dataType: "JSON",
                type: "POST",
                success: function(data) {
                    if (data == undefined) {
                        $("#div_username").attr("class", "form-group");
                        $('[name="usernameOld"]').attr("class", "form-control form-control-lg");
                        $("#username_feedback").html('');
                        $.ajax({
                            url: "<?= site_url('AdminController/getEmail') ?>",
                            data: {
                                [csrfToken]: csrfHash,
                                email: email,
                                idUser: idUser
                            },
                            dataType: "JSON",
                            type: "POST",
                            success: function(data) {
                                if (data == undefined || $("#email").val() == '') {
                                    $("#div_email").attr("class", "form-group");
                                    $("#email").attr("class", "form-control form-control-lg");
                                    $("#email_feedback").html('');
                                    $.ajax({
                                        url: "<?= site_url('AdminController/userDetailIpdate') ?>",
                                        data: {
                                            [csrfToken]: csrfHash,
                                            idUser: idUser,
                                            username: username,
                                            email: email,
                                            password: password,
                                            name: name,
                                            role: $("#role").val(),
                                        },
                                        type: "POST",
                                        beforeSend: function(data) {
                                            $('#btnUpUser').html(loaderBtn);
                                            $("#btnUpUser").attr("disabled", true);
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
                                            $('#btnUpUser').html(btnReset);
                                            $("#btnUpUser").attr("disabled", false);
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error!',
                                                text: thrownError
                                            })
                                        }
                                    });
                                } else {
                                    $("#div_email").attr("class", "form-group has-danger");
                                    $("#email").attr("class", "form-control form-control-lg form-control-danger");
                                    $("#email_feedback").html('Email sudah dipakai');
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
                    } else {
                        $("#div_username").attr("class", "form-group has-danger");
                        $('[name="usernameOld"]').attr("class", "form-control form-control-lg form-control-danger");
                        $("#username_feedback").html('Username sudah dipakai');
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

    }

    function deleteUser(idUser, a) {
        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan!',
            text: 'Semua data terkait user akan terhapus, apakah anda yakin?',
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('AdminController/deleteUser') ?>",
                    data: {
                        [csrfToken]: csrfHash,
                        idUser: idUser,
                        role: '<?= $role ?>'
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

    function openAddUser() {
        $('#addUser').modal('show');
        $('[name="btnAddUser"]').attr('onclick', 'saveUser()');
        $('[name="roleAdd"]').val('<?= $role ?>');
    }

    function saveUser() {
        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        var username = $("#usernameAdd").val();
        var name = $("#nameAdd").val();
        var email = $("#emailAdd").val();
        var password = $("#passwordAdd").val();
        var valError;

        if (username != '') {
            $("#div_add_username").attr("class", "form-group");
            $("#usernameAdd").attr("class", "form-control form-control-lg form-control");
            $("#add_username_feedback").html('');
            valError = false;
        }

        if (email == '') {
            $("#div_add_email").attr("class", "form-group");
            $("#emailAdd").attr("class", "form-control form-control-lg form-control");
            $("#add_email_feedback").html('');
            valError = false;
        }

        if (email != '' && isEmail(email) == true) {
            $("#div_add_email").attr("class", "form-group");
            $("#emailAdd").attr("class", "form-control form-control-lg form-control");
            $("#add_email_feedback").html('');
            valError = false;
        }

        if (password != '') {
            $("#div_add_password").attr("class", "form-group");
            $("#passwordAdd").attr("class", "form-control form-control-lg form-control");
            $("#add_password_feedback").html('');
            valError = false;
        }

        if (name != '') {
            $("#div_add_name").attr("class", "form-group");
            $("#nameAdd").attr("class", "form-control form-control-lg form-control");
            $("#add_name_feedback").html('');
            valError = false;
        }

        if (username == '') {
            $("#div_add_username").attr("class", "form-group has-danger");
            $("#usernameAdd").attr("class", "form-control form-control-lg form-control-danger");
            $("#add_username_feedback").html('Username tidak boleh kosong');
            valError = true;
        }

        if (email != '' && isEmail(email) == false) {
            $("#div_add_email").attr("class", "form-group has-danger");
            $("#emailAdd").attr("class", "form-control form-control-lg form-control-danger");
            $("#add_email_feedback").html('Format email tidak benar');
            valError = true;
        }

        if (password == '') {
            $("#div_add_password").attr("class", "form-group has-danger");
            $("#passwordAdd").attr("class", "form-control form-control-lg form-control-danger");
            $("#add_password_feedback").html('Password tidak boleh kosong');
            valError = true;
        }

        if (name == '') {
            $("#div_add_name").attr("class", "form-group has-danger");
            $("#nameAdd").attr("class", "form-control form-control-lg form-control-danger");
            $("#add_name_feedback").html('Name tidak boleh kosong');
            valError = true;
        }

        if (valError == true) {
            return false;
        } else {
            $.ajax({
                url: "<?= site_url('AdminController/getUsername') ?>",
                data: {
                    [csrfToken]: csrfHash,
                    username: $("#usernameAdd").val(),
                },
                dataType: "JSON",
                type: "POST",
                success: function(data) {
                    if (data == undefined) {
                        $("#div_add_username").attr("class", "form-group");
                        $("#usernameAdd").attr("class", "form-control form-control-lg");
                        $("#add_username_feedback").html('');
                        $.ajax({
                            url: "<?= site_url('AdminController/getEmail') ?>",
                            data: {
                                [csrfToken]: csrfHash,
                                email: $("#emailAdd").val(),
                            },
                            dataType: "JSON",
                            type: "POST",
                            success: function(data) {
                                if (data == undefined || $("#emailAdd").val() == '') {
                                    $("#div_add_email").attr("class", "form-group");
                                    $("#emailAdd").attr("class", "form-control form-control-lg");
                                    $("#add_email_feedback").html('');
                                    $.ajax({
                                        url: "<?= site_url('AdminController/saveUser') ?>",
                                        data: {
                                            [csrfToken]: csrfHash,
                                            username: $("#usernameAdd").val(),
                                            email: $("#emailAdd").val(),
                                            password: $("#passwordAdd").val(),
                                            name: $("#nameAdd").val(),
                                            role: $("#roleAdd").val(),
                                        },
                                        type: "POST",
                                        beforeSend: function(data) {
                                            $('#btnAddUser').html(loaderBtn);
                                            $("#btnAddUser").attr("disabled", true);
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
                                            $('#btnAddUser').html(btnReset);
                                            $("#btnAddUser").attr("disabled", false);
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error!',
                                                text: thrownError
                                            })
                                        }
                                    });
                                } else {
                                    $("#div_add_email").attr("class", "form-group has-danger");
                                    $("#emailAdd").attr("class", "form-control form-control-lg form-control-danger");
                                    $("#add_email_feedback").html('Email sudah dipakai');
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
                    } else {
                        $("#div_add_username").attr("class", "form-group has-danger");
                        $("#usernameAdd").attr("class", "form-control form-control-lg form-control-danger");
                        $("#add_username_feedback").html('Username sudah dipakai');
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
    }
</script>