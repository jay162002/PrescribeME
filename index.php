<?php

    if(isset($_GET['$mail'])){
        $mail = $_GET['$mail'];
    }
    else{
        $mail = false;
    }

    if(isset($_GET['$re'])){
        $resend = $_GET['$re'];
    }
    else{
        $resend = false;
    }

    $show_invalid_credentials = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include './partials/_dbconnect.php';

        $email=$_POST["signin_mail"];
        $password=$_POST["signin_pass"];

        $sql = "SELECT * FROM user_login_details where user_email='$email' and user_password='$password'";
        $result = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);

        if($num == 1){

            if(isset($_POST['rememberme'])){
                setcookie('emailcookie',$email,time()+86400);
                setcookie('passcookie',$password,time()+86400);
            }

            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $email;

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
    <link rel="stylesheet" href="./styles/style2.css">
    <script src="./scripts/main.js"></script>
    <title>PrescribeME | Sign In</title>
</head>

<body>


    <?php

        if($resend == true){
            echo '<div class="error_container" id= "error_popup_container">
            <span onclick="close_popup()" class="cross">&times;</span>
            <p><span class="first_word">Session Time Out!</span> Try Again!</p>
        </div>';
        }

        if($mail == true){
            echo '<div class="error_container_success" id= "error_popup_container">
            <span onclick="close_popup()" class="cross">&times;</span>
            <p><span class="first_word">"Password Reset Email Sent!</span>Please check your inbox to reset your password</p>
        </div>';
        }

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
            <img src="./img/sign_in_side_img.png" alt="" class="left_img">

            <div class="gradient_container">
                <a href="./sign_up.php">Create an Account</a>
            </div>
        </div>

        <div class="right_container">
            <div class="header_signin">
                <h2>Sign In</h2>
                <p>Welcome back! please enter your details</p>
            </div>
            <form action="./index.php" method="post">
                <div class="signin_email_container">
                    <label for="signin_email">Email</label>
                    <input type="email" name="signin_mail" id="signin_email" class="input_box" required="true"
                        placeholder="Enter your email"
                        value="<?php if(isset($_COOKIE['emailcookie'])){ echo $_COOKIE['emailcookie']; } ?>">
                </div>

                <div class="signin_password_container">
                    <label for="signin_password">Password</label>
                    <input type="password" name="signin_pass" id="signin_password" class="input_box" required="true"
                        placeholder="Password"
                        value="<?php if(isset($_COOKIE['passcookie'])){ echo $_COOKIE['passcookie']; } ?>">
                </div>
                <div class="forgot_container">
                    <div class="remember_me">
                        <input type="checkbox" name="rememberme" id="remeber">
                        <label for="remeber">Remember Me</label>
                    </div>
                    <a href="./forgot_pass.php ">Forgot password?</a>
                </div>

                <input type="submit" value="Sign In" id="sign_in_btn">
                <!-- <button id="sign_in_btn">Sign In</button> -->

                <div class="role_container">
                    <a href="./" class="role_btn" id="main_btn">Doctor</a>
                    <a href="./receiptinist/" class="role_btn">Receptionist</a>
                    <a href="./pharmasist/" class="role_btn">Pharmacist</a>
                </div>

            </form>
        </div>
    </div>

</body>

</html>