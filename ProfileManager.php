<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<?php

session_start();

if ($_SESSION['Id_manager'] == "") {
    header("location: signin.php");
    exit();
} else {
    include('functions.php'); // Include your DB_con class file

    $db = new DB_con(); // Create an instance of DB_con
    $conn = $db->dbcon; // Access the connection through the dbcon property

    $id_manager = $_SESSION['Id_manager'];
    $query = "SELECT img_manager, username, email, phone FROM manager WHERE Id_manager = ?";
    $stmt = $conn->prepare($query); // Use the $conn variable from DB_con
    $stmt->bind_param("i", $id_manager);
    $stmt->execute();
    $stmt->bind_result($img_manager, $username, $email, $phone);
    $stmt->fetch();
    $stmt->close();
    $conn->close(); // Close the connection when done
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="img/icon.png" type="image/ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lily+Script+One&display=swap" rel="stylesheet">
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

        h1 {
            font-family: "Itim", cursive;
            font-style: normal;
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
                        <img src="<?php echo $img_manager; ?>" class="rounded-circle " alt="...">


                        <a class="btn btn-danger" type="submit" href="logout.php">ออกจากระบบ</a>
                    </form>
                </div>
            </div>
        </div>
    </nav>

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
                    <img id="imgPreview1" class="img-preview" src="<?php echo $img_manager ? $img_manager : 'img/profile.png'; ?>" alt="Preview will be displayed here.">
                    <h2><?php echo $username; ?></h2>
                    <p>Email: <?php echo $email; ?></p>
                    <p>Phone: <?php echo $phone; ?></p>
                </div>
                <div style="width: 300px; padding: 20px; margin-left: 900px; white-space: nowrap; margin-top: 7px;">
                    <a href="EditProfileManager.php" class="btn btn-warning">เเก้ไขข้อมูลส่วนตัว</a>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>