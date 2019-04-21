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



<!-- sampai disini -->

</div>

  <?php
  require "partition/footer.php";
  ?>

</body>
</html>
