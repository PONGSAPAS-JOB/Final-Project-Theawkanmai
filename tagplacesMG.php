<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<?php

session_start();

if ($_SESSION['id_admin'] == "") {
    header("location: signin.php");
} else {

?>
    <?php
    include_once('functions.php');
    $userdata = new DB_con();

    if (isset($_POST['insert'])) {

        $tag_description = $_POST['tag_description'];


        $sql = $userdata->addtagplaces(
            $tag_description
        );


        if ($sql) {

            echo   "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Add Tag Places Success!',
                        text: 'กำลังบันทึกข้อมูลประเภท',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'tagplacesMG.php';
                    });
                });
            </script>";
        } else {

            echo   "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Add Tag Places Failed!',
                        text: 'ไม่สามารถเพิ่มประเภทได้ โปรดลองอีกครั้ง!',
                        icon: 'error',
                        
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'tagplacesMG.php';
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

        <script type="text/javascript" src="https://api.longdo.com/map/?key=5f0cf4be3ba02be29c4136aca052b5fd"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lily+Script+One&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>เพิ่มหมวดหมู่ของสถานที่</title>
    </head>
    <style>
        body {
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
            @font-face {
                font-family: 'Lily Script One';
                src: url('path_to_font_files/linly-script.woff2') format('woff2'),
                    url('path_to_font_files/linly-script.woff') format('woff');

            }

            a {
                font-family: 'Lily Script One', cursive;
            }

            .navbar {
                position: fixed;
                top: 0;
                width: 100%;
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
                margin-bottom: -5px;
            }

            .navbar-brand .app-desc {
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
        </style>


        <nav class="navbar navbar-expand-lg navbar-light bg-warning">
            <button class="btn btn-warning custom-margin-left" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="fas fa-bars "></i>
            </button>
            <div class="container-fluid ">
                <a class="navbar-brand" href="#">
                    <span class="app-name">Theaw-kan-mai App </span>
                    <span class="app-desc">Location information management application</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <form class="d-flex justify-content-end ">
                    <a class="navbar-brand " href="#">Welcome, </a>
                    <a class="navbar-brand" href="#">
                        <span class="app-name"><?php echo $_SESSION['username']; ?></span>
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


        <div class="addplace "><a></a></div>
        <div class="container">
            <div style="display: flex; ">
                <h1 class="mt-3" style="width: 600px; "> จัดการหมวดหมู่ของสถานที่ </h1>
                <div style="width: 300px; padding: 20px; margin-left: 300px; margin-top: 3px; ">
                    <a href="addplacesbyAD.php" class="btn btn-warning"> เพิ่มร้านค้า , ที่พัก -></a>
                </div>
            </div>
            <hr>

            <form method="POST" action="" enctype="multipart/form-data">
                <div style="display: flex; ">
                    <div class="mb-3 " style="margin-right: 150px; width: 500px; ">
                        <label for="tag_description" class="form-label required-label">ใส่ชื่อหมวดหมู่ของสถานที่ที่ต้องการจะเพิ่ม</label>
                        <input type="text" class="form-control " id="tag_description" name="tag_description" aria-describedby="ชื่อประเภท" onblur="nametagplacescheck(this.value)" required>
                        <span id="tagplacesnameavailable"></span>
                    </div>
                </div>

                <button type="submit" name="insert" id="insert" class="mt-3 mb-3 btn btn-warning">เพิ่มหมวดหมู่ของสถานที่ใหม่</button>

            </form>

            <hr>


            <?php
            include_once('functions.php');
            $fetchdataTag = new DB_con();
            $sqlTag = $fetchdataTag->fetchdataTag();

            $index = 1;

            ?>


            <div class="containertb" style="margin-left: 0px; font-size: 25px; background-color: #ffffff; width: 980px; padding: 20px;box-shadow: 0px 4px 10px rgba(0, 0, 10, 0.15); text-align: center;">
                <b>รายการหมวดหมู่สถานที่</b>
                <div style="margin-top: 20px; ">
                    <table class="table table-bordered" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับหมวดหมู่</th>
                                <th scope="col">ชื่อหมวดหมู่ของสถานที่</th>
                                <th scope="col">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($sqlTag)) {
                            ?>
                                <tr>
                                    <td><?php echo $index ?></td>
                                    <?php $index = $index + 1; ?>
                                    <td><?php echo $row['tag_description']; ?></td>
                                    <td><a href="deleteTagPlaces.php?del=<?php echo $row['id_tag']; ?>">ลบ</a></td>
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
            function nametagplacescheck(val) {
                $.ajax({
                    type: 'POST',
                    url: 'checktagplaces_available.php',
                    data: 'tag_description=' + val,
                    success: function(data) {
                        $('#tagplacesnameavailable').html(data);
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