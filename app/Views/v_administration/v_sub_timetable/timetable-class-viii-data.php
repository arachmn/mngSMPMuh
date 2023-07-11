<?php foreach ($class as $c) : ?>
    <a class="btn btn-outline-primary btn-lg btn-block" href="<?= site_url('administration/timetable/' . $c['school_year'] . '/' . $c['id_class']) ?>">
        <?= $c['class'] ?>
    </a>
<?php endforeach; ?>