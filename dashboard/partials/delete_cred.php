<?php

    include './session.php';

    if(isset($_POST['delete_rec_cred'])){
        include '../../partials/_dbconnect.php';

        $un = $_POST['user_name'];

        $sql_remove = "DELETE FROM receptionist_cred where `username`='$un' and `t`='$token';";
        $result_remove = mysqli_query($conn,$sql_remove);

        if($result_remove){
            header('Location: ../front_desk_cred.php');
            exit();
        }
    }

    if(isset($_POST['delete_pharm_cred'])){
        include '../../partials/_dbconnect.php';

        $un = $_POST['user_name'];

        $sql_remove = "DELETE FROM pharmacist_cred where `username`='$un' and `t`='$token';";
        $result_remove = mysqli_query($conn,$sql_remove);

        if($result_remove){
            header('Location: ../pharmasist_cred.php');
            exit();
        }
    }
?>