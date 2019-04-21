<?php 

include 'conn.php';

if($_SESSION['status'] !="login"){
	header("location:index.php");
}

include 'partition/header.php';


$id = $_SESSION['user_id'];
$sql = "SELECT * FROM produk a JOIN cart b ON a.id = b.id_produk WHERE b.user_id = '$id'";
$result = $conn->query($sql);
$no = 0;

?>
<link rel="icon" href="image/gambung.png">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">

<?php 

include 'partition/nav.php';

 ?>

<body>
	<div class="container">

		<form class="checkout_container">
			<h1>Checkout Pembayaran</h1>
			<!-- alamat -->
			<div class="row bg-light">
				<div class="col-lg-12">
					<h4>Alamat</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat.</p>
				</div>
			</div>
			<!-- list barang -->
			<div class="row bg-light">
				<div class="col-lg-12">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Pilih</th>
								<th scope="col">Produk</th>
								<th scope="col">Harga</th>
								<th scope="col">Kuantitas</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
							<?php while($row = $result->fetch_assoc()){
									$name = $row['nama'];
									$image = $row['gambar'];
									$price = $row['harga'];
									$kuantitas = $row['kuantitas'];
									$id = $row['id']; 
									$no++;
								?>
								<tr>
									<th scope="row">
										<?php echo $no ?>
									</th>
									<td class="nama_produk">
										<img src="images/<?php echo $image ?>" height="150px" width="150px">
										<span><?php echo $name ?></span>
									</td>
									<td><?php echo $price ?></td>
									<td>
									<?php echo $kuantitas ?>
									</td>
									<td><?php echo $price*$kuantitas ?></td>
								</tr>

							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<!-- pengiriman -->
			<div class="row bg-light">
				<div class="col-lg-12">
					<h4>Pilih Pengiriman</h4>
					<select class="form-control">
						<option>JNE</option>
						<option>TIKI</option>
					</select>
					<h4>Pilih Payment Method</h4>
					<select class="form-control">
						<option>Transfer via Alfamart</option>
						<option>Transfer via Bank</option>
					</select>
				</div>
			</div>

			<!-- detail -->
			<div class="row bg-light">
				<div class="col-lg-12" style="text-align: right;">
					<h4>Total Pembayaran</h4>
					<h3 style="font-size: 40px; color: #4C9A2A; padding: 5px 0px;">Rp 300.000</h3>
					<a href="transfer.php"><button class="btn btn-warning" style="width: 200px; color: white; font-weight: bold;s">Buat Pesanan</button>
					</a>
				</div>
			</div>
		</form>
	</div>

<?php 

include 'partition/footer.php';

 ?>

</body>