<?php

    include './session.php';
    if(isset($_POST['delete']))  {
        include '../../../partials/_dbconnect.php';
        $user_apt_id = $_POST['user_id'];

        $sql_remove = "DELETE FROM pharmacist_dashboard where `pres_id`='$user_apt_id' and `t`='$token';";
        $result_remove = mysqli_query($conn,$sql_remove);

        if($result_remove){
            header('Location: ../index.php');
            exit();
        }
    }  
?>