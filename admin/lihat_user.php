<?php
  include '../conn.php';
  $sql = "SELECT * FROM user WHERE role_id > 1";
  $result = $conn->query($sql);
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Lihat User</title>
  </head>
  <body style="padding: 150px;">
    <div class="container">
      <h1>Daftar User</h1>
      <br>
      <table class="table table-hover">
         <thead>
           <tr>
             <th>No</th>
             <th>Role</th>
             <th>Username</th>
             <th>Aksi</th>
           </tr>
         </thead>
         <tbody>
           <?php
           if ($result->num_rows > 0) {
               // output data of each row
               $a = 0;
               while($row = $result->fetch_assoc()) {
                 if ($row["role_id"] == 1 ) {
                   // code...
                 }
                 $a++;
                 if ($row["role_id"] == 2 ) {
                   $role = "Penjual";
                 }else {
                   $role = "Pembeli";
                 }


                 echo
                   "
                   <form action='edit_user.php' method='post'>
                   <tr>
                   <td name='id'>".$a."</td>
                   <td name=''>".$role."</td>
                   <td name=''>".$row["email"]."</td>
                   <td>
                   <button type='submit' class='btn btn-primary ' name='edit_user' value='".$row["email"]."'>Edit</button>
                   <button type='submit' class='btn btn-danger ' name='hapus_user' value='".$row["email"]."'>Hapus</button>
                   <button type='submit' class='btn btn-warning ' name='reset_password' value='".$row["email"]."'>Reset Password</button>
                   </td>
                   </tr>
                   </form>
                   ";
                                 // <button type='submit' class='btn btn-primary btn-block' name='edit_id_anggota' value='".$row["id"]."'>Edit Anggota</button><br>
               }
           } else {
               // echo "<center><h1>Data Belum Ada</h1></center>";
               echo "<h1>Data Belum Ada</h1><br>";
           }
           $conn->close();
            ?>
         </tbody>
       </table>
    </div>




    </div>
  </body>
</html>
