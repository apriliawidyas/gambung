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
      <a class="nav-link" href="#">TENTANG KAMI</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="list_produk.php">PRODUK</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">CONTACT US</a>
    </li>
    <li class="nav-item">

      <?php if ($check != null): ?>
        <a class="nav-link" href="#"><img src="image/account.svg" alt="">
        </a>
        </li>
        <li>
        <a class="nav-link" href="logout.php">LOGOUT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><img src="image/shopping.svg" alt="">
          </i></a>
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
        <a class="nav-link" href="#">MENU 1</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">MENU 2</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">MENU 3</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">MENU 4</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2 search" type="search" placeholder="Cari" aria-label="Search">
    </form>
</nav>
