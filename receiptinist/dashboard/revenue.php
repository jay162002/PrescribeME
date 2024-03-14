<?php

    include './partials/session.php';   
    include '../../partials/_dbconnect.php';

    $revenue_sql = "SELECT * FROM revenue where `t`='$token';";
    $result_revenue = mysqli_query($conn,$revenue_sql);

    // !search
    
    if(isset($_POST['search_patient'])){
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
    <title>PriscribeME | Revenue-Receptionis</title>
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
                <p>Revenue</p>
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
                <li><a href="./patient.php"><i class="fa-solid fa-user-injured"></i>Patients</a></li>
                <li><a href="./revenue.php" class="active"><i class="fa-solid fa-indian-rupee-sign"></i>Revenue</a></li>
                <li><a href="./fellow_doctors_.php"><i class="fa-solid fa-stethoscope"></i>Fellow Doctors</a></li>
                <!-- <li><a ><i class="fa-solid fa-external-link-alt"></i>Request Feture</a></li> -->
                <li><a href="./partials/_logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
            </ul>
        </nav>
    </div>

    <!-- !DASHBOARD SECTION -->
    <section class="dashboard_main_container">
        <div class="dashboard_card_container flex">
            <form action="./revenue.php" id="patient_search_input_form" method="post">
                <div class="patient_search_input_container flex">
                    <input type="text" name="search_patient"
                        placeholder="Search your patient by Id, Name or Phone No." id="search_patient">
                    <label for="search_patient"><i class="fa-solid fa-magnifying-glass"></i></label>
                </div>
            </form>
        </div>
        <!-- !TABLE CONTAINER -->
        <div class="table_main_container">
            <p class="detail_header">Total Revenue</p>
            <table class="dashboard_table" id="revenue_tbl">
                <thead>
                    <tr class="flex">
                        <td>ID</td>
                        <td>Revenue ID</td>
                        <td>Name</td>
                        <td>Mobile</td>
                        <td>Date</td>
                        <td>Total Amount</td>
                        <td>Paid Amount</td>
                        <td>Action</td>
                    </tr>
                </thead>

                <tbody class="tbody">
                <?php

                    if($search_var == true){
                        $search_query = "SELECT * FROM `revenue` WHERE (`fname` LIKE '%$search_token%' OR `lname` LIKE '%$search_token%' OR `phone_no`='$search_token' OR id='$search_token' OR revenue_id='$search_token') and `t`='$token';";
                        $search_result = mysqli_query($conn,$search_query);

                        while($row = mysqli_fetch_assoc($search_result)){
                            echo '<tr class="flex">
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['revenue_id'] . '</td>
                            <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                            <td>' . $row['phone_no'] . '</td>
                            <td>' . $row['date'] . '</td>
                            <td>' . $row['total_fees'] . '</td>
                            <td>' . $row['paid_amt'] . '</td>
                            <td class="view_pre_btn">
                                <form action="./view_revenue.php" method="post">
                                    <button type="submit"  name="jay">View</button>
                                    <input type="hidden" name="revenue_id" value="' . $row['revenue_id'] . '">
                                    <input type="hidden" name="patient_id" value="' . $row['id'] . '">
                                </form>
                            </td>
                        </tr>';
                        }

                        
                    }
                    else{
                        while($row = mysqli_fetch_assoc($result_revenue)){
                            echo '<tr class="flex">
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['revenue_id'] . '</td>
                            <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                            <td>' . $row['phone_no'] . '</td>
                            <td>' . $row['date'] . '</td>
                            <td>' . $row['total_fees'] . '</td>
                            <td>' . $row['paid_amt'] . '</td>
                            <td class="view_pre_btn">
                                <form action="./view_revenue.php" method="post">
                                    <button type="submit"  name="jay">View</button>
                                    <input type="hidden" name="revenue_id" value="' . $row['revenue_id'] . '">
                                    <input type="hidden" name="patient_id" value="' . $row['id'] . '">
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