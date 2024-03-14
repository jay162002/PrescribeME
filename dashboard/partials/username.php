<?php

    $user_email = $_SESSION['username'];

    $username_sql = "SELECT user_name FROM user_login_details WHERE user_email='$user_email'";
    $result_username = mysqli_query($conn, $username_sql);

    $row_username = mysqli_fetch_assoc($result_username);
    $username = $row_username['user_name'];

?>