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
        <title>รายการผู้ที่ทำเเบบสอบถามเกี่ยวกับสถานที่ท่องเที่ยวเเล้ว</title>
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
                        <a href="FormAns_Motivation.php" class="btn btn-warning"> กลับหน้าก่อนหน้านี้ -></a>
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
            $result = $db_con->fetchAnswersMotivation($id_member);

            // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
            $query = "SELECT username FROM member WHERE id_member = $id_member";
            $userResult = mysqli_query($db_con->dbcon, $query);

            if ($userResult && mysqli_num_rows($userResult) > 0) {
                $userRow = mysqli_fetch_assoc($userResult);
                $username = $userRow['username'];
            }
        } else {
            $result = [];
        }
        ?>

        <?php
        include_once('functions.php');

        // สร้างอินสแตนซ์ของคลาส DB_con
        $db_con = new DB_con();

        // ตรวจสอบว่ามีการส่ง id_member มาหรือไม่
        $id_member = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        $username = '';

        if ($id_member) {
            // ดึงข้อมูลคำตอบของผู้ใช้ที่เลือกจาก form_member1
            $result = $db_con->fetchAnswersMotivation($id_member);

            // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
            $query = "SELECT username FROM member WHERE id_member = $id_member";
            $userResult = mysqli_query($db_con->dbcon, $query);

            if ($userResult && mysqli_num_rows($userResult) > 0) {
                $userRow = mysqli_fetch_assoc($userResult);
                $username = $userRow['username'];
            }
        } else {
            $result = [];
        }
        ?>

        <div class="container" style="margin-left: 150px; font-size: 25px; background-color: #ffffff; width: 1230px; padding: 20px; box-shadow: 0px 4px 10px rgba(0, 0, 10, 0.15);">
            <h3><b>รายละเอียดเเบบสอบถามของ <?php echo htmlspecialchars($username); ?> ✨</b></h3>
            <?php if ($id_member && $result && mysqli_num_rows($result) > 0) : ?>
                <table class="table table-bordered" style="font-size: 15px;">
                    <thead>
                        <tr>
                            <th style="background-color: #ffc107;">รายการสถานที่ท่องเที่ยว</th>
                            <th style="background-color: #ffc107;">คำตอบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            foreach ($row as $column => $value) {
                                if ($column != 'id_member') { // ข้ามคอลัมน์ id_member
                                    $description = $db_con->getAnswerMotivationDescription($column, $value);
                                    echo "<tr>";
                                    echo "<td><b>" . htmlspecialchars($column) . "</b></td>";
                                    echo "<td><img src='img/check.png' width='30' height='30'> " . ($description ?: 'ไม่ได้ถูกตอบไว้ในแบบสอบถาม') . "</td>";
                                    echo "</tr>";
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>ไม่พบข้อมูล</p>
            <?php endif; ?>
        </div>



        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    </body>

    </html>


<?php
}
?>