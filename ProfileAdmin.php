<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<?php

session_start();

if ($_SESSION['id_admin'] == "") {
    header("location: signin.php");
    exit();
} else {
    include('functions.php'); // Include your DB_con class file

    $db = new DB_con(); // Create an instance of DB_con
    $conn = $db->dbcon; // Access the connection through the dbcon property

    $id_admin = $_SESSION['id_admin'];
    $query = "SELECT img_admin, username, email, phone FROM admin WHERE id_admin = ?";
    $stmt = $conn->prepare($query); // Use the $conn variable from DB_con
    $stmt->bind_param("i", $id_admin);
    $stmt->execute();
    $stmt->bind_result($img_admin, $username, $email, $phone);
    $stmt->fetch();
    $stmt->close();
    $conn->close(); // Close the connection when done
}
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
    <title>ข้อมูลของผู้ใช้งาน</title>
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

<body>
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
            margin-top: 5px;
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
                    <span class="app-name"><b><?php echo $_SESSION['username']; ?></b></span>
                    <span class="app-desc">ผู้ดูเเลระบบ</span>

                </a>
                <img src="<?php echo $img_admin; ?>" class="rounded-circle " alt="...">


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
            width: 1230px;
            /* Set button width */
            margin-left: 150px;
            margin-bottom: 10px;
            text-align: center;
            /* Center text within the button */
            display: flex;

        }

        .img-preview {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: 0px;
            margin-bottom: 30px;
        }
    </style>


    <div class="addplace ">
        <div class="container" style="margin-left: 0px; font-size: 25px; background-color: #ffffff; width: 1230px; padding: 20px; box-shadow: 0px 4px 10px rgba(0, 0, 10, 0.15); text-align: center;">
            <div style=" padding: 20px; white-space: nowrap; ">
                <h1><b>ข้อมูลของผู้ใช้งาน</b></h1>
            </div>


            <div class="containerbg">
                <div class="profile-container">
                    <img id="imgPreview1" class="img-preview" src="<?php echo $img_admin ? $img_admin : 'img/profile.png'; ?>" alt="Preview will be displayed here.">
                    <h2><?php echo $username; ?></h2>
                    <p>Email: <?php echo $email; ?></p>
                    <p>Phone: <?php echo $phone; ?></p>
                </div>
                <div style="width: 300px; padding: 20px; margin-left: 900px; white-space: nowrap; margin-top: 7px;">
                    <a href="EditProfileAdmin.php" class="btn btn-warning">เเก้ไขข้อมูลส่วนตัว</a>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>