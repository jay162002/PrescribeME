<?php
    include './session.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        include '../../../partials/_dbconnect.php';
    
        $fname = $_POST['edit_first_name'];
        $lname = $_POST['edit_last_name'];
        $email = $_POST['edit_email'];
        $phone = $_POST['edit_phone_num'];
        $dob = $_POST['edit_dob'];
        $gender = $_POST['edit_gender'];
        $appt_date = $_POST['edit_date'];
        $appt_time = $_POST['edit_time'];
        $status = 'new';


        $sql = "INSERT INTO `appointment` (`t`, `fname`, `lname`, `email`, `phone_no`, `gender`, `dob`, `appt_date`, `appt_time`, `status`) VALUES ('$token','$fname', '$lname', '$email', '$phone', '$gender', '$dob', '$appt_date', '$appt_time', '$status');";
        $result = mysqli_query($conn,$sql);

        if($result){
            header('Location: ../index.php');
            exit();
        }
    
    }
?>
