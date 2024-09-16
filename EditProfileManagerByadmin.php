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
    $img_admin = $db->getAdminProfilePicture($id_admin);


    $id_manager = $_GET['id'];
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
<?php

include_once('functions.php');
$userdata = new DB_con();
$updatedata = new DB_con();

if (isset($_POST['update'])) {

    // รับข้อมูลจากฟอร์ม
    $filename1 = $_POST["uploadfile1"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // อัปเดตโปรไฟล์ผู้จัดการ
    $sql = $updatedata->updateProfilemanager(
        $filename1,
        $username,
        $email,
        $phone,
        $id_manager
    );

    if ($sql) {
        echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Update Profile Success!',
                    text: 'กำลังเเก้ไขข้อมูลส่วนตัว',
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'ManagerMG.php';
                });
            });
        </script>";
    } else {
        echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Update Profile Failed!',
                    text: 'ไม่สามารถเเก้ไขข้อมูลส่วนตัวได้ โปรดลองอีกครั้ง!',
                    icon: 'error',
                    showConfirmButton: false
                }).then(() => {
                    history.back();
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
    <title>ข้อมูลของผู้ใช้งาน</title>
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
            margin-left: 450px;
            margin-bottom: 30px;
        }
    </style>

    <script>
        let imageError = false;

        function convertGoogleDriveLink(url) {
            const regex = /https:\/\/drive\.google\.com\/file\/d\/(.*?)\/view/;
            const match = url.match(regex);
            if (match && match[1]) {
                const fileId = match[1];
                const directLink = `https://lh3.googleusercontent.com/d/${fileId}=s1600-rw`;
                return directLink;
            }
            return url;
        }

        function showPreview(url, previewId, inputId) {
            const imgPreview = document.getElementById(previewId);
            const defaultImage = 'img/profile.png'; // กำหนดรูปเริ่มต้น
            const directUrl = url ? convertGoogleDriveLink(url) : defaultImage;
            const inputField = document.getElementById(inputId);

            if (url) {
                imgPreview.src = directUrl;
                imgPreview.style.display = 'block'; // Show the preview image
                inputField.value = directUrl; // Update the input field with the direct URL
                imageError = false;
            } else {
                imgPreview.src = defaultImage; // Set default image if no URL is provided
                imgPreview.style.display = 'block'; // Show the preview image with default
                inputField.value = ''; // Clear the input field if URL is empty
            }

            imgPreview.onerror = () => {
                imgPreview.src = defaultImage; // Revert to default image on error
                imgPreview.alt = 'Link นี้ไม่ใช่ Link ของรูปภาพ!';
                imageError = true;
                document.getElementById('submitBtn').disabled = true;
            };

            imgPreview.onload = () => {
                imgPreview.alt = 'Preview will be displayed here.';
                document.getElementById('submitBtn').disabled = false;
            };
        }


        function checkSubmit() {
            const uploadfile1 = document.getElementById('uploadfile1').value;

            if (imageError) {
                alert('ไม่สามารถ Submit ได้ เนื่องจากมี Link รูปภาพที่ไม่ถูกต้อง');
                return false;
            }
            return true;
        }


        function clearInput(inputId, previewId) {
            const inputField = document.getElementById(inputId);
            inputField.value = '';
            showPreview('', previewId, inputId); // Set default image when input is cleared
        }


        document.addEventListener("DOMContentLoaded", function() {
            // Show preview for img_manager or default image
            const img_managerValue = "<?php echo $img_manager ? $img_manager : ''; ?>";
            showPreview(img_managerValue, 'imgPreview1', 'uploadfile1');
        });
    </script>
    <div class="addplace ">
        <div class="container" style="margin-left: 0px; font-size: 25px; background-color: #ffffff; width: 1230px; padding: 20px; box-shadow: 0px 4px 10px rgba(0, 0, 10, 0.15); text-align: center;">
            <div style=" padding: 20px; white-space: nowrap; ">
                <h1><b>ข้อมูลของผู้ใช้งาน</b></h1>
            </div>

            <div class="profile-container">
                <form action="" method="post" onsubmit="return checkSubmit();">
                    <img id="imgPreview1" class="img-preview" src="<?php echo $img_manager ? $img_manager : 'img/profile.png'; ?>" alt="Preview will be displayed here.">

                    <div style="margin-left: 450px; margin-bottom: 50px; width: 300px;" class="input-group">
                        <input class="form-control" type="text" id="uploadfile1" name="uploadfile1" oninput="showPreview(this.value, 'imgPreview1', 'uploadfile1')" value="<?php echo $img_manager; ?>">
                        <button class="input-group-text" type="button" onclick="clearInput('uploadfile1', 'imgPreview1')">x</button>
                    </div>

                    <div style="display: flex;">
                        <label for="username" class="form-label">Username : </label>
                        <input style="margin-left: 20px; margin-bottom: 50px; width: 800px;" type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                    </div>
                    <div style="display: flex;">
                        <label for="email" class="form-label" style="margin-left: 53px;">Email : </label>
                        <input style="margin-left: 20px; margin-bottom: 50px; width: 800px;" type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                    </div>
                    <div style="display: flex;">
                        <label for="phone" class="form-label" style="margin-left: 48px;">Phone :</label>
                        <input style="margin-left: 20px; margin-bottom: 50px; width: 800px;" type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>">
                    </div>
                    <button type="submit" class="btn btn-warning" id="update" name="update">บันทึกการเปลี่ยนแปลง</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>