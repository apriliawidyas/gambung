<?php
  include '../conn.php';
  // session_start();
  $email = $_SESSION['email'];
  $user_id = $_SESSION['user_id'];

  echo $email;
  echo $user_id;

  if (isset($_POST['btn_submit'])) {
    $nama_depan =  $_POST["nama_depan"];
    $nama_belakang = $_POST["nama_belakang"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $alamat = $_POST["alamat"];
    $no_telp = $_POST["no_telp"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // $id = $_POST["id"];
    // $kategori = $_POST["kategori"];
    // $namabuku = $_POST["nama"];
    // $harga = $_POST["harga"];
    // $stok = $_POST["stok"];
    // $penerbit = $_POST["penerbit"];
    // echo $id;
    $sql = "INSERT INTO user VALUES (1,'$nama_depan','$nama_belakang','$tanggal_lahir','$alamat','$no_telp','$email','$password')";
    if ($conn->query($sql) === TRUE) {
      echo "<script>alert('Tambah User Penjual Berhasil')</script>";
      header('Location: ../admin/lihat_user.php');
    } else {
      echo "<script>alert('Gagal')</script>";
    }
    $conn->close();
  }
 ?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Tambah Buku</title>
  </head>
  <body style="padding: 150px;">
    <div class="container">
    <!-- Form Login -->
    <h1>Tambah User</h1>
    <form action="<?=($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="nama_depan">Nama Depan</label>
        <input type="text" class="form-control" name="nama_depan" placeholder="" >
      </div>
      <div class="form-group">
        <label for="nama_belakang">Nama Belakang</label>
        <input type="text" class="form-control" name="nama_belakang" placeholder="" >
      </div>
      <!-- <div class="form-group">
        <label for="kategori">Kategori</label>
        <select class="form-control" name="kategori">
          <option>Bisnis</option>
          <option>Keilmuan</option>
          <option>Novel</option>
        </select>
      </div> -->
      <div class="form-group">
        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" class="form-control" name="tanggal_lahir" placeholder="">
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" name="alamat" placeholder="" >
      </div>
      <div class="form-group">
        <label for="no_telp">Nomor Telepon</label>
        <input type="number" class="form-control" name="no_telp" placeholder="" >
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" placeholder="" >
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" placeholder="" >
      </div>
      <!-- <div class="form-group">
        <label>Harga</label>
        <input type="number" class="form-control" name="harga" placeholder="Harga Buku">
      </div>
      <div class="form-group">
        <label>Stok</label>
        <input type="number" class="form-control" name="stok" placeholder="Stok">
      </div>
      <div class="form-group">
        <label>Penerbit</label>
        <select class="form-control" name="penerbit">
          <?php
          $sql = "SELECT * FROM tb_penerbit";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<option>".$row["nama"]."</option>";
            }
          }
          $conn->close();
           ?>


        </select>
      </div> -->


      <button type="submit" class="btn btn-success" name="btn_submit">Submit</button>
    </form>

    <!-- <div class="w3-panel w3-card w3-yellow" style="width:300px; margin-top:50px"><a style="text-decoration:none" href="https://s.id/Modul5EA" target="_blank"><p>Modul 5 Application Architecture</p></a></div> -->
    <!-- <div class="w3-panel w3-card w3-red" style="width:300px; margin-top:20px"><a style="text-decoration:none" href="https://drive.google.com/file/d/1OOIqDKxp4HLB9H9NwA-VAbjm4pULY_74/view" target="_blank"><p>Tes Awal Modul 5</p></a></div> -->
    <!-- <div class="w3-panel w3-card w3-blue" style="width:300px; margin-top:20px"><a style="text-decoration:none" href="https://drive.google.com/file/d/1oP5_EYWX6u5cuVZ9HuvkexgShMi8xJdz/view" target="_blank"><p>Login</p></a></div>
    <div class="w3-panel w3-card w3-green" style="width:300px; margin-top:20px"><a style="text-decoration:none" href="https://drive.google.com/file/d/1giw0osra0iKes6O2asM5Z4ZiKnl-KwQc/view" target="_blank"><p>Daftar</p></a></div> -->

    </div>
  </body>
</html>
