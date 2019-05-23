<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","rent_car");
if (isset($_GET["id_mobil"])) {
  $kode_barang = $_GET["id_mobil"];
  $sql = "SELECT * from mobil where id_mobil='$id_mobil'";
  $result = mysqli_query($koneksi, $sql);
  $hasil = mysqli_fetch_array($result);

  if (!in_array($hasil,$_SESSION["session_transaksi"])) {
    array_push($_SESSION["session_transaksi"], $hasil);
  }
  header("location:template_olshop.php?page=list_barang");
}
if (isset($_GET["checkout"])) {
  $id_transaksi = rand(1,1000).date("dmY");
  $id_pelanggan = $_SESSION["session_pembeli"]["id_pelanggan"];
  $tanggal = date("Y-m-d");
  $sql = "insert into transaksi values('$id_transaksi','$id_pelanggan','$tanggal')";
  if (mysqli_query($koneksi, $sql)) {
    foreach ($_SESSION["session_transaksi"] as $hasil) {
      $id_mobil = $hasil["id_mobil"];
      $jumlah = $_POST['jumlah_barang'.$hasil["id_mobil"]];
      $harga = $hasil["harga"];
      $sql = "insert into detail_transaksi values('$id_mobil','$jumlah','$id_transaksi','$harga')";
      if(!mysqli_query($koneksi, $sql)) echo mysqli_error($koneksi);
    }
    $_SESSION["session_transaksi"] = array();
    header("location:template_olshop.php?page=nota&kode_transaksi=$id_transaksi");
  }
}
 ?>
