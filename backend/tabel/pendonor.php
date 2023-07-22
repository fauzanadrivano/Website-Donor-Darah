<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "donor";

$koneksi    = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}

$nama           = "";  
$golongan_darah = "";
$alamat         = "";
$no_hp          = "";
$id_posko       = "";
$sukses         = "";
$error          = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op == 'delete'){
    $id     = $_GET['id'];
    $sql1       = "delete from pendonor where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}

if ($op == 'edit') {
    $id             = $_GET['id'];
    $sql1           = "select * from pendonor where id = '$id'";
    $q1             = mysqli_query($koneksi, $sql1);
    $r1             = mysqli_fetch_array($q1);
    $nama           = $r1['nama'];
    $golongan_darah = $r1['golongan_darah'];
    $alamat         = $r1['alamat'];
    $no_hp          = $r1['no_hp'];
    $id_posko       = $r1['id_posko'];

    if ($nama == '') {
        $error = "Data tidak ditemukan";
    }
}

if(isset($_POST['simpan'])){
    $nama           = $_POST['nama'];
    $golongan_darah = $_POST['golongan_darah'];
    $alamat         = $_POST['alamat'];
    $no_hp          = $_POST['no_hp'];
    $id_posko       = $_POST['id_posko'];

    if($nama && $golongan_darah && $alamat && $no_hp && $id_posko){
        if ($op == 'edit') {
            $id = $_GET['id'];
            $sql1 = "UPDATE pendonor SET nama='$nama', golongan_darah='$golongan_darah', alamat='$alamat', no_hp='$no_hp', id_posko='$id_posko' WHERE id='$id'";
            $q1 = mysqli_query($koneksi, $sql1);

            if($q1){
                $sukses = "Data berhasil diupdate";
            }else{
                $error = "Data gagal diupdate";
            }
        } else {
            $sql1 = "INSERT INTO pendonor (nama, golongan_darah, alamat, no_hp, id_posko) VALUES ('$nama', '$golongan_darah', '$alamat', '$no_hp', '$id_posko')";
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
                DATA PENDONOR
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
                        <label for="nama" class="col-sm-2 col-form-label">nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
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
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $no_hp ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="id_posko" class="col-sm-2 col-form-label">ID Posko</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="id_posko" id="id_posko">
                                <option value="">-- Pilih ID Posko --</option>
                                <option value=1 <?php if($id_posko == 1) echo "selected" ?>>1</option>
                                <option value=2 <?php if($id_posko == 2) echo "selected" ?>>2</option>
                                <option value=3 <?php if($id_posko == 3) echo "selected" ?>>3</option>
                                <option value=4 <?php if($id_posko == 4) echo "selected" ?>>4</option>
                            </select>
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
                                <th scope="col">Edit / Hapus</th>
                            </tr>
                        </thead>

                        <tbody>
                                <?php
                                $sql2   = "select * from pendonor order by id asc";
                                $q2     = mysqli_query($koneksi, $sql2);
                                $urut   = 1;
                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $id             = $r2['id'];
                                    $nama           = $r2['nama'];
                                    $golongan_darah = $r2['golongan_darah'];
                                    $alamat         = $r2['alamat'];
                                    $no_hp          = $r2['no_hp'];
                                    $id_posko       = $r2['id_posko'];
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope="row"><?php echo $nama ?></td>
                                    <td scope="row"><?php echo $golongan_darah ?></td>
                                    <td scope="row"><?php echo $alamat ?></td>
                                    <td scope="row"><?php echo $no_hp ?></td>
                                    <td scope="row"><?php echo $id_posko ?></td>
                                    <td scope="row">
                                        <a href="pendonor.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                        <a href="pendonor.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Hapus Data ?')"><button type="button" class="btn btn-danger">Delete</button></a>            
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
    </section>
    <script src="../assets/js/script.js"></script>
</body>
</html>