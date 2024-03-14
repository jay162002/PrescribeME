<?php

    session_start();
        
    if(!isset($_SESSION['pharma_loggedin']) || $_SESSION['pharma_loggedin'] != true){
        header("location: ../index.php");
        exit;
    }

    $user_name_popup = $_SESSION['pharma_username'];

    $token = $_SESSION['token'];


?>