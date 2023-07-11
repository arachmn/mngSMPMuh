<table class="table table-bordered table-active table-hover" id="presenceTab">
    <thead>
        <tr>
            <th class="align-middle text-center">#</th>
            <th class="align-middle text-center">Name</th>
            <th class="align-middle text-center">Presence</th>
        </tr>
    </thead>
    <tbody>
        <?php $a = 0;
        foreach ($presence as $p) : $a++ ?>
            <?php for ($x = $a; $x <= $a; $x++) : ?>
                <tr id="td<?= $x ?>">
                    <input type="hidden" name="id_presence" value="<?= $p['id_presence'] ?>">
                    <td class="align-middle text-center"><?= $a ?></td>
                    <td class="align-middle"><?= $p['name'] ?></td>
                    <td>
                        <div class="faq-wrap">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header">
                                        <button class="btn btn-block collapsed" id="bt<?= $x ?>" style="min-width: 178.788px;" data-toggle="collapse" data-target="#press<?= $x ?>">
                                            -
                                        </button>
                                    </div>
                                    <div id="press<?= $x ?>" class="collapse" data-parent="#accordion">
                                        <?php foreach ($lessonHours as $l) : ?>
                                            <div class="card-body">
                                                <?php for ($m = 1; $m <= 9; $m++) : ?>
                                                    <?php if ($l['lesson_hours'] == $m) : ?>
                                                        <div class="btn-group btn-block mb-2" role="group" aria-label="First group">
                                                            <button type="button" class="btn btn<?= ($p['presence_' . $m] == 'hadir') ? "" : "-outline" ?>-primary btn-sm" name="presence" id="hadir" onclick="updateAct(<?= $p['id_presence'] ?>, 'hadir', '<?= $tab ?>', <?= $m ?>, <?= $x ?>)">
                                                                H
                                                            </button>
                                                            <button type="button" class="btn btn<?= ($p['presence_' . $m] == 'sakit') ? "" : "-outline" ?>-primary btn-sm" name="presence" id="sakit" onclick="updateAct(<?= $p['id_presence'] ?>, 'sakit', '<?= $tab ?>', <?= $m ?>, <?= $x ?>)">
                                                                S
                                                            </button>
                                                            <button type="button" class="btn btn<?= ($p['presence_' . $m] == 'izin') ? "" : "-outline" ?>-primary btn-sm" name="presence" id="izin" onclick="updateAct(<?= $p['id_presence'] ?>, 'izin', '<?= $tab ?>', <?= $m ?>, <?= $x ?>)">
                                                                I
                                                            </button>
                                                            <button type="button" class="btn btn<?= ($p['presence_' . $m] == 'alpa') ? "" : "-outline" ?>-primary btn-sm" name="presence" id="alpa" onclick="updateAct(<?= $p['id_presence'] ?>, 'alpa', '<?= $tab ?>', <?= $m ?>, <?= $x ?>)">
                                                                A
                                                            </button>
                                                        </div>
                                                    <?php endif ?>
                                                <?php endfor ?>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endfor ?>
        <?php endforeach ?>
    </tbody>
</table>