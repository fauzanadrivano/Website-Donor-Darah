<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "donor";

$koneksi    = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}

$totala = mysqli_query($koneksi, "SELECT sum(darah_a) as totaldarah FROM rumah_sakit")->fetch_array();
$totalb = mysqli_query($koneksi, "SELECT sum(darah_b) as totaldarah FROM rumah_sakit")->fetch_array();
$totalo = mysqli_query($koneksi, "SELECT sum(darah_o) as totaldarah FROM rumah_sakit")->fetch_array();
$totalab = mysqli_query($koneksi, "SELECT sum(darah_ab) as totaldarah FROM rumah_sakit")->fetch_array();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
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
        <br>
            <p>Total Darah A Tersedia : <?php echo $totala['totaldarah'] ?></p>
            <p>Total Darah B Tersedia : <?php echo $totalb['totaldarah'] ?></p>
            <p>Total Darah O Tersedia : <?php echo $totalo['totaldarah'] ?></p>
            <p>Total Darah AB Tersedia : <?php echo $totalab['totaldarah'] ?></p>
        <br>
        <br>
        <div class="row">
            <div class="col-lg-6">
                <canvas scope="col" id="barchart1" style="width:100%;max-width:500px"></canvas>
            </div>
            <div class="col-lg-6">
                <canvas scope="col" id="barchart2" style="width:100%;max-width:500px"></canvas>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-6">
                <canvas scope="col" id="barchart3" style="width:100%;max-width:500px"></canvas>
            </div>
            <div class="col-lg-6">
                <canvas scope="col" id="barchart4" style="width:100%;max-width:500px"></canvas>
            </div>
        </div>
        <br>
        <br>
        <!-- TAMPIL DATA -->
        <div class = "card">
            <div class = "card-header text-white bg-secondary">
                DATA STOK DARAH
            </div>
            <div class = "card-body">
                <form action="" method="POST">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">rumah_sakit</th>
                                <th scope="col">Stok Darah A</th>
                                <th scope="col">Stok Darah B</th>
                                <th scope="col">Stok Darah AB</th>
                                <th scope="col">Stok Darah O</th>
                            </tr>
                        </thead>

                        <tbody>
                                <?php
                                $sql2   = "select * from rumah_sakit order by rumah_sakit asc";
                                $q2     = mysqli_query($koneksi, $sql2);
                                $urut   = 1;
                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $rumah_sakit    = $r2['rumah_sakit'];
                                    $darah_a        = $r2['darah_a'];
                                    $darah_b        = $r2['darah_b'];
                                    $darah_ab       = $r2['darah_ab'];
                                    $darah_o        = $r2['darah_o'];
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope="row"><?php echo $rumah_sakit ?></td>
                                    <td scope="row"><?php echo $darah_a ?></td>
                                    <td scope="row"><?php echo $darah_b ?></td>
                                    <td scope="row"><?php echo $darah_ab ?></td>
                                    <td scope="row"><?php echo $darah_o ?></td>
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
<script>

// Chart Rumah Sakit Permata
<?php
    $result = mysqli_query($koneksi, "SELECT darah_a, darah_b, darah_o, darah_ab FROM rumah_sakit WHERE rumah_sakit = 'Permata'");

    foreach ($result as $data) {
        $darah_a    = $data['darah_a'];
        $darah_b    = $data['darah_b'];
        $darah_ab   = $data['darah_ab'];
        $darah_o    = $data['darah_o'];
    }
?>

var chart1x = ["DARAH A","DARAH B","DARAH AB","DARAH O"];
var chart1y = [<?php echo json_encode($darah_a) ?>, <?php echo json_encode($darah_b)?>, <?php echo json_encode($darah_ab) ?>, <?php echo json_encode($darah_o) ?>, 0];
var chart1c = ["#FFE6E6","#FFABE1","#A685E2","#6155A6"];

new Chart("barchart1", {
    type: "bar",
    data: {
    labels: chart1x,
    datasets: [{
        backgroundColor: chart1c,
        data: chart1y
    }]
    },
options: {
    legend: {display: false},
    title: {
        display: true,
        text: "Rumah Sakit Permata"
    }
}
});

// Chart rumah sakit Prasetya Husada
<?php
    $result = mysqli_query($koneksi, "SELECT darah_a, darah_b, darah_o, darah_ab FROM rumah_sakit WHERE rumah_sakit = 'Prasetya Husada'");

    foreach ($result as $data) {
        $darah_a    = $data['darah_a'];
        $darah_b    = $data['darah_b'];
        $darah_ab   = $data['darah_ab'];
        $darah_o    = $data['darah_o'];
    }
?>

var chart1x = ["DARAH A","DARAH B","DARAH AB","DARAH O"];
var chart1y = [<?php echo json_encode($darah_a) ?>, <?php echo json_encode($darah_b)?>, <?php echo json_encode($darah_ab) ?>, <?php echo json_encode($darah_o) ?>, 0];
var chart1c = ["#FFE6E6","#FFABE1","#A685E2","#6155A6"];

new Chart("barchart2", {
    type: "bar",
    data: {
    labels: chart1x,
    datasets: [{
        backgroundColor: chart1c,
        data: chart1y
    }]
    },
options: {
    legend: {display: false},
    title: {
        display: true,
        text: "Rumah Sakit Prasetya Husada"
    }
}
});

// Chart rumah sakit lavalette
<?php
    $result = mysqli_query($koneksi, "SELECT darah_a, darah_b, darah_o, darah_ab FROM rumah_sakit WHERE rumah_sakit = 'Lavalette'");

    foreach ($result as $data) {
        $darah_a    = $data['darah_a'];
        $darah_b    = $data['darah_b'];
        $darah_ab   = $data['darah_ab'];
        $darah_o    = $data['darah_o'];
    }
?>

var chart1x = ["DARAH A","DARAH B","DARAH AB","DARAH O"];
var chart1y = [<?php echo json_encode($darah_a) ?>, <?php echo json_encode($darah_b)?>, <?php echo json_encode($darah_ab) ?>, <?php echo json_encode($darah_o) ?>, 0];
var chart1c = ["#FFE6E6","#FFABE1","#A685E2","#6155A6"];

new Chart("barchart3", {
    type: "bar",
    data: {
    labels: chart1x,
    datasets: [{
        backgroundColor: chart1c,
        data: chart1y
    }]
    },
options: {
    legend: {display: false},
    title: {
        display: true,
        text: "Rumah Sakit Lavalette"
    }
}
});

// Chart rumah sakit Prima Husada
<?php
    $result = mysqli_query($koneksi, "SELECT darah_a, darah_b, darah_o, darah_ab FROM rumah_sakit WHERE rumah_sakit = 'Prima Husada'");

    foreach ($result as $data) {
        $darah_a    = $data['darah_a'];
        $darah_b    = $data['darah_b'];
        $darah_ab   = $data['darah_ab'];
        $darah_o    = $data['darah_o'];
    }
?>

var chart1x = ["DARAH A","DARAH B","DARAH AB","DARAH O"];
var chart1y = [<?php echo json_encode($darah_a) ?>, <?php echo json_encode($darah_b)?>, <?php echo json_encode($darah_ab) ?>, <?php echo json_encode($darah_o) ?>, 0];
var chart1c = ["#FFE6E6","#FFABE1","#A685E2","#6155A6"];

new Chart("barchart4", {
    type: "bar",
    data: {
    labels: chart1x,
    datasets: [{
        backgroundColor: chart1c,
        data: chart1y
    }]
    },
options: {
    legend: {display: false},
    title: {
        display: true,
        text: "Rumah Sakit Prima Husada"
    }
}
});

</script>
</html>