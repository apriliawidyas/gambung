<?php
include '../conn.php';

$id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE id='$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$nama_depan = $row['nama_depan'];
$nama_belakang = $row['nama_belakang'];
$no_telp = $row['no_telp'];
$email = $row['email'];
$alamat = $row['alamat'];

if (isset($_POST['btn_submit'])) {
  $nama_depan =  $_POST["nama_depan"];
  $nama_belakang = $_POST["nama_belakang"];
  $alamat = $_POST["alamat"];
  $no_telp = $_POST["no_telp"];
  $email = $_POST["email_user"];
  $kota = $_POST['kota'];
  // $password = $_POST["password"];

  $sql = "UPDATE user SET nama_depan='$nama_depan',nama_belakang='$nama_belakang'
  ,alamat='$alamat',no_telp='$no_telp',kota='$kota' WHERE id='$id'";

  if ($conn->query($sql) === TRUE) {
   echo"<script type='text/javascript'>
   alert('Berhasil Update');
   window.location.href='index.php';
   </script>";
 } else {
  echo "Error updating record: " . $conn->error;
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

<body >
  <div class="container" style="padding: 60px;">
    <!-- Form Login -->
    <h2 style="font-weight: bold; color:#562b00">Edit Admin</h2>
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
        <div class="col-xs-6">
          <label for="kota"><h5>Kota</h5></label>
          <select name="kota" class="form-control">
            <option value="<?php echo $row['kota']; ?>"><?php echo $row['kota']; ?></option>
            <?php foreach (getDataKota() as $result): ?>
              <option value="<?php echo $result['city_name'] ?>"><?php echo $result['city_name'] ?></option>
            <?php endforeach;?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" name="alamat" placeholder="" value="<?php echo "$alamat"; ?>" >
      </div>
      <div class="form-group">
        <label for="no_telp">Nomor Telepon</label>
        <input type="number" class="form-control" name="no_telp" placeholder="" value="<?php echo $no_telp ?>" >
      </div>

      <button type="submit" class="btn btn-dark" name="btn_submit" style="background-color: #562b00;">Update</button>
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
