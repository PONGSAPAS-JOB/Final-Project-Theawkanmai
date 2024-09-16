<?php

session_start();

if ($_SESSION['id_admin'] == "") {
    header("location: signin.php");
} else {
    // Include the DB_con class
    include 'functions.php';

    // Create an instance of the DB_con class
    $db = new DB_con();

    $id_admin = $_SESSION['id_admin'];
    $img_admin = $db->getAdminProfilePicture($id_admin);

    // Close the database connection (optional, as it will close automatically at the end of the script)
    $db->dbcon->close();

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="icon" href="img/icon.png" type="image/ico">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <!-- <script type="text/javascript" src="https://api.longdo.com/map/?key=5f0cf4be3ba02be29c4136aca052b5fd"></script> -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lily+Script+One&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="./style.css" />
        <script type="module" src="./index.js"></script>
        <script src="https://developers.google.com/maps/get-started"></script>
        <title>รายการผู้ที่ทำเเบบสอบถามเกี่ยวกับตนเองเเล้ว</title>
    </head>
    <style>
        body {
            font-family: "Itim", cursive;
            font-weight: 400;
            font-style: normal;
            margin-top: 0px;
            background-image: url('img/img4.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }

        i {
            margin-left: 20%;
        }
    </style>

    <body onload="init();">
        <style>
            a {

                font-family: "LXGW WenKai TC", cursive;

            }

            .navbar {
                position: fixed;
                top: 0;
                width: 100%;
                height: 11%;
                /* Ensures the navbar spans the full width of the viewport */
                z-index: 1000;
                /* Ensure the navbar appears above other content */
                overflow: hidden;
            }


            .navbar-nav {
                margin-left: 15%;
                flex-grow: 1;
                justify-content: center;

            }

            .navbar-nav .nav-item {
                margin-left: 10%;
                align-items: center;
                justify-content: center;

            }

            .collapse .navbar-collapse {
                margin-left: 4%;
                align-items: center;

            }

            .navbar-brand {
                margin-left: 1%;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .navbar-brand .app-name {
                font-family: "LXGW WenKai TC", cursive;
                margin-bottom: -5px;
                font-size: 25px;
            }

            .navbar-brand .app-desc {
                font-family: "Itim", cursive;
                font-size: 12px;
            }

            .navbar-brand .app-desct {
                font-family: "LXGW WenKai TC", cursive;

                font-size: 12px;
            }

            .dropdown-item {
                font-size: 20px;
            }

            .rounded-circle {
                width: 5%;
                height: 5%;
                margin-right: 3%;
                margin-bottom: -10%;

            }

            .sidebar {
                height: 100vh;
                width: 250px;
                position: fixed;
                top: 0;
                left: 0;
                background-color: #f8f9fa;
                padding-top: 20px;
                border-right: 1px solid #dee2e6;
            }

            .sidebar .nav-link {
                font-weight: bold;
                color: #000;
                /* Set font color to black */
            }

            .sidebar .nav-link:hover {
                background-color: #ffc107;
                /* Change background color to warning on hover */
                color: white;
                /* Optional: Change font color to white on hover */
            }

            .content {
                margin-left: 250px;
                padding: 20px;
            }

            .custom-margin-left {
                margin-left: 20px;
                /* Custom left margin */
            }

            .btn .btn-success {
                font-family: "Itim", cursive;
            }
        </style>


        <nav class="navbar navbar-expand-lg navbar-light bg-warning">
            <button class="btn btn-warning custom-margin-left" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="fas fa-bars "></i>
            </button>
            <div class="container-fluid ">
                <a class="navbar-brand" href="#">
                    <span class="app-name"><b>Theaw-kan-mai App </b></span>
                    <span class="app-desct">Location information management application</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <form class="d-flex justify-content-end ">
                    <a class="navbar-brand " href="#"><b>Welcome, </b></a>
                    <a class="navbar-brand" href="ProfileAdmin.php">
                        <span class="app-name"><b>
                                <?php echo $_SESSION['username']; ?>
                            </b></span>
                        <span class="app-desc">ผู้ดูเเลระบบ</span>

                    </a>
                    <img src="<?php echo htmlspecialchars($img_admin, ENT_QUOTES, 'UTF-8'); ?>" class="rounded-circle" alt="Admin Profile Picture">


                    <a class="btn btn-danger" type="submit" href="logout.php">ออกจากระบบ</a>
                </form>
            </div>
            </div>
            </div>
        </nav>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <li class="nav-item mt-3">
                        <a class="dropdown-item" aria-current="page" href="homeadmin.php">Home</a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="dropdown-item" href="Areamanagement.php">Area Management</a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="dropdown-item" href="areaandplacesMG.php">Places Management</a>
                    </li>
                    <li class="nav-item dropdown mt-2">
                        <a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Type Management
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item mt-2" href="typeareaMG.php">Area Type Management</a></li>
                            <li><a class="dropdown-item mt-2" href="tourtypeMG.php">Tour Type Management</a></li>
                            <li><a class="dropdown-item mt-2" href="tagplacesMG.php">Places Tag Management</a></li>
                            <li><a class="dropdown-item mt-2" href="areacategoryMG.php">Area Category Management</a></li>

                        </ul>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="dropdown-item" href="memberMG.php">Member Management</a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Form Management
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item mt-2" href="FormAns_User_personality.php">Form User personality</a></li>
                            <li><a class="dropdown-item mt-2" href="FormAns_Motivation.php">Form tourist attraction Motivation</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="dropdown-item" href="Recommend_train_page.php">Recommend System Management</a>
                    </li>
                </ul>
            </div>
        </div>

        <style>
            .addplace {
                margin-top: 100px;
                /* Adjusted margin-top to create space between button and cards */
                width: 1000px;
                /* Set button width */
                margin-left: 150px;
                margin-bottom: 10px;
                text-align: center;
                /* Center text within the button */
                display: flex;

            }
        </style>


        <div class="addplace ">
            <div style="width: 1000px; padding: 20px; white-space: nowrap;">

                <div style="display: flex; ">
                    <h1 class="mt-3" style="width: 600px; "> <b>คำตอบเเบบสอบถาม ที่ผู้ใช้งานทำเเล้ว</b></h1>
                    <div style="width: 300px; padding: 20px; margin-left: 300px; margin-top: 3px; ">
                        <a href="FormAns_User_personality.php" class="btn btn-warning"> กลับหน้าก่อนหน้านี้ -></a>
                    </div>
                </div>

            </div>


        </div>

        <style>
            .clicked {
                background-color: #ccc;
                /* Change to the desired gray color */
            }


            /* Style the page link text color */
            .pagination .page-link {
                color: black;
            }

            /* Style for the active page */
            .pagination .active .page-link,
            .pagination .page-link:hover {
                background-color: #ffc107;
                border-color: #ffc107;
                color: black;
            }


            /* Style for the select element */
            .form-control {


                /* Add padding to accommodate the arrow */
                background: url('img/down-arrow.png') no-repeat right center;
                background-size: 1.0rem;
                /* Size of the down arrow */
                border-radius: 0.25rem;
                /* Optional: rounded corners */
            }

            /* Optional: Style for the arrow to appear in the middle */
            .form-control option {
                background: white;
                /* Set the background for the dropdown options */
            }
        </style>

        <style>
            .container {
                font-size: 15px;
                width: 100%;
                max-width: 1220px;
                margin: 0 auto;
                background-color: #ffffff;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
                padding: 20px;
            }

            .header {
                background-color: #ffc107;
                padding: 10px;
                font-weight: bold;
            }

            .section {
                display: flex;
                margin-bottom: 10px;
            }

            .section label {
                width: 200px;
                font-weight: bold;
            }

            .section .answer {
                flex: 1;
            }

            .not-found {
                text-align: center;
                color: #999;
            }

            .table {
                border-collapse: collapse;
                font-size: 15px;
            }

            .table th,
            .table td {
                border: 1px solid #dee2e6;
                padding: 8px;
            }

            .table th {
                text-align: left;
            }

            .table .header-cell {

                font-weight: bold;
                text-align: left;
            }
        </style>



        <?php
        include_once('functions.php');

        // สร้างอินสแตนซ์ของคลาส DB_con
        $db_con = new DB_con();

        // ตรวจสอบว่ามีการส่ง id_member มาหรือไม่
        $id_member = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        $username = '';

        if ($id_member) {
            // ดึงข้อมูลคำตอบของผู้ใช้ที่เลือกจาก form_member1
            $result1 = $db_con->fetchAnswers($id_member);

            // Use the same function or a different one if fetchAnswers2 is supposed to be different
            $result2 = $db_con->fetchAnswers2($id_member);
            $result3 = $db_con->fetchAnswers3($id_member);
            $result4 = $db_con->fetchAnswers4($id_member);
            $result5 = $db_con->fetchAnswers5($id_member);


            // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
            $query = "SELECT username FROM member WHERE id_member = $id_member";
            $userResult = mysqli_query($db_con->dbcon, $query);

            if ($userResult && mysqli_num_rows($userResult) > 0) {
                $userRow = mysqli_fetch_assoc($userResult);
                $username = $userRow['username'];
            }
        } else {
            $result1 = [];
            $result2 = [];
            $result3 = [];
            $result4 = [];
            $result5 = [];
        }
        ?>

        <div class="container" style="margin-left: 150px; font-size: 25px; background-color: #ffffff; width: 1230px; padding: 20px; box-shadow: 0px 4px 10px rgba(0, 0, 10, 0.15);">
            <h3><b>รายละเอียดเเบบสอบถามของ <?php echo htmlspecialchars($username); ?> ✨</b></h3>
            <?php if ($id_member && $result1 && mysqli_num_rows($result1) > 0) : ?>
                <table class="table table-bordered" style="font-size: 15px;">
                    <thead>
                        <tr>
                            <th style="background-color: #ffc107;">ตอนที่ 1 ความสนใจในการท่องเที่ยวเบื้องต้น</th>
                        </tr>
                        <tr>
                            <th>1.1.กรุณาทำเครื่องหมายลงในช่องที่ตรงกับความสนใจของท่านมากที่สุด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result1)) {
                            echo "<tr><td>";
                            $answers = [];
                            foreach ($row as $column => $value) {
                                $description = $db_con->getAnswerDescription($column, $value);
                                if ($description) {
                                    $answers[] = '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo implode("<br>", $answers);
                            echo "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            <?php else : ?>
                <p>ไม่พบข้อมูล</p>
            <?php endif; ?>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="header-cell" colspan="2" style="background-color: #ffc107;">ตอนที่ 2 ข้อมูลส่วนตัว</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result2 && mysqli_num_rows($result2) > 0) : ?>
                        <?php while ($row2 = mysqli_fetch_assoc($result2)) : ?>
                            <tr>
                                <th class="header-cell">2.1. เพศของท่าน</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row2['ans_form1'])) {
                                        $description = $db_con->getAnswerDescription2('ans_form1', $row2['ans_form1']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="header-cell">2.2. อายุของท่าน</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row2['ans_form2'])) {
                                        $description = $db_con->getAnswerDescription2('ans_form2', $row2['ans_form2']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="header-cell">2.3. อาชีพของท่าน</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row2['ans_form3'])) {
                                        $description = $db_con->getAnswerDescription2('ans_form3', $row2['ans_form3']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="header-cell">2.4. รายได้ต่อเดือน</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row2['ans_form4'])) {
                                        $description = $db_con->getAnswerDescription2('ans_form4', $row2['ans_form4']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="2" class="answer-cell">ไม่พบข้อมูล</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>



            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="header-cell" colspan="4" style="background-color: #ffc107;">ตอนที่ 3 พฤติกรรมการท่องเที่ยวของนักท่องเที่ยว</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result5 && mysqli_num_rows($result5) > 0) : ?>
                        <?php while ($row3 = mysqli_fetch_assoc($result5)) : ?>
                            <tr>
                                <th class="header-cell">3.1. ท่านมักเดินทางท่องเที่ยวกับใคร</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row3['ans_form5'])) {
                                        $description = $db_con->getAnswerDescription5('ans_form5', $row3['ans_form5']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="header-cell">3.2. ส่วนใหญ่ท่านเดินทางท่องเที่ยวโดยยานพาหนะใด</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row3['ans_form6'])) {
                                        $description = $db_con->getAnswerDescription5('ans_form6', $row3['ans_form6']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="header-cell">3.3. ในการท่องเที่ยว ท่านมักเลือกที่พักแบบใด</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row3['ans_form7'])) {
                                        $description = $db_con->getAnswerDescription5('ans_form7', $row3['ans_form7']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="header-cell">3.4. งบประมาณที่ใช้ในการท่องเที่ยวต่อวัน</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row3['ans_form8'])) {
                                        $description = $db_con->getAnswerDescription5('ans_form8', $row3['ans_form8']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4" class="answer-cell">ไม่พบข้อมูล</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>



            <table class="table table-bordered" style="font-size: 15px;">
                <thead>
                    <tr>
                        <th class="header-cell" colspan="9" style="background-color: #ffc107;">ตอนที่ 4 แรงจูงใจในการท่องเที่ยวของท่าน</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result3 && mysqli_num_rows($result3) > 0) : ?>
                        <?php while ($row4 = mysqli_fetch_assoc($result3)) : ?>
                            <tr>
                                <th class="header-cell">4.1. ต้องการอยู่ในธรรมชาติที่สวยงามและอากาศบริสุทธิ์ มีน้ำตก พันธุ์ไม้สัตว์ป่า</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row4['eva_p1_ans1'])) {
                                        $description = $db_con->getAnswerDescription3('eva_p1_ans1', $row4['eva_p1_ans1']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="header-cell">4.2. ต้องการหลีกหนีจากชีวิตประจำวัน</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row4['eva_p1_ans2'])) {
                                        $description = $db_con->getAnswerDescription3('eva_p1_ans2', $row4['eva_p1_ans2']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="header-cell">4.3. ต้องการค้นหาตัวเอง/ทบทวนความคิดของตนเอง</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row4['eva_p1_ans3'])) {
                                        $description = $db_con->getAnswerDescription3('eva_p1_ans3', $row4['eva_p1_ans3']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="header-cell">4.4. ต้องการสร้างแรงบันดาลใจและความคิดสร้างสรรค์</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row4['eva_p1_ans4'])) {
                                        $description = $db_con->getAnswerDescription3('eva_p1_ans4', $row4['eva_p1_ans4']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="header-cell">4.5. ต้องการได้รับความรู้และประสบการณ์แปลกใหม่</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row4['eva_p1_ans5'])) {
                                        $description = $db_con->getAnswerDescription3('eva_p1_ans5', $row4['eva_p1_ans5']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="header-cell">4.6. ต้องการสร้างความสัมพันธ์กับคนใกล้ชิด/ครอบครัว</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row4['eva_p1_ans6'])) {
                                        $description = $db_con->getAnswerDescription3('eva_p1_ans6', $row4['eva_p1_ans6']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="header-cell">4.7. ต้องการสร้างความสัมพันธ์กับผู้อื่น</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row4['eva_p1_ans7'])) {
                                        $description = $db_con->getAnswerDescription3('eva_p1_ans7', $row4['eva_p1_ans7']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="header-cell">4.8. ต้องการแสวงหาความตื่นเต้น เร้าใจ และความเสี่ยง</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row4['eva_p1_ans8'])) {
                                        $description = $db_con->getAnswerDescription3('eva_p1_ans8', $row4['eva_p1_ans8']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="header-cell">4.9. ต้องการเป็นที่ยอมรับนับถือจากผู้อื่น</th>
                                <td class="answer-cell">
                                    <?php
                                    if (isset($row4['eva_p1_ans9'])) {
                                        $description = $db_con->getAnswerDescription3('eva_p1_ans9', $row4['eva_p1_ans9']);
                                        if ($description) {
                                            echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="9" class="answer-cell">ไม่พบข้อมูล</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>


            <table class="table table-bordered" style="font-size: 15px;">
                <thead>
                    <tr>
                        <th style="background-color: #ffc107;" colspan="2">ตอนที่ 5 องค์ประกอบการท่องเที่ยว 5A’S ที่มีอิทธิพลต่อการตัดสินใจท่องเที่ยว</th>
                    </tr>
                    <tr>
                        <th colspan="2" style="background-color: #ffd65e;">ท่านตัดสินใจเลือกเดินทางท่องเที่ยวเพราะเหตุใดมากที่สุด?</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th colspan="2" style="background-color: #ffe28e;">ด้านสิ่งที่ดึงดูดใจ (Attraction)</th>
                    </tr>
                    <?php
                    if ($result4 && mysqli_num_rows($result4) > 0) {
                        while ($row5 = mysqli_fetch_assoc($result4)) {
                            echo "<tr>";
                            echo "<th>5.1. ความสวยงามของแหล่งท่องเที่ยว</th><td>";
                            if (isset($row5['eva_p2_ans1'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans1', $row5['eva_p2_ans1']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo "<tr>";
                            echo "<th>5.2. ความมีชื่อเสียงของแหล่งท่องเที่ยว</th><td>";
                            if (isset($row5['eva_p2_ans2'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans2', $row5['eva_p2_ans2']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo "<tr>";
                            echo "<th>5.3. ความหลากหลายของประเภทแหล่งท่องเที่ยว</th><td>";
                            if (isset($row5['eva_p2_ans3'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans3', $row5['eva_p2_ans3']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo '<tr><th colspan="2" style="background-color: #ffe28e;">ด้านความสะดวกในการเดินทาง (Accessibility)</th></tr>';

                            echo "<tr>";
                            echo "<th>5.4. มีป้ายบอกทางเข้าถึงแหล่งท่องเที่ยว</th><td>";
                            if (isset($row5['eva_p2_ans4'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans4', $row5['eva_p2_ans4']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo "<tr>";
                            echo "<th>5.5. เส้นทางคมนาคมที่ใช้เข้าถึงแหล่งท่องเที่ยว</th><td>";
                            if (isset($row5['eva_p2_ans5'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans5', $row5['eva_p2_ans5']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo "<tr>";
                            echo "<th>5.6. มีสถานที่ให้บริการทางคมนาคม เช่น ปั๊มน้ำมัน จุดพักรถ อย่างทั่วถึง</th><td>";
                            if (isset($row5['eva_p2_ans6'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans6', $row5['eva_p2_ans6']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo "<tr>";
                            echo "<th>5.7. มีความปลอดภัยในการเดินทาง</th><td>";
                            if (isset($row5['eva_p2_ans7'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans7', $row5['eva_p2_ans7']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo "<tr>";
                            echo "<th>5.8. มีสถานที่จอดรถอย่างเพียงพอ</th><td>";
                            if (isset($row5['eva_p2_ans8'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans8', $row5['eva_p2_ans8']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo '<tr><th colspan="2" style="background-color: #ffe28e;">ด้านสิ่งอำนวยความสะดวก (Amenities)</th></tr>';

                            echo "<tr>";
                            echo "<th>5.9. มีร้านค้า ตั้งใกล้อยู่แหล่งท่องเที่ยวและชุมชน</th><td>";
                            if (isset($row5['eva_p2_ans9'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans9', $row5['eva_p2_ans9']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo "<tr>";
                            echo "<th>5.10. มีร้านอาหารสำหรับบริการที่หลากหลายและเพียงพอ</th><td>";
                            if (isset($row5['eva_p2_ans10'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans10', $row5['eva_p2_ans10']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo "<tr>";
                            echo "<th>5.11. มีสาธารณูปโภคขั้นพื้นฐาน เช่น น้ำสะอาด ไฟฟ้า สัญญาณโทรศัพท์ อย่างเหมาะสม</th><td>";
                            if (isset($row5['eva_p2_ans11'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans11', $row5['eva_p2_ans11']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo '<tr><th colspan="2" style="background-color: #ffe28e;">ด้านการบริการที่พัก (Accommodation) </th></tr>';

                            echo "<tr>";
                            echo "<th>5.12. ประเภทของที่พักมีความหลากหลายให้เลือกใช้บริการ</th><td>";
                            if (isset($row5['eva_p2_ans12'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans12', $row5['eva_p2_ans12']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo "<tr>";
                            echo "<th>5.13. ที่พักมีราคาที่เหมาะสม</th><td>";
                            if (isset($row5['eva_p2_ans13'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans13', $row5['eva_p2_ans13']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo "<tr>";
                            echo "<th>5.14. มีสิ่งอำนวยความสะดวกที่รับรองความต้องการ เช่น อินเตอร์เน็ต ห้องออกกำลังกาย สระว่ายน้ำ ฯลฯ</th><td>";
                            if (isset($row5['eva_p2_ans14'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans14', $row5['eva_p2_ans14']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo '<tr><th colspan="2" style="background-color: #ffe28e;">ด้านกิจกรรมการท่องเที่ยว (Activities) </th></tr>';

                            echo "<tr>";
                            echo "<th>5.15. กิจกรรมท่องเที่ยวมีความน่าสนใจ</th><td>";
                            if (isset($row5['eva_p2_ans15'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans15', $row5['eva_p2_ans15']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo "<tr>";
                            echo "<th>5.16. กิจกรรมท่องเที่ยวมีความหลากหลาย</th><td>";
                            if (isset($row5['eva_p2_ans16'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans16', $row5['eva_p2_ans16']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo "<tr>";
                            echo "<th>5.17. กิจกรรมท่องเที่ยวที่ส่งเสริมการเรียนรู้</th><td>";
                            if (isset($row5['eva_p2_ans17'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans17', $row5['eva_p2_ans17']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo "<tr>";
                            echo "<th>5.18. กิจกรรมท่องเที่ยวที่มีความปลอดภัย</th><td>";
                            if (isset($row5['eva_p2_ans18'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans18', $row5['eva_p2_ans18']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";

                            echo "<tr>";
                            echo "<th>5.19. กิจกรรมท่องเที่ยวที่ก่อให้เกิดประโยชน์ต่อสังคม</th><td>";
                            if (isset($row5['eva_p2_ans19'])) {
                                $description = $db_con->getAnswerDescription4('eva_p2_ans19', $row5['eva_p2_ans19']);
                                if ($description) {
                                    echo '<img src="img/check.png" width="30" height="30"> ' . $description;
                                }
                            }
                            echo "</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>ไม่พบข้อมูล</td></tr>";
                    }
                    ?>
                </tbody>
            </table>



        </div>




        </div>


        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    </body>

    </html>


<?php
}
?>