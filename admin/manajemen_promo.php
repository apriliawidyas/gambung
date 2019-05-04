<?php
include '../conn.php';

// mengaktifkan session
// session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
if($_SESSION['status'] !="login"){
	header("location:../index.php");
}

if (isset($_POST['inputvoucher'])) {
  $voucher = strtoupper($_POST['voucher']);
  $diskon = $_POST['diskon']/100;
  $sql = "INSERT INTO voucher VALUES ('', '$voucher', '$diskon')";
  $result = mysqli_query($conn, $sql);
  if($result){
    echo"<script type='text/javascript'>
    alert('Berhasil menambahkan voucher');
    window.location.href='manajemen_promo.php';
    </script>";
  }else{
    echo"<script type='text/javascript'>
    alert('Gagal menambahkan voucher');
    window.location.href='manajemen_promo.php';
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
      <h2 style="font-weight: bold; color:#562b00">Input Promo</h2>
      <hr>
      <div class="forminside">
        <div class="form-group">
          <label for="vouhcer">Kode Vouhcer ( Maksimal 10 Karakter )</label>
          <input name="voucher" type="text" class="form-control" id="nama_depan" placeholder="YH23SI92H4">
        </div>
        <div class="form-group">
          <label for="diskon">Nominal Diskon ( Dalam persen )</label>
          <input name="diskon" type="text" class="form-control" id="nama_depan" placeholder="50">
        </div>
      </div>
      <br>
      <button name="inputvoucher" type="submit" class="btn daftar btn-dark" style="background-color: #562b00;">Input</button>
    </div>
  </form>
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
