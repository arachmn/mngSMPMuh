<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $nameFile ?></title>
</head>

<body>
    <div style="font-size: 16px; font-weight: bold; margin-bottom: 20px">
        <table cellpadding="3" style=" margin-left: auto; margin-right: auto;">
            <tr style="text-align: center;">
                <td>PRESENSI SISWA</td>
            </tr>
            <tr style="text-align: center;">
                <td>SMP MUHAMMADIYAH TERPADU MOGA</td>
            </tr>
            <tr style="text-align: center;">
                <td>TAHUN PELAJARAN 2022/2023</td>
            </tr>
        </table>
    </div>
    <div style="font-size: 13px; font-weight: bold; padding-left: 3%; margin-top: 30px; margin-bottom: 10px">
        <a>KELAS <?= $class ?> | <?= $day ?> | <?= $week ?> | Semester <?= $semester ?></a>
    </div>
    <div style="padding-left: 3%; font-size: 10px;">
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr style="text-align: center;">
                    <th>NO</th>
                    <th>NIS</th>
                    <th>NISN</th>
                    <th>NAMA</th>
                    <th>PRESENSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $a = 0;
                foreach ($presence as $p) : $a++ ?>
                    <tr>
                        <td style="text-align: center;"><?= $a ?></td>
                        <td style="text-align: center;"><?= $p['nis'] ?></td>
                        <td style="text-align: center;"><?= $p['nisn'] ?></td>
                        <td><?= $p['name'] ?></td>
                        <td style="text-align: center;">
                            <?php if ($p['presence_' . $lesson] == 'hadir') : ?>
                                H
                            <?php elseif ($p['presence_' . $lesson] == 'sakit') : ?>
                                S
                            <?php elseif ($p['presence_' . $lesson] == 'izin') : ?>
                                I
                            <?php elseif ($p['presence_' . $lesson] == 'alpa') : ?>
                                A
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <table style="min-width: 400px;">
            <tr>
                <td colspan="5" style="padding: 5px;"></td>
            </tr>
            <tr>
                <td colspan="3" style="padding: 2px;"></td>
                <td colspan="2" style="padding: 2px; text-align: center;">MOGA, <?= $date ?></td>
            </tr>
            <tr>
                <td colspan="3" style="padding: 2px;"></td>
                <td colspan="2" style="padding: 2px; text-align: center;">GURU MAPEL</td>
            </tr>
            <tr>
                <td colspan="3" style="padding: 2px;"></td>
                <td colspan="2" style="padding: 2px; height: 40px;"></td>
            </tr>
            <tr>
                <td colspan="3" style="padding: 2px;"></td>
                <td colspan="2" style="padding: 2px; text-align: center;"><?= $teacher ?></td>
            </tr>
        </table>
    </div>
</body>

</html>