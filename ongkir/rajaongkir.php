<?php

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

function countPrice($origin, $destination, $courier = "jne", $weight)
{
    echo $origin." ".$destination." ".$courier." ".$weight;
    $request = "origin=$origin&destination=$destination&weight=$weight&courier=$courier";

    $data = curl("https://api.rajaongkir.com/starter/cost", "POST", $request);
    var_dump($data);
    return $data;
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <?php if (!empty($_POST)): ?>
        <div>
            <?php $hasil = countPrice($_POST['kotaAsal'], $_POST['kotaTujuan'], $_POST['kurir'], $_POST['weight']);?>
            <?php foreach ($hasil as $result): ?>
                <h3>Hasil</h3>
                <h4>Nama Ekspedisi: <?php echo $result['name'] ?></h4>
                    <?php foreach ($result['costs'] as $harga): ?>
                        <h5>Paket: <?php echo $harga['service'] ?> - <?php echo $harga['description'] ?></h5>
                        <h5>Harga: <?php echo $harga['cost'][0]['value'] ?></h5>    <!--kali berat-->
                        <h5>Waktu sampai: <?php echo $harga['cost'][0]['etd'] ?> hari</h5>
                        <hr>
                    <?php endforeach;?>
            <?php endforeach;?>
        </div>
    <?php endif;?>

    <form method="POST">

        <div>
            Kota asal:<br>
            <select name="kotaAsal">
                <?php foreach (getDataKota() as $result): ?>
                    <option value="<?php echo $result['city_id'] ?>"><?php echo $result['city_name'] ?></option>
                <?php endforeach;?>
            </select>
        </div>

        <div>
            Kota tujuan:<br>
            <select name="kotaTujuan">
                <?php foreach (getDataKota() as $result): ?>
                    <option value="<?php echo $result['city_id'] ?>"><?php echo $result['city_name'] ?></option>
                <?php endforeach;?>
            </select>
        </div>

        <div>
            Kurir:<br>
            <select name="kurir">
                <option value="jne">TIKI</option>
                <option value="tiki">JNE</option>
            </select>
        </div>

        <div>
            Berat barang: <br>
            <input type="text" name="weight" placeholder="Berat Barang">
        </div>

        <div>
            <input type="submit">
        </div>
    </form>

</body>
</html>
