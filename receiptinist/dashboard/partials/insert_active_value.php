<?php
    include './session.php';

    if(isset($_POST['accept'])){
        include '../../../partials/_dbconnect.php';

        $sql_remove = "DELETE FROM active where `t`='$token';";
        $result_remove = mysqli_query($conn,$sql_remove);

        $user_apt_id = $_POST['user_id'];

        $sql = "INSERT INTO `active` (`t`,`active_value`, `apt_id`) VALUES ('$token','true', '$user_apt_id');";
        $result = mysqli_query($conn,$sql);

        if($result){
            header('Location: ../index.php');
            exit();
        }
    }


    if(isset($_POST['delete']))  {
        include '../../../partials/_dbconnect.php';
        $user_apt_id = $_POST['user_id'];

        $sql_remove = "DELETE FROM appointment where `appointment_id`='$user_apt_id' and `t`='$token';";
        $result_remove = mysqli_query($conn,$sql_remove);

        if($result_remove){
            header('Location: ../index.php');
            exit();
        }
    }  



    // #######################################################



    
?>