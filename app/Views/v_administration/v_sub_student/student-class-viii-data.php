<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="align-middle text-center">#</th>
            <th class="align-middle text-center">Kelas</th>
            <th class="align-middle text-center">Wali Kelas</th>
            <th class="align-middle text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $a = 0;
        foreach ($class as $c) : $a++ ?>
            <tr id="tr<?= $a ?>">
                <td class="align-middle text-center"><?= $a ?></td>
                <td class="align-middle text-center"><?= $c['class'] ?></td>
                <td class="align-middle"><?= $c['name'] ?></td>
                <td class="align-middle">
                    <div class="d-flex justify-content-center">
                        <a style="width: 50px;" class="btn btn-outline-success mr-2" href="<?= site_url('administration/student/' . $c['school_year'] . '/' . $c['id_class']) ?>"><i class="ion-log-in" style="font-size: 20px;"></i></a>
                        <button style="width: 50px;" class="btn btn-outline-primary mr-2" onclick="openClass('<?= $c['id_class'] ?>')"><i class="ion-ios-information" style="font-size: 20px;"></i></button>
                        <button style="width: 50px;" class="btn btn-outline-danger" onclick="deleteClass('<?= $c['id_class'] ?>')"><i class="ion-trash-b" style="font-size: 20px;"></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>