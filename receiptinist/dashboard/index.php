<?php

    include './partials/session.php';
    include '../../partials/_dbconnect.php';

    

    $sql = "SELECT * FROM `active` where `t`='$token';";
    $result = mysqli_query($conn,$sql);
    $answer = mysqli_fetch_assoc($result);

    $crnt_date = date('Y-m-d');          // !current date

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


    $payment_sql = "SELECT * FROM `payment` where `t`='$token';";
    $result_payment = mysqli_query($conn,$payment_sql);
    $row_payment = mysqli_fetch_assoc($result_payment);

    if($answer > 0){  
        $active_status = $answer['active_value'];
        $appointment_id = $answer['apt_id'];

        $for_patient_status_sql = "SELECT * FROM `appointment` WHERE appointment_id='$appointment_id' and `t`='$token'";
        $result_for_patient_status = mysqli_query($conn,$for_patient_status_sql);
        
        $row_for_status = mysqli_fetch_assoc($result_for_patient_status);
        $patient_status = $row_for_status['status'];

    }
    else{
        $active_status = false;
        $appointment_id = false;
    }

    if($row_payment > 0){
        $payment_status = true;
        $revenue_id = $row_payment['revenue_id'];

        $Payment_patient_id = $row_payment['patient_id'];


        $for_patient_status_sql = "SELECT * FROM `appointment` WHERE appointment_id='$Payment_patient_id' and `t`='$token'";
        $result_for_patient_status = mysqli_query($conn,$for_patient_status_sql);
        
        $row_for_status = mysqli_fetch_assoc($result_for_patient_status);
        $patient_status = $row_for_status['status'];
    }
    else{
        $payment_status = false;
        $revenue_id = null;
        $patient_status = false;
        $Payment_patient_id= null;
    }


    if($active_status !== false){
        $first_row_sql = "SELECT * FROM `appointment` WHERE `appointment_id`='$appointment_id' and appt_date='$crnt_date' and `t`='$token';"; // !--
        $first_row_result = mysqli_query($conn,$first_row_sql);

        // !--
        $remaining_row_sql = "SELECT * FROM `appointment` WHERE `appointment_id`<>'$appointment_id' and appt_date='$crnt_date' and `t`='$token' ORDER BY appt_time;";
        $remaining_row_result = mysqli_query($conn,$remaining_row_sql);
    }


    // $sql_appointments = "SELECT * FROM `appointment` WHERE appt_date='$crnt_date' and `t`='$token' ORDER BY appt_time;"; // !--
    // $result_appointments = mysqli_query($conn,$sql_appointments);
    // $num_appointments = mysqli_num_rows($result_appointments);

    if($payment_status == true){
        // !--
        $payment_first_row_sql = "SELECT * FROM `appointment` WHERE `appointment_id`='$Payment_patient_id' and appt_date='$crnt_date' and `t`='$token';";
        $paymety_first_row = mysqli_query($conn,$payment_first_row_sql);

        if($active_status !== false){
            // !--
            $payment_remaining_rows_sql = "SELECT * FROM `appointment` WHERE `appointment_id`<>'$appointment_id' and `t`='$token' and `appointment_id`<>'$Payment_patient_id' and appt_date='$crnt_date' ORDER BY appt_time;";
            $payment_ramaining_rows = mysqli_query($conn,$payment_remaining_rows_sql);
        }
        else{
            // !--
            $payment_remaining_rows_sql = "SELECT * FROM `appointment` WHERE `appointment_id`<>'$Payment_patient_id' and `t`='$token' and appt_date='$crnt_date' ORDER BY appt_time;";
            $payment_ramaining_rows = mysqli_query($conn,$payment_remaining_rows_sql);
        }
    }


    // !search 

    if (isset($_POST['rec_search_patient_input'])){

        $search_token = $_POST['rec_search_patient_input'];
        $search_var = true;

    }
    else{
        $search_var = false;
    }


    // !payment fetch

    if($patient_status == 'old'){
        $fetch_payment_due_sql = "SELECT * FROM `patient_total_due` WHERE `id`='$Payment_patient_id' and `t`='$token' or `id`='$appointment_id';";
        $result_fetch_payment_due = mysqli_query($conn,$fetch_payment_due_sql);
        $payment_due_row = mysqli_fetch_assoc($result_fetch_payment_due);

        if($payment_due_row > 0){
            $total_payment_due = $payment_due_row['total_due_amt'];
        }
        else{
            $total_payment_due = 0;
        }
    }
    else{
        $total_payment_due = 0;
    }

    // !charges frtch

    if($payment_status == true){
        $fetch_charges_sql = "SELECT * FROM `revenue` WHERE `revenue_id`='$revenue_id' and `t`='$token';";
        $result_fetch_charges = mysqli_query($conn,$fetch_charges_sql);
        $row_charges = mysqli_fetch_assoc($result_fetch_charges);

        $consultation_fees = $row_charges['con_fees'];
        $additional_fees = $row_charges['addi_fees'];

        $total_amt = $consultation_fees + $additional_fees + $total_payment_due;

        $single_total_amt = $consultation_fees + $additional_fees;
    }
    else{
        $consultation_fees = 200;
        $additional_fees = 0;
        $total_amt = $consultation_fees + $additional_fees + $total_payment_due;

        $single_total_amt = $consultation_fees + $additional_fees;
    }

    // !card details

    // !--
    $sql_appointments = "SELECT * FROM `appointment` WHERE appt_date='$crnt_date' and `t`='$token' ORDER BY appt_time;";
    $result_appointments = mysqli_query($conn,$sql_appointments);
    $num_appointments = mysqli_num_rows($result_appointments);

    // $counter_str = file_get_contents("./partials/ctr.txt");
    // $counter_attended_patient = intval($counter_str);

    $ctr_detail_sql = "SELECT * FROM `date_check` WHERE `t`='$token';";
    $result_ctr_sql = mysqli_query($conn,$ctr_detail_sql);
    $ctr_data = mysqli_fetch_assoc($result_ctr_sql);


    $counter_attended_patient = $ctr_data['ctr'];

    $today_total_patient = $num_appointments + $counter_attended_patient;


    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PrescribeME | Receptionist - Dashboard</title>
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
    
    <section id="payment_pop_up_section">
        <div class="payment_pop_up_container">
            <div class="payment_form_header flex">
                <p>Past Due: <?php echo $total_payment_due; ?></p>
                <i id="payment_close_btn" class="fa-solid fa-xmark"></i>
            </div>
            <div class="payment_data_main_container flex">
                <div class="payment_data_container">
                    <h4>Consultation Fees :</h4>
                    <p><?php echo $consultation_fees; ?></p>
                </div>
                <div class="payment_data_container">
                    <h4>Additional Fees :</h4>
                    <p><?php echo $additional_fees; ?></p>
                </div>
                <div class="payment_data_container">
                    <h4>Total Amount :</h4>
                    <p><?php echo $total_amt; ?></p>
                </div>
            </div>
            <form action="./partials/payment_backend.php" id="payment_form" method="post">
                <div class="payment_main_input_container flex">
                    <div class="payment_input_container flex">
                        <label for="amount_paid">Amount Paid :</label>
                        <input type="number" name="amount_paid" id="amount_paid" required>
                    </div>
                    <div class="payment_input_container flex">
                        <label for="amount_due">Amount Due :</label>
                        <input type="number" name="amount_due" id="amount_due">
                    </div>
                    <input type="hidden" name="single_total_amt" value="<?php echo $single_total_amt; ?>">
                    <input type="hidden" name="all_total_amt" value="<?php echo $total_amt; ?>">
                    <input type="hidden" name="patient_status" value="<?php echo $patient_status; ?>">
                    <input type="hidden" name="apt_id" value="<?php echo $appointment_id; ?>">
                </div>
                <button type="submit" class="btn payment_submit_btn">Submit</button>
            </form>
        </div>
        
    </section>

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
                <!-- <li><a ><i class="fa-solid fa-external-link-alt"></i>Request Feture</a></li> -->
                <li><a href="./partials/_logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
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
                <p class="dashboard_card_label">Today’s Appointments</p>
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
                    <p class="dashboard_card_num" id="dashboard_total_que"><?php echo $num_appointments; ?></p>
                    <div class="dashboard_card_icon_container" id="i3">
                        <i class="fa-solid fa-hourglass-start"></i>
                    </div>
                </div>
                <p class="dashboard_card_label">Pending Appointments</p>
            </div>
        </div>
        <!-- !TABLE CONTAINER -->
        <div class="table_main_container">
            <div class="rec_table_header flex">
                <p class="detail_header">Today's Appointment List</p>
                <div class="add_appo_container flex">
                    <a href="./add_patient.php" class="add_apo_btn"><i class="fa-solid fa-plus"></i>Add Appointments</a>
                    <form action="./index.php" method="post" id="search_bar_id">
                        <input type="text" name="rec_search_patient_input" placeholder="Search Appointment"
                            id="rec_search_patient_input">
                    </form>
                </div>
            </div>
            <table class="dashboard_table" id="rec_main_tbl">
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
                        if($search_var == false){

                            if($active_status == true){

                                if($payment_status == true){
                                    $row = mysqli_fetch_assoc($paymety_first_row);

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
                                    <td class="view_pre_btn flex">
                                        <p class="payment_btn flex">Payment</p>
                                    </td>
                                    </tr>';
                                }

                                $row = mysqli_fetch_assoc($first_row_result);
    
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
                                <td class="view_pre_btn flex">
                                    <p class="active_btn flex">Active </p>
                                    <p class="payment_btn flex">Payment</p>
                                </td>
                                </tr>';

                                if($payment_status == true){

                                    while($row = mysqli_fetch_assoc($payment_ramaining_rows)){
    
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
                                            <td class="view_pre_btn flex">
                                            <form action="./partials/insert_active_value.php" method="post">
                                                <button class="accept_btn" type="submit" name="accept">Accept</button>
                                                <input type="hidden" name="user_id" value="' . $row['appointment_id'] . '">
                                            </form>                    
                                            <form action="./partials/insert_active_value.php" method="post">
                                                <button class="del_btn" name="delete" type="submit">Delete</button>
                                                <input type="hidden" name="user_id" value="' . $row['appointment_id'] . '">
                                            </form>
                                        </td>
                                        </tr>';
                                    }

                                }
                                else{
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
                                        <td class="view_pre_btn flex">
                                        <form action="./partials/insert_active_value.php" method="post">
                                            <button class="accept_btn" type="submit" name="accept">Accept</button>
                                            <input type="hidden" name="user_id" value="' . $row['appointment_id'] . '">
                                        </form>                    
                                        <form action="./partials/insert_active_value.php" method="post">
                                            <button class="del_btn" name="delete" type="submit">Delete</button>
                                            <input type="hidden" name="user_id" value="' . $row['appointment_id'] . '">
                                        </form>
                                    </td>
                                    </tr>';
                                    }
                                }
    
                            }
                            else{
                                if($payment_status == true){
                                    $row = mysqli_fetch_assoc($paymety_first_row);

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
                                    <td class="view_pre_btn flex">
                                        <p class="payment_btn flex">Payment</p>
                                    </td>
                                    </tr>';

                                    while($row = mysqli_fetch_assoc($payment_ramaining_rows)){
    
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
                                            <td class="view_pre_btn flex">
                                            <form action="./partials/insert_active_value.php" method="post">
                                                <button class="accept_btn" type="submit" name="accept">Accept</button>
                                                <input type="hidden" name="user_id" value="' . $row['appointment_id'] . '">
                                            </form>                    
                                            <form action="./partials/insert_active_value.php" method="post">
                                                <button class="del_btn" name="delete" type="submit">Delete</button>
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
                                        <td class="view_pre_btn flex">
                                        <form action="./partials/insert_active_value.php" method="post">
                                            <button class="accept_btn" type="submit" name="accept">Accept</button>
                                            <input type="hidden" name="user_id" value="' . $row['appointment_id'] . '">
                                        </form>                    
                                        <form action="./partials/insert_active_value.php" method="post">
                                            <button class="del_btn" name="delete" type="submit">Delete</button>
                                            <input type="hidden" name="user_id" value="' . $row['appointment_id'] . '">
                                        </form>
                                    </td>
                                    </tr>';
                                    }
                                }
                            }
                        }
                        else{
                            
                            $search_query = "SELECT * FROM `appointment` WHERE (`fname` LIKE '%$search_token%' OR `lname` LIKE '%$search_token%') and `t`='$token'";
                            $search_result = mysqli_query($conn,$search_query);

                            while($row = mysqli_fetch_assoc($search_result)){
    
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
                                <td class="view_pre_btn flex">
                                <form action="./partials/insert_active_value.php" method="post">
                                    <button class="accept_btn" type="submit" name="accept">Accept</button>
                                    <input type="hidden" name="user_id" value="' . $row['appointment_id'] . '">
                                </form>                    
                                <form action="./partials/insert_active_value.php" method="post">
                                    <button class="del_btn" name="delete" type="submit">Delete</button>
                                    <input type="hidden" name="user_id" value="' . $row['appointment_id'] . '">
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
    <script>
        const payment_close_btn = document.getElementById("payment_close_btn"),
        payment_btn = document.querySelector(".payment_btn"),
        payment_pop_up_section = document.getElementById("payment_pop_up_section");
        payment_btn.addEventListener("click",()=>{
            payment_pop_up_section.classList.add("active");
        })
        payment_close_btn.addEventListener("click",()=>{
            payment_pop_up_section.classList.remove("active");
        })
    </script>



    <script>

        var total_amount = "<?php echo $total_amt; ?>";
        
        var amt_paid = document.getElementById('amount_paid');
        var amt_due = document.getElementById('amount_due');

        amt_paid.addEventListener('input', function() {
            amt_due.value = total_amount - amt_paid.value;
        });

    </script>
</body>


</html>