<?php

  $exist = false;
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    include './partials/_dbconnect.php';

    $username = $_POST['sign_up_name'];
    $email = $_POST['sign_up_email'];
    $password = $_POST['sign_up_pass'];
    $cpassword = $_POST['sign_up_confirm_pass'];

    $sql_exist = "SELECT * FROM user_login_details WHERE user_email='$email';";
    $result_exist = mysqli_query($conn,$sql_exist);
    $num_exist = mysqli_num_rows($result_exist);

    if($num_exist == 1){
      $exist = true;
    }
    else{
      $exist=false;
    }
    
    $show_success_alert=false;

    if($password == $cpassword && $exist == false){

      $sql="INSERT INTO `user_login_details` (`user_name`, `user_email`, `user_password`, `sign_up_dt`) VALUES ('$username', '$email', '$password', current_timestamp());";
      $result = mysqli_query($conn,$sql);

      if($result){
        header('Location: ./index.php');
        exit();
      }
    }

   
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PriscribeME | Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- !FONT AWESOME -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- !LOCAL STYLES -->
    <link rel="stylesheet" href="./styles/style.css" />
    
    
  </head>
  <body>

    <!-- !SCRIPTS -->
    <script src="./scripts/main.js"></script>
    

    <header class="flex" id="header">
      <div class="logo_container">
        <a href=".index.html"
          ><img src="./img/logo.png" alt="PresibeME-LOGO" width="80px" height="80px"
        /></a>
      </div>
    </header>

    

    <!-- !SIGN UP FORM -->
    <div class="sign_up_outer_container">
      <div class="sign_up_container">
      <?php
        if($exist){
          echo '<div class="error_container" id= "error_popup_container">
                <span onclick="close_popup()" class="cross">&times;</span>
                <p><span class="first_word">Error!</span> Email already exist! </p>
            </div>';
        }
    ?>
      <div class="sign_up_form_inner flex">
        <div class="left_sign_up_form_container">
          <div class="form_header">Sign Up</div>
          <!-- INPUT FORM -->
          <form action="./sign_up.php" class="sign_up_form"method="post">
            <div class="main_sign_up_input_container flex">
              <div class="input_container flex">
                <label for="sign_up_name">Name</label>
                <input type="text" name="sign_up_name" required="true" id="sign_up_name"/>
                <p class="error" id="sign_up_name_error">This is an error</p>
              </div>
              <div class="input_container flex">
                <label for="sign_up_email">Email</label>
                <input type="email" name="sign_up_email" required="true" id="sign_up_email"/>
                <p class="error" style="opacity: 0;" id="sign_up_email_error">This is an error</p>
              </div>
            </div>
            <div class="main_sign_up_input_container flex">
              <div class="input_container flex">
                <label for="sign_up_pass">Password</label>
                <input type="password" name="sign_up_pass" required="true" id="sign_up_pass"/>
                <p class="error" style="opacity: 0;" id="sign_up_pass_error">This is an error</p>
              </div>
              <div class="input_container flex">
                <label for="sign_up_confirm_pass">Confirm Password</label>
                <input type="password" name="sign_up_confirm_pass" id="sign_up_confirm_pass" required="true" />
                <p class="error" style="opacity: 0;" id="sign_up_confirm_pass_error">This is an error</p>
              </div>
            </div>
            <!-- <input type="submit" onclick="checkvalidation()" class="btn create_account_btn"value="Create Account" /> -->
            <button onclick="checkvalidation()" class="btn create_account_btn">Create Account</button>

          </form>
          <div class="already_have_account_container flex">
            <p>Already have an account?</p>
            <a href="./">Sign In</a>
          </div>
        </div>
        <!-- *RIGHT SIDE IMAGE -->
        <div class="right_sign_up_form_container" id="right_sign_up_form_container">
          <img src="./img/nurse.png" alt="sign_up_img" />
        </div>
      </div>
    </div>
    </div>
    
  </body>
</html>
