<?php 

include '../conn.php';

if($_SESSION['status'] !="login"){
	header("location:../index.php");
}

include '../partition/header.php';


?>
<link rel="icon" href="../image/gambung.png">
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/style.css">

<?php 

include '../partition/nav.php';

 ?>

<body>

	<div class="cart container">
		<div class="row">
			<div class="col-lg-12">
				<h1>Keranjang Belanja</h1>
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
						<?php for ($i=0; $i < 3; $i++) { 
							?>
							<tr>
								<th scope="row">
									<input type="checkbox" class="form-check-input" id="exampleCheck1">
								</th>
								<td class="nama_produk">
									<img src="../image/gambung.png" height="150px" width="150px">
									<span>Kopi</span>
								</td>
								<td>Rp 20.000</td>
								<td>
									<button class="btn btn-danger increment">-</button>
									5
									<button class="btn btn-primary increment ">+</button>
								</td>
								<td>Rp 100.000</td>
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
								<a href="checkout.php"><button class="btn btn-warning" style="font-weight: bold; color: white;">CHECKOUT</button>
								</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<?php 

include '../partition/footer.php';

 ?>

</body>