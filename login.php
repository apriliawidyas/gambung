<?php
require "partition/header.php";
include 'conn.php';

if (isset($_POST['btnSubmit'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];

  if (strpos($email, '@') !== false) {
      $sql = "select * from user where email='$email' and password='$password'";
      $result = $conn->query($sql);
    }else {
        $sql = "select * from user where no_telp='$email' and password='$password'";
      $result = $conn->query($sql);
    }

  if($result->num_rows > 0){
    // echo "Benar";
  	session_start();
    while($row = $result->fetch_assoc()){
      $role_id = $row['role_id'];
      $id = $row['id'];
      $nama_depan = $row['nama_depan'];
    }
    $_SESSION['nama_depan'] = $nama_depan;
  	$_SESSION['email'] = $email;
    $_SESSION['user_id'] = $id;
    $_SESSION['status'] = "login";
    $_SESSION['role'] = $role_id;
    if ($role_id == 1) {
            echo "<script>
         window.location.href = 'admin/index.php';
         </script>";
    //   header("location:admin/index.php");
    }elseif ($role_id == 2) {
            echo "<script>
         window.location.href = 'penjual/index.php';
         </script>";
    //   header("location:penjual/index.php");
    }elseif ($role_id == 3) {
            echo "<script>
         window.location.href = 'index.php';
         </script>";
    //   header("location:index.php");

    }

  }else{
    echo "<script type='text/javascript'>
          alert('User/Password Salah');
          </script>";
  }


}

if (isset($_POST['btnDaftar'])) {
    echo "<script>
         window.location.href = 'daftar.php';
         </script>";

}
?>

<body class="bg-light">
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="login">
      <h2>Masuk</h2>
      <hr>
      <img src="image/gambung.png" alt="logo" height="150px" width="80%">
      <div class="forminside">
        <div class="form-group">
          <input name="email" type="text" class="form-control" id="email" placeholder="Email / Nomor Telephone">
        </div>
        <div class="form-group">
          <input name="password" type="password" class="form-control" id="password" placeholder="Password">
        </div>
<!--        <p>Lupa Password ? <a href="#">Klik disini</a></p>-->

        

        <button name="btnSubmit" type="submit" class="btn btn-primary">Login</button>
          </form>
          <button name="btnDaftar" class="btn btn-light">Daftar</button>
      </div>
    </div>

</body>

<!-- <?php
require "partition/footer.php";
 ?> -->

</html>
