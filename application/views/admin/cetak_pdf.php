<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>
<style type="text/css">
    td {
        padding: 5px;
    }
</style>

<body style="font-family:Times New Roman;font-size:12px">

    <center>
        <h3>LAPORAN KINERJA GURU</h3>
        <h3>PERIODE PENILAIAN TAHUN <?= $aktif['waktu'] ?></h3>
    </center>

    <table border="1" align="center">
        <tr>
            <th>NO</th>
            <th>NAMA</th>
            <th>NIP</th>
            <th>HASIL</th>
        </tr>

        <?php $no = 1;
        foreach ($hasil as $h) { ?>

            <tr>
                <td><?= $no++ ?></td>
                <td><?= $h['nama_guru'] ?></td>
                <td><?= $h['nip'] ?></td>
                <td><?= $h['alternatif'] ?></td>
            </tr>
        <?php
        }
        ?>

    </table>

</body>

</html>