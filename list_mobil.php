<?php

$koneksi = mysqli_connect("localhost", "root", "", "rent_car");
$sql = "SELECT * FROM mobil";
$result = mysqli_query($koneksi, $sql);
?>

<div class="row">
    <?php foreach ($result as $hasil): ?>
        <div class="card col-sm-4">
            <div class ="card-body">
                <img src="img_barang/<?php echo $hasil["gambar"];?>" class="img" width="100%" height="100%">
            </div>
            <div class="card-footer">
                <h6 class = "text-center"><?php echo $hasil["merk"]; ?></h6>
                <h6 class = "text-center"><?php echo $hasil["biaya_sewa_per_hari"]; ?></h6>
                <a href="db_transaksi.php?transaksi=true&id_mobil=<?php echo $hasil["id_mobil"];?>">
                <button type="button" class="btn btn-info btn-block">
                    PESAN
                </button>
                </a>
            </div>
        </div>
</div>