<?php session_start(); ?>
<?php if (isset($_SESSION["session_pembeli"])): ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Mobil</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-md bg-primary navbar-dark sticky-top">
      <a href="#" class="text-white">
        <h3>Sewa Mobil Online</h3>
      </a>

      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
      <span class="navbar navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav">
          <li class="nav-item"><a href="template_olshop.php?page=list_barang" class="nav-link">Mobil</a></li>
          <li class="nav-item"><a href="logout_pelanggan.php" class="nav-link">Logout</a></li>
        </ul>
      </div>
      <a href="template_olshop.php?page=list_transaksi">
          <b class="text-white">Penyewaan Mobil: </b>
      </a>
    </nav>
    <div class="container my-2">
      <?php if (isset($_GET["page"])): ?>
        <?php if ((@include $_GET["page"].".php") === true): ?>
          <?php include $GET["page"].".php"; ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </body>
</html>
<?php else: ?>
    <?php echo "Anda belum login:"; ?>
    <br>
    <a href="login_pelanggan.php">
      Login Terlebih Dahulu!
    </a>
<?php endif; ?>
