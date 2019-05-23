<div class="card">
        <div class="card-header">
            List Peminjaman
        </div>
        <div class="card-body">
            <form action="db_transaksi.php?checkout=true" method="post"
            onsubmit="return confirm('Apakah Anda Yakin Dengan Pesanan Ini?')">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Mobil</th>
                        <th>Nomor Mobil</th>
                        <th>Merk</th>
                        <th>Jenis</th>
                        <th>Warna</th>
                        <th>Tahun Pembuatan</th>
                        <th>Biaya Sewa Per Hari</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION["session_transaksi"] as $hasil): ?>
                        <tr>
                            <td><?php echo $hasil["id_mobil"]; ?></td>
                            <td><?php echo $hasil["merk"]; ?></td>
                            <td>
                                <img width="200" src="img_barang/<?php echo $hasil["gambar"]; ?>" alt="">
                            </td>
                            <td>
                                <input type="number" name="jumlah_barang<?php echo $hasil["id_album"];?>" min="1">
                            </td>
                            <td><?php echo $hasil["harga_sewa_per_hari"]; ?></td>
                            <td>
                                <a href="db_transaksi.php?hapus=true&id_mobil=<?php echo $hasil["id_mobil"];?>"></a>
                                <button type="button" class="btn btn-danger">
                                HAPUS
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-block btn-primary">CHECKOUT</button>
            </form>
        </div>
</div>