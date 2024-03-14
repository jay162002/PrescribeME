<?php

    include './partials/session.php';
    include '../../partials/_dbconnect.php';

    $pres_id = $_POST['presc_id'];

    $medicine_sql = "SELECT * FROM `prescription_rx` WHERE pres_id='$pres_id' and `t`='$token';";
    $medicine_result = mysqli_query($conn,$medicine_sql);
    $row = mysqli_fetch_assoc($medicine_result);

    $medicine_str = $row['medicine'];
    $medicine_array = explode(',', $medicine_str);

    $dose_str = $row['dose'];
    $dose_array = explode(',', $dose_str);

    $when_str = $row['when_rx'];
    $when_array = explode(',', $when_str);

    $frequency_str = $row['frequency'];
    $frequency_array = explode(',', $frequency_str);

    $qty_str = $row['qty'];
    $qty_array = explode(',', $qty_str);


    $len = count($medicine_array);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Prescribe Me | Prescription-Pharmacist</title>
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
                <p>View Medicines</p>
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
                            <a href="../forgot_pass.php" class="flex"><i class="fa-solid fa-user-lock"
                                    style="color: #99BBDD;"></i>Change Password</a>
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
                <li><a href="./fellow_doctors_.php"><i class="fa-solid fa-stethoscope"></i>Fellow Doctors</a></li>
                <li><a href="./partials/_logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
            </ul>
        </nav>
    </div>

    <!-- !DASHBOARD SECTION -->
    <section class="dashboard_main_container">
        <!-- !INPUT CHANGE -->
        <div class="create_visit_input_main_container">
            <div class="create_visit_input_header_container flex">
                <div class="green_dot"></div>
                <p>Rx</p>
            </div>
            <table class="rec_cre_tbl">
                <thead>
                    <tr>
                        <th>SR NO</th>
                        <th>Medicine Name</th>
                        <th>Dose</th>
                        <th>When</th>
                        <th>Frequency</th>
                        <th>Qty.</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <form action="./partials/manage_payment.php" method="post">
                <tbody>
                    <?php

                        for ($i = 0; $i < $len; $i++)
                        {
                            echo '<tr>
                                    <td>' . $i + 1 . '</td>
                                    <td>' . $medicine_array[$i] . '</td>
                                    <td>' . $dose_array[$i] . '</td>
                                    <td>' . $when_array[$i] . '</td>
                                    <td>' . $frequency_array[$i] . '</td>
                                    <td>' . $qty_array[$i] . '</td>
                                    <td class="med_price_td">
                                        <input type="number" class="med_price_input" name="med_inputs[]" id="Pharmacist_amount'.$i.'">
                                        
                                    </td>
                                </tr>';
                        }
                    ?>
                    
                    
                    <tr>
                        <td colspan="6">Total Amount :</td>
                    
                            <td>
                                <input type="hidden" name="presc_id" value="<?php echo $pres_id; ?>">
                                <input type="number" class="med_price_input" name="total_amt" id="total_amt" value="0">
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                
                
                
                <button type="submit" class="btn" id="end_consultaion" name="end_consultaion">SUBMIT</button>
            </form>
        </div>
    </section>


    <!-- !SCRIPTS -->
    <script src="./scripts/main.js"></script>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            // Get all the med_price_input fields
            const inputFields = document.querySelectorAll('.med_price_input');
            const totalAmountField = document.getElementById('total_amt');

            // Add an event listener to each input field
            inputFields.forEach(function(inputField) {
                inputField.addEventListener('input', calculateTotalAmount);
            });

            function calculateTotalAmount() {
            let totalAmount = 0;

            // Get the number of rows in the table
            const rowCount = <?php echo $len; ?>;

            // Iterate through the input fields and sum their values
            for (let i = 0; i < rowCount; i++) {
                const inputField = document.getElementById('Pharmacist_amount' + i);
                const fieldValue = parseFloat(inputField.value) || 0;
                totalAmount += fieldValue;
            }

            // Update the total amount field with the calculated sum
            const totalAmountField = document.getElementById('total_amt');
            totalAmountField.value = totalAmount.toFixed(2); // Round to 2 decimal places
            }
        });
    </script>








</body>


</html>