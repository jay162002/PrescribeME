<?php 
    include '../dashboard/partials/session.php';
    if(isset($_POST['add_cre_user_name'])){

        include './_dbconnect.php';

        $username = $_POST['add_cre_user_name'];
        $pass = $_POST['add_cre_user_pass'];

        $sql_exist = "SELECT * FROM receptionist_cred WHERE username='$username' and `t`='$token';";
        $result_exist = mysqli_query($conn,$sql_exist);
        $num_exist = mysqli_num_rows($result_exist);

        if($num_exist == 1){
            $exist = true;
        }
        else{
            $exist=false;
        }

        if($exist == false){
            $sql = "INSERT INTO `receptionist_cred` (`t`, `username`, `password`, `dt`) VALUES ('$token','$username', '$pass', current_timestamp());";
            $result = mysqli_query($conn,$sql);
        }
        else{
            header('Location: ../dashboard/front_desk_cred.php?$exist=true');
            exit();
        }

    
        header('Location: ../dashboard/front_desk_cred.php');
        exit();
        
    }
?>