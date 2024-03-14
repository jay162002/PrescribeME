<?php

  require "./vendor/autoload.php";
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;

  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->Host="smtp.gmail.com";
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port=587;
  $mail->isHTML(true);
  $mail->Username = "filesdoom@gmail.com";
  $mail->Password= "lxvacqchrjbdltgr";

  $mail->setFrom("filesdoom@gmail.com", 'varun');
  $mail->Subject = "Reset Password !!!";

  $show_error = false;
  if($_SERVER["REQUEST_METHOD"]=="POST"){

    include './partials/_dbconnect.php';
    
    $user_mail = $_POST['sign_in_confirm_email'];

    $fetch_sql = "SELECT * FROM `user_login_details` WHERE user_email='$user_mail';";
    $fetch_result = mysqli_query($conn,$fetch_sql);
    $row = mysqli_fetch_assoc($fetch_result);




    if($row > 0){
      $show_error = false;

      $name = $row['user_name'];
      $token = 456151222545212;

      $atag = "<a href='http://localhost/prescribe_me/reset_pass.php?token=$token' target='_blank'>Reset Your Password</a>";
      $email_body = "
      <h1>Welcome: $name</h1>
      <p>Reset your password by clicking on the link</p>
      link--> $atag ";

      global $mail,$user_mail;
      
      $mail->addAddress("$user_mail");
      $mail->Body = $email_body;
      $mail->send();

      setcookie("forgot_pass_mail",$user_mail,time() + (5 * 60));

      header('Location: ./index.php?$mail=true');
      exit();
    
    }
    else{
      $show_error = true;
    }


  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PriscribeME | Forgot Password</title>
    <!-- !FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- !LOCAL STYLES -->
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="stylesheet" href="./styles/responsive.css" />
</head>
<body>
    <header class="flex" id="header">
    <div class="logo_container">
        <a href=".index.html"><img src="./img/logo.png" alt="AYA-LOGO" width="80px"height="80px"/></a>
    </div>

    </header>

    <!-- !SIGN UP FORM -->
    <div class="sign_up_outer_container">

    <?php
      if($show_error == true){
        echo '<div class="error_container" id= "error_popup_container">
            <span onclick="close_popup()" class="cross">&times;</span>
            <p><span class="first_word">Error!</span> Email Does Not Exist!</p>
        </div>';
      }

    ?>
    
<div class="sign_up_container">
    <div class="sign_up_form_inner flex">
        <div class="left_sign_up_form_container">
        <div class="form_header">Password Reset</div>
        <!-- INPUT FORM -->
        <form action="./forgot_pass.php" class="sign_up_form"method="post">
            <div class="main_sign_up_input_container flex">
            <div class="input_container confirm_email_input_container flex">
                <label for="sign_up_confirm_email">Email Address*</label>
                <input type="text" name="sign_in_confirm_email" required="true" id="sign_in_confirm_email"/>
                <p class="error" id="confirm_email_error">This is an error</p>
            </div>
            </div>
            
            <input type="submit" value="Confirm Email" class="btn create_account_btn sign_in_btn" />
                
          </form>
          
        </div>
        <!-- *RIGHT SIDE IMAGE -->
        <div class="right_sign_up_form_container">
          <img src="./img/nurse.png" alt="sign_up_img" />
        </div>
      </div>
    </div>

    </div>
    
    <!-- !SCRIPTS -->
    <script src="./scripts/main.js"></script>
  </body>
</html>
