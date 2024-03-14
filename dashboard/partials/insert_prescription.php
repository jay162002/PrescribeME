<?php

    include './session.php';

    if(isset($_POST['end_consultaion'])){

        include '../../partials/_dbconnect.php';

        // !patient id
        $user_id = $_POST['user_id'];

        // !Fetch data from appointment table

        $sql_appointments = "SELECT * FROM `appointment` WHERE appointment_id='$user_id' and `t`='$token';";
        $result_appointments = mysqli_query($conn,$sql_appointments);
        
        $row = mysqli_fetch_assoc($result_appointments);
        $patient_status = $row['status'];

        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $phone_no = $row['phone_no'];
        $gender = $row['gender'];
        $dob = $row['dob'];
        $last_visit = $row['appt_date'];
        $appt_time = $row['appt_time'];

        // !ctr value

        $ctr_fetch = "SELECT * FROM `counter` WHERE `t`='jdtwitter1602@gmail.com'";
        $result_ctr = mysqli_query($conn,$ctr_fetch);

        $row_ctr = mysqli_fetch_assoc($result_ctr);

        $counter = $row_ctr['ctr'];
        $counter += 1;

        $insert_ctr_sql = "UPDATE `counter` SET `ctr`='$counter' WHERE `t`='jdtwitter1602@gmail.com';";
        $result_insert_ctr = mysqli_query($conn,$insert_ctr_sql);

        
        // !add vitals
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $pulse = $_POST['pulse'];
        $temperature = $_POST['temp'];
        $bp = $_POST['bp'];

        $vitals_sql = "INSERT INTO `prescription_vitals` (`t`,`pres_id`, `id`, `weight`, `height`, `pulse`, `temperature`, `bp`, `date`) VALUES ('$token','$counter', '$user_id', '$weight', '$height', '$pulse', '$temperature', '$bp', '$last_visit');";
        $vitals_result = mysqli_query($conn,$vitals_sql);

        // !add complain

        $complain = $_POST['complain-0-'];
        $complain_str = implode(',', $complain);

        // !dont uncomment
        // $array = explode(',', $string);
        // print_r($complain);

        $frequency_complain = $_POST['frequency-0-'];
        $frequency_complain_str = implode(',', $frequency_complain);

        $severity_complain = $_POST['severity-0-'];
        $severity_complain_str = implode(',', $severity_complain);
        
        $duration_complain = $_POST['duration-0-'];
        $duration_complain_str = implode(',', $duration_complain);


        $complain_sql = "INSERT INTO `prescription_complain` (`t`,`pres_id`,`id`, `complain`, `frequency`, `severity`, `duration`, `date`) VALUES ('$token','$counter','$user_id', '$complain_str', '$frequency_complain_str', '$severity_complain_str', '$duration_complain_str', '$last_visit');";
        $complain_result = mysqli_query($conn,$complain_sql);        


        // !add diagnosis

        $dignosis = $_POST['dignosis-0-'];
        $dignosis_str = implode(',', $dignosis);

        $duration_dignosis = $_POST['dd-0-'];
        $duration_dignosis_str = implode(',', $duration_dignosis);

        $diagnosis_sql = "INSERT INTO `prescription_diagnosis` (`t`,`pres_id`, `id`, `diagnosis`, `duration`, `date`) VALUES ('$token','$counter', '$user_id', '$dignosis_str', '$duration_dignosis_str', '$last_visit');";
        $result_diagnosis = mysqli_query($conn,$diagnosis_sql);


        // !add Rx

        $medicine = $_POST['Medicine-0-'];
        $medicine_str = implode(',', $medicine);

        $dose_rx = $_POST['dose-0-'];
        $dose_rx_str = implode(',', $dose_rx);

        $when_rx = $_POST['When-0-'];
        $when_rx_str = implode(',', $when_rx);

        $frequency_rx = $_POST['Frequency-0-'];
        $frequency_rx_str = implode(',', $frequency_rx);

        $qty_rx = $_POST['Qty-0-'];
        $qty_rx_str = implode(',', $qty_rx);

        $rx_sql = "INSERT INTO `prescription_rx` (`t`,`pres_id`, `id`, `medicine`, `dose`, `when_rx`, `frequency`, `qty`, `date`) VALUES ('$token','$counter','$user_id', '$medicine_str', '$dose_rx_str', '$when_rx_str', '$frequency_rx_str', '$qty_rx_str', '$last_visit');";
        $result_rx = mysqli_query($conn,$rx_sql);

        
        // !add other fields
        
        $advice = $_POST['advice_txt'];
        $consultation_fees = 200;

        $additional_fees = $_POST['additional_fees'];

        $total_fees = $consultation_fees + $additional_fees;

        $next_visit_date = $_POST['nxt_visit_date'];

        if(isset($_POST['patient_miss_behave'])){
            $checked = $_POST['patient_miss_behave'];
        } 
        else{
            $checked = "no";
        }


        $prescription_other_sql = "INSERT INTO `prescription_other_details` (`t`,`pres_id`, `id`, `advice`, `consultation_fees`, `additional_fees`, `total_fees`, `next_visit_date`, `miss_behave_checked`, `date`) VALUES ('$token','$counter', '$user_id', '$advice', '$consultation_fees', '$additional_fees', '$total_fees', '$next_visit_date', '$checked', '$last_visit');";
        $result_prescription_other = mysqli_query($conn,$prescription_other_sql);



        // !insertion finished

        

        if($patient_status == 'new'){
            

            // !patient entry

            $patient_sql = "INSERT INTO `patients` (`t`,`id`, `fname`, `lname`, `email`, `phone_no`, `gender`, `dob`, `last_visit`, `dt`) VALUES ('$token','$user_id', '$fname', '$lname', '$email', '$phone_no', '$gender', '$dob', '$last_visit', current_timestamp());";
            $result_patient = mysqli_query($conn,$patient_sql);
        }
        else{

            // !update last visit in patient table

            $update_last_visit_sql = "UPDATE `patients` SET `last_visit`='$last_visit' where id='$user_id' and `t`='$token';";
            $result_update_last_visit = mysqli_query($conn,$update_last_visit_sql);

        }

        // !prescription entry

            $Prescription_details_sql = "INSERT INTO `prescription` (`t`,`id`, `pres_id`, `date`) VALUES ('$token','$user_id', '$counter', '$last_visit');";
            $result_Prescription_details = mysqli_query($conn,$Prescription_details_sql);

        // !revenue entry

        $revenue_sql = "INSERT INTO `revenue` (`t`,`revenue_id`, `id`, `fname`, `lname`, `phone_no`, `date`, `con_fees`, `addi_fees`, `total_fees`, `paid_amt`, `amt_duo`, `dt`) VALUES ('$token','$counter', '$user_id', '$fname', '$lname', '$phone_no', '$last_visit', '$consultation_fees', '$additional_fees', '$total_fees', '', '', current_timestamp());";
        $result_revenue = mysqli_query($conn,$revenue_sql);

        $delete_payment = "DELETE FROM `payment` where `t`='$token';";
        $result_delete_payment = mysqli_query($conn,$delete_payment);

        $clear_active_sql = "DELETE FROM `active` where `t`='$token'";
        $result_clear_active = mysqli_query($conn,$clear_active_sql);

        $insert_payment_table_sql = "INSERT INTO `payment` (`t`,`patient_id`, `status`, `revenue_id`) VALUES ('$token','$user_id','true', '$counter');";
        $result_insert_payment = mysqli_query($conn,$insert_payment_table_sql);

        // !pharmacist entry    

        $pharmacist_sql = "INSERT INTO `pharmacist_dashboard` (`t`,`pres_id`, `id`, `fname`, `lname`, `email`, `phone_no`, `gender`, `appt_time`, `appt_date`) VALUES ('$token','$counter','$user_id', '$fname', '$lname', '$email', '$phone_no', '$gender', '$appt_time', '$last_visit');";
        $result_pharmacist = mysqli_query($conn,$pharmacist_sql);

        // !redirect

        if($result_pharmacist){
            header('Location: ../index.php');
            exit();
        }


    }



?>