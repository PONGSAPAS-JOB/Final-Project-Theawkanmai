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
        $tag_description = $_POST['tag_description'];
        $name_Area = $_POST['name_Area'];
        $name_places = $_POST['name_places'];
        $latitude_Places = $_POST['latitude_Places'];
        $longitude_Places = $_POST['longitude_Places'];
        $address_Places = $_POST['address'];
        $sub_dis_Places = $_POST['sub_dis_Places'];
        $dis_Places = $_POST['dis_Places'];
        $provi_Places = $_POST['provi_Places'];
        $post_code = $_POST['post_code'];
        $details_places = $_POST['details_places'];


        //รูปภาพที่ 1
        $filename1 = $_POST["uploadfile1"];

        //รูปภาพที่ 2
        $filename2 = $_POST["uploadfile2"];

        //รูปภาพที่ 3
        $filename3 = $_POST["uploadfile3"];

        //รูปภาพที่ 4
        $filename4 = $_POST["uploadfile4"];

        $has_Map = $_POST['has_Map'];
        $phonenum_places = $_POST['phonenum_places'];

        if (isset($_POST['email_places'])) {
            $email_places = $_POST['email_places'];
        } else {
            $email_places = '';
        }

        if (isset($_POST['url_places'])) {
            $url_places = $_POST['url_places'];
        } else {
            $url_places = '';
        }
        //เวลาเปิด
        if (isset($_POST['ontime_Mon'])) {
            $ontime_Mon = $_POST['ontime_Mon'];
        } else {
            $ontime_Mon = '';
        }
        if (isset($_POST['ontime_Tue'])) {
            $ontime_Tue = $_POST['ontime_Tue'];
        } else {
            $ontime_Tue = '';
        }
        if (isset($_POST['ontime_Wed'])) {
            $ontime_Wed = $_POST['ontime_Wed'];
        } else {
            $ontime_Wed = '';
        }
        if (isset($_POST['ontime_Thu'])) {
            $ontime_Thu = $_POST['ontime_Thu'];
        } else {
            $ontime_Thu = '';
        }
        if (isset($_POST['ontime_Fri'])) {
            $ontime_Fri = $_POST['ontime_Fri'];
        } else {
            $ontime_Fri = '';
        }
        if (isset($_POST['ontime_Sat'])) {
            $ontime_Sat = $_POST['ontime_Sat'];
        } else {
            $ontime_Sat = '';
        }
        if (isset($_POST['ontime_Sun'])) {
            $ontime_Sun = $_POST['ontime_Sun'];
        } else {
            $ontime_Sun = '';
        }
        //เวลาปิด
        if (isset($_POST['closetime_Mon'])) {
            $closetime_Mon = $_POST['closetime_Mon'];
        } else {
            $closetime_Mon = '';
        }
        if (isset($_POST['closetime_Tue'])) {
            $closetime_Tue = $_POST['closetime_Tue'];
        } else {
            $closetime_Tue = '';
        }
        if (isset($_POST['closetime_Wed'])) {
            $closetime_Wed = $_POST['closetime_Wed'];
        } else {
            $closetime_Wed = '';
        }
        if (isset($_POST['closetime_Thu'])) {
            $closetime_Thu = $_POST['closetime_Thu'];
        } else {
            $closetime_Thu = '';
        }
        if (isset($_POST['closetime_Fri'])) {
            $closetime_Fri = $_POST['closetime_Fri'];
        } else {
            $closetime_Fri = '';
        }
        if (isset($_POST['closetime_Sat'])) {
            $closetime_Sat = $_POST['closetime_Sat'];
        } else {
            $closetime_Sat = '';
        }
        if (isset($_POST['closetime_Sun'])) {
            $closetime_Sun = $_POST['closetime_Sun'];
        } else {
            $closetime_Sun = '';
        }



        $sql = $userdata->addplacesbyadmin(
            $tag_description,
            $name_Area,
            $name_places,
            $latitude_Places,
            $longitude_Places,
            $address_Places,
            $sub_dis_Places,
            $dis_Places,
            $provi_Places,
            $post_code,
            $details_places,
            $filename1,
            $filename2,
            $filename3,
            $filename4,
            $has_Map,
            $phonenum_places,
            $email_places,
            $url_places,
            $ontime_Mon,
            $ontime_Tue,
            $ontime_Wed,
            $ontime_Thu,
            $ontime_Fri,
            $ontime_Sat,
            $ontime_Sun,
            $closetime_Mon,
            $closetime_Tue,
            $closetime_Wed,
            $closetime_Thu,
            $closetime_Fri,
            $closetime_Sat,
            $closetime_Sun,

            $_SESSION['id_admin']
        );
        if ($sql) {
            // echo "<script>alert('Add Places Success!');</script>";
            // echo "<script>window.location.href='areaandplacesMG.php'</script>";
            echo  "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Add Places Success!',
                        text: 'กำลังบันทึกข้อมูลสถานที่',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'areaandplacesMG.php';
                    });
                });
            </script>";
        } else {
            // echo "<script>alert('Add Places Failed!');</script>";
            // echo "<script>window.location.href='addplacesbyAD.php'</script>";
            echo  "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Add Places Failed!',
                        text: 'ไม่สามารถเพิ่มสถานที่ได้ โปรดลองอีกครั้ง!',
                        icon: 'error',
                        timer: 3000,
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
        <title>เพิ่มข้อมูลสถานที่ท่องเที่ยว</title>

        <script>
            (g => {
                var h, a, k, p = "The Google Maps JavaScript API",
                    c = "google",
                    l = "importLibrary",
                    q = "__ib__",
                    m = document,
                    b = window;
                b = b[c] || (b[c] = {});
                var d = b.maps || (b.maps = {}),
                    r = new Set,
                    e = new URLSearchParams,
                    u = () => h || (h = new Promise(async (f, n) => {
                        await (a = m.createElement("script"));
                        e.set("libraries", [...r] + "");
                        for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                        e.set("callback", c + ".maps." + q);
                        a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                        d[q] = f;
                        a.onerror = () => h = n(Error(p + " could not load."));
                        a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                        m.head.append(a)
                    }));
                d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
            })
            ({
                key: "AIzaSyADH48Q3EkxO3rtcTAhXj1Fz4XJcge5Ew4",
                v: "weekly"
            });
        </script>
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
                width: 100%;
                max-width: 500px;
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

            .btnaddat {
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

            .btnaddtt {
                margin-top: 35px;
                margin-left: 20px;
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

            .img-preview {
                display: none;
                max-width: 100%;
                height: auto;
            }

            .select2-container .select2-results__options {
                max-height: 150px;
                /* Adjust the height as needed */
                overflow-y: auto;
            }


            #placesMessage {
                margin-top: 20px;
            }
        </style>
        <?php
        include_once('functions.php');
        $fetchdataarea = new DB_con();
        $sql = $fetchdataarea->fetchdataarea();


        ?>

        <div class="addplace "><a></a></div>
        <div class="container">
            <h1 class="mt-5"> เพิ่มข้อมูลร้านค้า , ที่พัก </h1>
            <hr>

            <form method="POST" action="" enctype="multipart/form-data">
                <div style="display: flex;">
                    <div class="mb-3" style=" width: 420px;">
                        <label for="name_Area" class="form-label required-label">ต้องการเพิ่มร้านค้าเเละที่พักในบริเวณสถานที่ท่องเที่ยวไหน</label>
                        <select class="form-select" id="name_Area" name="name_Area" aria-describedby="ชื่อสถานที่หลัก" required>
                            <option value="" disabled selected>โปรดเลือกสถานที่</option>
                            <?php
                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                                <option value='<?php echo $row['id_Area']; ?>'><?php echo $row['name_Area']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div id="placesMessage" style="margin-top: 20px;"></div>
                </div>

                <hr>

                <div style="display: flex;">
                    <div class="mb-3" style="margin-right: 150px; width: 500px;">
                        <label for="name_places" class="form-label required-label">ชื่อร้านค้าหรือที่พัก</label>
                        <input type="text" class="form-control" id="name_places" name="name_places" aria-describedby="ชื่อสถานที่" onblur="nameplacescheck(this.value)" required>
                        <span id="placesnameavailable"></span>
                    </div>

                    <?php
                    include_once('functions.php');
                    $fetchdataTag = new DB_con();
                    $sqlTag = $fetchdataTag->fetchdataTag();


                    ?>

                    <div class="mb-3" style="width: 200px; margin-right: 10px;">
                        <label for="tag_description" class="form-label required-label">หมวดหมู่ของสถานที่</label>
                        <select class="form-select" id="tag_description" name="tag_description" aria-describedby="หมวดหมู่" onchange="showOtherInput()" required>
                            <option value="" disabled selected>โปรดเลือกหมวดหมู่</option>
                            <?php
                            while ($rowTag = mysqli_fetch_array($sqlTag)) {
                            ?>
                                <option value='<?php echo $rowTag['tag_description']; ?>'><?php echo $rowTag['tag_description']; ?></option>
                            <?php
                            }
                            ?>

                        </select>

                    </div>

                    <button id="addTagButton" class="btnaddat rounded"><i class="fa fa-plus"></i></button>

                    <script>
                        $(document).ready(function() {
                            $('#addTagButton').click(function() {
                                Swal.fire({
                                    title: 'คุณต้องการเพิ่มหมวดหมู่ของสถานที่หรือไม่?',
                                    text: "กำลังจะเข้าสู่หน้าเพิ่มหมวดหมู่สถานที่ ข้อมูลที่กรอกไว้จะต้องเริ่มต้นกรอกใหม่",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'ใช่ฉันต้องการเพิ่ม!',
                                    cancelButtonText: 'ยังก่อน'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        Swal.fire({
                                            title: 'กำลังเข้าสู่หน้าเพิ่มหมวดหมู่ของสถานที่',

                                            icon: 'success',
                                            timer: 1000,
                                            showConfirmButton: false
                                        }).then(() => {
                                            window.location.href = 'tagplacesMG.php';
                                        });

                                    }
                                });
                            });
                        });
                    </script>


                </div>
                <div style="display: flex;">
                    <div>
                        <div class="mb-3" style="border: 10px;">
                            <label for="map" class="form-label">แผนที่ (คลิกซ้ายเพื่อดูข้อมูล)</label>
                            <div id="map" style="height: 500px; width: 500px; border: 3px solid #FFFFFF;"></div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            if (typeof google !== "undefined" && google.maps && google.maps.importLibrary) {
                                google.maps.importLibrary("maps").then(() => {
                                    initMap();
                                });
                            } else {
                                console.error("Google Maps library failed to load.");
                            }
                        });

                        function initMap() {
                            const map = new google.maps.Map(document.getElementById("map"), {
                                center: {
                                    lat: 19.16439475341099,
                                    lng: 99.89638077976038
                                },
                                zoom: 12,
                            });

                            let marker;

                            // Add a click event listener to the map
                            map.addListener("click", (event) => {
                                const latitude_Places = event.latLng.lat();
                                const longitude_Places = event.latLng.lng();

                                // Convert latitude and longitude to address
                                const geocoder = new google.maps.Geocoder();

                                geocoder.geocode({
                                    location: {
                                        lat: latitude_Places,
                                        lng: longitude_Places
                                    }
                                }, (results, status) => {
                                    if (status === "OK") {
                                        const addressComponents = parseAddressComponents(results[0].address_components);
                                        const filteredAddress = filterAddressComponents(results[0].address_components);
                                        const googleMapLink = `https://www.google.com/maps?q=${latitude_Places},${longitude_Places}`;

                                        document.getElementById("latitude_Places").value = latitude_Places.toFixed(4);
                                        document.getElementById("longitude_Places").value = longitude_Places.toFixed(4);
                                        document.getElementById("address").value = filteredAddress;
                                        document.getElementById("sub_dis_Places").value = addressComponents.subdistrict || "";
                                        document.getElementById("dis_Places").value = addressComponents.district || "";
                                        document.getElementById("provi_Places").value = addressComponents.province || "";
                                        document.getElementById("has_Map").value = googleMapLink;

                                        const postalCode = results[0].address_components.find(
                                            (component) => component.types.includes("postal_code")
                                        );
                                        document.getElementById("post_code").value = postalCode ? postalCode.long_name : "";
                                        if (marker) {
                                            marker.setMap(null);
                                        }

                                        // Add a new marker
                                        marker = new google.maps.Marker({
                                            position: {
                                                lat: latitude_Places,
                                                lng: longitude_Places
                                            },
                                            map: map,
                                            icon: {
                                                url: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png' // Red pin icon
                                            }
                                        });
                                    } else {
                                        console.error("Geocoder failed:", status);
                                    }
                                });
                            });
                        }

                        function parseAddressComponents(addressComponents) {
                            const subdistrict = addressComponents.find((component) =>
                                component.types.includes("sublocality_level_1") || component.types.includes("locality")
                            );
                            const district = addressComponents.find((component) =>
                                component.types.includes("administrative_area_level_2")
                            );
                            const province = addressComponents.find((component) =>
                                component.types.includes("administrative_area_level_1")
                            );

                            return {
                                subdistrict: subdistrict ? stripPrefix(subdistrict.long_name, "ตำบล") : "",
                                district: district ? stripPrefix(district.long_name, "อำเภอ") : "",
                                province: province ? province.long_name : "",
                            };
                        }

                        function filterAddressComponents(addressComponents) {
                            const excludeTypes = ["sublocality_level_1", "locality", "administrative_area_level_2", "administrative_area_level_1", "postal_code", "country"];
                            const filteredComponents = addressComponents.filter(component =>
                                !excludeTypes.some(type => component.types.includes(type))
                            );
                            return filteredComponents.map(component => component.long_name).join(", ");
                        }

                        function stripPrefix(text, prefix) {
                            if (text.startsWith(prefix)) {
                                return text.slice(prefix.length).trim();
                            }
                            return text;
                        }
                    </script>
                    <div style="margin-left: 50px; margin-top: 30px; width: 420px;">
                        <div class="mb-3" style=" width: 425px;">
                            <label for="has_Map" class="form-label required-label">Link Google Map</label>
                            <input type="text" class="form-control" id="has_Map" name="has_Map" aria-describedby="ลิ้งค์เเผนที่" required>
                        </div>
                        <div style="display: flex; width: 425px;">
                            <div class="mb-3" style="margin-right: 30px; width: 300px;">
                                <label for="latitude_Places" class="form-label required-label">Latitude ของสถานที่</label>
                                <input type="text" class="form-control " id="latitude_Places" name="latitude_Places" aria-describedby="Latitude ของสถานที่" required>
                            </div>
                            <div class="mb-3" style=" width: 300px;">
                                <label for="longitude_Places" class="form-label required-label">Longitude ของสถานที่</label>
                                <input type="text" class="form-control " id="longitude_Places" name="longitude_Places" aria-describedby="Longitude ของสถานที่" required>
                            </div>

                        </div>


                        <div class="mb-3" style="margin-right: 20px; width: 425px;">

                            <label for="address" class="form-label">ที่อยู่ เลขที่ ซอย ถนน</label>
                            <input type="text" class="form-control" id="address" name="address" aria-describedby="ที่อยู่ เลขที่">
                        </div>
                        <div style="display: flex; width: 425px;">
                            <div class="mb-3" style="margin-right: 30px; width: 300px;">
                                <label for="sub_dis_Places" class="form-label required-label">ตำบล</label>
                                <input type="text" class="form-control" id="sub_dis_Places" name="sub_dis_Places" aria-describedby="ตำบล" required>
                            </div>
                            <div class="mb-3" style=" width: 300px;">
                                <label for="dis_Places" class="form-label required-label">อำเภอ</label>
                                <input type="text" class="form-control" id="dis_Places" name="dis_Places" aria-describedby="อำเภอ" required>
                            </div>
                        </div>
                        <div style="display: flex; width: 425px;">
                            <div class="mb-3" style="margin-right: 30px; width: 300px;">
                                <label for="provi_Places" class="form-label required-label">จังหวัด</label>
                                <input type="text" class="form-control" id="provi_Places" name="provi_Places" aria-describedby="จังหวัด" required>
                            </div>
                            <div class="mb-3" style=" width: 300px;">
                                <label for="post_code" class="form-label required-label">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control" id="post_code" name="post_code" aria-describedby="รหัสไปรษณีย์" required>
                            </div>
                        </div>
                        <hr>
                    </div>

                </div>


                <div style="display: flex; ">
                    <div class="mb-3" style="margin-right: 20px; ">
                        <label for="phonenum_places" class="form-label required-label">เบอร์โทรศัพท์ สถานที่</label>
                        <input type="text" class="form-control" id="phonenum_places" name="phonenum_places" aria-describedby="เบอร์โทรศัพท์ สถานที่" required>
                    </div>
                    <div class="mb-3" style="margin-right: 20px; width: 400px;">
                        <label for="email_places" class="form-label">Email สถานที่</label>
                        <input type="email" class="form-control" id="email_places" name="email_places" aria-describedby="Email สถานที่">
                    </div>
                    <div class="mb-3" style=" width: 400px;">
                        <label for="url_places" class="form-label">Link สถานที่ เพิ่มเติม</label>
                        <input type="text" class="form-control" id="url_places" name="url_places" aria-describedby="Link สถานที่ เพิ่มเติม">
                    </div>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const infoArea = document.getElementById("details_places");
                        infoArea.value = infoArea.value.trim();
                    });
                </script>
                <div class="mb-3">
                    <label for="details_places" class="form-label required-label">ข้อมูลสถานที่</label>
                    <textarea type="text" class="form-control" row="10" id="details_places" name="details_places" aria-describedby="ข้อมูลสถานที่" required>
                    </textarea>
                </div>


                <hr>
                <h2 class="mt-3 mb-4">เวลาที่เปิด - ปิด</h2>

                <script>
                    function validateTime(day) {
                        const openTime = document.getElementById(`ontime_${day}`).value;
                        const closeTime = document.getElementById(`closetime_${day}`).value;
                        const errorMessage = document.getElementById(`error-message-${day}`);

                        if (openTime && closeTime && openTime >= closeTime) {
                            errorMessage.style.display = 'block';
                        } else {
                            errorMessage.style.display = 'none';
                        }
                    }

                    function toggleTimeInputs(day) {
                        const isOpen = document.getElementById(`switch_${day}`).checked;
                        const openTimeInput = document.getElementById(`ontime_${day}`);
                        const closeTimeInput = document.getElementById(`closetime_${day}`);
                        const hiddenOpenTimeInput = document.getElementById(`hidden_ontime_${day}`);
                        const hiddenCloseTimeInput = document.getElementById(`hidden_closetime_${day}`);

                        if (isOpen) {
                            openTimeInput.disabled = false;
                            closeTimeInput.disabled = false;
                            openTimeInput.style.backgroundColor = '';
                            closeTimeInput.style.backgroundColor = '';
                        } else {
                            openTimeInput.disabled = true;
                            closeTimeInput.disabled = true;
                            openTimeInput.value = '00:00'; // กำหนดเวลาเป็น 00:00 เมื่อสลับสวิตช์ไปยังการปิด
                            closeTimeInput.value = '00:00'; // กำหนดเวลาเป็น 00:00 เมื่อสลับสวิตช์ไปยังการปิด
                            hiddenOpenTimeInput.value = '00:00'; // บันทึกค่าเวลาใน hidden input เป็น 00:00 เมื่อสลับสวิตช์ไปยังการปิด
                            hiddenCloseTimeInput.value = '00:00'; // บันทึกค่าเวลาใน hidden input เป็น 00:00 เมื่อสลับสวิตช์ไปยังการปิด
                            openTimeInput.style.backgroundColor = 'lightgray';
                            closeTimeInput.style.backgroundColor = 'lightgray';
                        }
                    }



                    document.addEventListener('DOMContentLoaded', (event) => {
                        const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                        days.forEach(day => {
                            document.getElementById(`ontime_${day}`).addEventListener('change', () => {
                                document.getElementById(`hidden_ontime_${day}`).value = document.getElementById(`ontime_${day}`).value;
                                validateTime(day);
                            });
                            document.getElementById(`closetime_${day}`).addEventListener('change', () => {
                                document.getElementById(`hidden_closetime_${day}`).value = document.getElementById(`closetime_${day}`).value;
                                validateTime(day);
                            });
                            document.getElementById(`switch_${day}`).addEventListener('change', () => toggleTimeInputs(day));
                        });
                    });
                </script>


                <!-- Time inputs for each day of the week -->
                <div class="day-time-input">
                    <div style="display: flex;">
                        <div class="form-check form-switch mt-4" style="margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="switch_Mon" checked>
                            <label class="form-check-label" for="switch_Mon"></label>
                        </div>
                        <h5 class="mt-4" style="margin-right: 60px;">วันจันทร์ :</h5>
                        <div class="mb-3" style="margin-right: 20px;">
                            <label for="ontime_Mon" class="form-label required-label">เวลาเปิด</label>
                            <input type="time" class="form-control" id="ontime_Mon" name="ontime_Mon">
                            <input type="hidden" id="hidden_ontime_Mon" name="hidden_ontime_Mon">
                        </div>
                        <div class="mb-3" style="margin-right: 20px;">
                            <h5 class="mt-5">ถึง</h5>
                        </div>
                        <div class="mb-3">
                            <label for="closetime_Mon" class="form-label required-label">เวลาปิด</label>
                            <input type="time" class="form-control" id="closetime_Mon" name="closetime_Mon">
                            <input type="hidden" id="hidden_closetime_Mon" name="hidden_closetime_Mon">
                        </div>
                        <div id="error-message-Mon" class="alert" style="color: red; margin-left: 10px; display: none;">
                            เวลาเปิดต้องน้อยกว่าเวลาปิด
                        </div>
                    </div>
                </div>

                <!-- Repeat similar structure for other days -->
                <div class="day-time-input">
                    <div style="display: flex;">
                        <div class="form-check form-switch mt-4" style="margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="switch_Tue" checked>
                            <label class="form-check-label" for="switch_Tue"></label>
                        </div>
                        <h5 class="mt-4" style="margin-right: 56px;">วันอังคาร :</h5>
                        <div class="mb-3" style="margin-right: 20px;">
                            <label for="ontime_Tue" class="form-label "></label>
                            <input type="time" class="form-control" id="ontime_Tue" name="ontime_Tue">
                            <input type="hidden" id="hidden_ontime_Tue" name="hidden_ontime_Tue">
                        </div>
                        <div class="mb-1" style="margin-right: 20px;">
                            <h5 class="mt-4">ถึง</h5>
                        </div>
                        <div class="mb-1">
                            <label for="closetime_Tue" class="form-label "></label>
                            <input type="time" class="form-control" id="closetime_Tue" name="closetime_Tue">
                            <input type="hidden" id="hidden_closetime_Tue" name="hidden_closetime_Tue">
                        </div>
                        <div id="error-message-Tue" class="alert" style="color: red; margin-left: 10px; display: none;">
                            เวลาเปิดต้องน้อยกว่าเวลาปิด
                        </div>
                    </div>
                </div>

                <div class="day-time-input">
                    <div style="display: flex;">
                        <div class="form-check form-switch mt-4" style="margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="switch_Wed" checked>
                            <label class="form-check-label" for="switch_Wed"></label>
                        </div>
                        <h5 class="mt-4" style="margin-right: 80px;">วันพุธ :</h5>
                        <div class="mb-3" style="margin-right: 20px;">
                            <label for="ontime_Wed" class="form-label "></label>
                            <input type="time" class="form-control" id="ontime_Wed" name="ontime_Wed">
                            <input type="hidden" id="hidden_ontime_Wed" name="hidden_ontime_Wed">
                        </div>
                        <div class="mb-1" style="margin-right: 20px;">
                            <h5 class="mt-4">ถึง</h5>
                        </div>
                        <div class="mb-1">
                            <label for="closetime_Wed" class="form-label "></label>
                            <input type="time" class="form-control" id="closetime_Wed" name="closetime_Wed">
                            <input type="hidden" id="hidden_closetime_Wed" name="hidden_closetime_Wed">
                        </div>
                        <div id="error-message-Wed" class="alert" style="color: red; margin-left: 10px; display: none;">
                            เวลาเปิดต้องน้อยกว่าเวลาปิด
                        </div>
                    </div>
                </div>

                <div class="day-time-input">
                    <div style="display: flex;">
                        <div class="form-check form-switch mt-4" style="margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="switch_Thu" checked>
                            <label class="form-check-label" for="switch_Thu"></label>
                        </div>
                        <h5 class="mt-4" style="margin-right: 30px;">วันพฤหัสบดี :</h5>
                        <div class="mb-3" style="margin-right: 20px;">
                            <label for="ontime_Thu" class="form-label "></label>
                            <input type="time" class="form-control" id="ontime_Thu" name="ontime_Thu">
                            <input type="hidden" id="hidden_ontime_Thu" name="hidden_ontime_Thu">
                        </div>
                        <div class="mb-1" style="margin-right: 20px;">
                            <h5 class="mt-4">ถึง</h5>
                        </div>
                        <div class="mb-1">
                            <label for="closetime_Thu" class="form-label "></label>
                            <input type="time" class="form-control" id="closetime_Thu" name="closetime_Thu">
                            <input type="hidden" id="hidden_closetime_Thu" name="hidden_closetime_Thu">
                        </div>
                        <div id="error-message-Thu" class="alert" style="color: red; margin-left: 10px; display: none;">
                            เวลาเปิดต้องน้อยกว่าเวลาปิด
                        </div>
                    </div>
                </div>

                <div class="day-time-input">
                    <div style="display: flex;">
                        <div class="form-check form-switch mt-4" style="margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="switch_Fri" checked>
                            <label class="form-check-label" for="switch_Fri"></label>
                        </div>
                        <h5 class="mt-4" style="margin-right: 72px;">วันศุกร์ :</h5>
                        <div class="mb-3" style="margin-right: 20px;">
                            <label for="ontime_Fri" class="form-label "></label>
                            <input type="time" class="form-control" id="ontime_Fri" name="ontime_Fri">
                            <input type="hidden" id="hidden_ontime_Fri" name="hidden_ontime_Fri">
                        </div>
                        <div class="mb-1" style="margin-right: 20px;">
                            <h5 class="mt-4">ถึง</h5>
                        </div>
                        <div class="mb-1">
                            <label for="closetime_Fri" class="form-label "></label>
                            <input type="time" class="form-control" id="closetime_Fri" name="closetime_Fri">
                            <input type="hidden" id="hidden_closetime_Fri" name="hidden_closetime_Fri">
                        </div>
                        <div id="error-message-Fri" class="alert" style="color: red; margin-left: 10px; display: none;">
                            เวลาเปิดต้องน้อยกว่าเวลาปิด
                        </div>
                    </div>
                </div>

                <div class="day-time-input">
                    <div style="display: flex;">
                        <div class="form-check form-switch mt-4" style="margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="switch_Sat" checked>
                            <label class="form-check-label" for="switch_Sat"></label>
                        </div>
                        <h5 class="mt-4" style="margin-right: 70px;">วันเสาร์ :</h5>
                        <div class="mb-3" style="margin-right: 20px;">
                            <label for="ontime_Sat" class="form-label "></label>
                            <input type="time" class="form-control" id="ontime_Sat" name="ontime_Sat">
                            <input type="hidden" id="hidden_ontime_Sat" name="hidden_ontime_Sat">
                        </div>
                        <div class="mb-1" style="margin-right: 20px;">
                            <h5 class="mt-4">ถึง</h5>
                        </div>
                        <div class="mb-1">
                            <label for="closetime_Sat" class="form-label "></label>
                            <input type="time" class="form-control" id="closetime_Sat" name="closetime_Sat">
                            <input type="hidden" id="hidden_closetime_Sat" name="hidden_closetime_Sat">
                        </div>
                        <div id="error-message-Sat" class="alert" style="color: red; margin-left: 10px; display: none;">
                            เวลาเปิดต้องน้อยกว่าเวลาปิด
                        </div>
                    </div>
                </div>

                <div class="day-time-input">
                    <div style="display: flex;">
                        <div class="form-check form-switch mt-4" style="margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="switch_Sun" checked>
                            <label class="form-check-label" for="switch_Sun"></label>
                        </div>
                        <h5 class="mt-4" style="margin-right: 49px;">วันอาทิตย์ :</h5>
                        <div class="mb-3" style="margin-right: 20px;">
                            <label for="ontime_Sun" class="form-label "></label>
                            <input type="time" class="form-control" id="ontime_Sun" name="ontime_Sun">
                            <input type="hidden" id="hidden_ontime_Sun" name="hidden_ontime_Sun">
                        </div>
                        <div class="mb-1" style="margin-right: 20px;">
                            <h5 class="mt-4">ถึง</h5>
                        </div>
                        <div class="mb-1">
                            <label for="closetime_Sun" class="form-label "></label>
                            <input type="time" class="form-control" id="closetime_Sun" name="closetime_Sun">
                            <input type="hidden" id="hidden_closetime_Sun" name="hidden_closetime_Sun">
                        </div>
                        <div id="error-message-Sun" class="alert" style="color: red; margin-left: 10px; display: none;">
                            เวลาเปิดต้องน้อยกว่าเวลาปิด
                        </div>
                    </div>
                </div>

                <hr>


                <div>

                    <style>
                        .clear-button {
                            position: absolute;
                            right: 10px;
                            top: 35px;
                            background: none;
                            border: none;
                            font-size: 1.2em;
                            cursor: pointer;
                        }

                        .img-preview {
                            margin-top: 10px;
                            max-width: 100%;
                            display: none;
                            /* เริ่มต้นซ่อนภาพตัวอย่าง */
                        }
                    </style>
                    <h2 class="mt-3">เพิ่มรูปภาพ</h2>
                    <script>
                        let imageError = false;

                        function convertGoogleDriveLink(url) {
                            const regex = /https:\/\/drive\.google\.com\/file\/d\/(.*?)\/view/;
                            const match = url.match(regex);
                            if (match && match[1]) {
                                const fileId = match[1];
                                const directLink = `https://lh3.googleusercontent.com/d/${fileId}=s1600-rw`;
                                console.log('Converted URL:', directLink); // Log the converted URL
                                return directLink;
                            }
                            console.log('Original URL:', url); // Log the original URL if it doesn't match
                            return url; // Return the original URL if it doesn't match the Google Drive format
                        }

                        function showPreview(url, previewId, inputId) {
                            const imgPreview = document.getElementById(previewId);
                            const directUrl = convertGoogleDriveLink(url);
                            const inputField = document.getElementById(inputId);
                            console.log('Direct URL:', directUrl); // Log the direct URL
                            if (url) {
                                imgPreview.src = directUrl;
                                imgPreview.style.display = 'block'; // Show the preview image
                                inputField.value = directUrl; // Update the input field with the direct URL
                                console.log('Updated Input Value:', inputField.value); // Log the updated input value
                                imageError = false;
                            } else {
                                imgPreview.src = '';
                                imgPreview.style.display = 'none'; // Hide the preview image if there's no URL
                            }

                            imgPreview.onerror = () => {
                                console.log('Image loading error for URL:', directUrl); // Log the error URL
                                imgPreview.src = '';
                                imgPreview.alt = 'Link นี้ไม่ใช่ Link ของรูปภาพ!.';
                                imageError = true;
                                document.getElementById('submitBtn').disabled = true;
                            };

                            imgPreview.onload = () => {
                                imgPreview.alt = 'Preview will be displayed here.';
                                document.getElementById('submitBtn').disabled = false;
                                imageError = false; // Reset imageError on successful load
                            };
                        }

                        function checkSubmit() {
                            const uploadfile1 = document.getElementById('uploadfile1').value;
                            console.log('uploadfile1 Value:', uploadfile1); // Log the value of uploadfile1

                            // If an error occurs while loading the image, imageError will be true, preventing the submit
                            if (imageError) {
                                alert('ไม่สามารถ Submit ได้ เนื่องจากมี Link รูปภาพที่ไม่ถูกต้อง');
                                return false;
                            }
                            return true;
                        }

                        function clearInput(inputId, previewId) {
                            const inputField = document.getElementById(inputId);
                            inputField.value = '';
                            showPreview('', previewId, inputId); // Clear the preview image
                        }
                    </script>

                    <div id="content">
                        <div class="form-group mb-3">
                            <label for="uploadfile1" class="form-label required-label">รูปภาพที่ 1 (รูปภาพหน้าปก)</label>
                            <div style="position: relative;" class="input-group">
                                <input class="form-control" type="text" id="uploadfile1" name="uploadfile1" required oninput="showPreview(this.value, 'imgPreview1', 'uploadfile1')">
                                <button class="input-group-text" type="button" onclick="clearInput('uploadfile1', 'imgPreview1')">x</button>
                            </div>
                            <img id="imgPreview1" class="img-preview" src="" alt="Preview 1 will be displayed here.">
                        </div>
                        <div class="form-group mb-3">
                            <label for="uploadfile2" class="form-label">รูปภาพที่ 2 (รูปภาพเพิ่มเติม)</label>
                            <div style="position: relative;" class="input-group">
                                <input class="form-control" type="text" id="uploadfile2" name="uploadfile2" oninput="showPreview(this.value, 'imgPreview2', 'uploadfile2')">
                                <button class="input-group-text" type="button" onclick="clearInput('uploadfile2', 'imgPreview2')">x</button>
                            </div>
                            <img id="imgPreview2" class="img-preview" src="" alt="Preview 2 will be displayed here.">
                        </div>
                        <div class="form-group mb-3">
                            <label for="uploadfile3" class="form-label">รูปภาพที่ 3 (รูปภาพเพิ่มเติม)</label>
                            <div style="position: relative;" class="input-group">
                                <input class="form-control" type="text" id="uploadfile3" name="uploadfile3" oninput="showPreview(this.value, 'imgPreview3', 'uploadfile3')">
                                <button class="input-group-text" type="button" onclick="clearInput('uploadfile3', 'imgPreview3')">x</button>
                            </div>
                            <img id="imgPreview3" class="img-preview" src="" alt="Preview 3 will be displayed here.">
                        </div>
                        <div class="form-group">
                            <label for="uploadfile4" class="form-label">รูปภาพที่ 4 (รูปภาพเพิ่มเติม)</label>
                            <div style="position: relative;" class="input-group">
                                <input class="form-control" type="text" id="uploadfile4" name="uploadfile4" oninput="showPreview(this.value, 'imgPreview4', 'uploadfile4')">
                                <button class="input-group-text" type="button" onclick="clearInput('uploadfile4', 'imgPreview4')">x</button>
                            </div>
                            <img id="imgPreview4" class="img-preview" src="" alt="Preview 4 will be displayed here.">
                        </div>
                    </div>


                    <button type="submit" name="insert" id="insert" class="mt-5 mb-5 btn btn-warning" style="float: right;">เพิ่มข้อมูลร้านค้าหรือที่พักใหม่</button>

            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            function nameplacescheck(val) {
                $.ajax({
                    type: 'POST',
                    url: 'checkplaces_available.php',
                    data: 'name_places=' + val,
                    success: function(data) {
                        $('#placesnameavailable').html(data);
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