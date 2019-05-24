<?php
include '../conn.php';
include 'sidebar.php';
  // session_start();
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];
$id_toko = 0;
cekToko($conn);

  // echo $email;
  // echo $user_id;

function cekToko($conn){
  $id = $_SESSION['user_id'];
  $sql = "SELECT * FROM toko WHERE id_user = '$id'";
  $result = $conn->query($sql);
  $row = mysqli_num_rows($result);
  if ($row != 1){
    echo"<script type='text/javascript'>
    alert('Anda harus menginput toko');
    window.location.href='../daftar_toko.php';
    </script>";
    return;
  }else{
    $hasil = mysqli_fetch_assoc($result);
    $id_toko = $hasil['id_toko'];
    return $id_toko;
  }
}

if (isset($_POST['btnSubmit'])) {
  $id_toko = cekToko($conn);

    // Ambil Data yang Dikirim dari Form
  $nama_file = $_FILES['gambar']['name'];
  $ukuran_file = $_FILES['gambar']['size'];
  $tipe_file = $_FILES['gambar']['type'];
  $tmp_file = $_FILES['gambar']['tmp_name'];

  $nama_produk = $_POST['nama_produk'];
  $keterangan = $_POST['keterangan_produk'];
  $berat_produk = $_POST['berat_produk'];
  $kategori = strtolower($_POST['kategori']);
  $harga = $_POST['harga_produk'];
  $stock = $_POST['stock_produk'];
  $nama_file = $nama_produk.".".substr($tipe_file,6);

    // Set path folder tempat menyimpan gambarnya
  $path = "../images/".$nama_file;

    if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
    	// Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :

    		// Proses upload
    		if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
    			// Jika gambar berhasil diupload, Lakukan :
    			// Proses simpan ke Database
    			$query = "INSERT INTO produk VALUES('','$user_id','$id_toko','$nama_produk','$harga','$keterangan','$nama_file','$berat_produk','$kategori','$stock')";
    			$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query

    			if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    				// Jika Sukses, Lakukan :

            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM produk WHERE id = '$user_id'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            $id_produk = $row['id_produk'];


            // inputFoto2($id_produk);


            echo "<script type='text/javascript'>
            alert('Berhasil Tambah Produk');
            </script>";

          }else{
    				// Jika Gagal, Lakukan :
            echo"<script type='text/javascript'>
            alert('Terjadi Kesalahan');
            window.location.href='tambah_produk.php';
            </script>";
          }
        }else{
    			// Jika gambar gagal diupload, Lakukan :
          echo"<script type='text/javascript'>
          alert('Gagal Upload');
          window.location.href='tambah_produk.php';
          </script>";
        }

      }else{
    	// Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
        echo"<script type='text/javascript'>
        alert('Gambar harus jpeg / jpg / png');
        window.location.href='tambah_produk.php';
        </script>";
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
                <div class="text-center" style="padding: 50px; margin-bottom: -50px;">
                  <h4 class="text-gray-900"><b>Tambah Produk</b></h4>
                </div>

                <form class="user" action="<?=($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data" method="post" style="padding: 50px 100px;">

                  <div class="form-group">
                    <input name="nama_produk" type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Nama Produk">
                  </div>
                  <div class="form-group">
                    <input name="keterangan_produk" type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Keterangan Produk">
                  </div>
                  <div class="form-group">
                    <input name="harga_produk" type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Harga Produk">
                  </div>
                  <div class="form-group">
                    <input name="berat_produk" type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Berat Produk ( Dalam Gram )">
                  </div>
                  <div class="form-group">
                    <select name="kategori" class="form-control" style="border-radius: 20px;">

                      <?php 

                      $sql = "SELECT * FROM kategori";
                      $query = mysqli_query($conn,$sql);

                      while ($row = mysqli_fetch_assoc($query)) {

                       ?>

                       <option value="<?php echo $row['id']; ?>"><?php echo ucfirst($row['nama_kategori']); ?></option>

                     <?php } ?>

                   </select>
                 </div>
                 <div class="form-group">
                    <input name="stock_produk" type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Stock Produk">
                  </div>
                 <div class="input-group">
                  <div class="">
                   <label class="" for="inputGroupFile01">Pilih Foto Produk</label><br>
                   <input type="file" class="" name="gambar" multiple="multiple" accept="image/*">
                 </div>
               </div>
           <br>
           <button type="submit" name="btnSubmit" href="" class="btn btn-success btn-user btn-block">
            <b>Tambah Produk</b>
          </button>
        </form>

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

</html>s
