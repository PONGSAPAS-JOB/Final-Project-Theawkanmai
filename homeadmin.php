<?php

session_start();

if ($_SESSION['id_admin'] == "") {
    header("location: signin.php");
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="icon" href="img/icon.png" type="image/ico">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Itim&family=LXGW+WenKai+TC&family=Lily+Script+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./style.css" />
        <script type="module" src="./index.js"></script>
        <script src="https://developers.google.com/maps/get-started"></script>
        <title>หน้าหลัก admin</title>
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

            .rounded-circle {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                object-fit: cover;
                margin-right: 10px;
                margin-bottom: -10px;
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
                        <span class="app-name"><b><?php echo $_SESSION['username']; ?></b></span>
                        <span class="app-desc">ผู้ดูเเลระบบ</span>

                    </a>
                    <img src="img/pro.jpg" class="rounded-circle " alt="...">


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
                </ul>
            </div>
        </div>

        <style>
            .addplace {
                margin-top: 100px;
                width: 1000px;
                margin-left: 150px;
                margin-bottom: 10px;
                text-align: center;
                display: flex;
            }
        </style>

        <style>
            .containerbg {
                width: 100%;
                max-width: 1240px;
                height: 130px;
                margin: 0 auto;
                transition: transform 0.3s ease;
                overflow: hidden;
                opacity: 1;
                background-color: #FFFFFF;
                padding: 20px;
                max-height: 400px;
                overflow-y: auto;
                padding-right: 15px;
                resize: vertical;
                min-height: 150px;
                border: 1px solid #ccc;
            }

            .containerbg2 {
                width: 100%;
                max-width: 1240px;
                height: 500px;
                margin: 0 auto;
                transition: transform 0.3s ease;
                overflow: hidden;
                opacity: 1;
                background-color: #FFFFFF;
                padding: 20px;
                margin-top: 50px;
                margin-bottom: 50px;
                overflow-y: auto;
            }

            .switch {
                display: flex;
                justify-content: center;
                margin-bottom: 20px;
            }

            .switch button {
                padding: 10px 20px;
                margin: 0 10px;
                border: 1px solid #ccc;
                background-color: #f1f1f1;
                cursor: pointer;
            }

            .switch button.active {
                background-color: #ffcc00;
                color: #fff;
            }

            .comment-modal .modal-dialog {
                max-width: 600px;
                margin: 1.75rem auto;
            }

            .comment-modal .modal-header {
                border-bottom: none;
            }

            .comment-modal .modal-body {
                max-height: 400px;
                overflow-y: auto;
            }

            .comment-item {
                margin-bottom: 15px;
            }

            .comment-item .username {
                font-weight: bold;
            }

            .comment-item .date {
                font-size: 0.9em;
                color: #555;
            }

            .comment-item .star {
                color: #ffcc00;
            }

            .containerbg {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .place-item {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 3px;
                margin: 3px;
                height: 100px;
                width: 110px;
            }

            .area-container {
                display: inline-block;
                text-align: center;
                margin: 10px;
            }

            .area-name {
                width: 100px;
                white-space: nowrap;
                overflow: hidden;
                margin-top: 5px;
                position: relative;
            }

            .area-name span {
                display: inline-block;
                padding-left: 100%;
                animation: scroll-left 10s linear infinite;
            }

            @keyframes scroll-left {
                0% {
                    transform: translateX(100%);
                }

                100% {
                    transform: translateX(-100%);
                }
            }
        </style>
        </head>

        <body>
            <<div class="addplace">
                <div style="width: 500px; padding: 20px; white-space: nowrap;">
                    <h1><b>🌻รายชื่อสถานที่ของฉัน</b></h1>
                </div>
                </div>

                <div class="switch">
                    <button id="touristButton" class="active" onclick="showSection('tourist')">สถานที่ท่องเที่ยว</button>
                    <button id="shopButton" onclick="showSection('shop')">ร้านค้า และ ที่พัก</button>
                </div>

                <div id="touristSection" class="containerbg">
                    <?php
                    include_once('functions.php');

                    // Fetch data for places associated with the logged-in manager
                    $fetchdataplaces = new DB_con();
                    $sql = $fetchdataplaces->fetchdataarea();

                    while ($row = mysqli_fetch_array($sql)) {
                        $img_Area1 = !empty($row['img_Area1']) ? $row['img_Area1'] : 'img/default-placeholder.png';
                    ?>
                        <div class="place-item">
                            <div class="area-container">
                                <img src="<?php echo htmlspecialchars($img_Area1); ?>" alt="Image" width="100" height="100" class="rounded-circle" onclick="showComments(<?php echo $row['id_Area']; ?>)">
                                <div class="area-name">
                                    <span><?php echo htmlspecialchars($row['name_Area']); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <div id="shopSection" class="containerbg" style="display: none;">
                    <?php
                    include_once('functions.php');

                    // Fetch data for places associated with the logged-in manager
                    $fetchdataplaces = new DB_con();
                    $sql = $fetchdataplaces->fetchdataplaces();

                    while ($row = mysqli_fetch_array($sql)) {
                        $img_Places1 = !empty($row['img_Places1']) ? $row['img_Places1'] : 'img/default-placeholder.png';
                    ?>
                        <div class="place-item">
                            <div class="area-container">
                                <img src="<?php echo htmlspecialchars($img_Places1); ?>" alt="Image" width="100" height="100" class="rounded-circle" onclick="showCommentsPlaces(<?php echo $row['id_places']; ?>)">
                                <div class="area-name">
                                    <span><?php echo htmlspecialchars($row['name_places']); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <div class="containerbg2">
                    <div id="dashboard" style="display: none;">
                        <!-- Dashboard content will be loaded here -->
                    </div>
                </div>

                <script>
                    function showSection(section) {
                        var touristSection = document.getElementById('touristSection');
                        var shopSection = document.getElementById('shopSection');
                        var touristButton = document.getElementById('touristButton');
                        var shopButton = document.getElementById('shopButton');

                        if (section === 'tourist') {
                            touristSection.style.display = 'flex';
                            shopSection.style.display = 'none';
                            touristButton.classList.add('active');
                            shopButton.classList.remove('active');
                        } else if (section === 'shop') {
                            touristSection.style.display = 'none';
                            shopSection.style.display = 'flex';
                            touristButton.classList.remove('active');
                            shopButton.classList.add('active');
                        }
                    }

                    function showComments(id_Area) {
                        console.log("Loading comments for Area ID: " + id_Area);

                        document.getElementById('dashboard').style.display = 'block';

                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", "fetch_comments.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onload = function() {
                            if (this.status === 200) {
                                console.log("AJAX response received");
                                document.getElementById("dashboard").innerHTML = this.responseText;
                            } else {
                                console.error("Error loading comments: " + this.status);
                            }
                        };
                        xhr.onerror = function() {
                            console.error("Request failed");
                        };
                        xhr.send("id_Area=" + id_Area);
                    }

                    function showCommentsPlaces(id_places) {
                        console.log("Loading comments for places ID: " + id_places);

                        document.getElementById('dashboard').style.display = 'block';

                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", "fetch_comments_places.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onload = function() {
                            if (this.status === 200) {
                                console.log("AJAX response received");
                                document.getElementById("dashboard").innerHTML = this.responseText;
                            } else {
                                console.error("Error loading comments: " + this.status);
                            }
                        };
                        xhr.onerror = function() {
                            console.error("Request failed");
                        };
                        xhr.send("id_places=" + id_places);
                    }
                </script>

                <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>




                <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


        </body>

    </html>


<?php
}
?>