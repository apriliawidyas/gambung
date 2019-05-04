<?php
require "conn.php";

require "partition/header.php";
require "partition/nav.php";

$id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE id='$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$nama_depan = $row['nama_depan'];
$nama_belakang = $row['nama_belakang'];
$no_telp = $row['no_telp'];
$email = $row['email'];
$alamat = $row['alamat'];

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


if(isset($_POST['submit'])){

    $nama_depan = $_POST['nama_depan'];
    $nama_belakang = $_POST['nama_belakang'];
    $kota = $_POST['kota'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $id = $_SESSION['user_id'];

    if($password == null || $password2 == null){
        echo 'b';
        echo"<script type='text/javascript'>
            alert('Password harus diisi');
            window.location.href='editprofile.php';
             </script>";
        return;
    }

    if ($password == $password2){
        $sql = "UPDATE user SET nama_depan='$nama_depan', nama_belakang='$nama_belakang',
        kota = '$kota',alamat='$alamat',no_telp='$no_telepon',email='$email',password='$password' WHERE id=$id;";
        $result = mysqli_query($conn,$sql);
        if ($result){
            echo"<script type='text/javascript'>
            alert('Data berhasil diupdate');
            window.location.href='editprofile.php';
             </script>";
        }else{
            echo"<script type='text/javascript'>
            alert('Gagal diupdate');
            window.location.href='editprofile.php';
             </script>";
        }
    }else{
        echo"<script type='text/javascript'>
            alert('Password tidak sesuai');
            window.location.href='editprofile.php';
             </script>";
        return;
    }


}


?>


<section>
<h1 style="padding: 30px;">Edit Profile</h1>
<div class="container bootstrap snippet">
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              

      <div class="text-center">
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
        <h6 style="padding: 10px">Unggah foto</h6>
        <input type="file" class="" style="width: 90%; border:0px;">
      </div>
       
        </div><!--/col-3-->
    	<div class="col-sm-9">
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                  <form class="form-action" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h5>Nama Depan</h5></label>
                              <input value="<?php echo $nama_depan ?>" type="text" class="form-control" name="nama_depan" id="first_name" placeholder="Nama Depan" title="enter your first name if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h5>Nama Belakang</h5></label>
                              <input value="<?php echo $nama_belakang ?>" type="text" class="form-control" name="nama_belakang" id="last_name" placeholder="Nama Belakang" title="enter your last name if any.">
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="mobile"><h5>Handphone</h5></label>
                              <input value="<?php echo $no_telp ?>" type="text" class="form-control" name="no_telepon" id="no_telepon" placeholder="Nomor Handphone" title="enter your mobile number if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h5>Email</h5></label>
                              <input value="<?php echo $email ?>" type="email" class="form-control" name="email" id="email" placeholder="nama@email.com" title="enter your email.">
                          </div>
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
                          <div class="col-xs-6">
                              <label for="email"><h5>Alamat Lengkap</h5></label>
                              <textarea name="alamat" rows="5" cols="80" class="form-control" ><?php echo $alamat ?></textarea>

                          </div>
                      </div>

                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="password"><h5>Password</h5></label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="Password" title="enter your password.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="password2"><h5>Verifikasi Password</h5></label>
                              <input type="password" class="form-control" name="password2" id="password2" placeholder="Verifikasi Password" title="enter your password2.">
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-ok-sign" ></i> Simpan</button>
                               	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
							</div>
                      </div>
				  </form>
             </div>
              </div>

			  </div>
			  <!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
	</section>
	<!-- cart section end -->
<?php
require "partition/footer.php";
?>

	</body>
</html>
