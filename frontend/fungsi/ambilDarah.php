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
$alamat             = "";
$no_hp              = "";
$kantong            = "";
$rumah_sakit        = "";
$tanggal            = "";
$sukses             = "";
$error              = "";

if(isset($_POST['simpan'])){
    $nama_penerima      = $_POST['nama_penerima'];
    $golongan_darah     = $_POST['golongan_darah'];
    $kantong            = $_POST['kantong'];
    $rumah_sakit        = $_POST['rumah_sakit'];
    $tanggal            = $_POST['tanggal'];
    $alamat             = $_POST['alamat'];
    $no_hp              = $_POST['no_hp'];

    if($nama_penerima && $golongan_darah && $kantong && $rumah_sakit && $tanggal && $alamat && $no_hp){
        if($golongan_darah == 'A') {
            $sql = mysqli_query($koneksi, "SELECT darah_a FROM rumah_sakit WHERE rumah_sakit = '$rumah_sakit'");
            while($data = mysqli_fetch_array($sql)) {
                $sisa = $data['darah_a'];
            }
            if($sisa < $kantong) {
                $error = "Stok darah kurang dari yang diambil";
            } else if($sisa > $kantong) {
                $sql1 = "INSERT INTO riwayat_darah_keluar (nama_penerima, golongan_darah, kantong, rumah_sakit, tanggal) VALUES ('$nama_penerima', '$golongan_darah', '$kantong', '$rumah_sakit', '$tanggal')";
                $q1 = mysqli_query($koneksi, $sql1);
        
                $sql2 = "INSERT INTO penerima (nama_penerima, golongan_darah, alamat, no_hp, rumah_sakit) VALUES ('$nama_penerima', '$golongan_darah', '$alamat', '$no_hp', '$rumah_sakit')";
                $q2 = mysqli_query($koneksi, $sql2);

                $sql3 = "UPDATE rumah_sakit SET darah_a = darah_a - '$kantong' WHERE rumah_sakit = '$rumah_sakit'";
                $q3 = mysqli_query($koneksi, $sql3);
                $sukses = "Darah berhasil diambil";
            }
        } else if($golongan_darah == 'B') {
            $sql = mysqli_query($koneksi, "SELECT darah_b FROM rumah_sakit WHERE rumah_sakit = '$rumah_sakit'");
            while($data = mysqli_fetch_array($sql)) {
                $sisa = $data['darah_b'];
            }
            if($sisa < $kantong) {
                $error = "Stok darah kurang dari yang diambil";
            } else if($sisa > $kantong) {
                $sql1 = "INSERT INTO riwayat_darah_keluar (nama_penerima, golongan_darah, kantong, rumah_sakit, tanggal) VALUES ('$nama_penerima', '$golongan_darah', '$kantong', '$rumah_sakit', '$tanggal')";
                $q1 = mysqli_query($koneksi, $sql1);
        
                $sql2 = "INSERT INTO penerima (nama_penerima, golongan_darah, alamat, no_hp, rumah_sakit) VALUES ('$nama_penerima', '$golongan_darah', '$alamat', '$no_hp', '$rumah_sakit')";
                $q2 = mysqli_query($koneksi, $sql2);
                
                $sql3 = "UPDATE rumah_sakit SET darah_b = darah_b - '$kantong' WHERE rumah_sakit = '$rumah_sakit'";
                $q3 = mysqli_query($koneksi, $sql3);
                $sukses = "Darah berhasil diambil";
            }
        } else if($golongan_darah == 'AB') {
            $sql = mysqli_query($koneksi, "SELECT darah_ab FROM rumah_sakit WHERE rumah_sakit = '$rumah_sakit'");
            while($data = mysqli_fetch_array($sql)) {
                $sisa = $data['darah_ab'];
            }
            if($sisa < $kantong) {
                $error = "Stok darah kurang dari yang diambil";
            } else if($sisa > $kantong) {
                $sql1 = "INSERT INTO riwayat_darah_keluar (nama_penerima, golongan_darah, kantong, rumah_sakit, tanggal) VALUES ('$nama_penerima', '$golongan_darah', '$kantong', '$rumah_sakit', '$tanggal')";
                $q1 = mysqli_query($koneksi, $sql1);
        
                $sql2 = "INSERT INTO penerima (nama_penerima, golongan_darah, alamat, no_hp, rumah_sakit) VALUES ('$nama_penerima', '$golongan_darah', '$alamat', '$no_hp', '$rumah_sakit')";
                $q2 = mysqli_query($koneksi, $sql2);
                
                $sql3 = "UPDATE rumah_sakit SET darah_ab = darah_ab - '$kantong' WHERE rumah_sakit = '$rumah_sakit'";
                $q3 = mysqli_query($koneksi, $sql3);
                $sukses = "Darah berhasil diambil";
            }
        } else if($golongan_darah == 'O') {
            $sql = mysqli_query($koneksi, "SELECT darah_o FROM rumah_sakit WHERE rumah_sakit = '$rumah_sakit'");
            while($data = mysqli_fetch_array($sql)) {
                $sisa = $data['darah_o'];
            }
            if($sisa < $kantong) {
                $error = "Stok darah kurang dari yang diambil";
            } else if($sisa > $kantong) {
                $sql1 = "INSERT INTO riwayat_darah_keluar (nama_penerima, golongan_darah, kantong, rumah_sakit, tanggal) VALUES ('$nama_penerima', '$golongan_darah', '$kantong', '$rumah_sakit', '$tanggal')";
                $q1 = mysqli_query($koneksi, $sql1);
        
                $sql2 = "INSERT INTO penerima (nama_penerima, golongan_darah, alamat, no_hp, rumah_sakit) VALUES ('$nama_penerima', '$golongan_darah', '$alamat', '$no_hp', '$rumah_sakit')";
                $q2 = mysqli_query($koneksi, $sql2);
                
                $sql3 = "UPDATE rumah_sakit SET darah_o = darah_o - '$kantong' WHERE rumah_sakit = '$rumah_sakit'";
                $q3 = mysqli_query($koneksi, $sql3);
                $sukses = "Darah berhasil diambil";
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
    <div class = "mx-auto">
        <!-- INPUT DATA -->
        <div class = "card">
            <div class = "card-header">
                AMBIL DARAH
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
                        <label for="alamat" class="col-sm-2 col-form-label">alamat</label>
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
                        <label for="kantong" class="col-sm-2 col-form-label">Kantong</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kantong" name="kantong" value="<?php echo $kantong ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="rumah_sakit" class="col-sm-2 col-form-label">Rumah Sakit Asal</label>
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
    </div>
</body>
</html>
