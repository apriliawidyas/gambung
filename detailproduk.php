<?php
require "conn.php";
require "partition/header.php";


$id = $_GET['id'];
$sql = "SELECT * FROM produk WHERE id='$id'";
$result = $conn->query($sql);
if (mysqli_num_rows($result) == 0) {
    echo "<script>
    window.location.href = '404.php';
    </script>";
    // header("Location:404.php");
}


while($row = $result->fetch_assoc()) {
    $name = $row['nama'];
    $image = $row['gambar'];
    $price = $row['harga'];
    $keterangan = $row['keterangan'];
    $stock = $row['stock'];
}


if(isset($_POST['beli'])){
    if($_SESSION['status'] == "login"){
        $id_user = $_SESSION['user_id'];
        $kuantitas = $_POST['kuantitas'];
        $stock = $_POST['beli'];
        if ($kuantitas > $stock) {
            echo "<script type='text/javascript'>
            alert('Stock tidak mencukupi');
            location.reload(forceGet);
            </script>";
        }else{
            $sql = "INSERT INTO cart VALUES(NULL, '$id_user','$id', $kuantitas, 0,0,0 )";
            if($conn->query($sql) === TRUE){
               
                echo "<script type='text/javascript'>
                alert('Berhasil Dimasukan ke Cart');
                window.location.href='cart.php';
                </script>";
            }else{
                echo "<script type='text/javascript'>
                alert('Gagal Memasukan ke Cart');
                </script>";
            }
        }
    }else{
        echo "<script>
        window.location.href = 'login.php';
        </script>";
        // header("location:login.php");
    }


}

?>

<!--<link rel="stylesheet" href="styledetailproduk/css/bootstrap.min.css"/>-->
<link rel="stylesheet" href="styledetailproduk/css/font-awesome.min.css"/>
<link rel="stylesheet" href="styledetailproduk/css/flaticon.css"/>
<link rel="stylesheet" href="styledetailproduk/css/slicknav.min.css"/>
<link rel="stylesheet" href="styledetailproduk/css/jquery-ui.min.css"/>
<link rel="stylesheet" href="styledetailproduk/css/owl.carousel.min.css"/>
<link rel="stylesheet" href="styledetailproduk/css/animate.css"/>
<link rel="stylesheet" href="styledetailproduk/css/style.css"/>

<body>

  <?php

  require "partition/nav.php";
  
  ?>

  <div class="container-fluid">


    <!-- disini product -->
    <section class="product-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-pic-zoom">
                        <img class="product-big-img" src="images/<?php echo $image ?>" alt="" height="600">
                    </div>
                    <div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
                        <div class="product-thumbs-track">
                            <div class="pt active" data-imgbigurl="images/<?php echo $image ?>"><img src="images/<?php echo $image ?>" alt=""></div>

                            <?php 

                            $id_produk = $_GET['id'];
                            $sql = "SELECT * FROM foto_produk WHERE id_produk = '$id_produk'";

                            $result = mysqli_query($conn,$sql);
                            while($row = $result->fetch_assoc()){
                                $tambahan = $row['gambar'];
                                ?>

                                <div class="pt" data-imgbigurl="images/<?php echo $tambahan; ?>"><img src="images/<?php echo $tambahan; ?>" alt=""></div>

                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 product-details">
                    <h2 class=""><strong><?php echo $name ?></strong></h2>
                    <h3 class="p-price"><?php echo $price ?></h3>
                    <h4 class="p-stock">Available: <span><?php echo $stock; ?> Stock</span></h4>

                    <form action="" method="post">
                        <div class="quantity">
                            <p>Quantity</p>
                            <div class="pro-qty"><input type="text" value="1" name="kuantitas"></div>
                        </div>
                        <button class="site-btn" type="submit" name="beli" value="<?php echo $stock; ?>">BELI</button>
                    </form>

                    <!--                    accoordion-->
                    <div id="" class="accordion-area">
                        <div class="panel">
                            <div class="panel-header" id="headingOne">
                                <button class="panel-link" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
                            </div>
                            <div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="panel-body">
                                    <p><?php echo $keterangan ?></p>
                                </div>
                            </div>
                        </div>

                        <?php 

                        $id_produk = $_GET['id'];
                        $sql = "SELECT tk.id_toko,tk.nama_toko,tk.gambar FROM toko tk JOIN produk pr ON tk.id_toko = pr.id_toko WHERE pr.id = '$id_produk'";
                        $result = mysqli_query($conn,$sql);
                        $row = $result->fetch_assoc();
                        $gambar = $row['gambar'];
                        $nama_toko = $row['nama_toko'];

                        ?>


                        <div class="">
                            <div class="panel-header" id="headingOne">
                                <button class="panel-link" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">Toko</button>
                            </div>
                            <div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="panel-body" style="display: inline;">
                                    <a href="detailtoko.php?id=<?php echo $row['id_toko']; ?>">
                                        <img src="images/<?php echo $gambar; ?>" height="80px;" width="80px" style="margin-top: 20px; border-radius: 50px;">
                                        <h5 style="display: inline;font-size: 22px;"><?php echo $nama_toko; ?></h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--RELATED PRODUK-->
    <section class="related-product-section">
        <div class="container">
            <div class="section-title">
                <h2>PRODUK LAINNYA</h2>
            </div>
            <div class="product-slider owl-carousel">
                <?php

                $sql = "SELECT * FROM produk";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    $name = $row['nama'];
                    $image = $row['gambar'];
                    $price = $row['harga'];


                    ?>
                    <a href="detailproduk.php?id=<?php echo $row['id']; ?>">
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="images/<?php echo $image ?>" alt="" height="300px">
                            </div>
                            <div class="pi-text">
                                <h6><?php echo $price ?></h6>
                                <p><?php echo $name ?></p>
                            </div>
                        </div>
                    </a>
                <?php } ?>

            </div>
        </div>
    </section>

    <!-- sampai disini -->
    <!-- tinggal kenangan-->

</div>

<?php
require "partition/footer.php";
?>

<script src="styledetailproduk/js/jquery-3.2.1.min.js"></script>
<script src="styledetailproduk/js/bootstrap.min.js"></script>
<script src="styledetailproduk/js/jquery.slicknav.min.js"></script>
<script src="styledetailproduk/js/owl.carousel.min.js"></script>
<script src="styledetailproduk/js/jquery.nicescroll.min.js"></script>
<script src="styledetailproduk/js/jquery.zoom.min.js"></script>
<script src="styledetailproduk/js/jquery-ui.min.js"></script>
<script src="styledetailproduk/js/main.js"></script>


</body>
</html>
