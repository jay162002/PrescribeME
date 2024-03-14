<?php

    include './partials/session.php';
    include '../partials/_dbconnect.php';
    include './partials/username.php';
    
    if(isset($_POST['jay'])){
        $user_id = $_POST['user_id'];

        $sql_pres = "SELECT * FROM `prescription` where id='$user_id' and `t`='$token';";
        $result_sql_pres = mysqli_query($conn,$sql_pres);

        $name_sql = "SELECT * FROM `patients` WHERE `id`='$user_id' and `t`='$token';";
        $name_result = mysqli_query($conn,$name_sql);
        $num_name = mysqli_num_rows($name_result);

        $name_other_sql = "SELECT * FROM `appointment` WHERE `appointment_id`='$user_id' and `t`='$token';";
        $name_other_result = mysqli_query($conn,$name_other_sql);

        if($num_name == 0){
            $row_name = mysqli_fetch_assoc($name_other_result);
        }
        else{
            $row_name = mysqli_fetch_assoc($name_result);
        }

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PriscribeME | All Prescriptions</title>
    <!-- !FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- !LOCAL STYLES -->
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="stylesheet" href="./styles/reponsive.css" />
</head>

<body>
    <header class="flex edit-nav" id="dashborad_header">
        <!-- LINKS CONTAINER -->
        <nav class="link_container flex">
            <div class="dashboard_header flex">
                <p>Prescriptions</p>
            </div>
            <ul class="login_link_container flex">
                <div class="cred_box_container">
                    <div class="cred_box"></div>
                    <div class="cred_box"></div>
                    <div class="cred_box"></div>
                    <div class="cred_box"></div>
                    <div class="cred_box"></div>
                    <div class="cred_box"></div>
                    <div class="cred_box"></div>
                    <div class="cred_box"></div>
                    <div class="cred_box"></div>
                </div>
                <div class="profile_pop_up hide" id="cred_users_container">
                    <div class="cred_user_inner_container">
                        <a href="./front_desk_cred.php">

                            <figure>
                                <img src="./img/information-desk.png" alt="information-desk">
                            </figure>
                            Front-desk
                        </a>
                    </div>
                    <div class="cred_user_inner_container">
                        <a href="./pharmasist_cred.php">
                            <figure>
                                <img src="./img/medicine.png" alt="information-desk">
                            </figure>
                            Pharmacist
                        </a>
                    </div>
                </div>
                <li class="signed_in_btn flex">
                    <div class="sign_in_user_profile_btn"><i class="fa-solid fa-user" style="color: #000000"></i></div>
                    <div class="angle_container"><i class="fa-solid fa-angle-down" style="color: #fff;"></i></div>
                    <div class="profile_pop_up" id="profile_pop_up">
                        <div class="pop_up_btn flex">
                            <div class="sign_in_user_profile_btn"><i class="fa-solid fa-user"
                                    style="color: #000000"></i></div>
                            <div class="user_info_container">
                                <p class="user_greetings">Welcome</p>
                                <p class="user_name"><?php echo $username; ?></p>
                            </div>
                        </div>
                        <div class="pop_up_btn">
                            <a href="../forgot_pass.php" class="flex"><i class="fa-solid fa-user-lock"
                                    style="color: #99BBDD;"></i>Change Password</a>
                        </div>
                        <div class="pop_up_btn">
                            <a href="../partials/_logout.php" class="flex"><i class="fa-solid fa-power-off" style="color: #dd3e3e;"></i>Log
                                Out</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
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
                <li><a href="./patient.php"><i class="fa-solid fa-user-injured"></i>Patients</a></li>
                <li><a href="./revenue.php"><i class="fa-solid fa-indian-rupee-sign"></i>Revenue</a></li>
                <li><a href="./fellow_doctors_.php"><i class="fa-solid fa-stethoscope"></i>Fellow Doctors</a></li>
                <!-- <li><a ><i class="fa-solid fa-external-link-alt"></i>Request Feture</a></li> -->
                <li><a href="../partials/_logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
            </ul>
        </nav>
    </div>

    <!-- !DASHBOARD SECTION -->
    <section class="dashboard_main_container">
        <div class="dashboard_card_container flex">
            <div class="patient_search_input_container flex">
                <form id="myForm" action="./create_visit.php" method="post" name="create_visit_btn_name">
                    <!-- <button type="submit"></button> -->
                    <!-- <input type="submit" value="" style="display:none;" name="create_visit_btn_name"> -->
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                </form>

                <a href="#" onclick="document.getElementById('myForm').submit();" class="create_visit_btn btn">Create New Visit</a>
            </div>
        </div>
        <!-- !TABLE CONTAINER -->
        <div class="table_main_container">
            <p class="detail_header"><?php echo $row_name['fname'] . ' ' . $row_name['lname']; ?></p>
            <table class="dashboard_table" id="all_pre_tbl">
                <thead>
                    <tr class="flex">
                        <td>Sr.NO.</td>
                        <td>Prescription ID</td>
                        <td>Date</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody class="tbody">

                    <?php
                        $sr_ctr = 1;
                        while($row = mysqli_fetch_assoc($result_sql_pres)){

                            $date_string = $row['date'];
                            $timestamp = strtotime($date_string);
                            $formatted_date = date('d/m/Y', $timestamp);

                            echo '<tr class="flex">
                                <td>' . $sr_ctr . '</td>
                                <td>' . $row['pres_id'] . '</td>
                                <td>' . $formatted_date . '</td>
                                <td class="view_pre_btn">
                                    <form action="./view_prescri.php" method="post">
                                        <button type="submit" name="jay">View</button>
                                        <input type="hidden" name="pres_id_name" value="' . $row['pres_id'] . '">
                                    </form>
                                </td>
                            </tr>';
                            $sr_ctr += 1;
                        }
                    ?>

                    <!-- <tr class="flex">
                        <td>1</td>
                        <td>2564</td>
                        <td>02/04/2023</td>
                        <td class="view_pre_btn">
                            <form action="./all_prescri.php" method="post">
                                <button type="submit" name="jay">View</button>
                            </form>
                        </td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </section>


    <!-- !SCRIPTS -->
    <script src="./scripts/main.js"></script>
</body>

</html>