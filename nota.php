<div class="card col-sm-12">
    <div class="card-header">
        <h3>Nota Transaksi</h3>
    </div>
    <div class="card-body">
        <?php
        $koneksi = mysqli_connect("localhost", "root", "", "rent_car");
        $id_transaksi = $_GET["id_transaksi"];
        //data transaksi
        $sql = "SELECT t.id_transaksi, p.nama, t.tgl 
        from transaksi t INNER JOIN pembeli p
        on t.id_pembeli = p.id_pembeli 
        WHERE t.id_transaksi = '$id_transaksi'";

        $result = mysqli_query($koneksi, $sql);
        $hasil = mysqli_fetch_array($result);

        //data barang
        $sql2 = "SELECT b.*, dt.jumlah, dt.harga_beli
        FROM b mobil b INNER JOIN detail transaksi dt
        ON b.kode_barang = dt.kode_barang
        WHERE dt.id_transaksi = '$id_transaksi'";
        
        $result2 = mysqli_query($koneksi, $sql2);
        ?>

        <h4>ID Transaksi : <?php echo $hasil["id_transaksi"]; ?></h4>
        <h4>Nama Pemesan : <?php echo $hasil["nama_pelanggan"]; ?></h4>
        <h4>Tanggal : <?php echo $hasil["tgl"]; ?></h4>

        <table class="table">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama</th>
                    <th>Jumlah Item</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; foreach ($result2 as $mobil): ?>
                    <tr>
                    <td><?php echo $mobil["kode_barang"]; ?></td>
             <td><?php echo $mobil["nama"] ?></td>
             <td><?php echo $mobil["jumlah"] ?></td>
             <td><?php echo "Rp".number_format($mobil["harga"]); ?></td>
             <td><?php echo "Rp".number_format($mobil["harga"]*$mobil["jumlah"]); ?></td>
                    </tr>
                <?php
            $total += $mobil["harga"]*$mobil["jumlah"];
                endforeach; ?>
            </tbody>
        </table>
        <h2 class="text-right text-success">
            <?php echo "Rp".number_format($total); ?>
        </h2>
    </div>
</div>