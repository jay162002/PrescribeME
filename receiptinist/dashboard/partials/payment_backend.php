<?php
    include './session.php';
    include '../../../partials/_dbconnect.php';

    $amount_paid = $_POST['amount_paid'];
    $amount_due = $_POST['amount_due'];

    $single_total_amt = $_POST['single_total_amt'];
    $all_total_amt = $_POST['all_total_amt'];
    $patient_old_new = $_POST['patient_status'];


    if($amount_paid > $single_total_amt){
        $revenue_paid_amt = $single_total_amt;
        $revenue_due_amt = 0;
    }
    else{
        $revenue_paid_amt = $amount_paid;
        $revenue_due_amt = $single_total_amt - $amount_paid;
    }



    $payment_sql = "SELECT * FROM `payment` where `t`='$token';";
    $result_payment = mysqli_query($conn,$payment_sql);
    $row_payment = mysqli_fetch_assoc($result_payment);

    if($row_payment>0){
        $user_id = $row_payment['patient_id'];
        $revenue_id = $row_payment['revenue_id'];

        $update_revenue_sql = "UPDATE `revenue` SET `paid_amt`='$revenue_paid_amt',`amt_duo`='$revenue_due_amt' WHERE `revenue_id`='$revenue_id' and `t`='$token';";
        $update_revenue_result = mysqli_query($conn,$update_revenue_sql);
    }
    else{
        $user_id = $_POST['apt_id'];
    }

    
    if($patient_old_new == 'new'){
        $insert_total_due = "INSERT INTO `patient_total_due`(`t`, `id`, `total_due_amt`) VALUES ('$token','$user_id','$amount_due')";
        $insert_total_due_result = mysqli_query($conn,$insert_total_due);
    }
    else{
        $update_total_due = "UPDATE `patient_total_due` SET `total_due_amt`='$amount_due' WHERE `id`='$user_id' and `t`='$token';";
        $update_total_due_result = mysqli_query($conn,$update_total_due);
    }


    // $checkDate = file_get_contents("./dt.txt");
    // $counter = file_get_contents("./ctr.txt");
    // $todat_payment = file_get_contents("./payment.txt");
    // $current_date = date("Y-m-d");

    // if($current_date != $checkDate){
    //     $counter = 1;
    //     $todat_payment = $single_total_amt;

    //     file_put_contents("./dt.txt", $current_date);
    //     file_put_contents("./ctr.txt", $counter);
    //     file_put_contents("./payment.txt", $todat_payment);

    // }
    // else{
    //     $intvalue = intval($counter);
    //     $counter = $intvalue + 1;
    //     file_put_contents("./ctr.txt", $counter);

    //     $todat_payment_int = intval($todat_payment);
    //     $todat_payment = $todat_payment_int + $single_total_amt;
    //     file_put_contents("./payment.txt", $todat_payment) 
    // }


    $ctr_detail_sql = "SELECT * FROM `date_check` WHERE `t`='$token';";
    $result_ctr_sql = mysqli_query($conn,$ctr_detail_sql);
    $ctr_data = mysqli_fetch_assoc($result_ctr_sql);

    $counter = $ctr_data['ctr'] + 1;
    $today_payment = $ctr_data['payment'] + $single_total_amt;


    $update_ctr_sql = "UPDATE `date_check` SET `ctr`='$counter',`payment`='$today_payment' WHERE `t`='$token';";
    $result_update_ctr = mysqli_query($conn,$update_ctr_sql);

    



    $sql_remove = "DELETE FROM appointment where `appointment_id`='$user_id' and `t`='$token';";
    $result_remove = mysqli_query($conn,$sql_remove);


    $clear_payment_sql = "DELETE FROM `payment` where `t`='$token';";
    $clear_payment_result = mysqli_query($conn,$clear_payment_sql);

    if($clear_payment_result){
        header('Location: ../index.php');
        exit();
    }
?>