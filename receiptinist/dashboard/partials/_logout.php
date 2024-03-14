<?php

    session_start();

    unset($_SESSION['rec_loggedin']);
    unset($_SESSION['rec_username']);

    // session_unset();
    // session_destroy();

    header("location: ../../index.php");
    exit;

?>