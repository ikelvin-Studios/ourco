<?php
    // echo '<script>alert("hey");</script>';
   // include 'includes/classes/function.php';
            // echo '<div class="container">
            //     <div class="row">
            //     <div class="col-lg-6 col-lg-offset-3">';
    if(isset($_POST['signup'])) {
        // echo '<script>alert("hey");</script>';
        //$raw_phone =  site::fp_clear($_POST['phone']);
        $uphone	= site::fp_clear($_POST['full_phone']);
        $ufullname = site::fp_clear($_POST['fullNames']);
        // $lname = site::fp_clear($_POST['lastNames']);
        // $uname = site::fp_clear($_POST['userNames']);
        $uemail = site::fp_clear($_POST['email']);
        $upass = site::fp_hash($_POST['password']);
        $upass2 = site::fp_hash($_POST['password2']);
        $ucountry	= site::fp_clear($_POST['country']);
        $ugender	= site::fp_clear($_POST['gender']);
        $udob = site::fp_clear($_POST['dob']);
        $promoCode = site::fp_clear($_POST['promo']);
        $ubonus = 0;

        //$uwhatsapp = site::fp_clear($_POST['whatsapp']);

        // $upay_type = site::fp_clear($_POST['pay_type']);
        // $uacc_type = site::fp_clear($_POST['acc_type']);
        // $ureg_name = site::fp_clear($_POST['reg_name']);
        // $ureg_num = site::fp_clear($_POST['reg_num']);

        $rgd = date('Y/m/d');


        $error .= (DB::count("SELECT `email` FROM `users_tb` WHERE `email` = '$uemail' AND `user_id` = '$userid'") > 0) ? '<li> Email Already Exists!   </li>' : '' ;

        // $error .= (DB::count("SELECT `username` FROM `users_tb` WHERE `username`='$uname'") > 0) ? '<li> Username Already Exists!   </li>' : '' ;

        // $error .= (DB::count("SELECT `phone` FROM `login_tb` WHERE `phone`='$uphone'") > 0) ? '<li> Phone Already Exists!   </li>' : '' ;
       // echo '<script>alert("whey '.$error.'");</script>';

        if(empty($ufullname) || empty($upass) || empty($uphone) || empty($uemail) || empty($ucountry)){
            $error .='<li>All Fields are Required!</li>';
        }
        if(mb_strlen($ufullname) > 130){
            $error .='<li>Full Name Cannot be more than 130 Characters!</li>';
        }
        // if(mb_strlen($uname) > 15){
        //     $error .='<li>Username Cannot be more than 15 Characters!</li>';
        // }
        if($upass != $upass2){
        $error .='<li>Password do not Match!</li>';
        }
        if(mb_strlen($_POST['phone']) > 15 || mb_strlen($_POST['phone']) < 5){
            $error .='<li>Enter Your Correct Phone Number</li>';
        }
        // if(mb_strlen($_POST['whatsapp']) > 10 || mb_strlen($_POST['whatsapp']) < 9){
        //     $error .='<li>Phone number Min. 8 Max. 14 Characters eg: 023456789</li>';
        // }
       // echo '<script>alert("ohey '.$error.'");</script>';
        if(empty($error)){
           // echo '<script>alert("ehey");</script>';
            DB::query("UPDATE `users_tb` SET  `email`='$uemail',`name`='$ufullname',`mobile`='$uphone',`country`='$ucountry',`reg_date`='$rgd',`gender`='$ugender',`dob`='$udob' WHERE `user_id`='$userid'") or die(mysqli_error($pdo));

            DB::query("UPDATE `login_tb` SET `password`='$upass' WHERE `user_id`='$userid'") or die(mysqli_error($pdo));

            // DB::query("INSERT INTO `referal_tb` (`referer`, `referee`) VALUES ('$referer', '$u_id');");
            // TODO: wallet
            DB::query("UPDATE `wallet` SET `bonus`='$ubonus' WHERE `user_id`='$userid';");

            // TODO: payment_acc_tb
            // DB::query("INSERT INTO `payment_acc_tb` (`user_id`) VALUES ('$u_id');");

            // TODO: status_tb
            $upd = DB::query("UPDATE `status_tb` SET `is_setup`=  `is_setup`+1, `payment_ready`= 'yes' WHERE `status_tb`.`user_id` = '$userid'");

            // TODO: timeline_tb
            DB::query("INSERT INTO `timeline_tb` (`user_id`,`activity`,`act_type`) VALUES ('$userid','Account setup','acc');");

            // TODO: nok
            // DB::query("INSERT INTO `nok_tb` (`user_id`) VALUES ('$u_id');");

            // DB::query("INSERT INTO `user_paymethod_tb` (`method_id`, `acc_type`, `user_id`, `reg_name`, `reg_number` ) VALUES ('$upay_type', '$uacc_type', '$u_id', '$ureg_name', '$ureg_num');");
            //


            if($upd){
              header('location: ../setup');
              exit;
                echo '<script>alert("Registration was Succesful, Please Proceed to Login");window.location.assign("login");</script>';
            }
        } else {
            echo '<script>alert("ERROR: '.$error.'");</script>';
        }


        // echo '</div>
        //         </div>
        //         </div>';
    }

?>
