<?php

include 'sidebar.php';
cekToko($conn);

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

// Update Produk
if (isset($_POST['btn_submit'])) {
  $user_id = $_SESSION['user_id'];
  $nama_toko = $_POST['nama_toko'];
  $alamat = $_POST['alamat'];
  if ($_FILES['gambar']['name'] == '' ) {
    $query = "UPDATE toko SET nama_toko='$nama_toko',alamat='$alamat' WHERE id_user='$user_id'";
    $sql = mysqli_query($conn, $query); 
    if($sql){ 
     echo"<script type='text/javascript'>
     alert('Berhasil diupdate');
     window.location.href='edit_toko.php';
     </script>"; 
   }else{

    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
  }
}else{
  $nama_file = $_FILES['gambar']['name'];
  $ukuran_file = $_FILES['gambar']['size'];
  $tipe_file = $_FILES['gambar']['type'];
  $tmp_file = $_FILES['gambar']['tmp_name'];

  $nama_file = $nama_toko.".".substr($tipe_file,6);

  $path = "../images/".$nama_file;

  if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ 
        if(move_uploaded_file($tmp_file, $path)){ // 
          $query = "UPDATE toko SET nama_toko='$nama_toko',alamat='$alamat',gambar='$nama_file' WHERE id_user='$user_id'";
          $sql = mysqli_query($conn, $query); 
          if($sql){ 
           echo"<script type='text/javascript'>
           alert('Berhasil diupdate');
           window.location.href='edit_toko.php';
           </script>"; 
         }else{

          echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
        }
      }else{
          // Jika gambar gagal diupload, Lakukan :
        echo "Maaf, Gambar gagal untuk diupload.";
      }

    }else{

      echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
    }
  }
} else {
    // Ambil Data Existing
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM toko WHERE id_user = $user_id";
    // echo $sql;
  $result = $conn->query($sql);

  $row = mysqli_fetch_assoc($result);

  $nama_toko = $row['nama_toko'];
  $alamat = $row['alamat'];
  $gambar = $row['gambar'];

}

$conn->close();


?>

<div class="container">
 <!-- Form Login -->
 <h2 style="font-weight: bold;">Edit Toko</h2>
 <form action="<?=($_SERVER['PHP_SELF'])?>" method="post" style="padding: 50px 150px;"  enctype="multipart/form-data">
   <input type="hidden" class="form-control" name="id_penjual" value="<?php echo $user_id ?>">
   <div class="form-group">
     <label for="">Nama Toko</label>
     <input type="text" class="form-control" name="nama_toko" placeholder="" value="<?php echo "$nama_toko"; ?>" >
   </div>
   <div class="form-group">
     <label for="">Alamat</label>
     <input type="text" class="form-control" name="alamat" placeholder="" value="<?php echo "$alamat"; ?>" >
   </div>
   <div class="form-group">
     <label for="gambar">Gambar</label>
     <br>
     <img src='../images/<?php echo "$gambar"; ?>' width='100%' height='200px'>
     <br>
     <br>
     <div class="input-group">
       <div class="input-group-prepend">
         <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
       </div>
       <div class="custom-file">
        <input type="file" class="custom-file-input" name="gambar" aria-describedby="inputGroupFileAddon01" value="<?php echo "$gambar"; ?>">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
      </div>
    </div>
  </div>
  <br>
  <button type="submit" class="btn btn-success" name="btn_submit">Submit</button>
</form>


</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
