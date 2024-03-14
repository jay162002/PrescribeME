<?php

  if(isset($_COOKIE['forgot_pass_mail'])){
    $for_pass_email = $_COOKIE["forgot_pass_mail"]; 
  }
  else{
    header('Location: ./index.php?$re=true');
    exit();
  }


  $show_alert = false;

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    include './partials/_dbconnect.php';

    $pass = $_POST['new_pass'];
    $con_pass = $_POST['confirm_new_pass'];

    if($pass != $con_pass){
      $show_alert = true;
    }
    else{
      $update_sql = "UPDATE `user_login_details` SET `user_password`='$pass' WHERE `user_email`='$for_pass_email';";
      $result_update = mysqli_query($conn,$update_sql);

      if($result_update){
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
    <title>PriscribeME | Reset Password</title>
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
    <link rel="stylesheet" href="./styles/responsive.css" />
  </head>
  <body>
    <header class="flex" id="header">
      <div class="logo_container">
        <a href=".index.html"
          ><img src="./img/logo.png" alt="AYA-LOGO" width="80px" height="80px"
        /></a>
      </div>
      <!-- LINKS CONTAINER -->
      <!-- <nav class="link_container flex">
        <ul class="nav_link_container flex">
          <li><a href="#">Home</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Contact Us</a></li>
        </ul>
        <ul class="login_link_container flex">
          <li id="sign_in_btn">
            <a href="#"
              ><i class="fa-solid fa-user" style="color: #000000"></i>Sign In</a
            >
          </li>
          <li>
            <a href="#" id="register_btn" class="btn"
              ><i class="fa-solid fa-user-pen" style="color: #fff"></i
              >Register</a
            >
          </li>
        </ul>
      </nav>
      <div class="burger_container">
        <i></i>
        <i></i>
        <i></i>
      </div> -->
    </header>

    <!-- !SIGN UP FORM -->
    <div class="sign_up_outer_container">

    <?php

      if($show_alert == true){
        echo '<div class="error_container" id= "error_popup_container">
        <span onclick="close_popup()" class="cross">&times;</span>
        <p><span class="first_word">Error!</span> Passwords Do Not Match!</p>
    </div>';
      }

    ?>

    

      <div class="sign_up_container">
          <div class="form_header sign_in_header">Reset Password</div>
      <div class="sign_up_form_inner log_in_form_inner flex">
        <div class="left_sign_up_form_container left_change_pass_container">
          <!-- INPUT FORM -->
          <form action="./reset_pass.php" class="sign_up_form sign_in_form"method="post" id="myForm">
            <div class="main_sign_up_input_container flex">
              <div class="input_container sign_in_input_container flex">
                <label for="new_pass">Password*</label>
                <input type="password" name="new_pass" required="true" id="new_pass" required/>
                <p class="error" id="reset_pass_error">This is an error</p>
            </div>
            </div>
            <div class="main_sign_up_input_container flex">
            <div class="input_container sign_in_input_container flex">
                <label for="confirm_new_pass">Confirm Password*</label>
                <input type="password" name="confirm_new_pass" required="true" id="confirm_new_pass" required="true" />
                <p class="error" id="reset_confirm_pass_error">This is an error</p>
            </div>
            </div>
            <!-- *USE THIS INPUT -->
            <!-- <input type="submit"  class="btn sign_in_btn create_account_btn"value="Sign In" /> -->
            <!-- *DELETE THIS anchor IT IS JUST FOR DEMO -->
        <!-- <a onclick="document.getElementById('myForm').submit();" class="btn sign_in_btn create_account_btn" value="Create noe" >Save</a> -->

        <button class="btn sign_in_btn create_account_btn" value="Create noe">Save</button>
        </form>
        </div>
        <!-- *RIGHT SIDE IMAGE -->
        <div class="right_sign_up_form_container right_sign_in_form_container" id="right_sign_up_form_container_reset_pas">
          <img src="./img/nurse.png" alt="sign_up_img" />
        </div>
      </div>
    </div>
    </div>
    <!-- !SCRIPTS -->
    <script src="./scripts/main.js"></script>
  </body>
</html>
