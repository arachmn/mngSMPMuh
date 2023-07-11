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
        <table border="1" cellpadding="4" cellspacing="0">
            <thead>
                <tr style="text-align: center;">
                    <th rowspan="3">No</th>
                    <th rowspan="3">NISN/NIS</th>
                    <th rowspan="3">NAMA</th>
                    <th colspan="20">FORMATIF</th>
                    <th rowspan="3" style="max-width: 50px;">Rata-Rata Formatif</th>
                    <th rowspan="2" colspan="5">SUMATIF LINGKUP MATERI</th>
                    <th rowspan="3" style="max-width: 50px;">Rata-Rata Sumatif</th>
                    <th rowspan="3" style="max-width: 70px;">SUMATIF AKHIR SEMESTER</th>
                    <th rowspan="3" style="min-width: 30px;">NR</th>
                </tr>
                <tr style="text-align: center;">
                    <th colspan="4">Lingkup Materi 1</th>
                    <th colspan="4">Lingkup Materi 2</th>
                    <th colspan="4">Lingkup Materi 3</th>
                    <th colspan="4">Lingkup Materi 4</th>
                    <th colspan="4">Lingkup Materi 5</th>
                </tr>
                <tr style="text-align: center;">
                    <th>TP1</th>
                    <th>TP2</th>
                    <th>TP3</th>
                    <th>TP4</th>
                    <th>TP1</th>
                    <th>TP2</th>
                    <th>TP3</th>
                    <th>TP4</th>
                    <th>TP1</th>
                    <th>TP2</th>
                    <th>TP3</th>
                    <th>TP4</th>
                    <th>TP1</th>
                    <th>TP2</th>
                    <th>TP3</th>
                    <th>TP4</th>
                    <th>TP1</th>
                    <th>TP2</th>
                    <th>TP3</th>
                    <th>TP4</th>
                    <th>LM1</th>
                    <th>LM2</th>
                    <th>LM3</th>
                    <th>LM4</th>
                    <th>LM5</th>
                </tr>
            </thead>
            <tbody>
                <?php $a = 0;
                foreach ($score as $s) : $a++ ?>
                    <tr style="text-align: center;">
                        <td><?= $a ?></td>
                        <td style="text-align: left;"><?= $s['nis'] ?> / <?= $s['nisn'] ?></td>
                        <td style="text-align: left;"><?= $s['name'] ?></td>
                        <td><?= $s['lm1_tp1'] ?></td>
                        <td><?= $s['lm1_tp2'] ?></td>
                        <td><?= $s['lm1_tp3'] ?></td>
                        <td><?= $s['lm1_tp4'] ?></td>
                        <td><?= $s['lm2_tp1'] ?></td>
                        <td><?= $s['lm2_tp2'] ?></td>
                        <td><?= $s['lm2_tp3'] ?></td>
                        <td><?= $s['lm2_tp4'] ?></td>
                        <td><?= $s['lm3_tp1'] ?></td>
                        <td><?= $s['lm3_tp2'] ?></td>
                        <td><?= $s['lm3_tp3'] ?></td>
                        <td><?= $s['lm3_tp4'] ?></td>
                        <td><?= $s['lm4_tp1'] ?></td>
                        <td><?= $s['lm4_tp2'] ?></td>
                        <td><?= $s['lm4_tp3'] ?></td>
                        <td><?= $s['lm4_tp4'] ?></td>
                        <td><?= $s['lm5_tp1'] ?></td>
                        <td><?= $s['lm5_tp2'] ?></td>
                        <td><?= $s['lm5_tp3'] ?></td>
                        <td><?= $s['lm5_tp4'] ?></td>
                        <td><?= $s['average_for'] ?></td>
                        <td><?= $s['sum_lm_1'] ?></td>
                        <td><?= $s['sum_lm_2'] ?></td>
                        <td><?= $s['sum_lm_3'] ?></td>
                        <td><?= $s['sum_lm_4'] ?></td>
                        <td><?= $s['sum_lm_5'] ?></td>
                        <td><?= $s['average_sum'] ?></td>
                        <td><?= $s['sum_last'] ?></td>
                        <td><?= $s['nr'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div>
        <table style="font-size: 12px; margin: 20px 0 0 120px; text-align: left; width: 1300px;">
            <tr>
                <td>Mengetahui,</td>
                <td><strong>Keterangan : </strong></td>
                <td>Moga, <?= $date ?></td>
            </tr>
            <tr>
                <td>Kepala Sekolah</td>
                <td style="font-style: italic;">TP = Tujuan Pembelajaran</td>
                <td>Wali Kelas,</td>
            </tr>
            <tr>
                <td></td>
                <td style="font-style: italic;">LM = Lingkup Materi</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="font-style: italic;">NR = Nilai Raport</td>
                <td></td>
            </tr>
            <tr>
                <td><u><?= $master ?></u></td>
                <td></td>
                <td><u><?= $class->name ?></u></td>
            </tr>
            <tr>
                <td>NBM. 993.323</td>
                <td></td>
                <td>NBM. .......................</td>
            </tr>
        </table>
    </div>
</body>

</html>