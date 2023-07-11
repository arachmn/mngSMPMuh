<div class="profile-timeline">
    <div class="profile-timeline-list">
        <ul>
            <li>
                <div class="date">07.00-07.40</div>
                <div class="task-name">
                    <i class="ion-ios-clock ml-3"></i>&emsp;Lapangan
                </div>
                <div class="task-time ml-3"> Upacara</div>
            </li>
            <?php foreach ($senin as $s) : ?>
                <?php
                if ($s['lesson_hours'] == 2) {
                    $time = "07.40-08.20";
                } elseif ($s['lesson_hours'] == 3) {
                    $time = "08.20-09.00";
                } elseif ($s['lesson_hours'] == 4) {
                    $time = "09.00-09.40";
                } elseif ($s['lesson_hours'] == 5) {
                    $time = "09.50-10.30";
                } elseif ($s['lesson_hours'] == 6) {
                    $time = "10.30-11.10";
                } elseif ($s['lesson_hours'] == 7) {
                    $time = "11.10-11.50";
                } elseif ($s['lesson_hours'] == 8) {
                    $time = "12.10-12.50";
                } elseif ($s['lesson_hours'] == 9) {
                    $time = "12.50-13.30";
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