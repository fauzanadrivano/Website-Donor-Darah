<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "donor";

$koneksi    = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}

$total = mysqli_query($koneksi, "SELECT count(id) as totalpendonor FROM pendonor")->fetch_array();

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
            width: 80%;
            margin-top: 30px;
        }
        .card {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="mx-auto">
        <p>Total Pendonor : <?php echo $total['totalpendonor'] ?></p>
        <!--- Report Data Pendonor --->
        <div class = "card">
        <div class = "card-header text-white bg-secondary">
            DATA PENDONOR
            </div>
            <div class = "card-body">
                
                <form action="" method="POST">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Golongan Darah</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No Hp</th>
                                <th scope="col">ID Posko</th>
                                <th scope="col">Dokter</th>
                                <th scope="col">Rumah Sakit</th>
                            </tr>
                        </thead>

                        <tbody>
                                <?php
                                $sql2   = "select p.nama , p.golongan_darah, p.alamat, p.no_hp, p.id_posko, d.nama_dokter , d.rumah_sakit
                                from pendonor p
                                inner join dokter d
                                on p.id_posko = d.id_posko";
                                $q2     = mysqli_query($koneksi, $sql2);
                                $urut   = 1;
                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $nama           = $r2['nama'];
                                    $golongan_darah = $r2['golongan_darah'];
                                    $alamat         = $r2['alamat'];
                                    $no_hp          = $r2['no_hp'];
                                    $id_posko       = $r2['id_posko'];
                                    $dokter         = $r2['nama_dokter'];
                                    $rumah_sakit    = $r2['rumah_sakit'];
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope="row"><?php echo $nama ?></td>
                                    <td scope="row"><?php echo $golongan_darah ?></td>
                                    <td scope="row"><?php echo $alamat ?></td>
                                    <td scope="row"><?php echo $no_hp ?></td>
                                    <td scope="row"><?php echo $id_posko ?></td>
                                    <td scope="row"><?php echo $dokter ?></td>
                                    <td scope="row"><?php echo $rumah_sakit ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

        <!--- Tampil Riwayat Darah Masuk --->
        <div class = "card">
            <div class = "card-header text-white bg-secondary">
                DATA RIWAYAT DARAH MASUK
            </div>
            <div class = "card-body">
                <form action="" method="POST">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID Posko</th>
                                <th scope="col">Golongan Darah</th>
                                <th scope="col">Kantong</th>
                                <th scope="col">Rumah Sakit</th>
                                <th scope="col">Tanggal</th>
                                <tbody>
                            </tr>
                        </thead>

                                <?php
                                $sql2   =   "select * from riwayat_darah_masuk order by id asc";
                                $q2     = mysqli_query($koneksi, $sql2);
                                $urut   = 1;
                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $id_posko       = $r2['id_posko'];
                                    $golongan_darah = $r2['golongan_darah'];
                                    $kantong        = $r2['kantong'];
                                    $rumah_sakit    = $r2['rumah_sakit'];
                                    $tanggal        = $r2['tanggal'];
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope="row"><?php echo $id_posko ?></td>
                                    <td scope="row"><?php echo $golongan_darah ?></td>
                                    <td scope="row"><?php echo $kantong ?></td>
                                    <td scope="row"><?php echo $rumah_sakit ?></td>
                                    <td scope="row"><?php echo $tanggal ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

        <!--- Tampil Wiwayat Darah Keluar --->
        <div class = "card">
            <div class = "card-header text-white bg-secondary">
                DATA RIWAYAT DARAH KELUAR
            </div>
            <div class = "card-body">
                <form action="" method="POST">
                    <thead>
                    <table class="table">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Penerima</th>
                                <th scope="col">Golongan Darah</th>
                                <th scope="col">Kantong</th>
                                <th scope="col">Rumah Sakit Asal</th>
                                <th scope="col">Tanggal</th>
                            </tr>
                        </thead>

                        <tbody>
                                <?php
                                $sql2   = "select * from riwayat_darah_keluar order by nama_penerima asc";
                                $q2     = mysqli_query($koneksi, $sql2);
                                $urut   = 1;
                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $id                  = $r2['id'];
                                    $nama_penerima       = $r2['nama_penerima'];
                                    $golongan_darah      = $r2['golongan_darah'];
                                    $kantong             = $r2['kantong'];
                                    $rumah_sakit_asal    = $r2['rumah_sakit'];
                                    $tanggal             = $r2['tanggal'];
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope="row"><?php echo $nama_penerima ?></td>
                                    <td scope="row"><?php echo $golongan_darah ?></td>
                                    <td scope="row"><?php echo $kantong ?></td>
                                    <td scope="row"><?php echo $rumah_sakit_asal ?></td>
                                    <td scope="row"><?php echo $tanggal ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

        <!--- Tampil Data Penerima --->
        <div class = "card">
            <div class = "card-header text-white bg-secondary">
                DATA PENERIMA
            </div>
            <div class = "card-body">
                <form action="" method="POST">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Golongan Darah</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No Hp</th>
                                <th scope="col">Rumah Sakit Asal</th>
                            </tr>
                        </thead>

                        <tbody>
                                <?php
                                $sql2   = "select * from penerima order by nama_penerima asc";
                                $q2     = mysqli_query($koneksi, $sql2);
                                $urut   = 1;
                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $id                 = $r2['id'];
                                    $nama_penerima               = $r2['nama_penerima'];
                                    $golongan_darah     = $r2['golongan_darah'];
                                    $alamat             = $r2['alamat'];
                                    $no_hp              = $r2['no_hp'];
                                    $rumah_sakit_asal   = $r2['rumah_sakit'];
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope="row"><?php echo $nama_penerima ?></td>
                                    <td scope="row"><?php echo $golongan_darah ?></td>
                                    <td scope="row"><?php echo $alamat ?></td>
                                    <td scope="row"><?php echo $no_hp ?></td>
                                    <td scope="row"><?php echo $rumah_sakit_asal ?></td>
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
</html>