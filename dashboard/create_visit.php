<?php


    include './partials/session.php';
    include '../partials/_dbconnect.php';
    include './partials/username.php';

    $user_id = $_POST['user_id'];

    $name_sql = "SELECT * FROM `appointment` WHERE `appointment_id`='$user_id' and `t`='$token';";
    $name_result = mysqli_query($conn,$name_sql);
    $row_name = mysqli_fetch_assoc($name_result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PriscribeME | Prescription</title>
    <!-- !FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- !JQUERY -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- !SELECT TO LIBRARY -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- !LOCAL STYLES -->
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="stylesheet" href="./styles/reponsive.css" />

    
</head>

<body>
    <header class="flex edit-nav" id="dashborad_header">
        <!-- LINKS CONTAINER -->
        <nav class="link_container flex">
            <div class="dashboard_header flex">
                <p>Create Prescription</p>
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
                <li><a href="../partials/_logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
            </ul>
        </nav>
    </div>

    <!-- !DASHBOARD SECTION -->
    <section class="dashboard_main_container">
        <!-- !TABLE CONTAINER -->
        <div class="table_main_container" id="create_visit_table_main_container">
            <p class="detail_header"><?php echo $row_name['fname'] . ' ' . $row_name['lname']; ?></p>
            <form action="./partials/insert_prescription.php" id="create_visit_form" method="post">
                <div class="create_visit_input_main_container">
                    <div class="create_visit_input_header_container flex">
                        <div class="green_dot"></div>
                        <p>Vital</p>
                    </div>
                    <div class="vital_input_main_container flex">
                        <div class="vital_input_container flex">
                            <label for="weight">Weight</label>
                            <input type="number" step="0.01" name="weight" id="weight">
                            <p>Kg</p>
                        </div>
                        <div class="vital_input_container flex">
                            <label for="pulse">Pulse</label>
                            <input type="number" step="0.01" name="pulse" id="pulse">
                            <p>bpm</p>
                        </div>
                        <div class="vital_input_container flex">
                            <label for="temp">Temperature</label>
                            <input type="number" step="0.01" name="temp" id="temp">
                            <p>F</p>
                        </div>
                        <div class="vital_input_container flex">
                            <label for="bp">BP</label>
                            <input type="number" step="0.01" name="bp" id="bp">
                            <p>mmHg</p>
                        </div>
                        <div class="vital_input_container flex">
                            <label for="height">Height</label>
                            <input type="number" step="0.01" name="height" id="height">
                            <p>Feet</p>
                        </div>
                    </div>
                </div>

                <div class="create_visit_input_main_container">
                    <div class="create_visit_input_header_container flex">
                        <div class="green_dot"></div>
                        <p>Complain</p>
                    </div>
                    <table class="create_visit_tbl" >
                        <thead class="flex">
                            <tr>
                                <th>Complain</th>
                                <th>Frequency</th>
                                <th>Severity</th>
                                <th>Duration</th>
                                <td><i class="add-btn fa-solid fa-add" id="add_Complain_row"
                                        style="color: #027413;"></i></td>
                            </tr>
                        </thead>
                        <tbody class="complain_input_table">
                            <tr class="flex tbl_input_row complain_input_row">
                                <td><input type="text" name="complain-0-[]" id="complain-0"></td>
                                <td><input type="text" name="frequency-0-[]" id="frequency-0"></td>
                                <td><input type="text" name="severity-0-[]" id="severity-0"></td>
                                <td><input type="text" name="duration-0-[]" id="duration-0"></td>
                                <td><i class="fa-solid fa-xmark" style="color: #D92231;"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- !INPUT CHANGE -->
                <div class="create_visit_input_main_container" id="temp1">
                    <div class="create_visit_input_header_container flex">
                        <div class="green_dot"></div>
                        <p>Diagnosis</p>
                    </div>
                    <table class="create_visit_tbl">
                        <thead class="flex">
                            <tr class="temp3">
                                <th class="temp2">Diagnosis</th>
                                <th class="temp2">Duration</th>
                                <td id="aadd_Diagnosis_td"><i class="add-btn fa-solid fa-add" id="add_Diagnosis_row"
                                        style="color: #027413;"></i></td>
                            </tr>
                        </thead>
                        <tbody class="Diagnosis_input_table">
                            <tr class="flex tbl_input_row Diagnosis_input_row">
                                <td><input type="text" name="dignosis-0-[]" id="complain-0"></td>
                                <td><input type="text" name="dd-0-[]" id="frequency-0"></td>
                                <td><i class="fa-solid fa-xmark" style="color: #D92231;"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- !INPUT CHANGE -->
                <div class="create_visit_input_main_container">
                    <div class="create_visit_input_header_container flex">
                        <div class="green_dot"></div>
                        <p>Rx</p>
                    </div>
                    <table class="create_visit_tbl" id="rx_tbl">
                        <thead class="flex">
                            <tr>
                                <th>Medicine</th>
                                <th>Dose</th>
                                <th>When</th>
                                <th>Frequency</th>
                                <th>Qty.</th>
                                <td><i class="add-btn fa-solid fa-add" id="add_rx_row" style="color: #027413;"></i></td>
                            </tr>
                        </thead>
                        <tbody class="rx_input_table">
                            <tr class="flex tbl_input_row rx_input_row">
                                <td><input type="text" name="Medicine-0-[]" id="Medicine-0"></td>
                                <!-- <td><input type="text" name="Dose-0-[]" id="Dose-0"></td> -->
                                <td><select class="js-example-basic-single" name="dose-0-[]" id="dose-0">
                                    <option value="">Select an option</option>
                                    <option value="1-0-0">1-0-0</option>
                                    <option value="0-1-0">0-1-0</option>
                                    <option value="0-0-1">0-0-1</option>
                                    <option value="1-1-0">1-1-0</option>                                  
                                    <option value="1-0-1">1-0-1</option>                                  
                                    <option value="0-1-1">0-1-1</option>                                                                   
                                    <option value="1-1-1">1-1-1</option>                                  
                                </select></td>
                                <td>
                                    <select class="js-example-basic-single" name="When-0-[]" id="When-0">
                                        <option value="">Select an option</option>
                                        <option value="Before meal">Before meal</option>
                                        <option value="After meal">After meal</option>                                 
                                    </select>
                                </td>
                                <td>
                                    <select class="js-example-basic-single" name="Frequency-0-[]" id="Frequency-0">
                                        <option value="">Select an option</option>
                                        <option value="Daily">Daily</option>
                                        <option value="Semi Weekly">Semi Weekly</option>                                 
                                        <option value="Weekly">Weekly</option>                                 
                                        <option value="Monthly">Monthly</option>                                 
                                    </select>
                                </td>
                                <td><input type="text" name="Qty-0-[]" id="Qty-0"></td>
                                <td><i class="fa-solid fa-xmark" style="color: #D92231;"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- !INPUT CHANGE -->
                <!-- <div class="create_visit_input_main_container">
                    <div class="create_visit_input_header_container flex">
                        <div class="green_dot"></div>
                        <p>Allergy </p>
                    </div>
                    <table class="create_visit_tbl">
                        <thead class="flex">
                            <tr>
                                <th>Allergy Name</th>
                                <th>Duration</th>
                                <th>Severity</th>
                                <td><i class="add-btn fa-solid fa-add" id="add_allergy_row" style="color: #027413;"></i>
                                </td>
                            </tr>
                        </thead>
                        <tbody class="allergy_input_table">
                            <tr class="flex tbl_input_row allergy_input_row">
                                <td><input type="text" name="allergy_name-0-[]" id="allergy_name-0"></td>
                                <td><input type="text" name="allergy_Dur-0-[]" id="allergy_Dur-0"></td>
                                <td><input type="text" name="allergy_Severity-0-[]" id="allergy_Severity-0"></td>
                                <td><i class="fa-solid fa-xmark" style="color: #D92231;"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->
                <!-- !INPUT CHANGE -->
                <!-- !INPUT CHANGE -->
                <div class="create_visit_input_main_container">
                    <div class="create_visit_input_header_container flex">
                        <div class="green_dot"></div>
                        <p>Advice</p>
                    </div>
                    <textarea name="advice_txt" id="advice_txt" cols="30" rows="10"></textarea>
                </div>
                <!-- !INPUT CHANGE -->
                <div class="create_visit_input_main_container">
                    <div class="create_visit_input_header_container flex">
                        <div class="green_dot"></div>
                        <p>Additional Fees</p>
                    </div>
                    <table class="create_visit_tbl" id="fee_tbl">
                        <thead class="flex">
                            <tr>
                                <th>Consultation Fees</th>
                                <th>Additional Fees</th>
                                <th>Total Fees</th>
                            </tr>
                        </thead>
                        <tbody class="Additional_input_table">
                            <tr class="flex tbl_input_row Additional_input_row">
                                <td><input type="text" name="consultation_fees" value="200" disabled></td>
                                <td><input type="number" value="0" name="additional_fees" id="additional_fees"></td>
                                <td><input type="text" value="200" name="total_fees" id="total_fees" disabled></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="create_visit_input_main_container">
                    <div class="create_visit_input_header_container flex">
                        <div class="green_dot"></div>
                        <p>Next Visit Date</p>
                    </div>
                    <div class="vital_input_main_container flex">
                        <div class="vital_input_container flex" id="nxt_visit_container">
                            <label for="nxt_visit_date">Next Visit Date</label>
                            <input type="date" name="nxt_visit_date" id="nxt_visit_date">
                        </div>
                        
                    </div>
                </div>
                    <div class="creat_pre_input_container">
                        <input type="checkbox" name="patient_miss_behave" id="patient_miss_behave" value="yes">
                        <label for="patient_miss_behave">Did Patient Miss Behaved?</label>
                    </div>
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <button type="submit" class="btn" id="end_consultaion" name="end_consultaion">End Consultation</button>
            </form>
        </div>
    </section>


    <!-- !SCRIPTS -->
    <script src="./scripts/create_visit.js"></script>
    <script src="./scripts/main.js"></script>
    <script>
    
        var conslt_fees = 200
        var addi_fees = document.getElementById('additional_fees');
        var total_fees = document.getElementById('total_fees');

        addi_fees.addEventListener('input', function() {
            total_fees.value = parseInt(addi_fees.value) + conslt_fees;
        });
        
    </script>
</body>

</html>