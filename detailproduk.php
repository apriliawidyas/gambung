<?php
    require "conn.php";
  require "partition/header.php";

  $sql = "SELECT * FROM produk";
  $result = $conn->query($sql);
$limit = 0;

?>

<body>

  <?php
  require "partition/nav.php";
  ?>

<div class="container-fluid">


<!-- disini product -->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="row">
                    <div class="col-md-5">
                    <div class="span4">
                        <img src="image/gambung.png" alt="Gambar">
                    </div>
                    </div>
                    <div class="col-md-5">
                    <div class="span8">
                        <h5>Deskripsi</h5>
                        <p align="justify">Produk ini adalah produk yang dijual oleh gambung</p>
                        <h5>Harga : 80000</h5>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- sampai disini -->

</div>

  <?php
  require "partition/footer.php";
  ?>

</body>
</html>
