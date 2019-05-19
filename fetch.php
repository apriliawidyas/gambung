<?php
include 'conn.php';

$id = $_SESSION['user_id'];

if(isset($_POST['view'])){


if($_POST["view"] != '')
{
    $update_query = "UPDATE notif SET notif_status = 1 WHERE notif_status = 0 AND user_id = '$id'";
    mysqli_query($conn, $update_query);
}
$query = "SELECT * FROM notif WHERE user_id = '$id' ORDER BY notif_id DESC LIMIT 5";
$result = mysqli_query($conn, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_array($result))
 {
   $output .= '
   <li style="text-align:center; padding: 10px 30px;">
   <a href="#" >
   <strong>'.$row["notif_judul"].'</strong><br/>
   <small><em>'.$row["notif_text"].'</em></small>
   </a>
   </li>
   ';

 }
}
else{
     $output .= '
     <li><a href="#" class="text-bold text-italic">Tidak ada notifikasi</a></li>';
}

$status_query = "SELECT * FROM notif WHERE notif_status=0 AND user_id = '$id'";
$result_query = mysqli_query($conn, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
    'notification' => $output,
    'unseen_notification'  => $count
);

echo json_encode($data);

}

?>