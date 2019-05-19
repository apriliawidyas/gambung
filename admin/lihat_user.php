<?php
include '../conn.php';
$sql = "SELECT * FROM user WHERE role_id > 1";
$result = $conn->query($sql);

if($_SESSION['status'] !="login"){
    echo "<script>
         window.location.href = '../index.php';
         </script>";
// 	header("location:../index.php");
}

if (isset($_POST['hapus_user'])) {

  $email_user = $_POST['hapus_user'];
  // sql to delete a record
  $sql = "DELETE FROM user WHERE email='$email_user'";
  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Berhasil Hapus')</script>";
  } else {

    echo "<script> alert('Error deleting record: ".$conn->error."'); </script>";
     // echo "Error deleting record: " . $conn->error;
  }
  $conn->close();
}

?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="icon" href="../image/gambung.png">


  <!-- font -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

  <!-- css style -->
  <link rel="stylesheet" href="css/style.css">

  <title>Admin Gambung</title>

</head>

<?php 

include 'sidebar.php';

?>

<!-- Custom styles for this page -->
<link href="../penjual/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


<body>
  <div class="container" style="padding: 60px;">
   <h2 style="font-weight: bold; color:#562b00">Daftar User Admin</h2>
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
           <form action='index.php' method='post'>
           <tr>
           <td name='id'>".$a."</td>
           <td name=''>".$role."</td>
           <td name=''>".$row["email"]."</td>
           <td>
           <a href='edit_user.php?id=".$row["id"]."'>
           <button type='button' class='btn btn-primary ' name='edit_user' value='".$row["id"]."'>Edit</button>
           </a>
           <button type='submit' class='btn btn-danger ' name='hapus_user' value='".$row["email"]."'>Hapus</button>
           
           </td>
           </tr>
           </form>
           ";

         }
       } else {
         echo "<h1>Data Belum Ada</h1><br>";
       }
       $conn->close();
       ?>
     </tbody>
   </table>
 </div>




</div>
</body>



<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src=vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>
</html>
