<?php
require "conn.php";
require "partition/header.php";

?>

<!-- Stylesheets -->
<!--	<link rel="stylesheet" href="styledetailproduk/css/bootstrap.min.css"/>-->
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


	<!-- Contact section -->
	<section class="contact-section" style="margin: 50px;">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 contact-info">
					<h3>Kontak</h3>
					<p>Jalan</p>
					<p>No Telp</p>
					<p>Email</p>
					<div class="contact-social">
						<a href="#"><i class="fa fa-instagram"></i></a>
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-google-plus"></i></a>
					</div>
					<form class="contact-form">
						<input type="text" placeholder="Nama">
						<input type="text" placeholder="Email">
						<textarea placeholder="Saran / Pesan"></textarea>
						<button class="site-btn">KIRIM</button>
					</form>
				</div>
			</div>
		</div>
		<div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63348.78346519294!2d107.40805929731508!3d-7.091301712732746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e688b432de520d3%3A0x401e8f1fc28c530!2sCiwidey%2C+Bandung%2C+West+Java!5e0!3m2!1sen!2sid!4v1556550295703!5m2!1sen!2sid" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe></div>
	</section>
	<!-- Contact section end -->


    <?php
    require "partition/footer.php";
    ?>


	</body>
</html>
