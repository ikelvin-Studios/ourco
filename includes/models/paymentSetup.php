<?php
$dbCurrency = DB::query("select * from `currency_tb` order by `currency` asc");

$page = "0";
$acc_type = "";
$dbPaymentPlans = DB::query("SELECT * from `payment_plans` where `status` = 'enabled' AND `supports` = '$user_Country' or `status` = 'enabled' AND `supports` = 'all' order by `plan_name` asc");

if(isset($_POST['next_submit'])){
    //echo '<script>alert("hehy")</script>';
    $def_currency =  site::fp_clean($_POST['currency']);
    $bnamepay =  site::fp_clean($_POST['bank']);
    $uid = $userid;

    $query = DB::query("SELECT * from `payment_plans` where `status` = 'enabled' and `plan_name` = '$bnamepay' order by `plan_name` asc");

    if(DB::query("SELECT * from `payment_plans` where `status` = 'enabled' and `plan_name` = '$bnamepay'")){
        $row = DB::fetch("SELECT * from `payment_plans` where `status` = 'enabled' and `plan_name` = '$bnamepay'")[0];
        $type = $row['type'];
		$acc_type = $row['account_type'];
        $def_currency = $row['def_currency'];
        $page = $type;
		$page_type = $acc_type;
        //echo '<script>alert("hehy '.$page.'")</script>';

        $acc_type = "";
    }
}




if(isset($_POST['momo_submit'])){
    $bname = site::fp_clean($_POST['bank']);
    $aname = site::fp_clean($_POST['accName']);
    $ano = site::fp_clean($_POST['accNo']);
    // $pass= site::fp_hash($_POST['password']);
    $uid = $userid;
    // echo "<script>alert('".$bname."')</script>";
    if(empty($bname)){
        $error .='<li>Select Payment Method, it is Required!</li>';
    }
    if(empty($bname) || empty($aname) || empty($ano)){
        $error .='<li>All Fields are Required!</li>';
    }
    if(mb_strlen($ano) > 50 || mb_strlen($ano) < 10){
        $error .='<li>Account number Min. 10 Max. 50 Characters eg: 2082025121</li>';
    }

    // $cks = DB::query("SELECT * FROM `users_tb` WHERE `id`='$uid'");
    //
    // $ck = mysqli_fetch_array($cks);
    // if($ck['password'] != $pass){
    //     $error .='<li>The Password you entered Does Not Match you Account Password!</li>';
    // }

    if(empty($error)){
        if(isset($_POST['bank'])){
            $upd = DB::query("UPDATE `payment_acc_tb` SET `acc_name` = '$aname', `acc_num` = '$ano' WHERE `payment_acc_tb`.`user_id`='$userid'");

            if($upd){

                $updpay = DB::query($con,"UPDATE `user` SET `payment_method`=  '$bname', `payment_ready`= 'yes' WHERE `user`.`username` = '$userid'");

                if($updpay){
                    echo '<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span></button>
                              <strong>Well done!</strong> Payment Details Updated! <br> <a href="../" class="btn btn-default btn-block">&laquo;Back to DashBoard</a></div>';
                }
                else {
                    echo '<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span></button>
                              <strong>Oops!</strong> Cannot Update Payment Details</div>';
                }
            }

            else {
                echo '<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span></button>
                              <strong>Oops!</strong> Cannot Update Payment Info</div>';
            }

        }

   }
}


if(isset($_POST['bank_submit'])){
    $bname =  site::fp_clean($_POST['bank']);
    $aname =  site::fp_clean($_POST['accName']);
    $ano =  site::fp_clean($_POST['accNo']);
    // $pass= site::fp_hash($_POST['password']);

    $Bankname =  site::fp_clean($_POST['Bankname']);
    $bank_country =  site::fp_clean($_POST['bank_country']);

    $uid = $userid;
    // echo "<script>alert('".$bname."')</script>";
    if(empty($bname)){
        $error .='<li>Select Payment Method, it is Required!</li>';
    }
    if(empty($bname) || empty($aname) || empty($ano)){
        $error .='<li>All Fields are Required!</li>';
    }
    if ($bname =='Add Your Own Bank' && empty($Bankname) || $bname =='' && empty($bank_country)) {
        $error .='<li>All Fields are Required!</li>';
    }

    if(mb_strlen($_POST['accNo']) > 50 || mb_strlen($_POST['accNo']) < 10){
        $error .='<li>Account number Min. 10 Max. 50 Characters eg: 2082025121</li>';
    }

    if(empty($error)){
    if(isset($_POST['bank'])){

    if ($bname =='Add Your Own Bank') {
        $sql = "UPDATE `mtn_momo` SET `Account_Name` = '$aname', `Account_Number` = '$ano', `bank` = '$Bankname', `bank_country` = '$bank_country' WHERE `mtn_momo`.`wallet`='$userid'";
    } else {
        $sql = "UPDATE `mtn_momo` SET `Account_Name` = '$aname', `Account_Number` = '$ano' WHERE `mtn_momo`.`wallet`='$userid'";
    }

    $upd = mysqli_query($con,$sql) or die(mysqli_error($con));

    if($upd){

        $updpay = mysqli_query($con,"UPDATE `user` SET `payment_method`=  '$bname', `payment_ready`= 'yes' WHERE `user`.`username` = '$userid'") or die(mysqli_error($con));

        if($updpay){
            echo '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span></button>
                              <strong>Well done!</strong> Payment Details Updated! <br> <a href="../" class="btn btn-default btn-block">&laquo;Back to DashBoard</a></div>';
        }
        else {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span></button>
                              <strong>Oops!</strong> Cannot Update Payment Details</div>';
        }
    }

    else {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span></button>
                              <strong>Oops!</strong> Cannot Update Payment Info</div>';
    }


    }


   }
}


if(isset($_POST['email_submit'])){
    $bname =  site::fp_clean($_POST['bank']);
    $aname =  site::fp_clean($_POST['accName']);
    $address =  site::fp_clean($_POST['address']);
    // $pass= site::fp_hash($_POST['password']);
    $uid = $userid;
    // echo "<script>alert('".$bname."')</script>";
    if(empty($bname)){
        $error .='<li>Select Payment Method, it is Required!</li>';
    }
    if(empty($bname) || empty($aname) || empty($address)){
        $error .='<li>All Fields are Required!</li>';
    }
    if(mb_strlen($address) > 50 || mb_strlen($address) < 10){
        $error .='<li>Account number Min. 10 Max. 50 Characters eg: 2082025121</li>';
    }

    // $cks = mysqli_query($con,"SELECT * FROM `user` WHERE `username`='$uid'");
    //
    // $ck = mysqli_fetch_array($cks);
    // if($ck['password'] != $pass){
    //     $error .='<li>Your Old Password you entered Does Not Match you Account Password!</li>';
    // }

    if(empty($error)){
    if(isset($_POST['bank'])){
    $upd = mysqli_query($con,"UPDATE `mtn_momo` SET `info` = '$aname', `email` = '$address' WHERE `mtn_momo`.`wallet`='$userid'");

    if($upd){

        $updpay = mysqli_query($con,"UPDATE `user` SET `payment_method`=  '$bname', `payment_ready`= 'yes' WHERE `user`.`username` = '$userid'") or die(mysqli_error($con));

        if($updpay){
            echo '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span></button>
                              <strong>Well done!</strong> Payment Details Updated! <br> <a href="../" class="btn btn-default btn-block">&laquo;Back to DashBoard</a></div>';
        }
        else {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span></button>
                              <strong>Oops!</strong> Cannot Update Payment Details</div>';
        }
    }

    else {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span></button>
                              <strong>Oops!</strong> Cannot Update Payment Info</div>';
    }


    }


   }
}

if(isset($_POST['crypto_submit'])){
    $bname =  site::fp_clean($_POST['bank']);
    // $aname =  mysqli_real_escape_string($con,$_POST['accName']);
    $address =  site::fp_clean($_POST['address']);
    // $pass= site::fp_hash($_POST['password']);
    $uid = $userid;
    // echo "<script>alert('".$bname."')</script>";
    if(empty($bname)){
        $error .='<li>Select Payment Method, it is Required!</li>';
    }

    if(mb_strlen($address) > 100 || mb_strlen($address) < 10){
        $error .='<li>Account number Min. 10 Max. 100 Characters eg: fhdithdaptq343r8h8rb8hrdee</li>';
    }

    // $cks = mysqli_query($con,"SELECT * FROM `user` WHERE `username`='$uid'");
    //
    // $ck = mysqli_fetch_array($cks);
    // if($ck['password'] != $pass){
    //     $error .='<li>Your Old Password you entered Does Not Match you Account Password!</li>';
    // }

    if(empty($error)){
    if(isset($_POST['bank'])){
    $upd = mysqli_query($con,"UPDATE `mtn_momo` SET `address` = '$address' WHERE `mtn_momo`.`wallet`='$userid'");

    if($upd){

        $updpay = mysqli_query($con,"UPDATE `user` SET `payment_method`=  '$bname', `payment_ready`= 'yes' WHERE `user`.`username` = '$userid'") or die(mysqli_error($con));

        if($updpay){
            echo '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span></button>
                              <strong>Well done!</strong> Payment Details Updated! <br> <a href="../" class="btn btn-default btn-block">&laquo;Back to DashBoard</a></div>';
        }
        else {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span></button>
                              <strong>Oops!</strong> Cannot Update Payment Details</div>';
        }
    }

    else {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span></button>
                              <strong>Oops!</strong> Cannot Update Payment Info</div>';
    }


    }


   }
}


if(isset($_POST['api_submit'])){
    $bname = site::fp_clean($_POST['bank']);
    $aname = site::fp_clean($_POST['accName']);
    $ano = site::fp_clean($_POST['accNo']);
    // $pass= site::fp_hash($_POST['password']);
    $uid = $userid;
    // echo "<script>alert('".$bname."')</script>";
    if(empty($bname)){
        $error .='<li>Select Payment Method, it is Required!</li>';
    }
    if(empty($bname) || empty($aname) || empty($ano)){
        $error .='<li>All Fields are Required!</li>';
    }
    if(mb_strlen($ano) > 50 || mb_strlen($ano) < 10){
        $error .='<li>Account number Min. 10 Max. 50 Characters eg: 2082025121</li>';
    }

    // $cks = mysqli_query($con,"SELECT * FROM `user` WHERE `username`='$uid'");
    //
    // $ck = mysqli_fetch_array($cks);
    // if($ck['password'] != $pass){
    //     $error .='<li>Your Old Password you entered Does Not Match you Account Password!</li>';
    // }

    if(empty($error)){
    if(isset($_POST['bank'])){
    $upd = mysqli_query($con,"UPDATE `api_reference_tb` SET `service_name` = '$aname', `ref_code` = '$ano' WHERE `mtn_momo`.`wallet`='$userid'");

    if($upd){

        $updpay = mysqli_query($con,"UPDATE `user` SET `payment_method`=  '$bname', `payment_ready`= 'yes' WHERE `user`.`username` = '$userid'") or die(mysqli_error($con));

        if($updpay){
            echo '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span></button>
                              <strong>Well done!</strong> Payment Details Updated! <br> <a href="../" class="btn btn-default btn-block">&laquo;Back to DashBoard</a></div>';
        }
        else {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span></button>
                              <strong>Oops!</strong> Cannot Update Payment Details</div>';
        }
    }

    else {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span></button>
                              <strong>Oops!</strong> Cannot Update Payment Info</div>';
    }


    }


   }
}


if(!empty($error)){
echo '<center><div class="alert alert-danger alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
                              <span class="sr-only">Close</span></button>
                              <strong>Oops Error Occurs!</strong><ol>'.$error.'</ol></div></center>';
}


?>
