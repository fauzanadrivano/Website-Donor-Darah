<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "donor";

$koneksi    = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}

$sukses         = "";
$error          = "";


$username       = $_POST['username'];
$email          = $_POST['email'];
$password       = $_POST['password'];

$sql1 = "INSERT INTO admin (username, email, password) VALUES ('$username', '$email', '$password')";
$q1 = mysqli_query($koneksi, $sql1);
echo $q1;

header("Location: ../tabel/pendonor.php");
?>