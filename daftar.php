<?php
require "partition/header.php";
include 'conn.php';
// === ID ====
// 1 Admin
// 2 Penjual
// 3 Pembeli
// ===========
if (isset($_POST['btnDaftar'])) {
  $nama_depan = $_POST['nama_depan'];
  $nama_belakang = $_POST['nama_belakang'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $alamat = $_POST['alamat'];
  $no_telepon = $_POST['no_telepon'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  if ($role == 'Pembeli') {
    $role = '3';
  } elseif ($role == 'Penjual') {
    $role = '2';
  }

  $sql = "INSERT INTO user VALUES ('', '$role', '$nama_depan','$nama_belakang','$tanggal_lahir','$alamat','$no_telepon','$email','$password')";
  // echo $sql;

    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
        echo "<script type='text/javascript'>
        			alert('Berhasil Tambah User');
              </script>";
       header('Location: login.php');
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
        echo "<script type='text/javascript'>
        			alert('Gagal');
              </script>";

    }

    $conn->close();
}
?>



<body class="bg-light">
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="login">
      <h2>Daftar</h2>
      <hr>
      <img src="image/gambung.png" alt="logo" height="200px">
      <div class="forminside">
        <div class="form-group">
          <input name="nama_depan" type="text" class="form-control" id="nama_depan" placeholder="Nama Depan">
        </div>
        <div class="form-group">
          <input name="nama_belakang" type="text" class="form-control" id="nama_depan" placeholder="Nama Belakang">
        </div>
        <div class="form-group">
          <input name="tanggal_lahir" type="date" class="form-control"  placeholder="Tanggal Lahir">
        </div>
        <div class="form-group">
          <textarea name="alamat" rows="5" cols="80" class="form-control" placeholder="Alamat"></textarea>
        </div>
        <div class="form-group">
          <input name="no_telepon" type="text" class="form-control" id="nama_depan" placeholder="Nomor Telephone">
        </div>
        <div class="form-group">
          <input name="email" type="text" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="form-group">
          <input name="password" type="password" class="form-control" id="password" placeholder="Password">
        </div>
        <div class="form-group">
          <select name="role" class="form-control">
            <option>Pembeli</option>
            <option>Penjual</option>
          </select>
        </div>
        <button name="btnDaftar" type="submit" class="btn btn-primary daftar" value="btnDaftar">Daftar</button>
        </form>
      </div>
    </div>

</body>

<!-- <?php
require "partition/footer.php";
 ?> -->

</html>
