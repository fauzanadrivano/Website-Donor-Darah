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

if(isset($_POST['simpan'])){
    $nama           = $_POST['nama'];
    $golongan_darah = $_POST['golongan_darah'];
    $alamat         = $_POST['alamat'];
    $no_hp          = $_POST['no_hp'];
    $id_posko       = $_POST['id_posko'];

    if($nama && $golongan_darah && $alamat && $no_hp && $id_posko){
        $sql1 = "INSERT INTO pendonor (nama, golongan_darah, alamat, no_hp, id_posko) VALUES ('$nama', '$golongan_darah', '$alamat', '$no_hp', '$id_posko')";
        $q1 = mysqli_query($koneksi, $sql1);

        if($q1){
            $sukses = "Data berhasil ditambahkan";
        }else{
            $error = "Data gagal ditambahkan";
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
                        <label for="nama" class="col-sm-2 col-form-label">Nama Pendonor</label>
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
    </div>
</body>
</html>
