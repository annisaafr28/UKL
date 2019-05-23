<div class="container">
    <script type="text/javascript">
        function Add(){
            document.getElementById('action').value = "insert";
            document.getElementById('id_pelanggan').value = "";
            document.getElementById('nama_pelanggan').value = "";
            document.getElementById('alamat_pelanggan').value = "";
            document.getElementById('kontak').value = "";
            document.getElementById('username').value = "";
            document.getElementById('password').value = "";
        }

        function Edit(index){
            document.getElementById('action').value = "update";

            var table = document.getElementById("table_pelanggan");
            var id_pelanggan = table.rows[index].cells[0].innerHTML;
            var nama_pelanggan = table.rows[index].cells[1].innerHTML;
            var alamat_pelanggan = table.rows[index].cells[2].innerHTML;
            var kontak = table.rows[index].cells[3].innerHTML;
            var username = table.rows[index].cells[4].innerHTML;
            var password = table.rows[index].cells[5].innerHTML;

            document.getElementById('id_pelanggan').value = id_pelanggan;
            document.getElementById('nama_pelanggan').value = nama_pelanggan;
            document.getElementById('alamat_pelanggan').value = alamat_pelanggan;
            document.getElementById('kontak').value = kontak;
            document.getElementById('username').value = username;
            document.getElementById('password').value = password;
        }
    </script>
    <div class="card col-sm-12">
        <div class="card-header">
            <h4>Biodata Pelanggan</h4>
        </div>
        <div class="card-body">
            <?php
            $koneksi = mysqli_connect("localhost", "root", "", "rent_car");
            $sql = "SELECT * FROM pelanggan";
            $result = mysqli_query($koneksi, $sql);
            $count = mysqli_num_rows($result)
            ?>

            <?php if ($count == 0): ?>
                <div class="alert alert-info">
                    Data masih belum ada.
                </div>
            <?php else: ?>
                <table class="table" id="table_pembeli">
                    <thead>
                        <tr>
                            <th>ID Pelanggan</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat Pelanggan</th>
                            <th>Kontak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result as $hasil): ?>
                        <tr>
                            <td><?php echo $hasil["id_pelanggan"]; ?></td>
                            <td><?php echo $hasil["nama_pelanggan"]; ?></td>
                            <td><?php echo $hasil["alamat_pelanggan"]; ?></td>
                            <td><?php echo $hasil["kontak"]; ?></td>
                            <td>
                                <button type="button" class="btn btn-info"
                                data-toggle="modal" data-target="#modal"
                                onclick="Edit(this.parentElement.parentElement.rowIndex);">
                                EDIT
                                </button>
                            <a href="db_pelanggan.php?hapus=pelanggan&id_pelanggan=<?php echo $hasil["id_pelanggan"]; ?>"
                            onclick="return confirm('Apa anda yakin akan menghapus data?')">
                            <button type="button" class="btn btn-danger">
                                HAPUS
                            </button>
                            </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <div class="card-footer">
            <button type="button" class= "btn btn-success"
            data-toggle="modal" data-target="#modal" onclick="Add()">
                TAMBAH
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="db_pelanggan.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4>Data Pelanggan</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" id="action">
                        ID Pelanggan
                    <input type="text" name="id_pelanggan" id="id_pelanggan" class="form-control">
                        Nama Pelanggan
                    <input type="text" name="nama" id="nama" class="form-control">
                        Alamat Pelanggan 
                    <input type="text" name="alamat" id="alamat" class="form-control">   
                        Kontak
                    <input type="text" name="kontak" id="kontak" class="form-control">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

