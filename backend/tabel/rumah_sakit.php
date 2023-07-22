<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "donor";

$koneksi    = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}

$rumah_sakit           = "";  
$darah_a        = "";
$darah_b        = "";
$darah_o        = "";
$darah_ab       = "";
$sukses         = "";
$error          = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op == 'delete'){
    $id     = $_GET['id'];
    $sql1       = "delete from rumah_sakit where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}

if ($op == 'edit') {
    $id             = $_GET['id'];
    $sql1           = "select * from rumah_sakit where id = '$id'";
    $q1             = mysqli_query($koneksi, $sql1);
    $r1             = mysqli_fetch_array($q1);
    $rumah_sakit    = $r1['rumah_sakit'];
    $darah_a        = $r1['darah_a'];
    $darah_b        = $r1['darah_b'];
    $darah_o        = $r1['darah_o'];
    $darah_ab       = $r1['darah_ab'];

    if ($rumah_sakit == '') {
        $error = "Data tidak ditemukan";
    }
}

if(isset($_POST['simpan'])){
    $rumah_sakit           = $_POST['rumah_sakit'];
    $darah_a        = $_POST['darah_a'];
    $darah_b        = $_POST['darah_b'];
    $darah_o        = $_POST['darah_o'];
    $darah_ab       = $_POST['darah_ab'];

    if($rumah_sakit && $darah_a && $darah_b && $darah_o && $darah_ab){
        if ($op == 'edit') {
            $id = $_GET['id'];
            $sql1 = "UPDATE rumah_sakit SET rumah_sakit='$rumah_sakit', darah_a='$darah_a', darah_b='$darah_b', darah_o='$darah_o', darah_ab='$darah_ab' WHERE id='$id'";
            $q1 = mysqli_query($koneksi, $sql1);

            if($q1){
                $sukses = "Data berhasil diupdate";
            }else{
                $error = "Data gagal diupdate";
            }
        } else {
            $sql1 = "INSERT INTO rumah_sakit (rumah_sakit, darah_a, darah_b, darah_o, darah_ab) VALUES ('$rumah_sakit', '$darah_a', '$darah_b', '$darah_o', '$darah_ab')";
            $q1 = mysqli_query($koneksi, $sql1);

            if($q1){
                $sukses = "Data berhasil ditambahkan";
            }else{
                $error = "Data gagal ditambahkan";
            }
        }
    } else {
        $error = "Data tidak boleh kosong";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Bloodku</title> 
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
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="logo.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">Bloodku</span>
                    <span class="profession">Web Donor Darah</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box" hidden>
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="pendonor.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Pendonor</span>
                        </a>
                    </li>
                </ul>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="dokter.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dokter</span>
                        </a>
                    </li>
                </ul>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="posko_donor.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Posko Donor</span>
                        </a>
                    </li>
                </ul>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="riwayat_darah_masuk.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Darah Masuk</span>
                        </a>
                    </li>
                </ul>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="rumah_sakit.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Rumah Sakit</span>
                        </a>
                    </li>
                </ul>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="riwayat_darah_keluar.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Darah Keluar</span>
                        </a>
                    </li>
                </ul>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="penerima.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Penerima</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="../login/login.html">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
                
            </div>
        </div>
    </nav>

    <section class="home">
        <div class = "mx-auto">
            <!-- INPUT DATA -->
            <div class = "card">
                <div class = "card-header">
                    DATA RUMAH SAKIT
                </div>
                <div class = "card-body">
                    <?php
                        if($error){
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error ?>
                            </div>
                            <?php
                        }
                    ?>
                    <?php
                        if($sukses){
                            ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $sukses ?>
                            </div>
                            <?php
                        }
                    ?>
                    <form action="" method="POST">
                        <div class="mb-3 row">
                            <label for="rumah_sakit" class="col-sm-2 col-form-label">Rumah Sakit</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="rumah_sakit" id="rumah_sakit">
                                    <option value="">-- Rumah Sakit Tujuan --</option>
                                    <option value="Permata" <?php if($rumah_sakit == "Permata") echo "selected" ?>>Permata</option>
                                    <option value="Prasetya Husada" <?php if($rumah_sakit == "Prasetya Husada") echo "selected" ?>>Prasetya Husada</option>
                                    <option value="Lavalette" <?php if($rumah_sakit == "Lavalette") echo "selected" ?>>Lavalette</option>
                                    <option value="Prima Husada" <?php if($rumah_sakit == "Prima Husada") echo "selected" ?>>Prima Husada</option>
                                </select>
                            </div> 
                        </div>
                        <div class="mb-3 row">
                            <label for="darah_a" class="col-sm-2 col-form-label">Stok Darah A</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="darah_a" name="darah_a" value="<?php echo $darah_a ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="darah_b" class="col-sm-2 col-form-label">Stok Darah B</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="darah_b" name="darah_b" value="<?php echo $darah_b ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="darah_o" class="col-sm-2 col-form-label">Stok Darah O</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="darah_o" name="darah_o" value="<?php echo $darah_o ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="darah_ab" class="col-sm-2 col-form-label">Stok Darah AB</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="darah_ab" name="darah_ab" value="<?php echo $darah_ab ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="submit" name="simpan" value="simpan data" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>

            <!-- TAMPIL DATA -->
            <div class = "card">
                <div class = "card-header text-white bg-secondary">
                    DATA RUMAH SAKIT
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
                                    <th scope="col">Stok Darah O</th>
                                    <th scope="col">Stok Darah AB</th>
                                    <th scope="col">Edit / Hapus</th>
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
                                        $darah_o        = $r2['darah_o'];
                                        $darah_ab        = $r2['darah_ab'];
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $urut++ ?></th>
                                        <td scope="row"><?php echo $rumah_sakit ?></td>
                                        <td scope="row"><?php echo $darah_a ?></td>
                                        <td scope="row"><?php echo $darah_b ?></td>
                                        <td scope="row"><?php echo $darah_o ?></td>
                                        <td scope="row"><?php echo $darah_ab ?></td>
                                        <td scope="row">
                                            <a href="rumah_sakit.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                            <a href="rumah_sakit.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Hapus Data ?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                        </td>
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
    </section>
    <script src="../assets/js/script.js"></script>
</body>
</html>