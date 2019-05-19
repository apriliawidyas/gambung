<?php
include '../conn.php';
  // session_start();
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];

if (isset($_POST['hapus_user'])) {

  $email_user = $_POST['hapus_user'];
  // sql to delete a record
  $sql = "DELETE FROM user WHERE email='$email_user'";
  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Berhasil Hapus')</script>";
  } else {

    echo "<script> alert('Error deleting record: ".$conn->error."'); </script>";
     // echo "Error deleting record: " . $conn->error;
  }
  $conn->close();
}


if (isset($_POST['btn_submit'])) {
  $nama_depan =  $_POST["nama_depan"];
  $nama_belakang = $_POST["nama_belakang"];
  $tanggal_lahir = $_POST["tanggal_lahir"];
  $alamat = $_POST["alamat"];
  $no_telp = $_POST["no_telp"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $kota = $_POST['kota'];

  $sql = "INSERT INTO user VALUES ('',1,'$nama_depan','$nama_belakang','$tanggal_lahir','$kota','$alamat','$no_telp','$email','$password')";
  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Tambah User Admin Berhasil')</script>";
  } else {
    echo "<script>alert('Gagal')</script>";
  }
  $conn->close();
}

function curl($url, $type = "GET", $request = null) // TODO:: change this implementation later, not efficient.

{
  $key = "d631df6429af64d03766ca8ec46be886";
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $type,
    CURLOPT_POSTFIELDS => $request,
    CURLOPT_HTTPHEADER => array(
      "content-type: application/x-www-form-urlencoded",
      "Key: $key",
    ),
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  $data = json_decode($response, true);

  if ($err) {
    die("Failed to get response");
  }

  return $data['rajaongkir']['results'];
}

function getDataKota()
{
  $data = curl("http://api.rajaongkir.com/starter/city");

  return $data;
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

<body>
  <div class="container"  style="padding: 60px;">
    <!-- Form Login -->
    <h2 style="font-weight: bold; color:#562b00">Tambah User Admin</h2>
    <form action="<?=($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="nama_depan">Nama Depan</label>
        <input type="text" class="form-control" name="nama_depan" placeholder="" >
      </div>
      <div class="form-group">
        <label for="nama_belakang">Nama Belakang</label>
        <input type="text" class="form-control" name="nama_belakang" placeholder="" >
      </div>
      <div class="form-group">
        <label for="tanggal_  lahir">Tanggal Lahir</label>
        <input type="date" class="form-control" name="tanggal_lahir" placeholder="">
      </div>
      <div class="form-group">
         <label for="tanggal_lahir">Kota</label>
        <select name="kota" class="form-control">
          <option value="">Pilih Kota</option>
          <?php foreach (getDataKota() as $result): ?>
            <option value="<?php echo $result['city_name'] ?>"><?php echo $result['city_name'] ?></option>
          <?php endforeach;?>
        </select>
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
        <br>
        <button type="submit" class="btn btn-dark" name="btn_submit" style="background-color: #562b00;">Submit</button>
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
