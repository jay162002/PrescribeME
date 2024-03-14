<?php

    include './partials/session.php';
    include '../partials/_dbconnect.php';
    include './partials/username.php';

    $patient_sql = "SELECT patients.*, patient_total_due.total_due_amt FROM patients JOIN patient_total_due ON patients.id = patient_total_due.id and patients.t='$token';";
    $result_patient = mysqli_query($conn,$patient_sql);

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
    <title>PriscribeME | Doctor-Patients</title>
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
                <p>Patients</p>
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
                <li><a class="active" href="./patient.php"><i class="fa-solid fa-user-injured"></i>Patients</a></li>
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
            <form action="./patient.php" id="patient_search_input_form" method="post">
                <div class="patient_search_input_container flex">
                    <input type="text" name="search_patient"
                        placeholder="Search your patients with name, id or Phone no." id="search_patient">
                    <label for="search_patient"><i class="fa-solid fa-magnifying-glass"></i></label>
                </div>
            </form>
        </div>
        <!-- !TABLE CONTAINER -->
        <div class="table_main_container">
            <p class="detail_header">Total Patients List</p>
            <table class="dashboard_table" id="patient_table">
                <thead>
                    <tr class="flex">
                        <td>ID</td>
                        <td>Name</td>
                        <td>Gender</td>
                        <td>Mobile</td>
                        <td>Last Visit</td>
                        <td>Amount Due</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody class="tbody">
                <!-- WHERE `fname` LIKE '%$search_token%' OR `lname` LIKE '%$search_token%' OR `phone_no` LIKE '%$search_token%' OR `id` LIKE '%$search_token%' -->

                    <?php

                        if($search_var == true){
                            $search_query = "SELECT patients.*, patient_total_due.total_due_amt FROM `patients` JOIN patient_total_due ON patients.id = patient_total_due.id WHERE (`fname` LIKE '%$search_token%' OR `lname` LIKE '%$search_token%' OR `phone_no`='$search_token' OR patients.id='$search_token') AND patients.t='$token';";

                            $search_result = mysqli_query($conn,$search_query);

                            while($row = mysqli_fetch_assoc($search_result)){
                                echo '<tr class="flex">
                                <td>' . $row['id'] . '</td>
                                <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                <td>' . $row['gender'] . '</td>
                                <td>' . $row['phone_no'] . '</td>
                                <td>' . $row['last_visit'] . '</td>
                                <td>' . $row['total_due_amt'] . '</td>
                                <td class="view_pre_btn">
                                    <form action="./all_prescri_patient.php" method="post">
                                        <button type="submit"  name="jay">View</button>
                                        <input type="hidden" name="user_id" value="' . $row['id'] . '">
                                    </form>
                                </td>
                            </tr>';
                            }

                            
                        }
                        else{
                            while($row = mysqli_fetch_assoc($result_patient)){
                                echo '<tr class="flex">
                                <td>' . $row['id'] . '</td>
                                <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                <td>' . $row['gender'] . '</td>
                                <td>' . $row['phone_no'] . '</td>
                                <td>' . $row['last_visit'] . '</td>
                                <td>' . $row['total_due_amt'] . '</td>
                                <td class="view_pre_btn">
                                    <form action="./all_prescri_patient.php" method="post">
                                        <button type="submit"  name="jay">View</button>
                                        <input type="hidden" name="user_id" value="' . $row['id'] . '">
                                    </form>
                                </td>
                            </tr>';
                            }
                        }
                    ?>

                    <!-- <tr class="flex">
                        <td>1</td>
                        <td>Jay Darji</td>
                        <td>Male</td>
                        <td>+91 9624478191</td>
                        <td>19-03-2023</td>
                        <td>300</td>
                        <td class="view_pre_btn">
                            <form action="./temp.php" method="post">
                                <button type="submit"  name="jay">View</button>
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