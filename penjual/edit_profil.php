<?php

include 'sidebar.php';

// Update Produk
if (isset($_POST['btn_submit'])) {
          $user_id = $_SESSION['user_id'];
          $nama_depan = $_POST['nama_depan'];
          $nama_belakang = $_POST['nama_belakang'];
          $tanggal_lahir = $_POST['tanggal_lahir'];
          $alamat = $_POST['alamat'];
          $no_telp = $_POST['no_telp'];
          $password = $_POST['password'];

          $query = "UPDATE user SET nama_depan='$nama_depan', nama_belakang='$nama_belakang',tanggal_lahir='$tanggal_lahir', alamat='$alamat', no_telp='$no_telp', password='$password' WHERE id='$user_id'";
          // echo $query;
          $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
          if($sql){ // Cek jika proses simpan ke database sukses atau tidak
            // Jika Sukses, Lakukan :
            // echo "Sukses";
            echo "<script type='text/javascript'>
            			alert('Berhasil Simpan Data');
                  </script>";
            // header("location: edit_profil.php"); // Redirectke halaman index.php
            echo "<script> document.location.href='edit_profil.php';</script>"; 
          }else{
            // Jika Gagal, Lakukan :
            // echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
            echo "<script type='text/javascript'>
            			alert('Gagal Simpan Data');
                  </script>";
          }
  }else {
    // Ambil Data Existing
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user WHERE id = $user_id";
    // echo $sql;
    $result = $conn->query($sql);

    $row = mysqli_fetch_assoc($result);

    $nama_depan = $row['nama_depan'];
    $nama_belakang = $row['nama_belakang'];
    $tanggal_lahir = $row['tanggal_lahir'];
    $alamat = $row['alamat'];
    $no_telp = $row['no_telp'];
    $email = $row['email'];
    $password = $row['password'];
  }

  $conn->close();





 ?>

 <div class="container">
 <!-- Form Login -->
 <h1>Edit Profil</h1>
 <form action="<?=($_SERVER['PHP_SELF'])?>" method="post">
   <input type="hidden" class="form-control" name="id_penjual" value="<?php echo $user_id ?>">
   <div class="form-group">
     <label for="">Nama Depan</label>
     <input type="text" class="form-control" name="nama_depan" placeholder="" value="<?php echo "$nama_depan"; ?>" >
   </div>
   <div class="form-group">
     <label for="">Nama Belakang</label>
     <input type="text" class="form-control" name="nama_belakang" placeholder="" value="<?php echo "$nama_belakang"; ?>" >
   </div>
   <div class="form-group">
     <label for="">Tanggal Lahir</label>
     <input type="text" class="form-control" name="tanggal_lahir" placeholder="" value="<?php echo "$tanggal_lahir"; ?>" >
   </div>
   <div class="form-group">
     <label for="">Alamat</label>
     <input type="text" class="form-control" name="alamat" placeholder="" value="<?php echo "$alamat"; ?>" >
   </div>
   <div class="form-group">
     <label for="">Nomor Telepon</label>
     <input type="number" class="form-control" name="no_telp" placeholder="" value="<?php echo "$no_telp"; ?>" >
   </div>
   <div class="form-group">
     <label for="">Email</label>
     <input type="text" class="form-control" name="email" placeholder="" value="<?php echo "$email"; ?>" disabled >
   </div>
   <div class="form-group">
     <label for="">Password</label>
     <input type="password" class="form-control" name="password" placeholder="" value="<?php echo "$password"; ?>" >
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
