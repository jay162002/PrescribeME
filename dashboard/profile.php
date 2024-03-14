<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Prescribme | User Profile</title>
    <!-- !FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- !LOCAL STYLES -->
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="stylesheet" href="./styles/responsive.css" />
</head>

<body>
    <header class="flex edit-nav" id="header">
        <!-- LINKS CONTAINER -->
        <nav class="link_container flex">
            <div class="dashboard_header flex">
                <p>My Profile</p>
                <!-- <ul class="nav_link_container flex">
        <li><a href="#">Home</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Contact Us</a></li>
        </ul> -->
            </div>
            <ul class="login_link_container flex">
                <li class="signed_in_btn flex">
                    <a href="./profile.php" class="flex">
                        <div class="sign_in_user_profile_btn"><i class="fa-solid fa-user" style="color: #000000"></i>
                        </div>
                        <div class="angle_container"><i class="fa-solid fa-angle-down" style="color: #000000;"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- !BURGER FOR MOBILE VIEW -->
        <div class="burger_container">
            <i></i>
            <i></i>
            <i></i>
        </div>
    </header>
    <section class="section flex" id="user_profile_section">
        <header id="edit_header">
            <!-- !EDIT PROFILE IMAGE FORM -->
            <!-- <div class="user_profile_right_outer_container">
    <form action="#" method="post" >
        <label for="user_img" id="user_img_label" ><i class="fa-solid fa-image" style="color:#2498D9;"></i><i class="fa-solid fa-pencil" style="color: #1053c6;"></i></label>
        <input type="file" name="user_img" id="user_img">
    </form>
    <div class="user_profile_right_container_user_detail">
        <p class="user-name">Varun Salat</p>
        <p class="user-email">varunsalat@gmail.com</p>
        <p class="user-role">Student</p>
    </div>
</div> -->
            <div class="logo_container flex">
                <a href="./"><img src="./img/logo.png" alt="AYA-LOGO" /></a>
            </div>
            <!-- LINKS CONTAINER -->
            <nav class="edit_link_container">
                <ul class="edit_nav_link_container">
                    <li><a href="./"><i class="fa-solid fa-home"></i>Dashboard</a></li>
                    <li><a href="#"><i class="fa-solid fa-user"></i>Account</a></li>
                    <li><a><i class="fa-solid fa-key"></i>Change Password</a></li>
                    <li><a href="./login.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
                </ul>
            </nav>
        </header>
        <div class="user_profile_left_outer_container">
            <form action="#" method="post" id="edit_user_account">
                <div class="user_profile_main_container">
                    <div class="edit_profile_input_outer_container">
                        <div class="edit_profile_header flex">
                            <i class="fa-solid fa-user" style="color: #182c4e;"></i>
                            <p>Edit Profile</p>
                        </div>
                        <p class="edit_profile_input_main_container_header">Basic Information</p>
                        <div class="edit_profile_main_input_container flex">
                            <div class="edit_profile_input_container flex">
                                <label for="edit_first_name">First Name <span class="star">*</span></label>
                                <input type="text" required="true" id="edit_first_name" name="edit_first_name"
                                    placeholder="First Name">
                                <p class="error" id="edit_first_name_error">this is error</p>
                            </div>
                            <div class="edit_profile_input_container flex">
                                <label for="edit_last_name">Last Name <span class="star">*</span></label>
                                <input type="text" required="true" id="edit_last_name" name="edit_last_name"
                                    placeholder="Last Name">
                                <p class="error" id="edit_last_name_error">this is error</p>
                            </div>
                        </div>

                        <div class="edit_profile_main_input_container flex">
                            <div class="edit_profile_input_container flex">
                                <label for="edit_first_name">Email Address<span class="star">*</span></label>
                                <input type="email" required="true" id="edit_email" name="edit_email"
                                    placeholder="Email Address">
                                <p class="error" id="edit_email_error">this is error</p>
                            </div>
                            <div class="edit_profile_input_container flex">
                                <label for="edit_phone_num">Contact Number <span class="star">*</span></label>
                                <input type="number" required="true" id="edit_phone_num" name="edit_phone_num"
                                    placeholder="000 000 0000">
                                <p class="error" id="edit_phone_num_error">this is error</p>
                            </div>
                        </div>

                        <div class="edit_profile_main_input_container flex">
                            <div class="edit_profile_input_container flex">
                                <label for="edit_dob">DOB.<span class="star">*</span></label>
                                <input type="date" id="edit_dob" name="edit_dob" placeholder="First Name">
                                <p class="error" id="edit_dob_error">this is error</p>
                            </div>
                            <div class="edit_profile_input_container flex">
                                <p>Gender<span class="star">*</span></p>
                                <div class="edit_radio_btn_main_container flex">
                                    <div class="edit_radio_container flex">
                                        <label for="edit_gender_male">Male</label>
                                        <input type="radio" id="edit_gender_male" name="edit_gender" value="Male">
                                    </div>
                                    <div class="edit_radio_container flex">
                                        <label for="edit_gender_female">Female</label>
                                        <input type="radio" id="edit_gender_female" name="edit_gender" value="Female">
                                    </div>
                                    <div class="edit_radio_container flex">
                                        <label for="edit_gender_other">Other</label>
                                        <input type="radio" id="edit_gender_other" name="edit_gender" value="Other">
                                    </div>
                                </div>
                                <p class="error" id="edit_gender_error">this is error</p>
                            </div>
                        </div>
                        <div class="edit_profile_main_input_container flex">
                            <div class="edit_profile_input_container flex">
                                <label for="edit_course">Course<span class="star">*</span></label>
                                <input type="text" id="edit_course" name="edit_course" placeholder="Course Name">
                                <p class="error" id="edit_course_error">this is error</p>
                            </div>
                        </div>
                    </div>

                    <div class="edit_profile_input_outer_container">
                        <p class="edit_profile_input_main_container_header">Contact Information</p>
                        <div class="edit_profile_main_input_container flex">
                            <div id="edit_address_container" class="edit_profile_input_container flex">
                                <label for="edit_address">Address <span class="star">*</span></label>
                                <input type="text" required="true" id="edit_address" name="edit_address"
                                    placeholder="Your Address">
                                <p class="error" id="edit_address_error">this is error</p>
                            </div>
                        </div>
                        <div class="edit_profile_main_input_container flex">
                            <div class="edit_profile_input_container flex">
                                <label for="edit_city_name">City Name<span class="star">*</span></label>
                                <input type="text" required="true" id="edit_city_name" name="edit_city_name"
                                    placeholder="City Name">
                                <p class="error" id="edit_city_name_error">this is error</p>
                            </div>
                            <div class="edit_profile_input_container flex">
                                <label for="edit_zip_code">Zip Code <span class="star">*</span></label>
                                <input type="number" required="true" id="edit_zip_code" name="edit_zip_code"
                                    placeholder="00000">
                                <p class="error" id="edit_zip_code_error">this is error</p>
                            </div>
                        </div>
                    </div>
                    <div class="edit_profile_input_outer_container" id="edit_save_btn_container">
                        <button type="submit" class="btn edit_save_btn"><i class="fa-solid fa-floppy-disk"
                                style="color: #fff;"></i>Save</button>
                    </div>
                </div>
            </form>

            <!-- !CHANGE PASSWORD -->
            <form action="#" method="post" id="edit_change_pass_form" class="edit_profile_input_outer_container">
                <div class="user_profile_main_container">
                    <p class="edit_profile_input_main_container_header">Change Password</p>
                    <div class="edit_profile_main_input_container flex">
                        <div class="edit_profile_input_container flex">
                            <label for="edit_currnet_pass">Current Password<span class="star">*</span></label>
                            <input type="password" required="true" id="edit_currnet_pass" name="edit_currnet_pass"
                                placeholder="Current Password">
                            <p class="error" id="edit_currnet_pass_error">this is error</p>
                        </div>
                    </div>
                    <div class="edit_profile_main_input_container flex">
                        <div class="edit_profile_input_container flex">
                            <label for="edit_new_pass">New Password<span class="star">*</span></label>
                            <input type="password" required="true" id="edit_new_pass" name="edit_new_pass"
                                placeholder="New Password">
                            <p class="error" id="edit_new_pass_error">this is error</p>
                        </div>
                        <div class="edit_profile_input_container flex">
                            <label for="edit_confirm_new_pass">Cofirm Password<span class="star">*</span></label>
                            <input type="password" required="true" id="edit_confirm_new_pass"
                                name="edit_confirm_new_pass" placeholder="Cofirm Password">
                            <p class="error" id="edit_confirm_new_pass_error">this is error</p>
                        </div>
                    </div>
                    <button type="submit" name="edit_change_pass_btn" class="btn edit_save_btn">Change Password</button>
                </div>
            </form>
        </div>

    </section>


    <!-- !SCRIPTS -->
    <script src="./scripts/profile.js"></script>
</body>

</html>