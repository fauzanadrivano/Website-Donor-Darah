<?php 
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "donor";

$koneksi    = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}

$sql2   = "select * from admin";
$q2     = mysqli_query($koneksi, $sql2);
while ($r2 = mysqli_fetch_array($q2)) {
    $mail    = $r2['email'];
    $pass    = $r2['password'];
}

$email = $_POST['email'];
$password = $_POST['password'];

if ($mail != $email && $pass != $password){
    echo "Email / Password incorrect";
} else {
    $query = mysqli_query($koneksi, "select * from admin where email='$email' and password='$password'");
    $cek = mysqli_num_rows($query);
    echo $cek;
    header("Location: ../tabel/pendonor.php");
}
?>