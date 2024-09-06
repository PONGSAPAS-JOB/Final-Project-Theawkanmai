<?php

session_start();

if ($_SESSION['Id_manager'] == "") {
    header("location: signin.php");
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="icon" href="img/icon.png" type="image/ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lily+Script+One&display=swap" rel="stylesheet">
        <title>หน้าหลัก</title>
    </head>
    <style>
        body {
            margin-top: 0px;
            background-image: url('img/img4.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            position: relative;
            /* Make sure body is positioned relative for absolute positioning of buttons */
        }

        @font-face {
            font-family: 'Lily Script One';
            src: url('path_to_font_files/linly-script.woff2') format('woff2'),
                url('path_to_font_files/linly-script.woff') format('woff');
        }

        a {
            font-family: 'Lily Script One', cursive;
        }

        .navbar-nav {
            margin-left: 21%;
            flex-grow: 1;
            justify-content: center;
        }

        .navbar-nav .nav-item {
            margin-left: 10%;
            align-items: center;
            justify-content: center;
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

        .background-container {
            margin-top: 69px;
            margin-left: 122px;
            margin-right: 122px;
            display: flex;
            height: 625px;
            overflow: hidden;
            position: relative;
            /* Ensure container is positioned relative for absolute positioning of buttons */
        }

        .background-container .background-images {
            flex: 1;
            position: relative;
        }

        .background-images img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 3s ease-in-out;
        }

        .background-images img.active {
            opacity: 1;
        }

        /* New styles for buttons */
        .center-buttons {
            position: absolute;
            top: 50%;
            left: 50%;

            transform: translate(-51%, -50%);
            display: flex;
            gap: 200px;
        }

        .btn-custom {
            width: 320px;
            padding: 20px 30px;
            font-size: 30px;
            color: black;
            text-align: center;
            text-decoration: none;
            border-radius: 20px;
            background-color: #ffc107;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            color: white;
            background-color: #CC9933;
        }
    </style>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
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
        <div class="background-container">
            <div class="background-images" id="left-background">
                <img src="img/ธุมะสิกขีศรีจอมทอง (ลานพญานาคกว๊านพะเยา)1.jpg" class="active" alt="Left Background Image 1">
                <img src="img/อุทยานแห่งชาติดอยภูนาง3.jpg" alt="Left Background Image 2">
                <img src="img/อุทยานแห่งชาติภูซาง1.jpg" alt="Left Background Image 3">
                <img src="img/วัดศรีโคมคำ1.jpg" alt="Left Background Image 4">
                <img src="img/วัดพระธาตุจอมทอง1.jpg" alt="Left Background Image 5">
                <img src="img/อุทยานแห่งชาติแม่ปืม4.jpg" alt="Left Background Image 6">
            </div>
            <div class="background-images" id="right-background">
                <img src="img/Bear Bear Bear3.jpg" class="active" alt="Right Background Image 1">
                <img src="img/Pulu at Phusang2.jpg" alt="Right Background Image 2">
                <img src="img/บ่อกุ้งเพลินใจ ภูซาง4.jpg" alt="Right Background Image 3">
                <img src="img/ร้านแสงจันทร์3.jpg" alt="Right Background Image 4">
                <img src="img/มันตึงลำคาเฟ่2.jpg" alt="Right Background Image 5">
                <img src="img/Cafe de Phumin (บ้านรักขนม)1.jpg" alt="Right Background Image 6">
            </div>

            <!-- Centered buttons -->
            <div class="center-buttons">
                <a href="addareabymanager.php" class="btn-custom">เพิ่มสถานที่ท่องเที่ยว</a>
                <a href="addplaces.php" class="btn-custom">เพิ่มร้านค้า หรือ ที่พัก</a>
            </div>
        </div>

        <script>
            function setupBackgroundSlideshow(containerId) {
                const fadeDuration = 3; // Duration of the fade effect in seconds
                const delay = 1; // Time to hold the image before changing in seconds
                const interval = fadeDuration + delay; // Total time for each image to be shown
                let currentIndex = 0;
                const images = document.querySelectorAll(`#${containerId} img`);
                const totalImages = images.length;

                function changeImage() {
                    images[currentIndex].classList.remove('active');
                    currentIndex = (currentIndex + 1) % totalImages;
                    images[currentIndex].classList.add('active');
                }

                // Initial activation of the first image
                images[currentIndex].classList.add('active');

                setInterval(changeImage, interval * 1000); // Change image every interval seconds
            }

            setupBackgroundSlideshow('left-background');
            setupBackgroundSlideshow('right-background');
        </script>

    </body>

    </html>

<?php
}
?>