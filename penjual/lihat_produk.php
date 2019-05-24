<?php
include 'sidebar.php';
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM produk WHERE penjual_id = $user_id";
$result = $conn->query($sql);
  // echo $user_id;
  // include 'tables.php';
?>



<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Main Content -->
<div id="content">


  <!-- Begin Page Content -->
  <div class="container-fluid">


    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Daftar Produk</h1> -->
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->



    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabel Daftar Produk</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th>Harga</th>
                  <th>Keterangan</th>
                  <th>Gambar</th>
                  <th>Stock</th>
                  <th>Aksi</th>
                </tr>
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
                    <tr>
                    <td name='id'>".$a."</td>
                    <td name=''>".$row["nama"]."</td>
                    <td name=''>".$row["harga"]."</td>
                    <td name=''>".$row["keterangan"]."</td>
                    <td><img src='../images/".$row['gambar']."' width='100' height='100'></td>
                    <td name=''>".$row["stock"]."</td>
                    <td>

                    <form action='edit_produk.php' method='post'>
                    <button type='submit' class='btn btn-primary' name='edit_produk' value='".$row["id"]."'>Edit</button>
                    <button type='submit' class='btn btn-danger' name='hapus_produk' value='".$row["id"]."'>Hapus</button>
                    </form>
                    </td>
                    </tr>
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
      </div>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

  <!-- Bootstrap core JavaScript-->
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

  <?php

// include 'footer.php';

  ?>
