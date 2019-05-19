<?php
require "partition/header.php";
include 'conn.php';




if(!isset($_SESSION['role']) || ($_SESSION['role'] != 2)){
    header("Location:index.php");
}


if (isset($_POST['daftartoko'])) {
    $nama_file = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $tipe_file = $_FILES['gambar']['type'];
    $tmp_file = $_FILES['gambar']['tmp_name'];

    $nama_toko = $_POST['nama_toko'];
    $alamat = $_POST['alamat'];
    $id_user = $_SESSION['user_id'];

    $nama_file = $nama_toko.".".substr($tipe_file,6);

    $path = "images/".$nama_file;

    if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
        // Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :

        // Proses upload
        if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
            // Jika gambar berhasil diupload, Lakukan :
            // Proses simpan ke Database
            $sql = "INSERT INTO toko VALUES ('', '$id_user','$nama_toko', '$alamat','$nama_file')";
            // echo $sql;

            if ($conn->query($sql) === TRUE) {
                // echo "New record created successfully";
                echo "<script type='text/javascript'>
        			alert('Berhasil Daftar Toko');
        			window.location.href = 'penjual/index.php';
                </script>";

            } else {
                // echo "Error: " . $sql . "<br>" . $conn->error;
                echo "<script type='text/javascript'>
        			alert('Anda sudah memiliki Toko');
              </script>";

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

}





?>



<body class="bg-light">
  <form method="POST" action="" enctype="multipart/form-data">
    <div class="login">
      <h2>Daftar Toko</h2>
      <hr>
      <img src="image/gambung.png" alt="logo" height="200px">
      <div class="forminside">
        <div class="form-group">
          <input name="nama_toko" type="text" class="form-control" id="nama_depan" placeholder="Nama Toko">
        </div>
        <div class="form-group">
          <textarea name="alamat" rows="5" cols="80" class="form-control" placeholder="Alamat"></textarea>
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
      </div>
          <br>
        <button name="daftartoko" type="submit" class="btn btn-primary daftar">Daftar</button>
      </div>
  </form>
    </div>

</body>

<!-- <?php
require "partition/footer.php";
 ?> -->

</html>
