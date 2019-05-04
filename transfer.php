<?php 

include 'conn.php';


$id = $_SESSION['user_id'];
$sql = "SELECT * FROM transfer tf JOIN cart cart ON tf.id_transfer = cart.id_transfer WHERE id_user = '$id'";
$result = $conn->query($sql);
$row = mysqli_num_rows($result);    

if($_SESSION['status'] != "login" ){
    header("location:login.php");
}

if ($row == 0){
	header("location:index.php");
}


function upload($id_transaksi){

}
if (isset($_POST['upload'])) {

// Ambil Data yang Dikirim dari Form
    $nama_file = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $tipe_file = $_FILES['gambar']['type'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $id_transaksi = $_POST['upload_file'];
    $nama_file = $id_transaksi.".".substr($tipe_file,6);

    // Set path folder tempat menyimpan gambarnya
    $path = "images/".$nama_file;

    if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
        // Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :

        // Proses upload
        if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
            // Jika gambar berhasil diupload, Lakukan :
            // Proses simpan ke Database
            $today = date("Y/m/d");
            $query = "UPDATE transfer SET status_upload = 1, date_upload = '$today' WHERE id_transfer = '$id_transaksi'";
            $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query

            if($sql){ // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :
                echo "<script type='text/javascript'>
                alert('Berhasil Tambah Produk');
                </script>";
                header("location: transfer.php"); // Redirectke halaman index.php
            }else{
                // Jika Gagal, Lakukan :
                echo "<script type='text/javascript'>
                alert('Gagal Tambah Produk');
                </script>";
            }
        }else{
            // Jika gambar gagal diupload, Lakukan :
            echo "Maaf, Gambar gagal untuk diupload.";

        }

    }else{
        // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
        echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
    }


    $conn->close();

}

if (isset($_POST['upload_ulang'])){
    if (array_key_exists('delete_file', $_POST)) {
        //ini jpg
        $id_transaksi = $_POST['delete_file'];
        $filename = "images/".$_POST['delete_file'].".jpg";
        if (file_exists($filename)) {
            unlink($filename);
            $query = "UPDATE transfer SET status_upload = 0, date_upload = '0000-00-00' WHERE id_transfer = '$id_transaksi'";
            $sql = mysqli_query($conn, $query);
        } else {
//                        ini jpeg
            $filename = "images/".$_POST['delete_file'].".jpeg";
            if (file_exists($filename)) {
                unlink($filename);
                $query = "UPDATE transfer SET status_upload = 0, date_upload = '0000-00-00' WHERE id_transfer = '$id_transaksi'";
                $sql = mysqli_query($conn, $query);
            } else {
                //ini png
                $filename = "images/".$_POST['delete_file'].".png";
                if (file_exists($filename)) {
                    unlink($filename);
                    $query = "UPDATE transfer SET status_upload = 0, date_upload = '0000-00-00' WHERE id_transfer = '$id_transaksi'";
                    $sql = mysqli_query($conn, $query);
                }
            }
        }
    }
    header("location:transfer.php");
}


include 'partition/header.php';

?>



<?php

include 'partition/nav.php';

?>


<body>
	<div class="container">

        <?php

        while($row = $result->fetch_assoc()) {
            $harga = $row['total'];
            $status = $row['status_upload'];
            $id_transaksi = $row['id_transfer'];

            $status_pengiriman = $row['status_pengiriman'];
            $status_verifikasi = $row['status_verifikasi'];

            ?>

            <div class="row pembayaran bg-light">
               <div class="col-lg-12">
                <form action="" enctype="multipart/form-data" method="post">
                    <h1>Pembayaran</h1>
                    <h1 style="color: orange;">Rp. <?php echo $harga?></h1>
                    <p style="text-align: center;">Silahkan transfer sesuai dengan nominal dan kirim ke rekening <strong>Mandiri</strong> berikut</p>
                    <h1 style="font-weight: bold;line-height: 0px; font-size: 30px">123341200432</h1>
                    <p style="font-size: 20px; color: black; margin-top: 25px; text-align: center">a/n</p>
                    <h4 style="text-align: center; font-weight: bold; margin-bottom: 80px">Bumdes Gambung</h4>
                    <h4>Tata cara pembayaran</h4>
                    <ul>
                     <li>Bayarkan nominal yang tertera ke Rekening tersebut </li>
                     <li>Pastikan anda mencetak bukti pembayaran jika menggunakan ATM</li>
                     <li>Pastikan anda memfoto bukti pembayaran atau bukti transaksi</li>
                     <li>Upload foto bukti pembayaran di form berikut</li><br>
                     
                    <?php if ($status == 1 && $status_verifikasi == 1 && $status_pengiriman == 1){ ?> 

                        <h5>Sudah dikirim, dan datang dalam waktu dekat</h5>

                    <?php } else { ?>    

                        <?php if ($status == 0){ ?>

                            <input type="file" class="" name="gambar" style="width: 50%; border:0px;"><br><br>
                            <input type="hidden" value="<?php echo $id_transaksi ?>" name="upload_file" />
                            <button type="submit" name="upload" class="btn btn-danger">Upload</button>

                        <?php } else { ?>

                            <h5>Barang sedang di proses</h5>
                            <input type="hidden" value="<?php echo $id_transaksi ?>" name="delete_file" />
                            <button type="submit" name="upload_ulang" class="btn btn-danger">Upload Ulang</button>
                        <?php } ?>
                    <?php } ?>
                </ul>

            </form>
        </div>
    </div>

    <?php
}
?>

</div>
<?php 

include 'partition/footer.php';

?>


</body>