<?php
include 'sidebar.php';

$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];
$sql = "SELECT cart.status_pengiriman,cart.id,pr.nama as nama_produk,pr.gambar,cart.kuantitas,cart.status,pr.harga,CONCAT(user.nama_depan,user.nama_belakang) as nama 
FROM cart cart JOIN produk pr
ON pr.id = cart.id_produk
JOIN user user ON cart.user_id = user.id
JOIN transfer tf ON tf.id_transfer = cart.id_transfer
WHERE pr.penjual_id = '$user_id' AND tf.status_verifikasi = 1";

$result = $conn->query($sql);

if(isset($_POST['verifikasi'])){
    $id = $_POST['verifikasi'];
    $sql = "UPDATE cart SET status_pengiriman = 1 WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result){

        $sql = "SELECT user_id FROM cart WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $iduser = $row['user_id'];

        $query = "INSERT INTO notif VALUES('','$iduser','Verifikasi Pengiriman','Barang anda sudah dikirim',0)";
        mysqli_query($conn,$query);

        echo "<script type='text/javascript'>
        alert('Berhasil verifikasi');
        window.location.href='index.php';
        </script>";
    }else{
        echo "<script type='text/javascript'>
        alert('Gagal verifikasi');
        window.location.href='index.php';
        </script>";
    }
}

?>



<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Main Content -->
<div id="content">


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="font-weight: bold;">Dashboard <?php echo $_SESSION['nama_depan']; ?></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan Penjualan</a>
        </div>

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
                                    <th>Pembeli</th>
                                    <th>Kuantitas</th>
                                    <th>Gambar</th>
                                    <th>Harga</th>
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
                                        <td name=''>".$row["nama_produk"]."</td>
                                        <td name=''>".$row["nama"]."</td>
                                        <td name=''>".$row["kuantitas"]."</td>
                                        <td><img src='../images/".$row['gambar']."' width='100' height='100'></td>
                                        <td name=''>".$row["harga"]*$row["kuantitas"]."</td>
                                        <td>";
                                        if ($row['status_pengiriman']==0) {
                                            echo "<form action='' method='post'>
                                            <button type='submit' class='btn btn-primary' name='verifikasi' value='".$row["id"]."'>Verifikasi Pengiriman</button>
                                            </form>";
                                        }   else {
                                            echo "
                                            <button type='submit' class='btn btn-primary' name='verifikasi' value='".$row["id"]."' disabled>Verifikasi Pengiriman</button>
                                            ";

                                        }
                                        echo "</td>
                                        </tr>
                                        ";

                                    }
                                }

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
