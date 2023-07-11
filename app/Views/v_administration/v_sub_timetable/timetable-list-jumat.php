<div class="profile-timeline">
    <div class="profile-timeline-list">
        <ul>
            <?php foreach ($jumat as $s) : ?>
                <?php
                if ($s['lesson_hours'] == 1) {
                    $time = "07.00-07.30";
                } elseif ($s['lesson_hours'] == 2) {
                    $time = "07.30-08.30";
                } elseif ($s['lesson_hours'] == 3) {
                    $time = "08.30-09.00";
                } elseif ($s['lesson_hours'] == 4) {
                    $time = "09.10-09.40";
                } elseif ($s['lesson_hours'] == 5) {
                    $time = "09.20-10.50";
                }
                ?>
                <li>
                    <div class="date"><?= $time ?></div>
                    <div class="task-name">
                        <i class="ion-ios-clock ml-3"></i>&emsp;<?= $s['class'] ?>
                    </div>
                    <div class="task-time ml-3"> <?= $s['subject_name'] ?></div>
                    <div class="task-time ml-3"> <?= $s['name'] ?></div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>