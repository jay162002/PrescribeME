<?php
    include './session.php';
    if(isset($_POST['insert_pharma_cred'])){

        include '../../partials/_dbconnect.php';

        $username = $_POST['add_phar_user_name'];
        $pass = $_POST['add_phar_user_pass'];

        $sql_exist = "SELECT * FROM pharmacist_cred WHERE username='$username' and `t`='$token';";
        $result_exist = mysqli_query($conn,$sql_exist);
        $num_exist = mysqli_num_rows($result_exist);

        if($num_exist == 1){
            $exist = true;
        }
        else{
            $exist=false;
        }

        if($exist == false){
            $sql = "INSERT INTO `pharmacist_cred` (`t`,`username`, `password`, `dt`) VALUES ('$token','$username', '$pass', current_timestamp());";
            $result = mysqli_query($conn,$sql);
        }
        else{
            header('Location: ../pharmasist_cred.php?$exist=true');
            exit();
        }

    
        header('Location: ../pharmasist_cred.php');
        exit();
        
    }
?>