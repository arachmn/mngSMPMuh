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
                        <div class="btn-group btn-block mb-2" role="group" aria-label="First group">
                            <button type="button" class="btn btn<?= ($p['presence_' . $lesson] == 'hadir') ? "" : "-outline" ?>-primary btn-sm" name="presence" id="hadir" onclick="updateAct(<?= $p['id_presence'] ?>, 'hadir', '<?= $tab ?>','<?= $lesson ?>', '<?= $x ?>')">
                                H
                            </button>
                            <button type="button" class="btn btn<?= ($p['presence_' . $lesson] == 'sakit') ? "" : "-outline" ?>-primary btn-sm" name="presence" id="sakit" onclick="updateAct(<?= $p['id_presence'] ?>, 'sakit', '<?= $tab ?>','<?= $lesson ?>', '<?= $x ?>')">
                                S
                            </button>
                            <button type="button" class="btn btn<?= ($p['presence_' . $lesson] == 'izin') ? "" : "-outline" ?>-primary btn-sm" name="presence" id="izin" onclick="updateAct(<?= $p['id_presence'] ?>, 'izin', '<?= $tab ?>','<?= $lesson ?>', '<?= $x ?>')">
                                I
                            </button>
                            <button type="button" class="btn btn<?= ($p['presence_' . $lesson] == 'alpa') ? "" : "-outline" ?>-primary btn-sm" name="presence" id="alpa" onclick="updateAct(<?= $p['id_presence'] ?>, 'alpa', '<?= $tab ?>','<?= $lesson ?>', '<?= $x ?>')">
                                A
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endfor ?>
        <?php endforeach ?>
    </tbody>
</table>