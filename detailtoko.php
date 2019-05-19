<?php
require "conn.php";
require "partition/header.php";

if (isset($_GET['id'])) {
    $id_toko = $_GET['id'];
    $sql = "SELECT * FROM toko WHERE id_toko = '$id_toko'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        echo "<script>
         window.location.href = '404.php';
         </script>";
        // header("Location:404.php");
    }
    
    $row = mysqli_fetch_assoc($result);

}else{
    echo "<script>
         window.location.href = 'listtoko.php';
         </script>";
    // header("Location:listtoko.php");
}

?>

<body>
    <?php
    require "partition/nav.php";
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-xs-12" align="center">
                <img src="images/<?php echo $row['gambar']; ?>" alt="" height="200px" width="200px">
                <br><br>
                <h1><?php echo $row['nama_toko']; ?></h1>
                <p><?php echo $row['alamat']; ?></p>
            </div>
            <?php 

            $id_toko = $_GET['id'];
            $query = "SELECT pr.id, pr.gambar, pr.nama, pr.harga FROM toko tk JOIN produk pr ON tk.id_toko = pr.id_toko WHERE tk.id_toko = '$id_toko'";
            $hasil = mysqli_query($conn,$query);
            while ($row  = mysqli_fetch_assoc($hasil)){

                ?>
                <div class="col-lg-4 col-xs-12">
                    <div class="gambarlist" >
                        <img src="images/<?php echo $row['gambar']; ?>" alt="produk">
                        <a href="detailproduk.php?id=<?php echo $row['id']; ?>"  >
                          <div class="overflow list">
                            <h2><?php echo $row['nama']; ?><br><?php echo $row['harga']; ?></h2>
                        </div>
                    </a>
                </div>
            </div>

        <?php } ?>

    </div>
</div>

<?php
require "partition/footer.php";
?>
</body>
