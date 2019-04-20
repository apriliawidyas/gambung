<?php
include '../conn.php';

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
if($_SESSION['status'] !="login"){
	header("location:../index.php");
}

?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title> Menu Admin </title>
  </head>
  <body>
    <div class="container" style="padding:50px;">
      <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container" style="margin-left:240px;">
          <center><a class="navbar-brand" href="menu_admin.php">Menu Admin</a></center>
        </div>
      </nav> -->
      <center> <h1>Manajemen Produk</h1> </center>
      <br>
      <br>
      <a href="lihat_produk.php"> <button type="button" class="btn btn-primary btn-md btn-block">Lihat Produk</button> </a>
      <br>
      <a href="tambah_produk.php"> <button type="button" class="btn btn-primary btn-md btn-block">Tambah Produk</button> </a>
      <br>
      <!-- <a href="lihat_buku.php">  <button type="button" class="btn btn-primary btn-md btn-block">Lihat Buku</button> </a>
      <br>
      <a href="tambah_penerbit.php"> <button type="button" class="btn btn-secondary btn-md btn-block">Tambah Penerbit</button></a>
      <br>
      <a href="lihat_penerbit.php"> <button type="button" class="btn btn-secondary btn-md btn-block">Lihat Penerbit</button></a>
      <br>
      <a href="tambah_franchise.php"> <button type="button" class="btn btn-success btn-md btn-block">Tambah Franchise</button></a>
      <br>
      <a href="lihat_franchise.php"> <button type="button" class="btn btn-success btn-md btn-block">Lihat Franchise</button></a>
      <br>
      <a href="lihat_transaksi.php"> <button type="button" class="btn btn-info btn-md btn-block">Lihat Transaksi</button></a>
      <br> -->
      <a href="../logout.php"> <button type="button" class="btn btn-danger btn-md btn-block">Log Out</button></a>
      <br>
      <!-- <form action="" method="get">
        <button type="submit" class="btn btn-danger btn-md btn-block" name="btn_destroy">Log Out</button>
      </form> -->

    </div>
  </body>
</html>
