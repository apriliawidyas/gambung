<?php 
include 'conn.php';
if($_SESSION['status'] !="login"){
	header("location:login.php");
}

	$id = $_SESSION['user_id'];
	$sql = "SELECT SUM(harga*kuantitas) as total,nama,gambar,harga,kuantitas,status,b.id FROM produk a JOIN cart b ON a.id = b.id_produk WHERE b.user_id = '$id' AND status = 0 GROUP BY b.id ";
	$result = $conn->query($sql);

$total = 0;

	if($result->num_rows == 0){	
		header("Location:index.php");
	}

	//pending
    if(isset($_GET['increment'])){
        $iniid = $_GET['increment'];
        $sql = "SELECT kuantitas FROM cart WHERE id = '$iniid'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $kuantitas = $row['kuantitas'];
        $kuantitas = $kuantitas + 1;

        $sql = "UPDATE cart SET kuantitas = '$kuantitas' WHERE id = '$iniid'";
        if($conn->query($sql) === TRUE){
            header("Location:cart.php");
        }else{
            echo 'gagal';
        }
    }else {

    }

if(isset($_GET['decrement'])){
    $iniid = $_GET['decrement'];
    $sql = "SELECT kuantitas FROM cart WHERE id = '$iniid'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $kuantitas = $row['kuantitas'];
    $kuantitas = $kuantitas - 1;

    $sql = "UPDATE cart SET kuantitas = '$kuantitas' WHERE id = '$iniid'";
    if($conn->query($sql) === TRUE){
        header("Location:cart.php");
    }else{
        echo 'gagal';
    }
}else {

}


	if(isset($_POST['checkout'])){
		header("Location:checkout.php");
	}


        if(isset($_GET['deleteId'])){
            $iniid = $_GET['deleteId'];
            $sql = "DELETE FROM cart WHERE id = '$iniid'";
            if($conn->query($sql) === TRUE){
                header("Location:cart.php");
            }else{
                echo 'gagal';
            }
        }else {

        }


include 'partition/header.php';


?>

<link rel="icon" href="image/gambung.png">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">

<?php 

include 'partition/nav.php';

?>

<body>

	<div class="cart container">
		<div class="row">
			<div class="col-lg-12">
				<h1>Keranjang Belanja</h1>
<!--				<form action="--><?php //echo $_SERVER['PHP_SELF']; ?><!--" method="get">-->
				<table class="table">
					<thead>
						<tr>
<!--							<th scope="col">Pilih</th>-->
							<th scope="col">Produk</th>
							<th scope="col">Harga</th>
							<th scope="col">Kuantitas</th>
							<th scope="col">Total</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php while($row = $result->fetch_assoc()){

                                $name = $row['nama'];
                                $image = $row['gambar'];
                                $price = $row['harga'];
                                $kuantitas = $row['kuantitas'];
                                $id = $row['id'];
//                                $status = $row['status'];
                                $total += $row['total'];

                            ?>
							<tr>
<!--								<th scope="row">-->
<!--									<input type="checkbox" class="form-check-input" id="exampleCheck1">-->
<!--								</th>-->
								<td class="nama_produk">
									<img src="images/<?php echo $image ?>" height="150px" width="150px">
									<span><?php echo"$name" ?></span>
								</td>
								<td><?php echo"$price" ?></td>
								<td>
                                    <a href="<?php echo '?decrement='.$row['id']; ?>"><button class="btn btn-danger increment">-</button></a>
                                    <?php echo"$kuantitas" ?>
                                    <a href="<?php echo '?increment='.$row['id']; ?>"><button class="btn btn-primary increment">+</button></a>
								</td>
								<td><?php  echo $row['total']; ?></td>
								<td>
                                    <a href="<?php echo '?deleteId='.$row['id']; ?>"><button class="btn btn-danger">Hapus</button></a>
								</td>
							</tr>

						<?php } ?>
						<tr>
<!--							<th scope="row">-->
<!--								<p>Input Semua</p>-->
<!--								<input type="checkbox" class="form-check-input" id="exampleCheck1">-->
<!--							</th>-->
							<td></td>
							<td></td>
							<td></td>

							<td><strong><?php echo $total; ?></strong></td>
							<td>
                                <a href="checkout.php"><button name="checkout" class="btn btn-warning" style="font-weight: bold; color: white;">CHECKOUT</button></a>
							</td>
						</tr>
					</tbody>
				</table>
<!--				</form>-->
			</div>
		</div>
	</div>

<?php 

include 'partition/footer.php';

 ?>

</body>