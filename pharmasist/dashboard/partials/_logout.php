<?php

    session_start();

    unset($_SESSION['pharma_loggedin']);
    unset($_SESSION['pharma_username']);

    header("location: ../../index.php");
    exit;

?>