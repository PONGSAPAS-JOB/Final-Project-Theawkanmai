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
        <title>หน้าการจัดการระบบเเนะนำ</title>
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
                width: 1000px;
                margin-left: 150px;
                margin-bottom: 10px;
                text-align: center;
                display: flex;
            }

            .containerbg {
                width: 100%;
                max-width: 1240px;
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
        </style>

        </head>


        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid #ddd;
                padding: 8px;
            }

            th {
                background-color: #f4f4f4;
                text-align: left;
            }

            .table-container {
                padding: 20px;
            }
        </style>


        <?php
        // Include the database connection file
        include_once('functions.php');

        // Create a new instance of the DB_con class
        $db = new DB_con();

        // Handle form submission
        $selectedId = isset($_POST['update_id']) ? $_POST['update_id'] : null;

        // Fetch the distinct update IDs for the dropdown
        $updateIds = $db->fetchUpdateTimes();

        // Fetch the data based on the selected update ID
        $data = $db->fetchvaluecluster($selectedId);
        ?>

        <div class="addplace">
            <div style="width: 500px; padding: 20px; white-space: nowrap;">
                <h1><b>🌻การคำนวณค่า Cluster ในระบบ Recommend System</b></h1>
            </div>
        </div>

        <div class="container" style="margin-left: 150px; font-size: 25px; background-color: #ffffff; width: 1230px; padding: 20px; box-shadow: 0px 4px 10px rgba(0, 0, 10, 0.15); text-align: center;">
            <form method="post" action="">
                <label for="update_id"> ครั้ง ที่อัพเดต :</label>
                <select id="update_id" name="update_id" onchange="this.form.submit()">
                    <option value="">ครั้ง ล่าสุด </option>
                    <?php while ($row = mysqli_fetch_assoc($updateIds)): ?>
                        <option value="<?php echo htmlspecialchars($row['id_update_cluster']); ?>" <?php echo $selectedId == $row['id_update_cluster'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row['id_update_cluster']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </form>

            <div style="display: flex;">
                <b style="margin-left: 50px;">📑ค่า จากการ จัด Cluster <?php echo htmlspecialchars($selectedId); ?> </b>
                <button id="addtypeButton" style="margin-left: 500px;" class="btn-warning rounded" type="button"><img src="img/team.png" alt="..." width="30" height="30"> คำนวณค่า Cluster ใหม่</button>
            </div>
            <div class="table-container">
                <table class="table table-bordered" style="font-size: 10px;" id="placesTable">
                    <thead>
                        <tr style='background-color: #ffcc00;'>
                            <th>ID Cluster</th>
                            <?php for ($i = 1; $i <= 20; $i++): ?>
                                <th>Value<?php echo $i; ?></th>
                            <?php endfor; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Display the data in table rows
                        while ($row = mysqli_fetch_assoc($data)) {
                            echo "<tr>";
                            echo "<td>{$row['id_cluster']}</td>";
                            for ($i = 1; $i <= 20; $i++) {
                                echo "<td>{$row["value$i"]}</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            // Include the functions file
            include_once('functions.php');

            // Create a new instance of the DB_con class
            $db = new DB_con();

            // Fetch the recommendations
            $recommendations = $db->getClusterRecommendations();
            ?>
            <div class="table-container">
                <table class="table table-bordered" id="placesTable">
                    <thead>
                        <tr style='background-color: #ffcc00;'>
                            <th>Cluster</th>
                            <th>กิจกรรมแนะนำ</th>
                            <th>แหล่งท่องเที่ยวแนะนำ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recommendations as $cluster => $data): ?>
                            <tr>
                                <td>Cluster <?php echo $cluster; ?></td>
                                <td>
                                    <ul>
                                        <?php foreach ($data["กิจกรรม"] as $activity): ?>
                                            <li><?php echo $activity; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <?php foreach ($data["แหล่งท่องเที่ยว"] as $attraction): ?>
                                            <li><?php echo $attraction; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <button id="test" style="margin-left: 500px;" class="btn-warning rounded" type="button">
                <img src="img/team.png" alt="..." width="30" height="30"> Test ระบบ
            </button>

            <script>
                document.getElementById('test').addEventListener('click', function() {
                    window.location.href = 'homeadmin_for_cluster.php';
                });
            </script>
        </div>

        <script>
            $(document).ready(function() {
                $('#addtypeButton').click(function(event) {
                    event.preventDefault(); // Prevent the default button behavior

                    Swal.fire({
                        title: 'คุณต้องการคำนวณค่าการจัดกลุ่มใหม่หรือไม่?',
                        text: "จะเป็นการคำนวณข้อมูลกลุ่มใหม่ซึ่งจะมีผลต่อการ Recommend สถานที่ท่องเที่ยว ",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'ใช่ฉันต้องการคำนวณ!',
                        cancelButtonText: 'ยังก่อน'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'กำลังจะเข้าสู่หน้าคำนวณ ข้อมูล!',
                                icon: 'success',
                                timer: 1000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = 'Rec_calculated_cluster.php';
                            });
                        }
                    });
                });
            });
        </script>




        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    </body>

    </html>
<?php
}
?>