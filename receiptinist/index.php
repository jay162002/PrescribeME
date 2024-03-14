<?php
    $show_invalid_credentials = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include '../partials/_dbconnect.php';

        $email=$_POST["rec_signin_name"];
        $password=$_POST["signin_pass"];

        $sql = "SELECT * FROM receptionist_cred where username='$email' and password='$password'";
        $result = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);

        if($num == 1){

            $row = mysqli_fetch_assoc($result);

            $my_token = $row['t'];

            if(isset($_POST['rememberme'])){
                setcookie('rusercookie',$email,time()+86400);
                setcookie('rpasscookie',$password,time()+86400);
            }

            session_start();
            $_SESSION['rec_loggedin'] = true;
            $_SESSION['rec_username'] = $email;
            $_SESSION['token'] = $my_token;

            header('Location: ./dashboard/index.php');
            exit();
        }
        else{
            $show_invalid_credentials = true;
        }

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style2.css">
    <script src="../scripts/main.js"></script>
    <title>PrescribeME | Sign In-Receptionist</title>
</head>

<body>

    <?php

        if($show_invalid_credentials){

            echo '<div class="error_container" id= "error_popup_container">
            <span onclick="close_popup()" class="cross">&times;</span>
            <p><span class="first_word">Error!</span> Invalid Credentials</p>
        </div>';

        }

    ?>



    <div class="main_container">
        <div class="left_container">
            <h1>Online Prescription System for Hospitals.</h1>
            <p>We are Efficient, Accurate, and Secure</p>
            <img src="../img/sign_in_side_img.png" alt="" class="left_img">

            <div class="gradient_container">
            </div>
        </div>

        <div class="right_container">
            <div class="header_signin">
                <h2>Sign In</h2>
                <p>Welcome back! please enter your details</p>
            </div>
            <form action="./index.php" method="post">
                <div class="signin_email_container">
                    <label for="rec_signin_name">Username</label>
                    <input type="text" name="rec_signin_name" id="rec_signin_name" class="input_box" required="true"
                        placeholder="Enter User Name"
                        value="<?php if(isset($_COOKIE['rusercookie'])){ echo $_COOKIE['rusercookie']; } ?>">
                </div>

                <div class="signin_password_container">
                    <label for="rec_signin_password">Password</label>
                    <input type="password" name="signin_pass" id="rec_signin_password" class="input_box" required="true"
                        placeholder="Enter Password"
                        value="<?php if(isset($_COOKIE['rpasscookie'])){ echo $_COOKIE['rpasscookie']; } ?>">
                </div>

                <div class="forgot_container">
                    <div class="remember_me">
                        <input type="checkbox" name="rememberme" id="remeber">
                        <label for="remeber">Remember Me</label>
                    </div>
                </div>

                <input type="submit" value="Sign In" id="sign_in_btn">
                <div class="role_container">
                    <a href="../" class="role_btn">Doctor</a>
                    <a href="./" class="role_btn" id="main_btn">Receptionist</a>
                    <a href="../pharmasist" class="role_btn">Pharmacist</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>