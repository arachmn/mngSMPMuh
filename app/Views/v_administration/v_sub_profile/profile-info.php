<div class="profile-photo">
    <img src="<?= base_url() ?>/img/<?= $administration['photo'] ?>" alt="" class="avatar-photo" />
</div>
<h5 class="text-center h5 mb-0"><?= $administration['name'] ?></h5>
<div class="profile-info">

    <h5 class="mb-10 h5 text-blue">Profile Information</h5>
    <ul>
        <li>
            <span>Gender:</span>
            <?= $administration['gender'] ?>
        </li>
        <li>
            <span>Email:</span>
            <?= $administration['email'] ?>
        </li>
        <li>
            <span>Phone Number:</span>
            <?= $administration['phone_number'] ?>
        </li>
        <li>
            <span>Address:</span>
            <?= $administration['address'] ?>
        </li>
    </ul>
</div>