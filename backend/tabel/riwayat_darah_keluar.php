<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "donor";

$koneksi    = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}

$nama_penerima      = ""; 
$golongan_darah     = "";
$kantong            = "";
$rumah_sakit        = "";
$tanggal            = "";
$sukses             = "";
$error              = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op == 'delete'){
    $id     = $_GET['id'];
    $sql1       = "delete from riwayat_darah_keluar where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}

if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from riwayat_darah_keluar where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nama_penerima      = $r1['nama_penerima'];
    $golongan_darah     = $r1['golongan_darah'];
    $kantong            = $r1['kantong'];
    $rumah_sakit        = $r1['rumah_sakit'];
    $tanggal            = $r1['tanggal'];

    if ($nama_penerima == '') {
        $error = "Data tidak ditemukan";
    }
}

if(isset($_POST['simpan'])){
    $nama_penerima      = $_POST['nama_penerima'];
    $golongan_darah     = $_POST['golongan_darah'];
    $kantong            = $_POST['kantong'];
    $rumah_sakit        = $_POST['rumah_sakit'];
    $tanggal            = $_POST['tanggal'];

    if($nama_penerima && $golongan_darah && $kantong && $rumah_sakit && $tanggal){
        if ($op == 'edit') {
            $id = $_GET['id'];
            $sql1 = "UPDATE riwayat_darah_keluar SET nama_penerima='$nama_penerima', golongan_darah='$golongan_darah', kantong='$kantong', rumah_sakit ='$rumah_sakit', tanggal='$tanggal' WHERE id='$id'";
            $q1 = mysqli_query($koneksi, $sql1);

            if($q1){
                $sukses = "Data berhasil diupdate";
            }else{
                $error = "Data gagal diupdate";
            }
        } else {
            $sql1 = "INSERT INTO riwayat_darah_keluar (nama_penerima, golongan_darah, kantong, rumah_sakit, tanggal) VALUES ('$nama_penerima', '$golongan_darah', '$kantong', '$rumah_sakit', '$tanggal')";
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
                    DATA RIWAYAT DARAH KELUAR
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
                            <label for="nama_penerima" class="col-sm-2 col-form-label">Nama Penerima</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" value="<?php echo $nama_penerima ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="golongan_darah" class="col-sm-2 col-form-label">Golongan Darah</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="golongan_darah" id="golongan_darah">
                                    <option value="">-- Pilih Golongan Darah --</option>
                                    <option value="A" <?php if($golongan_darah == "A") echo "selected" ?>>A</option>
                                    <option value="B" <?php if($golongan_darah == "B") echo "selected" ?>>B</option>
                                    <option value="AB" <?php if($golongan_darah == "AB") echo "selected" ?>>AB</option>
                                    <option value="O" <?php if($golongan_darah == "O") echo "selected" ?>>O</option>
                                </select>
                            </div> 
                        </div>
                        <div class="mb-3 row">
                            <label for="kantong" class="col-sm-2 col-form-label">Kantong</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kantong" name="kantong" value="<?php echo $kantong ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="rumah_sakit" class="col-sm-2 col-form-label">Rumah Sakit</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="rumah_sakit" id="rumah_sakit">
                                    <option value="">-- Rumah Sakit Asal --</option>
                                    <option value="Permata" <?php if($rumah_sakit == "Permata") echo "selected" ?>>Permata</option>
                                    <option value="Prasetya Husada" <?php if($rumah_sakit == "Prasetya Husada") echo "selected" ?>>Prasetya Husada</option>
                                    <option value="Lavalette" <?php if($rumah_sakit == "Lavalette") echo "selected" ?>>Lavalette</option>
                                    <option value="Prima Husada" <?php if($rumah_sakit == "Prima Husada") echo "selected" ?>>Prima Husada</option>
                                </select>
                            </div> 
                        </div>
                        <div class="mb-3 row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal ?>">
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
                    DATA POSKO DONOR
                </div>
                <div class = "card-body">
                    <form action="" method="POST">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Penerima</th>
                                    <th scope="col">Golongan Darah</th>
                                    <th scope="col">Kantong</th>
                                    <th scope="col">Rumah Sakit Asal</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Edit / Hapus</th>
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
                                        $rumah_sakit         = $r2['rumah_sakit'];
                                        $tanggal             = $r2['tanggal'];
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $urut++ ?></th>
                                        <td scope="row"><?php echo $nama_penerima ?></td>
                                        <td scope="row"><?php echo $golongan_darah ?></td>
                                        <td scope="row"><?php echo $kantong ?></td>
                                        <td scope="row"><?php echo $rumah_sakit   ?></td>
                                        <td scope="row"><?php echo $tanggal ?></td>
                                        <td scope="row">
                                            <a href="riwayat_darah_keluar.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                            <a href="riwayat_darah_keluar.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Hapus Data ?')"><button type="button" class="btn btn-danger">Delete</button></a>            
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