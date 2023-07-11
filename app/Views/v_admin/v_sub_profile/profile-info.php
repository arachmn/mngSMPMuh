<div class="profile-photo">
    <img src="<?= base_url() ?>/img/<?= $admin['photo'] ?>" alt="" class="avatar-photo" />
</div>
<h5 class="text-center h5 mb-0"><?= $admin['name'] ?></h5>
<div class="profile-info">

    <h5 class="mb-10 h5 text-blue">Profile Information</h5>
    <ul>
        <li>
            <span>Gender:</span>
            <?= $admin['gender'] ?>
        </li>
        <li>
            <span>Email:</span>
            <?= $admin['email'] ?>
        </li>
        <li>
            <span>Phone Number:</span>
            <?= $admin['phone_number'] ?>
        </li>
        <li>
            <span>Address:</span>
            <?= $admin['address'] ?>
        </li>
    </ul>
</div>