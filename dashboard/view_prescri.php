<?php

    include './partials/session.php';
    include '../partials/_dbconnect.php';

    $pres_id = $_POST['pres_id_name'];

    // !vitals

    $vitals_sql = "SELECT * FROM `prescription_vitals` WHERE `pres_id`='$pres_id' and `t`='$token';";
    $result_vitals = mysqli_query($conn,$vitals_sql);
    $row_vitals = mysqli_fetch_assoc($result_vitals);

    $weigth = $row_vitals['weight'];
    $height = $row_vitals['height'];
    $pulse = $row_vitals['pulse'];
    $temperature = $row_vitals['temperature'];
    $bp = $row_vitals['bp'];

    // !complain

    $complain_sql = "SELECT * FROM `prescription_complain` WHERE pres_id='$pres_id' and `t`='$token';";
    $complain_result = mysqli_query($conn,$complain_sql);
    $row_complain = mysqli_fetch_assoc($complain_result);

    $complain = $row_complain['complain'];
    $complain_array = explode(',', $complain);

    $complain_frequency = $row_complain['frequency'];
    $complain_frequency_array = explode(',', $complain_frequency);

    $complain_severity = $row_complain['severity'];
    $complain_severity_array = explode(',', $complain_severity);

    $complain_duration = $row_complain['duration'];
    $complain_duration_array = explode(',', $complain_duration);

    $len_complain = count($complain_array);

    // !diagnosis

    $diagnosis_sql = "SELECT * FROM `prescription_diagnosis` WHERE pres_id='$pres_id' and `t`='$token';";
    $diagnosis_result = mysqli_query($conn,$diagnosis_sql);
    $row_diagnosis = mysqli_fetch_assoc($diagnosis_result);

    $diagnosis = $row_diagnosis['diagnosis'];
    $diagnosis_array = explode(',', $diagnosis);

    $diagnosis_duration = $row_diagnosis['duration'];
    $diagnosis_duration_array = explode(',', $diagnosis_duration);

    $len_diagnosis = count($diagnosis_array);

    // !medicine

    $medicine_sql = "SELECT * FROM `prescription_rx` WHERE pres_id='$pres_id' and `t`='$token';";
    $medicine_result = mysqli_query($conn,$medicine_sql);
    $row_rx = mysqli_fetch_assoc($medicine_result);

    $medicine_str = $row_rx['medicine'];
    $medicine_array = explode(',', $medicine_str);

    $dose_str = $row_rx['dose'];
    $dose_array = explode(',', $dose_str);

    $when_str = $row_rx['when_rx'];
    $when_array = explode(',', $when_str);

    $frequency_str = $row_rx['frequency'];
    $frequency_array = explode(',', $frequency_str);

    $qty_str = $row_rx['qty'];
    $qty_array = explode(',', $qty_str);


    $len_rx = count($medicine_array);

    // !other

    $other_sql = "SELECT * FROM `prescription_other_details` WHERE pres_id='$pres_id' and `t`='$token';";
    $other_result = mysqli_query($conn,$other_sql);
    $row_other = mysqli_fetch_assoc($other_result);

    $advice = $row_other['advice'];
    $consultation_fees = $row_other['consultation_fees'];
    $additional_fees = $row_other['additional_fees'];
    $total_fees = $row_other['total_fees'];
    $next_visit_date = $row_other['next_visit_date'];
    $miss_behave_checked = $row_other['miss_behave_checked'];
    


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PriscribeME | View Prescription</title>
    <!-- !FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- !LOCAL STYLES -->
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="stylesheet" href="./styles/reponsive.css" />
    <link rel="stylesheet" href="./styles/view_pre.css" />
</head>

<body>
    <header class="flex edit-nav" id="dashborad_header">
        <!-- LINKS CONTAINER -->
        <nav class="link_container flex">
            <div class="dashboard_header flex">
                <p>View Payment Records</p>
            </div>
            <ul class="login_link_container flex">
                <li class="signed_in_btn flex">
                    <a href="./index.php" class="close_btn btn">Close</a>

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
                <li><a href="../"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
            </ul>
        </nav>
    </div>
    </header>
    <section class="dashboard_main_container" id="rec_cre_main_container">
        <!-- !TABLE START -->
        <div class="rec_cre_container" id="view_revenue_container">
            <h2 class="view_revenue_main_heading_temp">Vitals</h2>
            <table class="rec_cre_tbl" id="view_revenue_table_temp">
                <thead>
                    <tr>
                        <th>Weight</th>
                        <th>Height</th>
                        <th>Temperature</th>
                        <th>BP</th>
                        <th>Pulse</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $weigth; ?></td>
                        <td><?php echo $height; ?></td>
                        <td><?php echo $temperature; ?></td>
                        <td><?php echo $bp; ?></td>
                        <td><?php echo $pulse; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- !TABLE ENDS -->
        <!-- !TABLE START -->
        <div class="rec_cre_container" id="view_revenue_container">
            <h2 class="view_revenue_main_heading_temp">Complain</h2>
            <table class="rec_cre_tbl" id="view_revenue_table_temp">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Complain</th>
                        <th>Frequency</th>
                        <th>Severity</th>
                        <th>Duration</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $ctr = 1;
                        for ($i = 0; $i < $len_complain; $i++){
                            echo '<tr>
                            <td>' . $i + 1 . '</td>
                            <td>' . $complain_array[$i] . '</td>
                            <td>' . $complain_frequency_array[$i] . '</td>
                            <td>' . $complain_severity_array[$i] . '</td>
                            <td>' . $complain_duration_array[$i] . '</td>
                        </tr>';
                        $ctr += 1;
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- !TABLE ENDS -->
        <!-- !TABLE START -->
        <div class="rec_cre_container" id="view_revenue_container">
            <h2 class="view_revenue_main_heading_temp">Diagnosis</h2>
            <table class="rec_cre_tbl" id="view_revenue_table_temp">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Diagnosis</th>
                        <th>Duration</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $ctr = 1;
                        for ($i = 0; $i < $len_diagnosis; $i++){
                            echo '<tr>
                            <td>' . $i + 1 . '</td>
                            <td>' . $diagnosis_array[$i] . '</td>
                            <td>' . $diagnosis_duration_array[$i] . '</td>
                        </tr>';
                        $ctr += 1;
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- !TABLE ENDS -->
        <!-- !TABLE START -->
        <div class="rec_cre_container" id="view_revenue_container">
            <h2 class="view_revenue_main_heading_temp">Rx</h2>
            <table class="rec_cre_tbl" id="view_revenue_table_temp">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Medicine</th>
                        <th>Dose</th>
                        <th>When</th>
                        <th>Frequency</th>
                        <th>Qty.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for ($i = 0; $i < $len_rx; $i++)
                            {
                                echo '<tr>
                                        <td>' . $i + 1 . '</td>
                                        <td>' . $medicine_array[$i] . '</td>
                                        <td>' . $dose_array[$i] . '</td>
                                        <td>' . $when_array[$i] . '</td>
                                        <td>' . $frequency_array[$i] . '</td>
                                        <td>' . $qty_array[$i] . '</td>
                                    </tr>';
                            }
                        ?>
                </tbody>
            </table>
        </div>
        <!-- !TABLE ENDS -->
        <!-- !TABLE START -->
        <div class="create_visit_input_main_container">
            <div class="create_visit_input_header_container flex">
                <p>Advice</p>
            </div>
            <p id="advice_txt"><?php echo $advice; ?></p>
        </div>
        <!-- !TABLE ENDS -->
        <!-- !TABLE START -->
        <div class="rec_cre_container" id="view_revenue_container">
            <h2 class="view_revenue_main_heading_temp">Additional Fees</h2>
            <table class="rec_cre_tbl" id="view_revenue_table_temp">
                <thead>
                    <tr>
                        <th>Consultation Fees</th>
                        <th>Additional Fees</th>
                        <th>Total Fees</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $consultation_fees; ?></td>
                        <td><?php echo $additional_fees; ?></td>
                        <td><?php echo $total_fees; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- !TABLE ENDS -->
        <!-- !TABLE START -->
        <div class="rec_cre_container" id="view_revenue_container">
            <h2 class="view_revenue_main_heading_temp">Next Visit Date : <?php echo $next_visit_date; ?></h2>
        </div>
        <!-- !TABLE ENDS -->
        <!-- !TABLE START -->
        <div class="rec_cre_container" id="patient_miss_behaive_container">
            <h2 class="view_revenue_main_heading_temp">Patient Miss Behaved : <?php echo $miss_behave_checked; ?></h2>
        </div>
        <!-- !TABLE ENDS -->
    </section>

    </section>


    <!-- !SCRIPTS -->
    <script src="./scripts/profile.js"></script>
</body>

</html>