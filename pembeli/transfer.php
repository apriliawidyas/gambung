<?php 

include '../conn.php';

if($_SESSION['status'] !="login"){
	header("location:../index.php");
}

include '../partition/header.php';



?>
<link rel="icon" href="../image/image.png">
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/style.css">

<?php 

include '../partition/nav.php';

 ?>

<body>
	<div class="container">
		<div class="row pembayaran bg-light">
			<div class="col-lg-12">
				<h1>Pembayaran</h1>
				<p style="text-align: center;">Silahkan transfer sesuai dengan nominal dan sertakan kode transaksi berikut</p>
				<h1 style="font-weight: bold; color: orange;">56DSG2749HH</h1>
				<h4>Tata cara pembayaran</h4>
				<ul>
					<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua.</li>
					<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat.</li>
					<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua.</li>
				</ul>
			</div>
		</div>
	</div>
<?php 

include '../partition/footer.php';

 ?>


</body>