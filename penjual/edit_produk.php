<?php

include 'sidebar.php';

// Ambil Data  Existing
if (isset($_POST['edit_produk'])) {
  $id_produk =$_POST['edit_produk'];
  $sql = "SELECT * FROM produk WHERE id = $id_produk";
  $result = $conn->query($sql);
  $row = mysqli_fetch_assoc($result);
  $id_produk = $row['id'];
  $nama_produk = $row['nama'];
  $keterangan = $row['keterangan'];
  $harga = $row['harga'];
  $gambar = $row['gambar'];
  // mysqli_close($conn);
}

// Hapus Produk
if (isset($_POST['hapus_produk'])) {
  // echo "Mau Hapus";
  $id_produk = $_POST['hapus_produk'];
  // sql to delete a record
  $sql = "DELETE FROM produk WHERE id='$id_produk'";
  if ($conn->query($sql) === TRUE) {
      echo "<script>alert('Berhasil Hapus')</script>";
      // echo "Berhasil Hapus";
      header('Location: lihat_produk.php');
      exit;
  } else {
    // echo "<script> alert('Berhasil Hapus'); </script>";
    echo "<script> alert('Error deleting record: ".$conn->error."'); </script>";
     // echo "Error deleting record: " . $conn->error;
  }
  $conn->close();
}

// Update Produk
if (isset($_POST['btn_submit'])) {

  // Kalo ada gambar
  // if (isset($_FILES['gambar']['name'])) {
  if ($_FILES['gambar']['name'] != '' ) {
    // Ambil Data yang Dikirim dari Form
    $nama_file = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $tipe_file = $_FILES['gambar']['type'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $keterangan = $_POST['keterangan'];
    $harga_produk = $_POST['harga_produk'];
    $nama_file = $nama_produk.".".substr($tipe_file,6);

    // Set path folder tempat menyimpan gambarnya
    $path = "../images/".$nama_file;

    if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
      // Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :

        // Proses upload
        if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
          // Jika gambar berhasil diupload, Lakukan :
          // Proses simpan ke Database
          // $query = "INSERT INTO produk(id,penjual_id,nama,keterangan,gambar) VALUES('','$user_id','$nama_produk','$keterangan','$nama_file')";

          $query = "UPDATE produk SET nama='$nama_produk',harga='$harga_produk',keterangan='$keterangan',gambar='$nama_file' WHERE id='$id_produk'";
          $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query

          if($sql){ // Cek jika proses simpan ke database sukses atau tidak
            // Jika Sukses, Lakukan :
            echo "Sukses";
            header("location: lihat_produk.php"); // Redirectke halaman index.php
          }else{
            // Jika Gagal, Lakukan :
            echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
          }
        }else{
          // Jika gambar gagal diupload, Lakukan :
          echo "Maaf, Gambar gagal untuk diupload.";
        }

    }else{
      // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
      echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
    }
  }else {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $keterangan = $_POST['keterangan'];
    $harga_produk = $_POST['harga_produk'];
    $query = "UPDATE produk SET nama='$nama_produk',harga='$harga_produk',keterangan='$keterangan' WHERE id='$id_produk'";
    $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query

    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
      // Jika Sukses, Lakukan :
      // echo "Sukses";
      // header("location: lihat_produk.php"); // Redirectke halaman index.php
      echo " <script> location.replace('lihat_produk.php'); </script>";
    }else{
      // Jika Gagal, Lakukan :
      echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    }
  }




  $conn->close();
}




 ?>

 <div class="container">
 <!-- Form Login -->
 <h1>Edit Produk</h1>
 <form action="<?=($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
   <input type="hidden" class="form-control" name="id_produk" value="<?php echo $id_produk ?>">
   <div class="form-group">
     <label for="nama_produk">Nama Produk</label>
     <input type="text" class="form-control" name="nama_produk" placeholder="" value="<?php echo "$nama_produk"; ?>" >
   </div>
   <div class="form-group">
     <label for="harga_produk">Harga Produk</label>
     <input type="number" class="form-control" name="harga_produk" placeholder="" value="<?php echo "$harga"; ?>" >
   </div>
   <div class="form-group">
     <label for="keterangan">Keterangan</label>
     <input type="text" class="form-control" name="keterangan" placeholder="" value="<?php echo "$keterangan"; ?>" >
   </div>
   <div class="form-group">
     <label for="gambar">Gambar</label>
     <br>
     <img src='../images/<?php echo "$gambar"; ?>' height='500'>
     <br>
     <br>
     <div class="input-group">
       <div class="input-group-prepend">
         <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
       </div>
       <div class="custom-file">
         <input type="file" class="custom-file-input" name="gambar" aria-describedby="inputGroupFileAddon01">
         <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
       </div>
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

 <?php

include 'footer.php';

  ?>
