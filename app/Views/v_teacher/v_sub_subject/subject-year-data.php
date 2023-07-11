<?php if ($jumlah > 0) : ?>
    <?php foreach ($subject as $s) : ?>
        <a class="btn btn-outline-primary btn-lg btn-block" href="<?= site_url('teacher/subject/' . $s['school_year']) ?>">
            <?= $s['school_year'] ?>
        </a>
    <?php endforeach; ?>
<?php else : ?>
    <button class="btn btn-outline-primary btn-lg btn-block">
        Tidak Ada Data
    </button>
<?php endif ?>