<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<style>
body {
  margin: 0;
  font-family: initial;
  background-color: #f2f2f2 ;
}

.topnav {
  overflow: hidden;
  background-color: deeppink;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 25px;
}

.topnav a:hover {
  background-color: lightpink;
  color: deeppink;
}

.topnav a.split {
  float: right;
  background-color: lightpink;
  color: ghostwhite;
  font-size: 27px;
}
</style>
</head>
<body>
<?php
    $status = isset($_SESSION['status']) ? $_SESSION['status'] : '';
?>
<div class="topnav">
  <a class="active" href="?id=home">Home</a>
  <?php
    if ($status == 'Kasir') {
    ?>
        <a href="?id=barang.php">Produk</a>
        <a href="?id=penjualan.php">Data Penjualan</a>
    <?php } ?>
  <a href="?id=login.php" class="split">Login</a>
</div>

<div style="padding-inline: 16px;">
  <?php 
  if (isset($_GET['id']) && $_GET['id'] != 'home') {
      // Validasi file yang di-include
      $valid_pages = ['barang.php', 'penjualan.php', 'login.php'];
      $page = $_GET['id'];

      if (in_array($page, $valid_pages) && file_exists($page)) {
          include($page);
      } else {
          echo "<p>Halaman tidak ditemukan!</p>";
      }
  } else { 
      echo "<p><br></p>";
      echo "<p><br></p>";
      echo "<p><br></p>";
      echo "<b><p><div style='font-size: 100px; text-align: center;  background-color: lightpink; color: deeppink;'>Welcome to Nova Project! &#x1F407;</div></p></b>";
  } 
  ?>
</div>
</body>
</html>
