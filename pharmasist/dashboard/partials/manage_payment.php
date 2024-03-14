<?php
    include './session.php';
    include '../../../partials/_dbconnect.php';

    $pres_id = $_POST['presc_id'];
    $total_amt = $_POST['total_amt'];
    $med_prices = $_POST['med_inputs'];
    $med_prices_str = implode(',', $med_prices);

    

    $fetch_pharmacist_sql = "SELECT * FROM `pharmacist_dashboard` WHERE pres_id='$pres_id' and `t`='$token';";
    $fetch_pharmacist_result = mysqli_query($conn,$fetch_pharmacist_sql);

    $row = mysqli_fetch_assoc($fetch_pharmacist_result);

    $user_id = $row['id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $phone = $row['phone_no'];
    $date = $row['appt_date'];

    // $checkDate = file_get_contents("./dt.txt");
    // $counter = file_get_contents("./ctr.txt");
    // $todat_payment = file_get_contents("./payment.txt");
    // $current_date = date("Y-m-d");

    // if($current_date != $checkDate){
    //     $counter = 1;
    //     $todat_payment = $total_amt;

    //     file_put_contents("dt.txt", $current_date);
    //     file_put_contents("ctr.txt", $counter);
    //     file_put_contents("payment.txt", $todat_payment);

    // }
    // else{
    //     $intvalue = intval($counter);
    //     $counter = $intvalue + 1;
    //     file_put_contents("ctr.txt", $counter);

    //     $todat_payment_int = intval($todat_payment);
    //     $todat_payment = $todat_payment_int + $total_amt;
    //     file_put_contents("payment.txt", $todat_payment);
     
    // }
    $ctr_detail_sql = "SELECT * FROM `date_check_pharma` WHERE `t`='$token';";
    $result_ctr_sql = mysqli_query($conn,$ctr_detail_sql);
    $ctr_data = mysqli_fetch_assoc($result_ctr_sql);

    $counter = $ctr_data['ctr'] + 1;
    $today_payment = $ctr_data['payment'] + $total_amt;


    $update_ctr_sql = "UPDATE `date_check_pharma` SET `ctr`='$counter',`payment`='$today_payment' WHERE `t`='$token';";
    $result_update_ctr = mysqli_query($conn,$update_ctr_sql);





    $insert_revenue_sql = "INSERT INTO `pharmacist_revenue`(`t`, `pres_id`, `id`, `fname`, `lname`, `phone_no`, `date`, `med_fees`, `total_amt`) VALUES ('$token','$pres_id','$user_id','$fname','$lname','$phone','$date','$med_prices_str','$total_amt')";
    $insert_revenue_result = mysqli_query($conn,$insert_revenue_sql);

    $remove_sql = "DELETE FROM pharmacist_dashboard where `pres_id`='$pres_id' and `t`='$token';";
    $remove_result = mysqli_query($conn,$remove_sql);

    if($remove_result){
        header('Location: ../index.php');
        exit();
    }

?>