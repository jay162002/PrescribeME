<?php


    include './partials/session.php';
    include '../partials/_dbconnect.php';
    include './partials/username.php';

    if(isset($_GET['$exist'])){
        $exist = $_GET['$exist'];
    }
    else{
        $exist = false;
    }

    $sql = "SELECT * FROM `receptionist_cred` where `t`='$token'";
    $result = mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PrescibeME | Add Credentials</title>
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
                <p>Receptionist credentials</p>
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
                <li><a href="./patient.php"><i class="fa-solid fa-user-injured"></i>Patients</a></li>
                <li><a><i class="fa-solid fa-indian-rupee-sign"></i>Revenue</a></li>
                <li><a><i class="fa-solid fa-stethoscope"></i>Fellow Doctors</a></li>
                <!-- <li><a ><i class="fa-solid fa-external-link-alt"></i>Request Feture</a></li> -->
                <li><a href="../partials/_logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
            </ul>
        </nav>
    </div>

    

    <!-- !DASHBOARD SECTION -->
    <section class="dashboard_main_container" id="rec_cre_main_container">
        <?php
            if($exist){
                echo '<div class="error_container" id= "error_popup_container">
                        <span onclick="close_popup()" class="cross">&times;</span>
                        <p><span class="first_word">Error!</span> Username Already Exist! </p>
                    </div>';
            }
        ?>
        <div class="rec_cre_container">
        
            <table class="rec_cre_tbl">
                <thead>
                    <tr>
                        <th>SR NO</th>
                        <th>User Name</th>
                        <th>Password</th>
                        <th>Time</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        $counter = 1;
                        while($row = mysqli_fetch_assoc($result)){

                            echo '<tr>
                            <td>' . $counter . '</td>
                            <td>' . $row['username'] . '</td>
                            <td>' . $row['password'] . '</td>
                            <td>' . $row['dt'] . '</td>
                            <td>
                                <form action="./partials/delete_cred.php" method="post">
                                    <button class="del_cre" type="submit" name="delete_rec_cred"><i class="fa-solid fa-trash"></i></button>
                                    <input type="hidden" name="user_name" value="' . $row['username'] . '">
                                </form>
                            </td>
                        </tr>';
                        $counter += 1;
                        }
                    ?>

                    <!-- <tr>
                        <td>01</td>
                        <td>kavita</td>
                        <td>kavita1234</td>
                        <td>2018-02-21 12:00:01</td>
                        <td>
                            <form action="#" method="post">
                                <button class="del_cre" type="submit"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>01</td>
                        <td>kavita</td>
                        <td>kavita1234</td>
                        <td>2018-02-21 12:00:00</td>
                        <td>
                            <form action="#" method="post">
                                <button class="del_cre" type="submit"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr> -->
                </tbody>
            </table>
            <!-- !ADD CRED FORM -->
            <form action="../partials/insert_cred.php" method="post" id="add_front_desk_cred_form">
                <h3 class="add_front_desk_cre_form_header">Add Receptionist</h3>
                <div class="input_main_container flex">
                    <div class="input_container">
                        <label for="add_cre_user_name">User Name</label>
                        <input type="text" name="add_cre_user_name" id="add_cre_user_name" value="<?php echo $token; ?>" readonly="true">
                    </div>
                    <div class="input_container">
                        <label for="add_cre_user_pass">Password</label>
                        <input type="password" name="add_cre_user_pass" id="add_cre_user_pass" required="true">
                    </div>
                </div>
                <button type="submit" class="btn" id="add_rec_btn"><i class="fa-solid fa-plus"></i>Add
                    Receptionist</button>
            </form>
        </div>
    </section>


    <!-- !SCRIPTS -->
    <script src="./scripts/main.js"></script>
    <script>
    const cred_box_container = document.querySelector(".cred_box_container");
    cred_box_container.addEventListener("click", () => {
        document.getElementById("cred_users_container").classList.toggle("hide");
        document.getElementById("profile_pop_up").classList.add("hide");
        document.getElementById("profile_pop_up").classList.remove("active");
    })
    </script>
</body>

</html>