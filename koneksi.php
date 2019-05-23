<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "rent_car";

// untuk connect ke database
$koneksi = mysqli_connect($host, $user, $password, $db);

// untuk mengecek koneksi berhasil
// if($koneksi)
// {
//     echo "Koneksi berhasil";
// }
// else
// {
//     echo "Koneksi gagal: " . mysqli_connect_error();
// }

?>