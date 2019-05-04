<?php 

include 'conn.php';

if($_SESSION['status'] !="login"){
	header("location:login.php");
}

//ongkir
function curl($url, $type = "GET", $request = null) // TODO:: change this implementation later, not efficient.

{
    $key = "d631df6429af64d03766ca8ec46be886";
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $type,
        CURLOPT_POSTFIELDS => $request,
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "Key: $key",
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $data = json_decode($response, true);

    if ($err) {

        die("Failed to get response");
    }


    return $data['rajaongkir']['results'];
}

function getDataKota()
{
    $data = curl("http://api.rajaongkir.com/starter/city");

    return $data;
}

function countPrice($origin, $destination, $courier, $weight)
{
    $request = "origin=$origin&destination=$destination&weight=$weight&courier=$courier";

    $data = curl("https://api.rajaongkir.com/starter/cost", "POST", $request);


    return $data;
}

function getAlamat($conn,$id){
    $sql = "SELECT * FROM user WHERE id = '$id'";
    $result = $conn->query($sql);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        echo  "<p>".$row['kota'].", ".$row['alamat']."</p>";
    }else{
        echo "
        <p>Alamat anda belum terdaftar</p>
        <a href='editprofile.php'></a><button class='btn btn-warning' style='width: 200px; color: white; font-weight: bold;' name='alamat' type='button'>Masukan Alamat</button>";
    }
}


include 'partition/header.php';


$id = $_SESSION['user_id'];
$sql = "SELECT SUM(harga*kuantitas) as total,nama,gambar,harga,kuantitas,status,b.id FROM produk a JOIN cart b ON a.id = b.id_produk WHERE b.user_id = '$id' AND status = 0 GROUP BY b.id ";
$result = $conn->query($sql);
$no = 0;
$total = 0;
$voucher = "";
$harga = 0;



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

    $_SESSION['voucher'] = $kode;

    $sql = "SELECT * FROM voucher WHERE kode = '$kode'";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        $total = $total - $total*$row['diskon'];
        $discount = $row['diskon']*100;
        $voucher = $kode;
    }else{
        echo"<script type='text/javascript'>
        alert('kode voucher tidak ada');
        window.location.href='checkout.php';
        </script>";
    }
}


function getKota($conn,$id){
    $sql = "SELECT * FROM user WHERE id = '$id'";
    $result = $conn->query($sql);
    $kota;
    $id_kota;
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $kota = $row['kota'];
    }
    foreach (getDataKota() as $result){
        if($result['city_name'] == $kota){
            $id_kota = $result['city_id'];
            break;
        }
    }

    return $id_kota;


}

function getBerat($conn,$id){
    $sql = "SELECT * FROM user WHERE id = '$id'";
    $result = $conn->query($sql);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        return $row['kota'];
    }
}

$kurir = null;
if (isset($_POST['kurir'])) {
    $kurir = strtolower($_POST['kurir']);
//    include 'ongkir/rajaongkir.php';
    $kota = getKota($conn, $_SESSION['user_id']);
    $hasil = countPrice(22, 1, $kurir, 1);


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
                    <?php getAlamat($conn,$_SESSION['user_id']); ?>
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
                 <th scope="row"><?php echo $no ?></th>
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
     <select class="form-control" onchange="this.form.submit()" name="kurir">
        <?php if ($kurir == null){ ?>
            <option>Pilih Kurir</option>
            <option value="jne">JNE</option>
            <option value="tiki">TIKI</option>
        <?php } else if($kurir == "jne"){ ?>
            <option value="jne">JNE</option>
            <option value="tiki">TIKI</option>
        <?php } else if($kurir == "tiki"){ ?>
            <option value="tiki">TIKI</option>
            <option value="jne">JNE</option>
        <?php } else { ?>
            <option>Pilih Kurir</option>
            <option value="jne">JNE</option>
            <option value="tiki">TIKI</option>
        <?php } ?>
    </select>


    <?php if(!empty($hasil)): ?>
        <h4>Ongkir : </h4>
        <!--                    selection-->

        <?php foreach ($hasil as $result): ?>
            <?php foreach ($result['costs'] as $harga): ?>

                <?php if($harga['service'] == "REG"){

                    $nama = $result['name'];
                    $paket = $harga['service'];
                    $desc = $harga['description'];
                    $harga = $harga['cost'][0]['value'];

                    $_SESSION['ongkir'] = $harga;

                    $waktu = $harga['cost'][0]['etd'];

                }
                ?>

            <?php endforeach;?>
        <?php endforeach;?>

        <h6>Nama Ekspedisi: <?php echo $nama; ?></h6>
        <h6>Paket: <?php echo $paket; ?> - <?php echo $desc; ?></h6>
        <h6>Harga: <?php echo $harga; ?></h6>
        <h6>Waktu sampai: <?php echo $waktu; ?> hari</h6>

    <?php endif; ?>

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

         <h3 style="font-size: 40px; color: #4C9A2A; padding: 5px 0px;"><?php echo $total + $harga?></h3>
     <?php } else { ?>
        <h5>Discount : <?php echo $discount ?>%</h5>

        <h3 style="font-size: 40px; color: #4C9A2A; padding: 5px 0px;"><?php echo $total + $harga?></h3>
    <?php } ?>
    <button class="btn btn-warning" style="width: 200px; color: white; font-weight: bold;" name="payment" type="submit">Buat Pesanan</button>

</div>
</div>
</form>
</div>

<?php

if(isset($_POST['payment'])){
    if ($kurir == "pilih kurir"){
        $kurir = null;
        echo"<script type='text/javascript'>
        alert('Pilih Kurir Terlebih Dahulu');
        window.location.href='checkout.php';
        </script>";
    }else{

       $kode = $_POST['voucher'];
       $sql = "SELECT * FROM voucher WHERE kode = '$kode'";
       $result = $conn->query($sql);
       if ($row = $result->fetch_assoc()) {
        $total = $total - $total*$row['diskon'];
    }
    $total = $total + $_SESSION['ongkir'];

    $user_id = $_SESSION['user_id'];
    $time = date('h:i:a', time());
    $sql = "INSERT INTO transfer VALUES(null, '$user_id', '$total',0,0,'0000-00-00','$time')";  
    $exec = $conn->query($sql);

    $sql = "SELECT * FROM transfer WHERE date_upload = '0000-00-00' && id_user = '$user_id' && total = '$total' && status_upload = 0 && status_verifikasi = 0";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $id_transfer = $row['id_transfer'];

    if($exec){
        $sql = "UPDATE cart SET status = 1, id_transfer = '$id_transfer'WHERE user_id = '$user_id' && id_transfer = 0";
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
    $_SESSION['ongkir'] = 0;
}
}

include 'partition/footer.php';


?>



</body>