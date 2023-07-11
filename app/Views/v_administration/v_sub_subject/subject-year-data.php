<?php foreach ($subject as $s) : ?>
    <a class="btn btn-outline-primary btn-lg btn-block" href="<?= site_url('administration/subject/' . $s['school_year']) ?>">
        <?= $s['school_year'] ?>
    </a>
<?php endforeach; ?>