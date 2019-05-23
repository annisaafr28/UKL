<?php
 session_start();
 $koneksi = mysqli_connect("localhost","root","","rent_car");
 if (isset($_POST["action"])) {
    $id_mobil = $_POST["id_mobil"];
    $nomor_mobil = $_POST["nomor_mobil"];
    $merk = $_POST["merk"];
    $jenis = $_POST["jenis"];
    $warna = $_POST["warna"];
    $tahun_pembuatan = $_POST["tahun_pembuatan"];
    $biaya_sewa_per_hari = $_POST["biaya_sewa_per_hari"];
    $action = $_POST["action"];
   if ($_POST["action"] == "insert") {
     $path = pathinfo($_FILES["gambar"]["name"]);
     $extensi = $path["extension"];
     $filename = $id_mobil."-".rand(1,10000).".".$extensi;

     $sql = "INSERT INTO mobil values('$id_mobil','$nomor_mobil','$merk','$filename','$jenis','$warna', '$tahun_pembuatan', '$biaya_sewa_per_hari')";

     if (mysqli_query($koneksi,$sql)) {
       // jika eksekusi berhasil
       move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_barang/$filename");
       $_SESSION["message"] = array(
         "type" => "success",
         "message" => "Insert Data has been SUCCESS"
       );
     }else {
       // jika eksekusi gagal
       $_SESSION["message"] = array(
         "type" => "danger",
         "message" => mysqli_error($koneksi)
       );
     }
     header("location:template.php?page=mobil");
   }elseif ($_POST["action"]== "update") {
     // code...
     if (!empty($_FILES["gambar"]["name"])) {
       // jika gambar diedit
      $sql = "SELECT * FROM mobil where id_mobil='$id_mobil'";
      $result = mysqli_query($koneksi, $sql);
      $hasil = mysqli_fetch_array($result);
      // hapus file yang sudah ada
      if (file_exists("img_barang/".$hasil["gambar"])) {
          unlink("img_barang/".$hasil["gambar"]);
        }

        //membuat file baru
        $path = pathinfo($_FILES["gambar"]["name"]);
        $ekstensi = $path["extension"];
        $filename = $id_mobil."-".rand(1, 1000).".".$ekstensi;

        //membuat perintah update
        $sql = "UPDATE mobil set nomor_mobil='$nomor_mobil', merk='$merk', jenis='$jenis', warna='$warna', gambar='$filename' where id_mobil='$id_mobil'";

        if (mysqli_query($koneksi,$sql)) {
          // jika query sukses
          move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_barang/$filename");
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
   }else{
     $sql = "UPDATE mobil set nomor_mobil='$nomor_mobil', merk='$merk',jenis='$jenis', warna='$warna' where id_mobil='$id_mobil'";

     if (mysqli_query($koneksi,$sql)) {
       // jika query sukses

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
   }
   header("location:template.php?page=mobil");
 }
}

if (isset($_GET["hapus"])) {
  // jika yang dikirim adalah variabel GET hapus
  $id_mobil = $_GET["id_mobil"];
  // ambil data dari database
  $sql = "SELECT * FROM mobil where id_mobil = '$id_mobil'";
  // eksekusi query nya
  $result = mysqli_query($koneksi,$sql);
  // konversi ke array
  $hasil = mysqli_fetch_array($result);
  if (file_exists("img_barang/".hasil["image"])) {
    unlink("img_barang/".$hasil["image"]);
    // menghapus file
  }
  $sql = "DELETE FROM mobil where id_mobil='$id_mobil'";
  if (mysqli_query($koneksi,$sql)) {
    // jika query sukses

    $_SESSION["message"] = array(
      "type" => "success",
      "message" => "Delete data has been SUCCESS"
    );
  }else {
    $_SESSION["message"] = array(
      "type" => "danger",
      "message" => mysqli_error($koneksi)
    );
  }
   header("location:template.php?page=mobil");
}
 ?>
