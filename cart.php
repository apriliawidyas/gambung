<?php 
include 'conn.php';
if($_SESSION['status'] !="login"){
	header("location:login.php");
}

	$id = $_SESSION['user_id'];
	$sql = "SELECT * FROM produk a JOIN cart b ON a.id = b.id_produk WHERE b.user_id = '$id'";
	$result = $conn->query($sql);

	if($result->num_rows == 0){	
		header("Location:index.php");
	}

	//pending
	if(isset($_POST['btntambah'])){
		$kuantitas = $kuantitas + 1;
		$sql = "UPDATE cart SET kuantitas = '$kuantitas' WHERE id = '$id'";
		if($conn->query($sql) === TRUE){
			header("Location:cart.php");
		}else{

			header("Location:index.php");
		}
	}
	  
	if(isset($_POST['checkout'])){
		header("Location:checkout.php");
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
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Pilih</th>
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
						?>
							<tr>
								<th scope="row">
									<input type="checkbox" class="form-check-input" id="exampleCheck1">
								</th>
								<td class="nama_produk">
									<img src="images/<?php echo $image ?>" height="150px" width="150px">
									<span><?php echo"$name" ?></span>
								</td>
								<td><?php echo"$price" ?></td>
								<td>
									<button class="btn btn-danger increment" name="kurang">-</button>
                                    <?php echo"$kuantitas" ?>
									<button class="btn btn-primary increment " name="btntambah">+</button>
								</td>
								<td><?php echo $kuantitas*$price ?></td>
								<td>
									<button class="btn btn-danger">Hapus</button>
								</td>
							</tr>

						<?php } ?>
						<tr>
							<th scope="row">
								<p>Input Semua</p>
								<input type="checkbox" class="form-check-input" id="exampleCheck1">
							</th>
							<td></td>
							<td></td>
							<td></td>
							<td><strong>Rp 300.000</strong></td>
							<td>
								<button name="checkout" class="btn btn-warning" style="font-weight: bold; color: white;">CHECKOUT</button>
							</td>
						</tr>
					</tbody>
				</table>
				</form>
			</div>
		</div>
	</div>

<?php 

include 'partition/footer.php';

 ?>

</body>