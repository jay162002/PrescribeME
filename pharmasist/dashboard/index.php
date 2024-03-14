<?php

    include './partials/session.php';
    include '../../partials/_dbconnect.php';


    $crnt_date = date('Y-m-d');

    $fetch_date_sql = "SELECT * FROM `date_check_pharma` where `t`='$token';";
    $result_fetch_date = mysqli_query($conn,$fetch_date_sql);
    $fetched_date = mysqli_fetch_assoc($result_fetch_date);

    if ($fetched_date !== null){

        if($crnt_date != $fetched_date['dt']){

            $dt = "DELETE FROM date_check_pharma where `t`='$token';";
            $r = mysqli_query($conn,$dt);

            $set_ctr = "INSERT INTO `date_check_pharma` (`t`, `dt`, `ctr`, `payment`) VALUES ('$token', '$crnt_date', '0', '0');";
            $result_set_ctr = mysqli_query($conn,$set_ctr);
        }
    }
    else{
        $set_ctr = "INSERT INTO `date_check_pharma` (`t`, `dt`, `ctr`, `payment`) VALUES ('$token', '$crnt_date', '0', '0');";
        $result_set_ctr = mysqli_query($conn,$set_ctr);
    }


    // $crnt_date = date('Y-m-d');  // !current date

    $sql_pharmacist = "SELECT * FROM `pharmacist_dashboard` WHERE appt_date='$crnt_date' and `t`='$token' ORDER BY appt_time;";  // !--
    $result_pharmacist = mysqli_query($conn,$sql_pharmacist);
    $num_patients = mysqli_num_rows($result_pharmacist);

    if (isset($_POST['rec_search_patient_input'])){

        $search_token = $_POST['rec_search_patient_input'];
        $search_var = true;

    }
    else{
        $search_var = false;
    }


    $ctr_detail_sql = "SELECT * FROM `date_check_pharma` WHERE `t`='$token';";
    $result_ctr_sql = mysqli_query($conn,$ctr_detail_sql);
    $ctr_data = mysqli_fetch_assoc($result_ctr_sql);


    $attended_patient_val = $ctr_data['ctr'];
    $Pharma_revenue_val = $ctr_data['payment'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Prescribe Me | Dashboard-Pharmacist</title>
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
                <li><a class="active" href="./index.php"><i class="fa-solid fa-home"></i>Dashboard</a></li>
                <li><a href="./revenue.php"><i class="fa-solid fa-indian-rupee-sign"></i>Revenue</a></li>
                <li><a href="./fellow_doctors_.php"><i class="fa-solid fa-stethoscope"></i>Fellow Doctors</a></li>
                <li><a href="./partials/_logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
            </ul>
        </nav>
    </div>

    <!-- !DASHBOARD SECTION -->
    <section class="dashboard_main_container">
        <div class="dashboard_card_container flex">
            <div class="dashboard_card" id="dashboard_card_total_que">
                <div class="dashboard_card_top flex">
                    <p class="dashboard_card_num" id="dashboard_total_que"><?php echo $num_patients; ?></p>
                    <div class="dashboard_card_icon_container" id="i1">
                        <i class="fa-solid fa-user-injured" style="color: #000;"></i>
                    </div>
                </div>
                <p class="dashboard_card_label">Total Pending Patients</p>
            </div>
            <div class="dashboard_card" id="dashboard_card_total_ans">
                <div class="dashboard_card_top flex">
                    <p class="dashboard_card_num" id="dashboard_total_ans"><?php echo $attended_patient_val; ?></p>
                    <div class="dashboard_card_icon_container" id="i2">
                        <i class="fa-solid fa-check-double" style="color: #000;"></i>
                    </div>
                </div>
                <p class="dashboard_card_label">Attended Patients</p>
            </div>
            <div class="dashboard_card" id="dashboard_card_total_pending_que">
                <div class="dashboard_card_top flex">
                    <p class="dashboard_card_num" id="dashboard_total_que"><?php echo $Pharma_revenue_val; ?></p>
                    <div class="dashboard_card_icon_container" id="i3">
                        <i class="fa-solid fa-indian-rupee-sign"></i>
                    </div>
                </div>
                <p class="dashboard_card_label">Medical Revenue</p>
            </div>
        </div>
        <!-- !TABLE CONTAINER -->
        <div class="table_main_container">
            <div class="rec_table_header flex">
                <p class="detail_header">Patient List for Medical Store</p>
                <div class="add_appo_container flex">
                    <form action="./index.php" method="post" id="search_bar_id">
                        <input type="text" name="rec_search_patient_input" placeholder="Search Patient"
                            id="rec_search_patient_input">
                    </form>
                </div>
            </div>
            <table class="dashboard_table" id="rec_main_tbl">
                <thead>
                    <tr class="flex">
                        <td>ID</td>
                        <td>Name</td>
                        <td>Gender</td>
                        <td>Phone Number</td>
                        <td>Time</td>
                        <td>Date</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody class="tbody">

                    <?php

                        if($search_var == false){

                            while($row = mysqli_fetch_assoc($result_pharmacist)){

                                $date_string = $row['appt_date'];
                                $timestamp = strtotime($date_string);
                                $formatted_date = date('d/m/Y', $timestamp);
    
                                echo '<tr class="flex">
                                <td>' . $row['id'] . '</td>
                                <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                <td>' . $row['gender'] . '</td>
                                <td>' . $row['phone_no'] . '</td>
                                <td>' . $row['appt_time'] . '</td>
                                <td>' . $formatted_date . '</td>
                                <td class="view_pre_btn flex">
    
                                    <form id="myForm" action="./view_medicines.php" method="post" name="pharmacist_view_form">                 
                                        <input type="hidden" name="presc_id" value="' . $row['pres_id'] . '">
                                        <button type="submit" class="accept_btn" name="pharma_view_btn">View</button>
                                    </form>
    
                                    <form action="./partials/delete_row.php" method="post">
                                        <button class="del_btn" name="delete" type="submit">Delete</button>
                                        <input type="hidden" name="user_id" value="' . $row['pres_id'] . '">
                                    </form>
                                </td>
                            </tr>';
                            }

                        }
                        else{

                            $search_query = "SELECT * FROM `pharmacist_dashboard` WHERE (`fname` LIKE '%$search_token%' OR `lname` LIKE '%$search_token%' OR `phone_no`='$search_token' OR id='$search_token') and `t`='$token';";
                            $search_result = mysqli_query($conn,$search_query);

                            while($row = mysqli_fetch_assoc($search_result)){

                                $date_string = $row['appt_date'];
                                $timestamp = strtotime($date_string);
                                $formatted_date = date('d/m/Y', $timestamp);
    
                                echo '<tr class="flex">
                                <td>' . $row['id'] . '</td>
                                <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                <td>' . $row['gender'] . '</td>
                                <td>' . $row['phone_no'] . '</td>
                                <td>' . $row['appt_time'] . '</td>
                                <td>' . $formatted_date . '</td>
                                <td class="view_pre_btn flex">
    
                                    <form id="myForm" action="./view_medicines.php" method="post" name="pharmacist_view_form">                 
                                        <input type="hidden" name="presc_id" value="' . $row['pres_id'] . '">
                                        <button type="submit" class="accept_btn" name="pharma_view_btn">View</button>
                                    </form>
    
                                    <form action="./partials/delete_row.php" method="post">
                                        <button class="del_btn" name="delete" type="submit">Delete</button>
                                        <input type="hidden" name="user_id" value="' . $row['pres_id'] . '">
                                    </form>
                                </td>
                            </tr>';
                            }

                        }
                        

                    ?>

                </tbody>
            </table>
        </div>
    </section>


    <!-- !SCRIPTS -->
    <script src="./scripts/main.js"></script>
</body>


</html>