<?php
$mustSettle = 'no';
if($powerstatus['badge'] == '2019') {
  $mustSettle = (DB::query("SELECT * FROM `settlement_tb` WHERE `user_id`='$userid'")) ? 'yes' : 'no';
}

if($mustSettle == 'yes') {
  $settlement = DB::fetch("SELECT * FROM `settlement_tb` WHERE `user_id`='$userid'")[0];
}

// $requests_no = DB::count("SELECT * FROM `requests_tb` WHERE `from_id` = '$userid' AND `status` = 'issued' OR `to_id` = '$userid' AND `status` = 'confirmed'");
// if ($requests_no > 0) {
// $requests_tb = DB::fetch("SELECT * FROM `requests_tb` WHERE `from_id` = '$userid' AND `status` = 'issued' OR `to_id` = '$userid' AND `status` = 'confirmed'");
// }

$referals = DB::fetch("SELECT * FROM `referal_tb` WHERE `referee`='$userid' OR `referer`='$userid'");
$dbreferals = DB::query('SELECT referal_tb.referer, referal_tb.referee, referal_tb.status, users_tb.`username` FROM users_tb, referal_tb
WHERE users_tb.id = referal_tb.referer
AND referal_tb.referee = :userid
OR users_tb.id = referal_tb.referee
AND referal_tb.referer = :userid;', array(':userid'=>$userid));
// print_r($referals);
$dbUserActs = DB::query('SELECT id, activity, act_time, status FROM timeline_tb
WHERE user_id = :userid ORDER BY id DESC;', array(':userid'=>$userid));
?>

<?php
//echo '<script> alert("hey '.print_r($requests_tb).'")</script>';
if(isset($_POST["proof-submit"])) {
    img::upload('fileToUpload');
// $img1 = img::upload('fileToUpload');
// db_insert($img1, $code);
}

?>
