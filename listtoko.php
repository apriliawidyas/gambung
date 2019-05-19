<?php
require "conn.php";
require "partition/header.php";

if(isset($_GET['kategori'])){
  $kategori = $_GET['kategori'];
  $sql = "SELECT * FROM produk WHERE kategori='$kategori'";
  $result = $conn->query($sql);
  if (mysqli_num_rows($result) == 0) {
      echo "<script>
         window.location.href = '404.php';
         </script>";
    // header("Location:404.php");
  }
}else if(isset($_GET['search'])) {
  $cari = $_GET['search'];
  $sql = "SELECT * FROM produk WHERE nama like '%$cari%' or keterangan like '%$cari%' or kategori like '%$cari%' ";
  $result = $conn->query($sql);
  if (mysqli_num_rows($result) == 0) {
      echo "<script>
         window.location.href = '404.php';
         </script>";
    // header("Location:404.php");
  }
} else {
  $sql = "SELECT * FROM toko";
  $result = $conn->query($sql);
  $limit = 0;
}
?>

<body>

  <?php
  require "partition/nav.php";
  ?>


  <div class="container-fluid">


    <!-- product -->

    <h1>LIST TOKO</h1>
    <hr>
    <div class="row produk">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
        aliquip ex ea commodo consequat.

        <?php  while($row = $result->fetch_assoc()){
         $name = $row['nama_toko'];
         $image = $row['gambar'];
         $id = $row['id_toko'];

         ?>

         <div class="col-lg-4 col-xs-12">
          <div class="gambarlist" >

            <img src="images/<?php echo $image ?>" alt="produk">
            <a href="detailtoko.php?id=<?php echo $id ?>">
              <div class="overflow list">
                <br>
                <br>
                <h2><?php echo $name ?></h2>
              </div>
            </a>
          </div>
        </div>

      <?php } ?>

    </div>



  </div>

  <?php
  require "partition/footer.php";
  ?>

</body>
</html>
