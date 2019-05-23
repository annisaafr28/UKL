<?php
$koneksi = mysqli_connect("localhost", "root", "", "olshop");

if (isset($_POST["action"])) {
  // code...
  $id_pelanggan = $_POST["id_pelanggan"];
  $nama_pelanggan = $_POST["nama_pelanggan"];
  $alamat_pelanggan = $_POST["alamat_pelanggan"];
  $kontak = $_POST["kontak"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $action = $_POST["action"];

  if ($action == "insert") {
    // code...
    $path = pathinfo($_FILES["gambar"]["name"]);
    $extensi = $path["extension"];
    $filename = $id_pembeli."-".rand(1,1000).".".$extensi;

    move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_pembeli/$filename");
    $sql = "insert into pelanggan values('$id_pelanggan','$nama_pelanggan','$alamat_pelanggan','$kontak','$filename','$username','$password')";
  }else if ($action == "update") {
    // code...
    if (!empty($_FILES["gambar"]["name"])) {
    $sql = "select * from pelanggan where id_pelanggan='$id_pelanggan'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);


      if (file_exists("img_pembeli/".$hasil["image"])) {
        // jika filenya tersedia
        unlink("img_pembeli/".$hasil["image"]);
        //untuk menghapus file
      }
      $path = pathinfo($_FILES["image"]["nama_pelanggan"]);
      $extensi = $path["extension"];
      $filename = $nisn."-".rand(1,1000).".".$extensi;

      $sql = "update pelanggan set username = '$username', password = '$password', nama_pelanggan = '$nama_pelanggan', image='$filename', kontak = '$kontak', alamat_pelanggan ='$alamat_pelanggan' where id_pelanggan = '$id_pelanggan'";
      if (mysqli_query($koneksi,$sql)){
        move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_pembeli/$filename");
        $_SESSION["message"] = array(
          "type" => "success",
          "message" => "Update data has been SUCCESS"
        );
      }else {
        $_SESSION["message"] = array(
          "type" => "danger",
          "message" => mysqli_error($koneksi)
        );
      }

  }else {
    $sql = "update pelanggan set username = '$username', password = '$password', nama_pelanggan = '$nama_pelanggan', kontak = '$kontak', alamat_pelanggan ='$alamat_pelanggan' where id_pelanggan = '$id_pelanggan'";
  }

}

mysqli_query($koneksi,$sql);
header("location:template.php?page=pembeli");
}

if (isset($_GET["hapus"])) {
  // code...
  $id_pembeli = $_GET["id_pelanggan"];
  $sql = "select * from pelanggan where id_pelanggan='$id_pelanggan'";
  $result = mysqli_query($koneksi,$sql);
  $hasil = mysqli_fetch_array($result);
  if (file_exists("img_pembeli/".$hasil["gambar"])) {
    unlink("img_pembeli/".$hasil["gambar"]);
  }
  $sql = "delete from pembeli where id_pelanggan='$id_pelanggan'";
  mysqli_query($koneksi,$sql);
  header("location:template.php?page=pembeli");
}
 ?>
