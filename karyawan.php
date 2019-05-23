<div class="container">
    <script type="text/javascript">
        function Add(){
            document.getElementById('karyawan').value = "insert";
            document.getElementById('id_karyawan').value = "";
            document.getElementById('nama_karyawan').value = "";
            document.getElementById('alamat_karyawan').value = "";
            document.getElementById('kontak').value = "";
        }

        function Edit(index){
            document.getElementById('action').value = "insert";

            var table = document.getElementById("table_karyawan");
            var id_karyawan = table.rows[index].cells[0].innerHTML;
            var nama_karyawan = table.rows[index].cells[1].innerHTML;
            var username = table.rows[index].cells[2].innerHTML;
            var password = table.rows[index].cells[3].innerHTML;

            document.getElementById('id_karyawan').value = id_karyawan;
            document.getElementById('username').value = username;
            document.getElementById('password').value = password;
            document.getElementById('nama_karyawan').value = nama_karyawan;
        }
    </script>
    <div class="card col-sm-12">
        <div class="card-header">
            <h4>Daftar Admin</h4>
        </div>
        <div class="card-body">
            <?php if (isset($_SESSION[""])): ?>
                <div class="alert alert-<?php=($_SESSION["message"]["type"])?>">
                <?php echo $_SESSION["message"]["message"]; ?>
                <?php unset ($_SESSION["message"]); ?>
            </div>
            <?php endif; ?>
            <?php
            $koneksi = mysqli_connect("localhost", "root", "", "rent_car");
            $sql = "SELECT * FROM karyawan";
            $result = mysqli_query($koneksi, $sql);
            $count = mysqli_num_rows($result)
            ?>

            <?php if ($count == 0): ?>
                <div class="alert alert-info">
                    Data masih belum ada.
                </div>
            <?php else: ?>
                <table class="table" id="table_karyawan">
                    <thead>
                        <tr>
                            <th>ID Karyawan</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Nama Karyawan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result as $hasil): ?>
                        <tr>
                            <td><?php echo $hasil["id_karyawan"]; ?></td>
                            <td><?php echo $hasil["nama_karyawan"]; ?></td>
                            <td><?php echo $hasil["username"]; ?></td>
                            <td><?php echo $hasil["password"]; ?></td>
                            <td>
                                <button type="button" class="btn btn-info"
                                data-toggle="modal" data-target="#modal"
                                onclick="Edit(this.parentElement.parentElement.rowIndex);">
                                EDIT
                                </button>
                            <a href="db_karyawan.php?hapus=karyawan&id_karyawan=<?php echo $hasil["id_karyawan"]; ?>"
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
            <form action="db_karyawan.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4>Data Karyawan</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" id="action">
                        ID Karyawan
                    <input type="text" name="id_karyawan" id="id_karyawan" class="form-control">
                        Username
                    <input type="text" name="username" id="username" class="form-control">
                        Password 
                    <input type="text" name="password" id="password" class="form-control">   
                        Nama Karyawan
                    <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>