<?php

    session_start();
        
    if(!isset($_SESSION['rec_loggedin']) || $_SESSION['rec_loggedin'] != true){
        header("location: ../index.php");
        exit;
    }

    $user_name_popup = $_SESSION['rec_username'];
    $token = $_SESSION['token'];

?>