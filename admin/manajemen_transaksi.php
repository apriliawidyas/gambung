<?php
include '../conn.php';
$sql = "SELECT CONCAT(user.nama_depan, user.nama_belakang) as nama, tf.total, tf.date_upload, tf.id_transfer, tf.status_verifikasi
FROM transfer tf JOIN user user ON tf.id_user = user.id WHERE user.role_id > 0 && tf.status_upload = 1 ORDER BY tf.status_verifikasi ASC";
$result = $conn->query($sql);

if(isset($_POST['verifikasi'])){
  $id = $_POST['verifikasi'];
  $sql = "UPDATE transfer SET status_verifikasi = 1 WHERE id_transfer = '$id'";
  $result = $conn->query($sql);
  if ($result){
    echo "<script type='text/javascript'>
    alert('Berhasil verifikasi');
    window.location.href='manajemen_transaksi.php';
    </script>";
  }else{
    echo "<script type='text/javascript'>
    alert('Gagal verifikasi');
    window.location.href='manajemen_transaksi.php';
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

<body >
  <div class="container" style="padding: 60px;">
   <h2 style="font-weight: bold; color:#562b00">Verifikasi Pembayaran</h2>
   <br>
   <table class="table table-hover">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Pengirim</th>
        <th>Total</th>
        <th>Date Upload</th>
        <th>Gambar Transaksi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
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
          <td name=''>" . $row['nama'] . "</td>
          <td name=''>" . $row["total"] . "</td>
          <td name=''>" . $row["date_upload"] . "</td>
          <td name=''> <img src='../images/".$row['id_transfer'].".png' alt='' width='150px'><img src='../images/".$row['id_transfer'].".jpg' alt='' width='150px'><img src='../images/".$row['id_transfer'].".jpeg' alt='' width='150px'></td> 
          <td>";
          if ($row['status_verifikasi']==0) {
            echo "<button type='submit' class='btn btn-warning ' name='verifikasi' value='" . $row["id_transfer"] . "'>Verifikasi</button>";
          } else {
            echo "<button type='button' class='btn btn-secondary' disabled>Verifikasi</button>";
          }
          echo "</td>
          </tr>
          </form>
          ";

        }
      } else {

        echo "<h1>Data Belum Ada</h1><br>";
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


</div>
</body>
</html>
