<?php
session_start();

if ($_SESSION['Id_manager'] == "") {
    header("location: signin.php");
    exit();
} else {
    $img_manager = isset($_SESSION['img_manager']) ? $_SESSION['img_manager'] : "img_manager";
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
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlRR13/uB7BVC7h2C9Pz5pDSh2cse8lx7vX5AHs2GKLK1WEg7Xr9br2vvD" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhG6CkUJmH9BT6BqZtihTScbMl3h5S3pZ1pKNxwBfGVcEGPqM5LaB6r9aXU3" crossorigin="anonymous"></script>

        <title>หน้าหลัก</title>
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
    </style>

    <body>
        <style>
            @font-face {
                font-family: 'Lily Script One';
                src: url('path_to_font_files/linly-script.woff2') format('woff2'),
                    url('path_to_font_files/linly-script.woff') format('woff');
            }

            a {
                font-family: 'Lily Script One', cursive;
            }

            nav.navbar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1000;
            }

            .navbar-nav {
                margin-left: 21%;
                flex-grow: 1;
                justify-content: center;
            }

            .navbar-nav .nav-item {
                margin-left: 10%;
            }

            .collapse .navbar-collapse {
                margin-left: 10%;
                align-items: center;
                justify-content: center;
            }

            .navbar-brand {
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

            .rounded-circle {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                object-fit: cover;
                margin-right: 10px;
                margin-bottom: -10px;
            }
        </style>

        <nav class="navbar navbar-expand-lg navbar-light bg-warning " style="position: fixed;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <span class="app-name">Theaw-kan-mai App</span>
                    <span class="app-desc">Location information management application</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" style="white-space: nowrap;" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" style="white-space: nowrap;" aria-current="page" href="chooseAdd.php">Add Places</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" style="white-space: nowrap;" aria-current="page" href="myplaces.php">My Places</a>
                        </li>
                    </ul>
                    <div>
                        <form class="d-flex justify-content-end ">
                            <a class="navbar-brand " href="#">Welcome, </a>
                            <a class="navbar-brand" href="ProfileManager.php">
                                <span class="app-name"><?php echo $_SESSION['username']; ?></span>
                                <span class="app-desc">ผู้ที่เกี่ยวข้องกับสถานที่</span>
                            </a>
                            <img src="img/pro.jpg" class="rounded-circle " alt="...">
                            <a class="btn btn-danger" type="submit" href="logout.php">ออกจากระบบ</a>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

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

        <div class="addplace">
            <div style="width: 500px; padding: 20px; white-space: nowrap;">
                <h1><b>🌻รายชื่อสถานที่ของฉัน</b></h1>
            </div>
        </div>

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
                /* เพิ่มฟังก์ชันลากขยาย */
                overflow: auto;
                /* แสดงแถบเลื่อนเมื่อจำเป็น */
                min-height: 150px;
                /* กำหนดความสูงขั้นต่ำ */
                border: 1px solid #ccc;
                /* เพิ่มขอบเพื่อให้ผู้ใช้เห็นพื้นที่ที่ลากได้ */

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
                /* Allows items to wrap to the next line if they overflow */
                gap: 10px;
                /* Optional: adds space between items */
            }

            .place-item {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 3px;
                /* ช่องว่างภายในกรอบ */
                margin: 3px;
                /* ระยะห่างระหว่างแต่ละกรอบ */

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
                /* Set the width according to your design */
                white-space: nowrap;
                overflow: hidden;
                margin-top: 5px;
                position: relative;
            }

            .area-name span {
                display: inline-block;
                padding-left: 100%;
                /* Ensures the text starts off-screen */
                animation: scroll-left 10s linear infinite;
                /* Adjust duration as needed */
            }

            @keyframes scroll-left {
                0% {
                    transform: translateX(100%);
                    /* Start from the right edge */
                }

                100% {
                    transform: translateX(-100%);
                    /* End at the left edge */
                }
            }
        </style>

        <div class="containerbg">
            <?php
            include_once('functions.php');

            // Fetch data for places associated with the logged-in manager
            $fetchdataplaces = new DB_con();
            $sql = $fetchdataplaces->fetchdataAreaByManager($_SESSION['Id_manager']);

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

        <!-- Dashboard Section -->
        <div class="containerbg2">

            <div id="dashboard" style="display: none;">


                <!-- Dashboard content will be loaded here -->
            </div>
        </div>

        <script>
            function showComments(id_Area) {
                console.log("Loading comments for Area ID: " + id_Area); // Debugging line

                // Show the dashboard section
                document.getElementById('dashboard').style.display = 'block';

                const xhr = new XMLHttpRequest();
                xhr.open("POST", "fetch_comments.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function() {
                    if (this.status === 200) {
                        console.log("AJAX response received"); // Debugging line

                        // Display comments in the dashboard section
                        document.getElementById("dashboard").innerHTML = this.responseText;
                    } else {
                        console.error("Error loading comments: " + this.status); // Debugging line
                    }
                };
                xhr.onerror = function() {
                    console.error("Request failed"); // Debugging line
                };
                xhr.send("id_Area=" + id_Area);
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlRR13/uB7BVC7hJ2C9Pz5pDSh2cse8lx7vX5AHs2GKLK1WEg7Xr9br2vvD" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhG6CkUJmH9BT6BqZtihTScbMl3h5S3pZ1pKNxwBfGVcEGPqM5LaB6r9aXU3" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
}
?>