<?php
include 'conn.php';
if(isset($_SESSION['status'])){
  $check = $_SESSION['status'];
}else{
  $check = null;
}

?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><img src="image/gambung.png" alt="brand" height="80px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="nav navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="list_produk.php">PRODUK</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="listtoko.php">TOKO</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">CONTACT US</a>
      </li>
      <li class="nav-item">

        <?php if ($check != null): ?>
          <li class="nav-item">
            <a class="nav-link" href="transfer.php">TRANSAKSI</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php"><img src="image/shopping.svg" alt=""></a>
          </li>

          <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:white;font-size: 15px; line-height: normal; font-weight: bold;">
            <img src="image/notif.svg" height="20px" style="margin: 12px 5px;">
            <span class="label label-pill label-danger bg-danger count" style=" border-radius: 50px;"></span>
            
          </a>
          <ul class="dropdown-menu notif">
          </ul>
        </li>

        <div class="dropdown">
         <a class="nav-link dropdown-toggle" href="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="image/account.svg" alt="">
         </a>
         <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li class="nav-item">
            <a class="nav-link" href="editprofile.php">PROFILE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">LOGOUT</a>
          </li>
        </div>
      </div>



    </li>

    <?php else: ?>
      <a href="login.php"><button type="button" name="button" class="btn btn-primary">Masuk / Daftar</button></a>
    <?php endif; ?>

  </li>

</ul>
</div>
</nav>

<nav class="navbar navbar-expand-md navbar-dark bg-brown">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link" href="list_produk.php?kategori=kopi">KOPI</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="list_produk.php?kategori=teh">TEH</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="list_produk.php?kategori=kerajinan">KERAJINAN</a>
    </li>

  </ul>
  <form class="form-inline my-2 my-lg-0" method="get" action="list_produk.php">
    <input class="form-control mr-sm-2 search" type="search" placeholder="Cari" aria-label="Search" name="search">
  </form>
</nav>


