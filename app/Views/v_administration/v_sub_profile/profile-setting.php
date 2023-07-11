<div class="profile-edit-list row">
    <div class="weight-500 col">
        <h4 class="text-blue h5 mb-20">
            Edit Profile
        </h4>
        <input id="id" value="<?= $administration['id_administration'] ?>" type="hidden" name="id" />
        <div id="div_name" class="form-group">
            <label>Name</label>
            <input id="name" class="form-control form-control-lg" value="<?= $administration['name'] ?>" type="text" name="name" />
            <div id="name_feedback" class="form-control-feedback">
            </div>
        </div>
        <div class="form-group">
            <label>Gender</label>
            <div class="d-flex">
                <div class="custom-control custom-radio mb-5 mr-20">
                    <input type="radio" id="male" name="gender" class="custom-control-input" <?= $administration['gender'] == 'LAKI-LAKI' ? 'checked' : '' ?> value="LAKI-LAKI" />
                    <label class="custom-control-label weight-400" for="male">LAKI-LAKI</label>
                </div>
                <div class="custom-control custom-radio mb-5">
                    <input type="radio" id="female" name="gender" class="custom-control-input" <?= $administration['gender'] == 'PEREMPUAN' ? 'checked' : '' ?> value="PEREMPUAN" />
                    <label class="custom-control-label weight-400" for="female">PEREMPUAN</label>
                </div>
            </div>
        </div>
        <div id="div_email" class="form-group">
            <label>Email</label>
            <input id="email" class="form-control form-control-lg" value="<?= $administration['email'] ?>" type="text" name="email" />
            <div id="email_feedback" class="form-control-feedback">
            </div>
        </div>
        <div id="div_phone_number" class="form-group">
            <label>Phone Number</label>
            <input id="phone_number" class="form-control form-control-lg" value="<?= $administration['phone_number'] ?>" type="text" name="phone_number" />
            <div id="phone_number_feedback" class="form-control-feedback">
            </div>
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea id="address" class="form-control" name="address"><?= $administration['address'] ?></textarea>
        </div>
        <div class="form-group mb-0">
            <button type="submit" id="kirim" class="btn btn-outline-primary" onclick="updateProfile()">
                <i class="bi bi-send-fill"></i> Save
            </button>
        </div>
    </div>
</div>