<?php
    session_start();
    $koneksi = new mysqli("localhost", "root", "", "rent_car");

    $user = $_POST['txt_user'];
    $pass = $_POST['txt_pass'];

    $sql = "SELECT * FROM karyawan
            WHERE username = '$user' and
            password = '$pass'";

    $result = mysqli_query($koneksi, $sql);
    $count = mysqli_num_rows($result);
    if($count > 0) {
        $_SESSION["session_template"] = mysqli_fetch_array($result);
        header("Location: template.php");
    } else {
        echo "Login failed <br/>";
        echo "<a href='login.php'> Go Back </a>";
    }
?>