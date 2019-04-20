<?php
  include '../conn.php';

  // session_start();
  $email = $_SESSION['email'];
  $user_id = $_SESSION['user_id'];

  // echo $email;
  // echo $user_id;

  if (isset($_POST['btnSubmit'])) {

    // Ambil Data yang Dikirim dari Form
    $nama_file = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $tipe_file = $_FILES['gambar']['type'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $nama_produk = $_POST['nama_produk'];
    $keterangan = $_POST['keterangan_produk'];
    $harga = $_POST['harga_produk'];
    $nama_file = $nama_produk.".".substr($tipe_file,6);

    // Set path folder tempat menyimpan gambarnya
    $path = "../images/".$nama_file;

    if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
    	// Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :

    		// Proses upload
    		if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
    			// Jika gambar berhasil diupload, Lakukan :
    			// Proses simpan ke Database
    			$query = "INSERT INTO produk(id,penjual_id,nama,harga,keterangan,gambar) VALUES('','$user_id','$nama_produk','$harga','$keterangan','$nama_file')";
          echo $query;
    			$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query

    			if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    				// Jika Sukses, Lakukan :
            echo "<script type='text/javascript'>
            			alert('Berhasil Tambah Produk');
                  </script>";
    				header("location: lihat_produk.php"); // Redirectke halaman index.php
    			}else{
    				// Jika Gagal, Lakukan :
    				echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    				echo "<br><a href='form.php'>Kembali Ke Form</a>";
    			}
    		}else{
    			// Jika gambar gagal diupload, Lakukan :
    			echo "Maaf, Gambar gagal untuk diupload.";
    			echo "<br><a href='form.php'>Kembali Ke Form</a>";
    		}

    }else{
    	// Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
    	echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
    	echo "<br><a href='form.php'>Kembali Ke Form</a>";
    }


    $conn->close();
  }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Tambah Produk</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Tambah Produk</h1>
              </div>
              <form class="user" action="<?=($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data" method="post">
                <!-- <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                  </div>
                </div> -->
                <div class="form-group">
                  <input name="nama_produk" type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Nama Produk">
                </div>
                <div class="form-group">
                  <input name="keterangan_produk" type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Keterangan Produk">
                </div>
                <div class="form-group">
                  <input name="harga_produk" type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Harga Produk">
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                  </div>
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" name="gambar" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Pilih File Gambar</label>
                  </div>
                </div>
                <Br>
                <button type="submit" name="btnSubmit" href="" class="btn btn-success btn-user btn-block">
                  Tambah Produk
                </button>
                <hr>
                <a href="index.php" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-fw"></i> Kembali Ke Laman Sebelumnya
                </a>
                <!-- <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a> -->
              </form>
              <!-- <hr> -->
              <!-- <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.html">Already have an account? Login!</a>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
