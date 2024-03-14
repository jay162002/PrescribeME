<?php

    include './partials/session.php';
    include '../../partials/_dbconnect.php';

    $sql = "SELECT * From fellow_doctors;";
    $result = mysqli_query($conn,$sql);

    if (isset($_POST['search_patient'])){

        $search_token = $_POST['search_patient'];
        $search_var = true;

    }
    else{
        $search_var = false;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PriscribeME | Fellow Doctors</title>
    <!-- !FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- !LOCAL STYLES -->
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="stylesheet" href="./styles/reponsive.css" />
</head>

<body id="fellow_doc_body">
<header class="flex edit-nav" id="dashborad_header">
        <!-- LINKS CONTAINER -->
        <nav class="link_container flex">
            <div class="dashboard_header flex">
                <p>Dashboard</p>
            </div>
            <ul class="login_link_container flex">
                <li class="signed_in_btn flex">
                    <div class="sign_in_user_profile_btn"><i class="fa-solid fa-user" style="color: #000000"></i></div>
                    <div class="angle_container"><i class="fa-solid fa-angle-down" style="color: #fff;"></i></div>
                    <div class="profile_pop_up">
                        <div class="pop_up_btn flex">
                            <div class="sign_in_user_profile_btn"><i class="fa-solid fa-user"
                                    style="color: #000000"></i></div>
                            <div class="user_info_container">
                                <p class="user_greetings">Welcome</p>
                                <p class="user_name"><?php echo $user_name_popup; ?></p>
                            </div>
                        </div>
                        <div class="pop_up_btn">
                            <a href="./partials/_logout.php" class="flex"><i class="fa-solid fa-power-off" style="color: #dd3e3e;"></i>Log
                                Out</a>
                        </div>
                    </div>
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

    <div id="edit_header">
        <!-- !EDIT PROFILE IMAGE FORM -->
        <div id="dashboard_logo">
            <img src="./img/logo.webp" alt="AYA-LOGO" />
        </div>
        <!-- LINKS CONTAINER -->
        <nav class="edit_link_container">
            <ul class="edit_nav_link_container">
                <li><a href="./index.php"><i class="fa-solid fa-home"></i>Dashboard</a></li>
                <li><a href="./revenue.php"><i class="fa-solid fa-indian-rupee-sign"></i>Revenue</a></li>
                <li><a class="active" href="./fellow_doctors_.php"><i class="fa-solid fa-stethoscope"></i>Fellow
                        Doctors</a></li>
                <!-- <li><a ><i class="fa-solid fa-external-link-alt"></i>Request Feture</a></li> -->
                <li><a href="./partials/_logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
            </ul>
        </nav>
    </div>

    <!-- !DASHBOARD SECTION -->
    <section class="dashboard_main_container" id="fellow_doc_section">
        <div class="dashboard_card_container flex">
            <form action="./fellow_doctors_.php" id="patient_search_input_form" method="post">
                <div class="patient_search_input_container flex">
                    <input type="text" name="search_patient"
                        placeholder="Search your Doctors with name, phone, specialization, city or state" id="search_doc">
                    <label for="search_patient"><i class="fa-solid fa-magnifying-glass"></i></label>
                </div>
            </form>
        </div>
        <!-- !FELLOW DOCTOR CONTAINER -->
        <div class="fellow_doc_container">
            <!-- *FELLOW DOCTOR CARD -->

            <?php

                if($search_var == false){
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<div class="fellow_doc_card flex">
                        <div class="fellow_doc_inner_container">
                            <div class="fellow_doc_dis_container">
                                <p class="doc_dis_header">' . $row['name'] . '</p>
                                <p class="doc_dis">ID: ' . $row['id'] . '</p>
                            </div>
                            <div class="fellow_doc_dis_container">
                                <p class="doc_dis_header">Phone Number:</p>
                                <p class="doc_dis">+91 ' . $row['phone'] . '</p>
                            </div>
                            <div class="fellow_doc_dis_container">
                                <p class="doc_dis_header">Specialization:</p>
                                <p class="doc_dis">' . $row['specialization'] . '</p>
                            </div>
                        </div>
                        <div class="fellow_doc_inner_container">
                            <div class="fellow_doc_dis_container">
                                <p class="doc_dis_header">Clinic Name:</p>
                                <p class="doc_dis">' . $row['clinic_name'] . '</p>
                            </div>
                            <div class="fellow_doc_dis_container">
                                <p class="doc_dis_header">Clinic Address:</p>
                                <p class="doc_dis">' . $row['addr'] . '</p>
                            </div>
                            <div class="fellow_doc_dis_container">
                                <p class="doc_dis_header">City - State:</p>
                                <p class="doc_dis">' . $row['city'] . ' - ' . $row['state'] . '</p>
                            </div>
                        </div>
                    </div>';
                    }
                }
                else{
                    $search_query = "SELECT * FROM `fellow_doctors` WHERE `name` LIKE '%$search_token%' OR `specialization` LIKE '%$search_token%' OR `city`='$search_token' OR 'state'='$search_token' OR `phone`='$search_token';";
                    $search_result = mysqli_query($conn,$search_query);

                    while($row = mysqli_fetch_assoc($search_result)){
                        echo '<div class="fellow_doc_card flex">
                        <div class="fellow_doc_inner_container">
                            <div class="fellow_doc_dis_container">
                                <p class="doc_dis_header">' . $row['name'] . '</p>
                                <p class="doc_dis">ID: ' . $row['id'] . '</p>
                            </div>
                            <div class="fellow_doc_dis_container">
                                <p class="doc_dis_header">Phone Number:</p>
                                <p class="doc_dis">+91 ' . $row['phone'] . '</p>
                            </div>
                            <div class="fellow_doc_dis_container">
                                <p class="doc_dis_header">Specialization:</p>
                                <p class="doc_dis">' . $row['specialization'] . '</p>
                            </div>
                        </div>
                        <div class="fellow_doc_inner_container">
                            <div class="fellow_doc_dis_container">
                                <p class="doc_dis_header">Clinic Name:</p>
                                <p class="doc_dis">' . $row['clinic_name'] . '</p>
                            </div>
                            <div class="fellow_doc_dis_container">
                                <p class="doc_dis_header">Clinic Address:</p>
                                <p class="doc_dis">' . $row['addr'] . '</p>
                            </div>
                            <div class="fellow_doc_dis_container">
                                <p class="doc_dis_header">City - State:</p>
                                <p class="doc_dis">' . $row['city'] . ' - ' . $row['state'] . '</p>
                            </div>
                        </div>
                    </div>';
                }

                }

            ?>

            </div>
            
            
        </div>
    </section>


    <!-- !SCRIPTS -->
    <script src="./scripts/main.js"></script>
</body>

</html>