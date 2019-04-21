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

<!-- carousel -->
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
          <img class="d-block w-100" src="https://www.ayobandung.com/images-bandung/post/articles/2019/01/24/43794/coffee.jpg" alt="First slide" >
          <div class="carousel-caption d-none d-md-block">
            <div class="note">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
              </p>
              <button type="button" name="button" class="btn btn-primary">BELI SEKARANG</button>
            </div>
          </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="https://images.unsplash.com/photo-1523906630133-f6934a1ab2b9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80" alt="Second slide" >
        <div class="carousel-caption d-none d-md-block">
          <div class="note">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
              sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
              ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
              in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            </p>
            <button type="button" name="button" class="btn btn-primary">BELI SEKARANG</button>
          </div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

<!-- product -->

<h1>PRODUK KAMI</h1>
<hr>
<div class="row produk">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
    aliquip ex ea commodo consequat. - <a href="#">LIHAT PRODUK</a></p>

    <?php  while(($row = $result->fetch_assoc()) && ($limit < 3)){
									$name = $row['nama'];
									$image = $row['gambar'];
                  $price = $row['harga'];
                  $limit++;
		 ?>

  <div class="col-lg-4 col-xs-12">
    <div class="gambar" >

      <img src="images/<?php echo $image ?>" alt="produk">
      <div class="overflow">
          <h2>NAMA<br>PRODUK</h2>
      </div>
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
