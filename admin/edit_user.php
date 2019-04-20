<?php
include '../conn.php';
if (isset($_POST['hapus_user'])) {
  // echo "Mau Hapus";
  $email_user = $_POST['hapus_user'];
  // sql to delete a record
  $sql = "DELETE FROM user WHERE email='$email_user'";
  if ($conn->query($sql) === TRUE) {
      echo "<script>alert('Berhasil Hapus')</script>";
      // echo "Berhasil Hapus";
      header('Location: lihat_user.php');
      exit;
  } else {
    // echo "<script> alert('Berhasil Hapus'); </script>";
    echo "<script> alert('Error deleting record: ".$conn->error."'); </script>";
     // echo "Error deleting record: " . $conn->error;
  }
  $conn->close();
}
// Ambil Data Buku Existing
if (isset($_POST['edit_user'])) {
  $email_user =$_POST['edit_user'];
  $sql = "SELECT * FROM user WHERE email='$email_user'";
  $result = $conn->query($sql);
  $row = mysqli_fetch_assoc($result);
  $nama_depan =  $row["nama_depan"];
  $nama_belakang = $row["nama_belakang"];
  $tanggal_lahir = $row["tanggal_lahir"];
  $alamat = $row["alamat"];
  $no_telp = $row["no_telp"];
  $email = $row["email"];
  $password = $row["password"];
  mysqli_close($conn);
}

if (isset($_POST['reset_password'])) {
  $email_user =$_POST['reset_password'];
  $password = 'tehataukopi';
  $sql = "UPDATE user SET password = '$password' WHERE email='$email_user'";
  // echo $sql;

  if ($conn->query($sql) === TRUE) {
      echo "<script> alert('Update Berhasil') </script>";
      header('Location: lihat_user.php');
  } else {
      echo "Error updating record: " . $conn->error;
  }
  $conn->close();

}
// Update User
if (isset($_POST['btn_submit'])) {
  $nama_depan =  $_POST["nama_depan"];
  $nama_belakang = $_POST["nama_belakang"];
  $tanggal_lahir = $_POST["tanggal_lahir"];
  $alamat = $_POST["alamat"];
  $no_telp = $_POST["no_telp"];
  $email = $_POST["email_user"];
  // $password = $_POST["password"];

  $sql = "UPDATE user SET nama_depan='$nama_depan',nama_belakang='$nama_belakang',tanggal_lahir='$tanggal_lahir'
  ,alamat='$alamat',no_telp='$no_telp' WHERE email='$email'";
  // echo $sql;

  if ($conn->query($sql) === TRUE) {
      echo "<script> alert('Update Berhasil') </script>";
      header('Location: lihat_user.php');
  } else {
      echo "Error updating record: " . $conn->error;
  }
  $conn->close();
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Edit User</title>
</head>
<body style="padding: 150px;">
  <div class="container">
  <!-- Form Login -->
  <h1>Edit User</h1>
  <form action="<?=($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
    <input type="hidden" class="form-control" name="email_user" placeholder="" value="<?php echo $email ?>">
    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" class="form-control" name="email" placeholder="" value="<?php echo $email ?>" disabled>
    </div>
    <div class="form-group">
      <label for="nama_depan">Nama Depan</label>
      <input type="text" class="form-control" name="nama_depan" placeholder="" value="<?php echo $nama_depan; ?>" >
    </div>
    <div class="form-group">
      <label for="nama_belakang">Nama Belakang</label>
      <input type="text" class="form-control" name="nama_belakang" placeholder="" value="<?php echo "$nama_belakang"; ?>" >
    </div>
    <div class="form-group">
      <label for="tanggal_lahir">Tanggal Lahir</label>
      <input type="date" class="form-control" name="tanggal_lahir" placeholder="" value="<?php echo "$tanggal_lahir"; ?>">
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <input type="text" class="form-control" name="alamat" placeholder="" value="<?php echo "$alamat"; ?>" >
    </div>
    <div class="form-group">
      <label for="no_telp">Nomor Telepon</label>
      <input type="number" class="form-control" name="no_telp" placeholder="" value="<?php echo $no_telp ?>" >
    </div>

    <!-- <div class="form-group">
      <label for="password">Password</label>
      <input type="text" class="form-control" name="password" placeholder="" value="<?php echo $password ?>" >
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
