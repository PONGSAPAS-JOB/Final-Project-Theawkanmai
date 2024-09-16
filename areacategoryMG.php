<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
    <?php
    include_once('functions.php');
    $userdata = new DB_con();

    if (isset($_POST['insert'])) {

        $name_category = $_POST['name_category'];


        $sql = $userdata->addcategory(
            $name_category
        );


        if ($sql) {
            // echo "<script>alert('Add Area Success!');</script>";
            // echo "<script>window.location.href='areaandplacesMG.php'</script>";
            echo   "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Add Area Category Success!',
                        text: 'กำลังบันทึกข้อมูลกลุ่ม',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'areacategoryMG.php';
                    });
                });
            </script>";
        } else {
            // echo "<script>alert('Add Area Failed!');</script>";
            // echo "<script>window.location.href='addarea.php'</script>";
            // echo error_reporting();
            echo   "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Add Area Category Failed!',
                        text: 'ไม่สามารถเพิ่มกลุ่มได้ โปรดลองอีกครั้ง!',
                        icon: 'error',
                        
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'areacategoryMG.php';
                    });
                });
            </script>";
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="icon" href="img/icon.png" type="image/ico">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Itim&family=LXGW+WenKai+TC&family=Lily+Script+One&display=swap" rel="stylesheet">
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
        <title>จัดการหมวดหมู่สถานที่ท่องเที่ยวหลัก</title>
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
                margin-top: 1%;
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

            .btn .btn-danger {
                margin-top: 1%;
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
                    <img src="<?php echo htmlspecialchars($img_admin, ENT_QUOTES, 'UTF-8'); ?>" class="rounded-circle" alt="Admin Profile Picture">



                    <a class="btn btn-danger" type="submit" href="logout.php" style="margin-top: 1%;">ออกจากระบบ</a>
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
            b {
                font-family: "Itim", cursive;

            }

            .container {
                margin-top: 40px;
                width: 100%;
                /* Set the initial width */
                max-width: 1000px;
                margin-top: 10px;

            }

            #map {
                height: 50%;
            }

            .addplace {
                margin-top: 100px;
                /* Adjusted margin-top to create space between button and cards */
                width: 200px;
                /* Set button width */
                margin-left: 1255px;
                margin-right: auto;
                display: block;
                /* Make the button a block-level element to center it */
                text-align: center;
                /* Center text within the button */
            }

            .required-label::after {
                content: '*';
                color: red;
                margin-left: 5px;
            }


            #other-input {
                display: none;
            }


            .img-preview {
                display: block;
                margin-top: 10px;
                max-width: 100%;
                max-height: 300px;
                border: 1px solid #ccc;
            }

            .btnadd {
                margin-top: 35px;
                background-color: #ffc107;
                text-align: center;
                border: none;
                color: white;
                width: 30px;
                height: 30px;
                font-size: 16px;
                align-items: center;
                cursor: pointer;
            }
        </style>
        <script>
            function init() {
                var map = new longdo.Map({
                    placeholder: document.getElementById('map')
                });
            }
        </script>

        <div class="addplace "><a></a></div>
        <div class="container">
            <div style="display: flex; ">
                <h1 class="mt-3" style="width: 700px; "> จัดการหมวดหมู่ของสถานที่ท่องเที่ยว </h1>
                <div style="width: 300px; padding: 20px; margin-left: 300px; margin-top: 3px; ">
                    <a href="addarea.php" class="btn btn-warning"> เพิ่มสถานที่หลัก -></a>
                </div>
            </div>
            <hr>

            <form method="POST" action="" enctype="multipart/form-data">
                <div style="display: flex; ">
                    <div class="mb-3 " style="margin-right: 150px; width: 500px; ">
                        <label for="name_category" class="form-label required-label">ใส่ชื่อหมวดหมู่ของเเหล่งท่องเที่ยวที่ต้องการจะเพิ่ม</label>
                        <input type="text" class="form-control " id="name_category" name="name_category" aria-describedby="ชื่อประเภท" onblur="name_categorycheck(this.value)" required>
                        <span id="areacategoryavailable"></span>
                    </div>
                </div>

                <button type="submit" name="insert" id="insert" class="mt-3 mb-3 btn btn-warning">เพิ่มหมวดหมู่ของเเหล่งท่องเที่ยวใหม่</button>

            </form>

            <hr>


            <?php
            include_once('functions.php');
            $fetchdatacategory = new DB_con();
            $sqlcategory = $fetchdatacategory->fetchdatacategory();

            $index = 1;

            ?>


            <div class="containertb" style="margin-left: 0px; font-size: 25px; background-color: #ffffff; width: 980px; padding: 20px;box-shadow: 0px 4px 10px rgba(0, 0, 10, 0.15); text-align: center;">
                <b>รายการหมวดหมู่ของเเหล่งท่องเที่ยว</b>
                <div style="margin-top: 20px; ">
                    <table class="table table-bordered" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับหมวดหมู่</th>
                                <th scope="col">ชื่อหมวดหมู่ของเเหล่งท่องเที่ยว</th>
                                <th scope="col">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($sqlcategory)) {
                            ?>
                                <tr>
                                    <td><?php echo $index ?></td>
                                    <?php $index = $index + 1; ?>
                                    <td><?php echo $row['name_category']; ?></td>
                                    <td><a href="deleteAreacategory.php?del=<?php echo $row['id_category']; ?>">ลบ</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>


                    </table>
                </div>
            </div>


        </div>



        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            function name_categorycheck(val) {
                $.ajax({
                    type: 'POST',
                    url: 'checkarea_category_available.php',
                    data: 'name_category=' + val,
                    success: function(data) {
                        $('#areacategoryavailable').html(data);
                    }
                });

            }
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    </body>

    </html>

<?php
}
?>