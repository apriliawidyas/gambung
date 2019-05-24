<?php
include '../conn.php';

// mengaktifkan session
// session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
if($_SESSION['status'] !="login"){
  echo "<script>
  window.location.href = '../index.php';
  </script>";
// 	header("location:../index.php");
}


if (isset($_POST['inputkategori'])) {
  $kategori = strtolower($_POST['kategori']);
  $sql = "INSERT INTO kategori VALUES ('', '$kategori')";
  $result = mysqli_query($conn, $sql);
  if($result){
    echo"<script type='text/javascript'>
    alert('Berhasil menambahkan kategori');
    window.location.href='manajemen_kategori.php';
    </script>";
  }else{
    echo"<script type='text/javascript'>
    alert('Gagal menambahkan kategori');
    window.location.href='manajemen_kategori.php';
    </script>";
  }
}

?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="icon" href="../image/gambung.png">


  <!-- font -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

  <!-- css style -->
  <link rel="stylesheet" href="css/style.css">

  <title>Admin Gambung</title>

</head>

<?php 

include 'sidebar.php';

?>

<body class="bg-light">
  <form method="POST" action="" enctype="multipart/form-data" style="padding: 60px;">
    <div class="login">
      <h2 style="font-weight: bold; color:#562b00">Input Kategori</h2>
      <hr>
      <div class="forminside">
        <div class="form-group">
          <label for="kategori">Nama Kategori</label>
          <input name="kategori" type="text" class="form-control" placeholder="Kerajinan">
        </div>
      </div>
      <br>
      <button name="inputkategori" type="submit" class="btn daftar btn-dark" style="background-color: #562b00;">Input</button>
    </div>
  </form>


  <div class="container" style="padding-top: -80px;">
    <br>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Kategori</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $sql = "SELECT * FROM kategori";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
              // output data of each row
          $a = 0;
          while($row = $result->fetch_assoc()) {
            $a++;
            echo
            "
            <form action='' method='post'>
            <tr>
            <td name='id'>" . $a . "</td>
            <td name=''>" . ucfirst($row['nama_kategori']) . "</td>        
            </tr>
            </form>
            ";

          }
        } else {

          echo "<h1>Kategori Belum Ada</h1><br>";
        }
        $conn->close();
        ?>
      </tbody>
    </table>
  </div>


  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src=vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>
</html>
