<?php

    include './partials/session.php';
    include '../../partials/_dbconnect.php';

    $revenue_id = $_POST['revenue_id'];
    $patient_id = $_POST['patient_id'];

    $this_revenue_sql = "SELECT * FROM revenue WHERE revenue_id='$revenue_id' and `t`='$token';";
    $this_revenue_result = mysqli_query($conn,$this_revenue_sql);

    $all_revenue_sql = "SELECT * FROM revenue WHERE id='$patient_id' and `t`='$token';";
    $all_revenue_result = mysqli_query($conn,$all_revenue_sql);

    $row = $row = mysqli_fetch_assoc($this_revenue_result);
    $full_name = $row['fname'] . ' ' . $row['lname'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PriscribeME | View Revenue</title>
    <!-- !FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- !LOCAL STYLES -->
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="stylesheet" href="../../dashboard/styles/style.css" />
    <link rel="stylesheet" href="./styles/reponsive.css" />
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
                    <a href="./revenue.php" class="close_btn btn">Close</a>

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
                <li><a href="./patient.html"><i class="fa-solid fa-user-injured"></i>Patients</a></li>
                <li><a href="./revenue.php"><i class="fa-solid fa-indian-rupee-sign"></i>Revenue</a></li>
                <li><a href="./fellow_doctors_.php"><i class="fa-solid fa-stethoscope"></i>Fellow Doctors</a></li>
                <!-- <li><a ><i class="fa-solid fa-external-link-alt"></i>Request Feture</a></li> -->
                <li><a href="./partials/_logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
            </ul>
        </nav>
    </div>
    </header>
    <section class="dashboard_main_container" id="rec_cre_main_container">
                <div class="rec_cre_container" id="view_revenue_container">
        
            <table class="rec_cre_tbl">
                <thead>
                    <tr>
                        <th>SR NO</th>
                        <th>Revenue ID</th>
                        <th>Date</th>
                        <th>Consultation Fees</th>
                        <th>Additional Fees</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                        $date_string = $row['date'];
                        $timestamp = strtotime($date_string);
                        $formatted_date = date('d/m/Y', $timestamp);

                        echo '<tr>
                            <td>1</td>
                            <td>' . $row['revenue_id'] . '</td>
                            <td>' . $formatted_date . '</td>
                            <td>' . $row['con_fees'] . '</td>
                            <td>' . $row['addi_fees'] . '</td>
                            <td>' . $row['total_fees'] . '</td>
                            <td>' . $row['paid_amt'] . '</td>
                            <td>' . $row['amt_duo'] . '</td>    
                        </tr>';
                            
                    ?>
    
                </tbody>
            </table>  


            
            <h2 class="view_revenue_main_heading_temp">All Records of <?php echo $full_name; ?></h2>

            <table class="rec_cre_tbl" id="view_revenue_table_temp">
                <thead>
                    <tr>
                        <th>SR NO</th>
                        <th>Revenue ID</th>
                        <th>Date</th>
                        <th>Consultation Fees</th>
                        <th>Additional Fees</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sr_ctr = 1;
                        while($row = mysqli_fetch_assoc($all_revenue_result)){

                            $date_string = $row['date'];
                            $timestamp = strtotime($date_string);
                            $formatted_date = date('d/m/Y', $timestamp);

                            echo '<tr>
                                <td>' . $sr_ctr . '</td>
                                <td>' . $row['revenue_id'] . '</td>
                                <td>' . $formatted_date . '</td>
                                <td>' . $row['con_fees'] . '</td>
                                <td>' . $row['addi_fees'] . '</td>
                                <td>' . $row['total_fees'] . '</td>
                                <td>' . $row['paid_amt'] . '</td>
                                <td>' . $row['amt_duo'] . '</td>    
                            </tr>';
                            $sr_ctr += 1;
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </section>

    </section>


    <!-- !SCRIPTS -->
    <script src="./scripts/profile.js"></script>
</body>

</html>