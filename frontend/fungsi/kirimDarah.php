<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "donor";

$koneksi    = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}

$id_posko       = "";
$golongan_darah = "";
$kantong        = "";
$rumah_sakit    = "";
$tanggal        = "";
$sukses         = "";
$error          = "";

#inputan tabel posko donor
if(isset($_POST['simpan'])){
    $id_posko       = $_POST['id_posko'];
    $golongan_darah = $_POST['golongan_darah'];
    $kantong        = $_POST['kantong'];
    $rumah_sakit    = $_POST['rumah_sakit'];
    $tanggal        = $_POST['tanggal'];

    if($id_posko && $golongan_darah && $kantong && $rumah_sakit && $tanggal){
        $sql1 = "INSERT INTO riwayat_darah_masuk (id_posko, golongan_darah, kantong, rumah_sakit, tanggal) VALUES ('$id_posko', '$golongan_darah', '$kantong', '$rumah_sakit', '$tanggal')";
        $q1 = mysqli_query($koneksi, $sql1);

        if($q1){
            if($golongan_darah == 'A') {
                $sql3 = "UPDATE rumah_sakit SET darah_a = darah_a + '$kantong' WHERE rumah_sakit = '$rumah_sakit'";
            } else if($golongan_darah == 'B') {
                $sql3 = "UPDATE rumah_sakit SET darah_b = darah_b + '$kantong' WHERE rumah_sakit = '$rumah_sakit'";
            } else if($golongan_darah == 'AB') {
                $sql3 = "UPDATE rumah_sakit SET darah_ab = darah_ab + '$kantong' WHERE rumah_sakit = '$rumah_sakit'";
            } else if($golongan_darah == 'O') {
                $sql3 = "UPDATE rumah_sakit SET darah_o = darah_o + '$kantong' WHERE rumah_sakit = '$rumah_sakit'";
            }
            $q3 = mysqli_query($koneksi, $sql3);

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
            width: 80%;
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
                KIRIM DARAH
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
                                <option value="">-- Rumah Sakit Tujuan --</option>
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
