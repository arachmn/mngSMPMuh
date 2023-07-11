<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="align-middle text-center">#</th>
            <th class="align-middle text-center">Nama Mapel</th>
            <th class="align-middle text-center">Kelas</th>
            <th class="align-middle text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $a = 0;
        foreach ($subject as $p) : $a++ ?>
            <tr id="tr<?= $a ?>">
                <td class="align-middle text-center"><?= $a ?></td>
                <td class="align-middle"><?= $p['subject_name'] ?></td>
                <td class="align-middle text-center"><?= $p['class'] ?></td>
                <td class="align-middle">
                    <div class="d-flex justify-content-center">
                        <button style="width: 50px;" class="btn btn-outline-success mr-2" onclick="openSubject('<?= $p['id_subject'] ?>')"><i class="ion-log-in" style="font-size: 20px;"></i></button>
                        <button style="width: 50px;" class="btn btn-outline-primary mr-2" onclick="subjectDetailModal('<?= $p['id_subject'] ?>')"><i class="ion-ios-information" style="font-size: 20px;"></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>