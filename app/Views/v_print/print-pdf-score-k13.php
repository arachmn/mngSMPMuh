<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>
    <div style="font-size: 17px; font-weight: bold; margin-bottom: 10px">
        <a>KELAS <?= $nClass ?></a>
    </div>
    <div style="font-size: 12px; max-width: 1500px;">
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr style="text-align: center;">
                    <th rowspan=" 3">No</th>
                    <th rowspan="3">NISN/NIS</th>
                    <th rowspan="3">NAMA</th>
                    <th colspan="7">PH-1</th>
                    <th colspan="7">PH-2</th>
                    <th colspan="7">PH-3</th>
                    <th colspan="7">PH-4</th>
                    <th colspan="7">PH-5</th>
                    <th colspan="7">PH-6</th>
                </tr>
                <tr style="text-align: center;">
                    <?php for ($v = 1; $v <= 6; $v++) : ?>
                        <th style="max-width: 40px" colspan="2">
                            <div style="min-height: 60px; transform: rotate(-90deg); margin: 0 0 0 33">KINERJA</div>
                        </th>
                        <th style="max-width: 20px" rowspan="2">
                            <div style="min-height: 60px; transform: rotate(-90deg); margin: 0 0 0 25">OPTIMUM</div>
                        </th>
                        <th style="max-width: 40px" colspan="2">
                            <div style="min-height: 60px; transform: rotate(-90deg); margin: 0 0 0 33">PROYEK</div>
                        </th>
                        <th style="max-width: 20px" rowspan="2">
                            <div style="min-height: 60px; transform: rotate(-90deg); margin: 0 0 0 25">OPYIMUM</div>
                        </th>
                        <th style="max-width: 20px">
                            <div style="min-height: 60px; transform: rotate(-90deg); margin: -5px 0 0 25">SEKOR</div>
                        </th>
                    <?php endfor ?>
                </tr>
                <tr style="text-align: center;">
                    <?php for ($v = 1; $v <= 6; $v++) : ?>
                        <th>1</th>
                        <th>2</th>
                        <th>1</th>
                        <th>2</th>
                        <th>0</th>
                    <?php endfor ?>
                </tr>
            </thead>
            <tbody>
                <?php $a = 0;
                foreach ($score as $s) : $a++ ?>
                    <tr style="text-align: center;">
                        <td><?= $a ?></td>
                        <td style="text-align: left;"><?= $s['nisn'] ?> / <?= $s['nis'] ?></td>
                        <td style="text-align: left;"><?= $s['name'] ?></td>
                        <?php for ($v = 1; $v <= 6; $v++) : ?>
                            <td><?= $s['ph' . $v . '_kinerja1'] ?></td>
                            <td><?= $s['ph' . $v . '_kinerja2'] ?></td>
                            <td><?= $s['ph' . $v . '_optimum'] ?></td>
                            <td><?= $s['ph' . $v . '_proyek1'] ?></td>
                            <td><?= $s['ph' . $v . '_proyek2'] ?></td>
                            <td><?= $s['ph' . $v . '_opyimum'] ?></td>
                            <td><?= $s['ph' . $v . '_sekor'] ?></td>
                        <?php endfor ?>
                    <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div>
        <table style="font-size: 12px; margin: 20px 0 0 120px; text-align: left; width: 1300px;">
            <tr>
                <td>Mengetahui,</td>
                <td>Moga, <?= $date ?></td>
            </tr>
            <tr>
                <td>Kepala Sekolah</td>
                <td>Wali Kelas,</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr style="margin-top: 70px;">
                <td><u><?= $master ?></u></td>
                <td><u><?= $class->name ?></u></td>
            </tr>
            <tr>
                <td>NBM. 993.323</td>
                <td>NBM. .......................</td>
            </tr>
        </table>
    </div>
</body>

</html>