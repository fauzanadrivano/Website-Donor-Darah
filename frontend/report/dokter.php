<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "donor";

$koneksi    = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloodku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 70%;
        }
        .card {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="mx-auto">
        <!-- TAMPIL DATA -->
        <div class = "card">
            <div class = "card-header text-white bg-secondary">
                DATA dokter
            </div>
            <div class = "card-body">
                <form action="" method="POST">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Dokter</th>
                                <th scope="col">Umur</th>
                                <th scope="col">Rumah Sakit</th>
                                <th scope="col">ID Posko</th>
                            </tr>
                        </thead>

                        <tbody>
                                <?php
                                $sql2   = "select * from dokter order by id asc";
                                $q2     = mysqli_query($koneksi, $sql2);
                                $urut   = 1;
                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $id             = $r2['id'];
                                    $nama_dokter    = $r2['nama_dokter'];
                                    $umur           = $r2['umur'];
                                    $rumah_sakit    = $r2['rumah_sakit'];
                                    $id_posko       = $r2['id_posko'];
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope="row"><?php echo $nama_dokter ?></td>
                                    <td scope="row"><?php echo $umur ?></td>
                                    <td scope="row"><?php echo $rumah_sakit ?></td>
                                    <td scope="row"><?php echo $id_posko ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>