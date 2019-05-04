<?php
  include '../conn.php';
  $email = $_SESSION['email'];
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM produk WHERE penjual_id = $user_id";
  $result = $conn->query($sql);
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Lihat Produk</title>
  </head>
  <body style="padding: 150px;">
    <div class="container">
      <h1>Daftar Produk</h1>
      <br>

      <table class="table table-hover">
         <thead>
           <?php
           if ($result->num_rows > 0) {
              echo "<tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Gambar</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>";
           } else {
               echo "<h1>Data Belum Ada</h1><br>";
           }
            ?>

         </thead>
         <tbody>
           <?php
           if ($result->num_rows > 0) {
               // output data of each row
               $a = 0;
               while($row = $result->fetch_assoc()) {
                 $a++;

                 echo
                   "
                   <form action='edit_produk.php' method='post'>
                   <tr>
                   <td name='id'>".$a."</td>
                   <td name=''>".$row["nama"]."</td>
                   <td><img src='../images/".$row['gambar']."' width='100' height='100'></td>
                   <td name=''>".$row["keterangan"]."</td>
                   <td>
                   <button type='submit' class='btn btn-primary ' name='edit_produk' value='".$row["id"]."'>Edit</button>
                   <button type='submit' class='btn btn-danger ' name='hapus_produk' value='".$row["id"]."'>Hapus</button>
                   </td>
                   </tr>
                   </form>
                   ";
                                 // <button type='submit' class='btn btn-primary btn-block' name='edit_id_anggota' value='".$row["id"]."'>Edit Anggota</button><br>
               }
           }
           $conn->close();
            ?>
         </tbody>
       </table>
    </div>




    </div>
  </body>
</html>
