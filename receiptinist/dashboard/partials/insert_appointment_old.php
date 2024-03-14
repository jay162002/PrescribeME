<?php
    include './session.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        include '../../../partials/_dbconnect.php';

        $patient_id = $_POST['edit_patient_id'];
        $fname = $_POST['edit_first_name'];
       
        $appt_date = $_POST['edit_date'];
        $appt_time = $_POST['edit_time'];

        $patient_sql = "SELECT * FROM `patients` WHERE `id`='$patient_id' and `t`='$token';";
        $result_patient = mysqli_query($conn,$patient_sql);
        $num_result_patient = mysqli_num_rows($result_patient);

        if($num_result_patient == 1){

            $row = mysqli_fetch_assoc($result_patient);

            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $phone_no = $row['phone_no'];
            $gender = $row['gender'];
            $dob = $row['dob'];
            $status = 'old';
            
            $appointment_check_sql = "SELECT * FROM `appointment` WHERE `appointment_id`='$patient_id' and `t`='$token';";
            $result_appointment_check = mysqli_query($conn,$appointment_check_sql);
            $num_appointment_check = mysqli_num_rows($result_appointment_check);

            if($num_appointment_check >= 1){
                header('Location: ../add_patient_old.php?$apt=true');
                exit();
            }
            else{
                $sql = "INSERT INTO `appointment` (`t`, `appointment_id`, `fname`, `lname`, `email`, `phone_no`, `gender`, `dob`, `appt_date`, `appt_time`, `status`) VALUES ('$token','$patient_id', '$fname', '$lname', '$email', '$phone_no', '$gender', '$dob', '$appt_date', '$appt_time', '$status');";
                $result = mysqli_query($conn,$sql);
            }

            if($result){
                header('Location: ../index.php');
                exit();
            }
        }
        else{
            header('Location: ../add_patient_old.php?$p=true');
            exit();
        }
    
    }
?>