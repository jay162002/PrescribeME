<?php
    
    include './partials/session.php';
    include '../partials/_dbconnect.php';
    include './partials/username.php';

    $crnt_date = date('Y-m-d');    // !current date

    $fetch_date_sql = "SELECT * FROM `date_check` where `t`='$token';";
    $result_fetch_date = mysqli_query($conn,$fetch_date_sql);
    $fetched_date = mysqli_fetch_assoc($result_fetch_date);

    if ($fetched_date !== null){

        if($crnt_date != $fetched_date['dt']){

            $dt = "DELETE FROM date_check where `t`='$token';";
            $r = mysqli_query($conn,$dt);

            $set_ctr = "INSERT INTO `date_check` (`t`, `dt`, `ctr`, `payment`) VALUES ('$token', '$crnt_date', '0', '0');";
            $result_set_ctr = mysqli_query($conn,$set_ctr);
        }
    }
    else{
        $set_ctr = "INSERT INTO `date_check` (`t`, `dt`, `ctr`, `payment`) VALUES ('$token', '$crnt_date', '0', '0');";
        $result_set_ctr = mysqli_query($conn,$set_ctr);
    }
    
    


    $sql_appointments = "SELECT * FROM `appointment` WHERE appt_date='$crnt_date' and `t`='$token' ORDER BY appt_time;";         // !--- 
    $result_appointments = mysqli_query($conn,$sql_appointments);
    $num_appointments = mysqli_num_rows($result_appointments);



    $ctr_detail_sql = "SELECT * FROM `date_check` WHERE `t`='$token';";
    $result_ctr_sql = mysqli_query($conn,$ctr_detail_sql);
    $ctr_data = mysqli_fetch_assoc($result_ctr_sql);


    $counter_attended_patient = $ctr_data['ctr'];
    $total_revenue_val = $ctr_data['payment'];

    // $counter_str = file_get_contents("../receiptinist/dashboard/partials/ctr.txt");
    // $total_revenue_val = file_get_contents("../receiptinist/dashboard/partials/payment.txt");
    // $counter_attended_patient = intval($counter_str);

    $today_total_patient = $num_appointments + $counter_attended_patient;



    // $sql_appointments = "SELECT * FROM `appointment` WHERE appt_date='2023-05-18' ORDER BY appt_time";  // !---
    // $result_appointments = mysqli_query($conn,$sql_appointments);
    // $num_appointments = mysqli_num_rows($result_appointments);

    $sql = "SELECT * FROM `active` where `t`='$token';";
    $result = $result = mysqli_query($conn,$sql);

    $answer = mysqli_fetch_assoc($result);

    if($answer > 0){  
        $active_status = $answer['active_value'];
        $appointment_id = $answer['apt_id'];
    }
    else{
        $active_status = false;
        $appointment_id = false;
    }

    if($active_status !== false){
        $first_row_sql = "SELECT * FROM `appointment` WHERE `appointment_id`='$appointment_id' and appt_date='$crnt_date' and `t`='$token';";  // !--
        $first_row_result = mysqli_query($conn,$first_row_sql);

        // !--
        $remaining_row_sql = "SELECT * FROM `appointment` WHERE `appointment_id`<>'$appointment_id' and `t`='$token' and appt_date='$crnt_date' ORDER BY appt_time;";
        $remaining_row_result = mysqli_query($conn,$remaining_row_sql);
    }



    // $user_email = $_SESSION['username'];

    // $username_sql = "SELECT user_name FROM user_login_details WHERE user_email='$user_email'";
    // $result_username = mysqli_query($conn, $username_sql);

    // $row_username = mysqli_fetch_assoc($result_username);
    // $username = $row_username['user_name'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <meta http-equiv="refresh" content="5"> -->
    <title>PriscribeME | Doctor Dashboard</title>

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
                <li><a class="active" href="./index.php"><i class="fa-solid fa-home"></i>Dashboard</a></li>
                <li><a href="./patient.php"><i class="fa-solid fa-user-injured"></i>Patients</a></li>
                <li><a href="./revenue.php"><i class="fa-solid fa-indian-rupee-sign"></i>Revenue</a></li>
                <li><a href="./fellow_doctors_.php"><i class="fa-solid fa-stethoscope"></i>Fellow Doctors</a></li>
                <li><a href="../partials/_logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
            </ul>
        </nav>
    </div>

    <!-- !DASHBOARD SECTION -->
    <section class="dashboard_main_container">
        <div class="dashboard_card_container flex">
            <div class="dashboard_card" id="dashboard_card_total_que">
                <div class="dashboard_card_top flex">
                    <p class="dashboard_card_num" id="dashboard_total_que"><?php echo $today_total_patient; ?></p>
                    <div class="dashboard_card_icon_container" id="i1">
                        <i class="fa-solid fa-user-injured" style="color: #000;"></i>
                    </div>
                </div>
                <p class="dashboard_card_label">Total Patients</p>
            </div>
            <div class="dashboard_card" id="dashboard_card_total_ans">
                <div class="dashboard_card_top flex">
                    <p class="dashboard_card_num" id="dashboard_total_ans"><?php echo $counter_attended_patient; ?></p>
                    <div class="dashboard_card_icon_container" id="i2">
                        <i class="fa-solid fa-check-double" style="color: #000;"></i>
                    </div>
                </div>
                <p class="dashboard_card_label">Attended Patients</p>
            </div>
            <div class="dashboard_card" id="dashboard_card_total_pending_que">
                <div class="dashboard_card_top flex">
                    <p class="dashboard_card_num" id="dashboard_total_que"><?php echo $total_revenue_val; ?></p>
                    <div class="dashboard_card_icon_container" id="i3">
                        <i class="fa-solid fa-indian-rupee-sign" style="color:#000;"></i>
                    </div>
                </div>
                <p class="dashboard_card_label">Total Revenue</p>
            </div>
        </div>
        <!-- !TABLE CONTAINER -->
        <div class="table_main_container">
            <p class="detail_header">Today's Appointment List</p>
            <table class="dashboard_table">
                <thead>
                    <tr class="flex">
                        <td>ID</td>
                        <td>Name</td>
                        <td>Time</td>
                        <td>Date</td>
                        <td>Phone Number</td>
                        <td>Gender</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody class="tbody">

                <?php
                    if($active_status == true){
                        $row = mysqli_fetch_assoc($first_row_result);
                        if($row >= 1){

                            $date_string = $row['appt_date'];
                            $timestamp = strtotime($date_string);
                            $formatted_date = date('d/m/Y', $timestamp);
    
                            echo '<tr class="flex">
                            <td>' . $row['appointment_id'] . '</td>
                            <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                            <td>' . $row['appt_time'] . '</td>
                            <td>' . $formatted_date . '</td>
                            <td>' . $row['phone_no'] . '</td>
                            <td>' . $row['gender'] . '</td>
                            <td class="view_pre_btn">
                                <form action="./all_prescri.php" method="post">
                                    <button type="submit" id="active_main_btn" name="jay">Active</button>
                                    <input type="hidden" name="user_id" value="' . $row['appointment_id'] . '">
                                </form>
                            </td>
                            </tr>';
                        }
                        
                        // <a href="./temp.php" type="submit" id="active_main_btn" name="jay">Active</a>

                        while($row = mysqli_fetch_assoc($remaining_row_result)){

                            $date_string = $row['appt_date'];
                            $timestamp = strtotime($date_string);
                            $formatted_date = date('d/m/Y', $timestamp);

                            echo '<tr class="flex">
                            <td>' . $row['appointment_id'] . '</td>
                            <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                            <td>' . $row['appt_time'] . '</td>
                            <td>' . $formatted_date . '</td>
                            <td>' . $row['phone_no'] . '</td>
                            <td>' . $row['gender'] . '</td>
                            <td class="view_pre_btn">
                            <form action="./all_prescri.php" method="post">
                                <button type="submit"  name="jay">View</button>
                                <input type="hidden" name="user_id" value="' . $row['appointment_id'] . '">
                            </form>
                            </td>
                            </tr>';
                        }
                    }
                    else{
                        while($row = mysqli_fetch_assoc($result_appointments)){

                            $date_string = $row['appt_date'];
                            $timestamp = strtotime($date_string);
                            $formatted_date = date('d/m/Y', $timestamp);

                            echo '<tr class="flex">
                            <td>' . $row['appointment_id'] . '</td>
                            <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                            <td>' . $row['appt_time'] . '</td>
                            <td>' . $formatted_date . '</td>
                            <td>' . $row['phone_no'] . '</td>
                            <td>' . $row['gender'] . '</td>
                            <td class="view_pre_btn">
                            <form action="./all_prescri.php" method="post">
                                <button type="submit"  name="jay">View</button>
                                <input type="hidden" name="user_id" value="' . $row['appointment_id'] . '">
                            </form>
                            </td>
                            </tr>';
                        }
                    }

                ?>
                    <!-- <tr class="flex">
                        <td>1</td>
                        <td>Jay Darji</td>
                        <td>12:00 PM</td>
                        <td>02/04/2023</td>
                        <td>+97 6658658455</td>
                        <td>Male</td>
                        <td class="view_pre_btn"><a href="./all_prescri.php">View</a></td>
                    </tr> -->

                </tbody>
            </table>
        </div>
    </section>


    <!-- !SCRIPTS -->
    <script src="./scripts/main.js"></script>

</body>

</html>