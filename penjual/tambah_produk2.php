<?php
  include '../conn.php';

  // session_start();
  $email = $_SESSION['email'];
  $user_id = $_SESSION['user_id'];

  // echo $email;
  // echo $user_id;

  if (isset($_POST['btn_submit'])) {

    // Ambil Data yang Dikirim dari Form
    $nama_file = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $tipe_file = $_FILES['gambar']['type'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $nama_produk = $_POST['nama_produk'];
    $keterangan = $_POST['keterangan'];
    $nama_file = $nama_produk.".".substr($tipe_file,6);

    // Set path folder tempat menyimpan gambarnya
    $path = "../images/".$nama_file;

    if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
    	// Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :

    		// Proses upload
    		if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
    			// Jika gambar berhasil diupload, Lakukan :
    			// Proses simpan ke Database
    			$query = "INSERT INTO produk(id,penjual_id,nama,keterangan,gambar) VALUES('','$user_id','$nama_produk','$keterangan','$nama_file')";
    			$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query

    			if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    				// Jika Sukses, Lakukan :
            echo "Sukses";
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
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Tambah Produk</title>
  </head>
  <body style="padding: 100px;">
    <div class="container">
    <!-- Form Login -->
    <h1>Tambah Produk</h1>
    <form action="<?=($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="nama_produk">Nama Produk</label>
        <input type="text" class="form-control" name="nama_produk" placeholder="" >
      </div>
      <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <input type="text" class="form-control" name="keterangan" placeholder="" >
      </div>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
        </div>
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="gambar" aria-describedby="inputGroupFileAddon01">
          <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
        </div>
      </div>
      <br>
      <button type="submit" class="btn btn-success" name="btn_submit">Submit</button>
    </form>

    <!-- <div class="w3-panel w3-card w3-yellow" style="width:300px; margin-top:50px"><a style="text-decoration:none" href="https://s.id/Modul5EA" target="_blank"><p>Modul 5 Application Architecture</p></a></div> -->
    <!-- <div class="w3-panel w3-card w3-red" style="width:300px; margin-top:20px"><a style="text-decoration:none" href="https://drive.google.com/file/d/1OOIqDKxp4HLB9H9NwA-VAbjm4pULY_74/view" target="_blank"><p>Tes Awal Modul 5</p></a></div> -->
    <!-- <div class="w3-panel w3-card w3-blue" style="width:300px; margin-top:20px"><a style="text-decoration:none" href="https://drive.google.com/file/d/1oP5_EYWX6u5cuVZ9HuvkexgShMi8xJdz/view" target="_blank"><p>Login</p></a></div>
    <div class="w3-panel w3-card w3-green" style="width:300px; margin-top:20px"><a style="text-decoration:none" href="https://drive.google.com/file/d/1giw0osra0iKes6O2asM5Z4ZiKnl-KwQc/view" target="_blank"><p>Daftar</p></a></div> -->

    </div>
  </body>
</html>
