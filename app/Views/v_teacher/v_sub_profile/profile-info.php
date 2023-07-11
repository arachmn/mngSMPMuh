<div class="profile-photo">
    <img src="<?= base_url() ?>/img/<?= $teacher['photo'] ?>" alt="" class="avatar-photo" />
</div>
<h5 class="text-center h5 mb-0"><?= $teacher['name'] ?></h5>
<div class="profile-info">

    <h5 class="mb-10 h5 text-blue">Contact Information</h5>
    <ul>
        <li>
            <span>Gender:</span>
            <?= $teacher['gender'] ?>
        </li>
        <li>
            <span>Email:</span>
            <?= $teacher['email'] ?>
        </li>
        <li>
            <span>Phone Number:</span>
            <?= $teacher['phone_number'] ?>
        </li>
        <li>
            <span>Address:</span>
            <?= $teacher['address'] ?>
        </li>
    </ul>
</div>