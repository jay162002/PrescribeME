<?php

    include './partials/session.php';
    include '../partials/_dbconnect.php';
    include './partials/username.php';



    $ctr_detail_sql = "SELECT * FROM `date_check` WHERE `t`='$token';";
    $result_ctr_sql = mysqli_query($conn,$ctr_detail_sql);
    $ctr_data = mysqli_fetch_assoc($result_ctr_sql);
    
    

    echo $ctr_data['ctr'];

?>