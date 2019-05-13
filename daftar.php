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
  $kota = $_POST['kota'];

  if ($role == 'Pembeli') {
    $role = '3';
    
    $sql = "INSERT INTO user VALUES ('', '$role', '$nama_depan','$nama_belakang','$tanggal_lahir','$kota','$alamat','$no_telepon','$email','$password')";
      // echo $sql;

    if ($conn->query($sql) === TRUE) {
          // echo "New record created successfully";
      echo "<script type='text/javascript'>
      alert('Berhasil Tambah User');
      window.location.href='login.php';
      </script>";

    } else {
          // echo "Error: " . $sql . "<br>" . $conn->error;
      echo "<script type='text/javascript'>
      alert('Gagal');
      window.location.href='daftar.php';
      </script>";

    }

    $conn->close();

  } elseif ($role == 'Penjual') {
    $role = '2';

     $sql = "INSERT INTO user VALUES ('', '$role', '$nama_depan','$nama_belakang','$tanggal_lahir','$kota','$alamat','$no_telepon','$email','$password')";
      // echo $sql;

    if ($conn->query($sql) === TRUE) {
          // echo "New record created successfully";
      echo "<script type='text/javascript'>
      alert('Berhasil Tambah User, silahkan isi Toko');
      window.location.href='login.php';
      </script>";

    } else {
          // echo "Error: " . $sql . "<br>" . $conn->error;
      echo "<script type='text/javascript'>
      alert('Gagal');
      window.location.href='daftar.php';
      </script>";

    }

    $conn->close();

  }

  

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
          <select name="kota" class="form-control" style="border-radius: 20px;">
            <option value="">Pilih Kota</option>
            <?php foreach (getDataKota() as $result): ?>
              <option value="<?php echo $result['city_name'] ?>"><?php echo $result['city_name'] ?></option>
            <?php endforeach;?>
          </select>
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
          <select name="role" class="form-control" style="border-radius: 20px;">
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
