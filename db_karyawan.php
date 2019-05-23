<?php
$koneksi = mysqli_connect("localhost", "root", "", "rent_car");

if (isset($_POST["action"])) {
  // code...
  $id_karyawan = $_POST["id_karyawan"];
  $nama_karyawan = $_POST["nama_karyawan"];
  $alamat_karyawan = $_POST["alamat_karyawan"];
  $kontak = $_POST["kontak"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $action = $_POST["action"];
  if ($action == "insert") {
   $path = pathinfo($_FILES["image"]["name"]);
   $extensi = $path["extension"];
   $filename = $id_karyawan."-".rand(1,1000).".".$extensi;
  
   move_uploaded_file($_FILES["image"]["tmp_name"], "img_admin/$filename");
   $sql = "insert into karyawan values ('$id_karyawan', '$nama_karyawan', '$username', '$password', '$filename')";

} elseif ($action == "update") {
    $sql = "select * from karyawan where id_karyawan='$id_karyawan'";
    $result = mysqli_query($koneksi, $sql);
    $hasil = mysqli_fetch_array($result);

    if(isset($_FILES["image"])) {
      if(file_exists("img_admin/".$hasil["image"])) {
        //jika file tersedia
        unlink("img_admin/".$hasil["image"]);
        //menghapus file
      }
      $path = pathinfo($_FILES["image"]["name"]);
      $extensi = $path["extension"];
      $filename = $id_karyawan."-".rand(1,1000).".".$extensi;

      move_uploaded_file($_FILES["image"]["tmp_name"], "img_admin/$filename");
      $sql = "update karyawan set nama_karyawan=$nama_karyawan',username='$username',password='$password',image='$filename' where id_karyawan='$id_karyawan')";
    } else {
      $sql = "update karyawan set nama_karyawan=$nama_karyawan',username='$username',password='$password' where id_karyawan='$id_karyawan')";
    }

}

    mysqli_query($koneksi, $sql);
    header("location: template.php");
}

if (isset($_GET["hapus"])) {
  // code...
  $id_karyawan = $_GET["id_karyawan"];
  $sql = "select * from karyawan where id_karyawan='$id_karyawan'";
  $result = mysqli_query($koneksi, $sql);
  $hasil = mysqli_fetch_array($koneksi, $sql);
  if (file_exists("img_admin/".$hasil["image"])) {
    unlink("img_admin/".$hasil["image"]);
        //menghapus file
  }
  $sql = "delete from karyawan where id_karyawan='$id_karyawan'";
  mysqli_query($koneksi, $sql);
  header("location:template.php");
  }
?>