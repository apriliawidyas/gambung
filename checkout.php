<?php 

include 'conn.php';

if($_SESSION['status'] !="login"){
	header("location:login.php");
}



include 'partition/header.php';


$id = $_SESSION['user_id'];
$sql = "SELECT SUM(harga*kuantitas) as total,nama,gambar,harga,kuantitas,status,b.id FROM produk a JOIN cart b ON a.id = b.id_produk WHERE b.user_id = '$id' AND status = 0 GROUP BY b.id ";
$result = $conn->query($sql);
$no = 0;
$total = 0;
$voucher = "";

if(mysqli_num_rows($result) == 0){
    header("location:index.php");
}

//$parseTotal = 0;
//while($row = $result->fetch_assoc()) {
//    $parseTotal += $row['total'];
//}
$booleanvoucher = false;
if (isset($_POST['cekvoucer'])) {
    $booleanvoucher = true;
    $sql = "SELECT SUM(harga*kuantitas) as total,nama,gambar,harga,kuantitas,status,b.id FROM produk a JOIN cart b ON a.id = b.id_produk WHERE b.user_id = '$id' AND status = 0 GROUP BY b.id ";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        $total += $row['total'];
    }

    $kode = $_POST['voucher'];
    $sql = "SELECT * FROM voucher WHERE kode = '$kode'";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        $total = $total - $total*$row['diskon'];
        $discount = $row['diskon']*100;
        $voucher = $kode;

    }
}



include 'partition/nav.php';

 ?>

<body>
	<div class="container">

		<form class="checkout_container" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
							<?php

                            $sql = "SELECT SUM(harga*kuantitas) as total,nama,gambar,harga,kuantitas,status,b.id FROM produk a JOIN cart b ON a.id = b.id_produk WHERE b.user_id = '$id' AND status = 0 GROUP BY b.id ";
                            $result = $conn->query($sql);

                            while($row = $result->fetch_assoc()){
									$name = $row['nama'];
									$image = $row['gambar'];
									$price = $row['harga'];
									$kuantitas = $row['kuantitas'];
									$id = $row['id']; 
									$no++;
									if(!$booleanvoucher) {
                                        $total += $row['total'];
                                    }

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
                    <h4>Voucher</h4>

                    <input type="text" class="form-control" value="<?php echo $voucher ?>" name="voucher"><br>
                    <button class="btn btn-warning" style="width: 150px; color: white; font-weight: bold;" name="cekvoucer" type="submit">Cek Voucer</button>

				</div>
			</div>

			<!-- detail -->
			<div class="row bg-light">
				<div class="col-lg-12" style="text-align: right;">

					<h4>Total Pembayaran</h4>
                    <?php if ($voucher == ""){ ?>

					<h3 style="font-size: 40px; color: #4C9A2A; padding: 5px 0px;"><?php echo $total ?></h3>
                    <?php } else { ?>
                        <h5>Discount : <?php echo $discount ?>%</h5>

                        <h3 style="font-size: 40px; color: #4C9A2A; padding: 5px 0px;"><?php echo $total ?></h3>
                    <?php } ?>
					<button class="btn btn-warning" style="width: 200px; color: white; font-weight: bold;" name="payment" type="submit">Buat Pesanan</button>

				</div>
			</div>
		</form>
	</div>

<?php

if(isset($_POST['payment'])){
    $kode = $_POST['voucher'];
    $sql = "SELECT * FROM voucher WHERE kode = '$kode'";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        $total = $total - $total*$row['diskon'];
    }


    $user_id = $_SESSION['user_id'];
    $sql = "UPDATE cart SET status = 1 WHERE user_id = '$user_id'";
    $exec = $conn->query($sql);
    if($exec){


        $sql = "INSERT INTO transfer VALUES(null, '$user_id', '$total',0,0,'0000-00-00')";
        $exec = $conn->query($sql);
        if($exec) {
            echo"<script type='text/javascript'>
            alert('Berhasil Checkout');
            window.location.href='transfer.php';
             </script>";
        }else{
            echo"<script type='text/javascript'>
            alert('parse');
             </script>";
        }
    }else{
        echo"<script type='text/javascript'>
        alert('Gagal checkout');
         </script>";
    }
}

include 'partition/footer.php';

 ?>

</body>