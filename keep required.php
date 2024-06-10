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
        $name_Area = $_POST['name_Area'];
        $latitude_Area = $_POST['latitude_Area'];
        $longitude_Area = $_POST['longitude_Area'];
        $address_Area = $_POST['address_Area'];
        $sub_dis_Area = $_POST['sub_dis_Area'];
        $dis_Area = $_POST['dis_Area'];
        $provi_Area = $_POST['provi_Area'];
        $post_code = $_POST['post_code'];
        $info_Area = $_POST['info_Area'];
        $activityinfo_Area = $_POST['activityinfo_Area'];
        $has_map_Area = $_POST['has_map_Area'];
        $phonenum_Area = $_POST['phonenum_Area'];
        $email_Area = $_POST['email_Area'];
        $url_Area = $_POST['url_Area'];
        $ontime_Mon = $_POST['ontime_Mon'];
        $ontime_Tue = $_POST['ontime_Tue'];
        $ontime_Wed = $_POST['ontime_Wed'];
        $ontime_Thu = $_POST['ontime_Thu'];
        $ontime_Fri = $_POST['ontime_Fri'];
        $ontime_Sat = $_POST['ontime_Sat'];
        $ontime_Sun = $_POST['ontime_Sun'];
        $closetime_Mon = $_POST['closetime_Mon'];
        $closetime_Tue = $_POST['closetime_Tue'];
        $closetime_Wed = $_POST['closetime_Wed'];
        $closetime_Thu = $_POST['closetime_Thu'];
        $closetime_Fri = $_POST['closetime_Fri'];
        $closetime_Sat = $_POST['closetime_Sat'];
        $closetime_Sun = $_POST['closetime_Sun'];
        $Access_Status = $_POST['Access_Status'];
        $price_in = $_POST['price_in'];
        $img_Area1 = $_POST['img_Area1'];
        $img_Area2 = $_POST['img_Area2'];
        $img_Area3 = $_POST['img_Area3'];
        $img_Area4 = $_POST['img_Area4'];


        $sql = $userdata->addarea(
            $name_Area,
            $latitude_Area,
            $longitude_Area,
            $address_Area,
            $sub_dis_Area,
            $dis_Area,
            $provi_Area,
            $post_code,
            $info_Area,
            $activityinfo_Area,
            $has_map_Area,
            $phonenum_Area,
            $email_Area,
            $url_Area,
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
            $Access_Status,
            $price_in,
            $img_Area1,
            $img_Area2,
            $img_Area3,
            $img_Area4
        );

        if ($sql) {
            // echo "<script>alert('Add Area Success!');</script>";
            // echo "<script>window.location.href='areaandplacesMG.php'</script>";
            echo   "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Add Area Success!',
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
            // echo "<script>alert('Add Area Failed!');</script>";
            // echo "<script>window.location.href='addarea.php'</script>";
            // echo error_reporting();
            echo   "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Add Area Failed!',
                        text: 'ไม่สามารถเพิ่มสถานที่ได้ โปรดลองอีกครั้ง!',
                        icon: 'error',
                        timer: 3000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'addarea.php';
                    });
                });
            </script>";
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <script type="text/javascript" src="https://api.longdo.com/map/?key=5f0cf4be3ba02be29c4136aca052b5fd"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lily+Script+One&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>เพิ่มข้อมูลสถานที่ท่องเที่ยวหลัก</title>
    </head>
    <style>
        body {
            margin-top: 0px;
            background-image: url('img/img4.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
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
                width: 8%;
                height: 8%;
                margin-right: 3%;
                margin-bottom: -10%;

            }
        </style>



        <nav class="navbar navbar-expand-lg navbar-light bg-warning">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <span class="app-name">Theaw-kan-mai App </span>
                    <span class="app-desc">Location information management application</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" style="white-space: nowrap;" aria-current="page" href="homeadmin.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" style="white-space: nowrap;" aria-current="page" href="areaandplacesMG.php">Area/Places Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" style="white-space: nowrap;" aria-current="page" href="memberMG.php">Member Management</a>
                        </li>


                    </ul>
                    <div>

                        <form class="d-flex justify-content-end ">
                            <a class="navbar-brand " href="#">Welcome, </a>
                            <a class="navbar-brand" href="#">
                                <span class="app-name"><?php echo $_SESSION['username']; ?></span>
                                <span class="app-desc">ผู้ดูเเลระบบ</span>

                            </a>
                            <img src="img/pro.jpg" class="rounded-circle " alt="...">


                            <a class="btn btn-success" type="submit" href="logout.php">ออกจากระบบ</a>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
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


            .required:after {
                content: "*";
            }

            #other-input {
                display: none;
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
            <h1 class="mt-5"> เพิ่มข้อมูลสถานที่ท่องเที่ยวหลัก </h1>
            <hr>

            <form method="post">
                <div style="display: flex; ">
                    <div class="mb-3 " style="margin-right: 150px; width: 500px;">
                        <label for="name_Area" class="form-label">ชื่อสถานที่หลัก</label>
                        <input type="text" class="form-control" id="name_Area" name="name_Area" aria-describedby="ชื่อสถานที่" onblur="nameareacheck(this.value)" required>
                        <span id="areanameavailable"></span>
                    </div>


                    <?php
                    include_once('functions.php');
                    $fetchdataType = new DB_con();
                    $sqlType = $fetchdataType->fetchdataType();


                    ?>

                    <div class="mb-3" style="width: 200px; margin-right: 10px;">
                        <label for="name_typeArea" class="form-label">ประเภทของสถานที่</label>
                        <select class="form-select" id="name_typeArea" name="name_typeArea" aria-describedby="ประเภท" required onchange="showOtherInput()">
                            <option value="" disabled selected>โปรดเลือกประเภท</option>
                            <?php
                            while ($rowType = mysqli_fetch_array($sqlType)) {
                            ?>
                                <option value='<?php echo $rowType['name_typeArea']; ?>'><?php echo $rowType['name_typeArea']; ?></option>
                            <?php
                            }
                            ?>
                            <option value="other">อื่นๆ</option>
                        </select>
                    </div>

                    <div class="mb-3" id="other-input" style="width: 200px; margin-left: 15px;">
                        <label for="other-type" class="form-label">กรอกประเภทเพิ่มเติม</label>
                        <input type="text" class="form-control" id="other-type" name="other-type">
                    </div>

                    <script>
                        function showOtherInput() {
                            var selectBox = document.getElementById('name_typeArea');
                            var otherInput = document.getElementById('other-input');
                            if (selectBox.value === 'other') {

                                otherInput.style.display = 'block';
                            } else {

                                otherInput.style.display = 'none';
                            }
                        }
                    </script>

                </div>

                <div class="mb-3" style=" border: 10px;">
                    <label for="map" class="form-label">เเผนที่ (คลิกซ้ายเพื่อดูข้อมูล)</label>
                    <div id="map" style="border: 3px solid #FFFFFF;"></div>
                </div>
                <div style="display: flex; ">
                    <div class="mb-3" style="margin-right: 50px; width: 500px;">
                        <label for="has_map_Area" class="form-label">Link Google Map</label>
                        <input type="text" class="form-control" id="has_map_Area" name="has_map_Area" aria-describedby="ลิ้งค์เเผนที่" required>
                    </div>
                    <div class="mb-3" style="margin-right: 20px;">
                        <label for="latitude_Area" class="form-label">Latitude ของสถานที่</label>
                        <input type="text" class="form-control required" id="latitude_Area" name="latitude_Area" aria-describedby="Latitude ของสถานที่" required>
                    </div>
                    <div class="mb-3">
                        <label for="longitude_Area" class="form-label">Longitude ของสถานที่</label>
                        <input type="text" class="form-control required" id="longitude_Area" name="longitude_Area" aria-describedby="Longitude ของสถานที่" required>
                    </div>
                </div>
                <div style="display: flex; ">
                    <div class="mb-3" style="margin-right: 20px;">
                        <label for="address_Area" class="form-label">ที่อยู่ เลขที่ ซอย ถนน</label>
                        <input type="text" class="form-control" id="address_Area" name="address_Area" aria-describedby="ที่อยู่ เลขที่" required>
                    </div>
                    <div class="mb-3" style="margin-right: 20px;">
                        <label for="sub_dis_Area" class="form-label">ตำบล</label>
                        <input type="text" class="form-control" id="sub_dis_Area" name="sub_dis_Area" aria-describedby="ตำบล" required>
                    </div>
                    <div class="mb-3" style="margin-right: 20px;">
                        <label for="dis_Area" class="form-label">อำเภอ</label>
                        <input type="text" class="form-control" id="dis_Area" name="dis_Area" aria-describedby="อำเภอ" required>
                    </div>

                    <div class="mb-3" style="margin-right: 20px;">
                        <label for="provi_Area" class="form-label">จังหวัด</label>
                        <input type="text" class="form-control" id="provi_Area" name="provi_Area" aria-describedby="จังหวัด" required>
                    </div>
                    <div class="mb-3">
                        <label for="post_code" class="form-label">รหัสไปรษณีย์</label>
                        <input type="text" class="form-control" id="post_code" name="post_code" aria-describedby="รหัสไปรษณีย์" required>
                    </div>
                </div>
                <div style="display: flex; ">
                    <div class="mb-3" style="margin-right: 20px; ">
                        <label for="phonenum_Area" class="form-label">เบอร์โทรศัพท์ สถานที่</label>
                        <input type="text" class="form-control" id="phonenum_Area" name="phonenum_Area" aria-describedby="เบอร์โทรศัพท์ สถานที่" required>
                    </div>
                    <div class="mb-3" style="margin-right: 20px; width: 400px;">
                        <label for="email_Area" class="form-label">Email สถานที่</label>
                        <input type="text" class="form-control" id="email_Area" name="email_Area" aria-describedby="Email สถานที่" required>
                    </div>
                    <div class="mb-3" style=" width: 400px;">
                        <label for="url_Area" class="form-label">Link สถานที่ เพิ่มเติม</label>
                        <input type="text" class="form-control" id="url_Area" name="url_Area" aria-describedby="Link สถานที่ เพิ่มเติม" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="info_Area" class="form-label">ข้อมูลสถานที่</label>
                    <textarea type="text" class="form-control" row="10" id="info_Area" name="info_Area" aria-describedby="ข้อมูลสถานที่" required>
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="activityinfo_Area" class="form-label">กิจกรรมที่น่าสนใจ</label>
                    <textarea type="text" class="form-control" row="10" id="activityinfo_Area" name="activityinfo_Area" aria-describedby="กิจกรรมที่น่าสนใจ" required>
                    </textarea>
                </div>

                <?php
                include_once('functions.php');
                $fetchdataTypetour = new DB_con();
                $sqlTypetour = $fetchdataTypetour->fetchdataTypetour();
                $tourTypes = [];
                while ($rowTypetour = mysqli_fetch_array($sqlTypetour)) {
                    $tourTypes[] = $rowTypetour['tour_type_descrip'];
                }
                ?>
                <div style="display: flex; ">
                    <div class="mb-3" style="margin-right: 50px; width: 400px;">
                        <label for="tour_type_descrip1" class="form-label">กลุ่มนักท่องเที่ยวเป้าหมาย กลุ่มที่ 1</label>
                        <select class="form-select" id="tour_type_descrip1" name="tour_type_descrip1" aria-describedby="ประเภท" required>
                            <option value="" disabled selected>โปรดเลือกกลุ่มนักท่องเที่ยว</option>
                            <?php foreach ($tourTypes as $type) { ?>
                                <option value='<?php echo $type; ?>'><?php echo $type; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3" style=" width: 400px;">
                        <label for="tour_type_descrip2" class="form-label">กลุ่มนักท่องเที่ยวเป้าหมาย กลุ่มที่ 2</label>
                        <select class="form-select" id="tour_type_descrip2" name="tour_type_descrip2" aria-describedby="ประเภท" required>
                            <option value="" disabled selected>โปรดเลือกกลุ่มนักท่องเที่ยว</option>
                            <?php foreach ($tourTypes as $type) { ?>
                                <option value='<?php echo $type; ?>'><?php echo $type; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <script>
                    document.getElementById('tour_type_descrip1').addEventListener('change', function() {
                        var selectedValue = this.value;
                        var tourType2 = document.getElementById('tour_type_descrip2');
                        var options = tourType2.querySelectorAll('option');

                        options.forEach(function(option) {
                            if (option.value === selectedValue) {
                                option.style.display = 'none';
                            } else {
                                option.style.display = 'block';
                            }
                        });
                    });

                    document.getElementById('tour_type_descrip2').addEventListener('change', function() {
                        var selectedValue = this.value;
                        var tourType1 = document.getElementById('tour_type_descrip1');
                        var options = tourType1.querySelectorAll('option');

                        options.forEach(function(option) {
                            if (option.value === selectedValue) {
                                option.style.display = 'none';
                            } else {
                                option.style.display = 'block';
                            }
                        });
                    });
                </script>

                <hr>
                <h2 class="mt-3 mb-4">เวลาที่เปิด-ปิด</h2>

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

                        openTimeInput.disabled = !isOpen;
                        closeTimeInput.disabled = !isOpen;

                        if (!isOpen) {
                            openTimeInput.value = '';
                            closeTimeInput.value = '';
                            openTimeInput.style.backgroundColor = 'lightgray';
                            closeTimeInput.style.backgroundColor = 'lightgray';
                        } else {
                            openTimeInput.style.backgroundColor = '';
                            closeTimeInput.style.backgroundColor = '';
                        }

                        validateTime(day);
                    }


                    document.addEventListener('DOMContentLoaded', (event) => {
                        const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                        days.forEach(day => {
                            document.getElementById(`ontime_${day}`).addEventListener('change', () => validateTime(day));
                            document.getElementById(`closetime_${day}`).addEventListener('change', () => validateTime(day));
                            document.getElementById(`switch_${day}`).addEventListener('change', () => toggleTimeInputs(day));
                        });
                    });
                </script>


                <!-- Time inputs for each day of the week -->

                <div class="day-time-input">
                    <div style="display: flex; ">
                        <div class="form-check form-switch mt-4" style="margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="switch_Mon" checked>
                            <label class="form-check-label" for="switch_Mon"></label>
                        </div>
                        <h5 class="mt-4" style="margin-right: 60px;">วันจันทร์ :</h5>
                        <div class="mb-3" style="margin-right: 20px;">
                            <label for="ontime_Mon" class="form-label">เวลาเปิด</label>
                            <input type="time" class="form-control" id="ontime_Mon" name="ontime_Mon" required>
                        </div>
                        <div class="mb-3" style="margin-right: 20px;">
                            <h5 class="mt-5">ถึง</h5>
                        </div>
                        <div class="mb-3">
                            <label for="closetime_Mon" class="form-label">เวลาปิด</label>
                            <input type="time" class="form-control" id="closetime_Mon" name="closetime_Mon" required>
                        </div>
                        <div id="error-message-Mon" class="alert " style="color: red; margin-left: 10px; display: none;">
                            เวลาเปิดต้องน้อยกว่าเวลาปิด
                        </div>
                    </div>
                </div>

                <div class="day-time-input">
                    <div style="display: flex; ">
                        <div class="form-check form-switch mt-4" style="margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="switch_Tue" checked>
                            <label class="form-check-label" for="switch_Tue"></label>
                        </div>
                        <h5 class="mt-4" style="margin-right: 53px;">วันอังคาร :</h5>
                        <div class="mb-3" style="margin-right: 20px;">
                            <label for="ontime_Tue" class="form-label"></label>
                            <input type="time" class="form-control" id="ontime_Tue" name="ontime_Tue" required>
                        </div>
                        <div class="mb-1" style="margin-right: 20px;">
                            <h5 class="mt-4">ถึง</h5>
                        </div>
                        <div class="mb-1">
                            <label for="closetime_Tue" class="form-label"></label>
                            <input type="time" class="form-control" id="closetime_Tue" name="closetime_Tue" required>
                        </div>
                        <div id="error-message-Tue" class="alert " style="color: red; margin-left: 10px; display: none;">
                            เวลาเปิดต้องน้อยกว่าเวลาปิด
                        </div>
                    </div>
                </div>

                <div class="day-time-input">
                    <div style="display: flex; ">
                        <div class="form-check form-switch mt-4" style="margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="switch_Wed" checked>
                            <label class="form-check-label" for="switch_Wed"></label>
                        </div>
                        <h5 class="mt-4" style="margin-right: 85px;">วันพุธ :</h5>
                        <div class="mb-3" style="margin-right: 20px;">
                            <label for="ontime_Wed" class="form-label"></label>
                            <input type="time" class="form-control" id="ontime_Wed" name="ontime_Wed" required>
                        </div>
                        <div class="mb-3" style="margin-right: 20px;">
                            <h5 class="mt-4">ถึง</h5>
                        </div>
                        <div class="mb-3">
                            <label for="closetime_Wed" class="form-label"></label>
                            <input type="time" class="form-control" id="closetime_Wed" name="closetime_Wed" required>
                        </div>
                        <div id="error-message-Wed" class="alert " style="color: red; margin-left: 10px; display: none;">
                            เวลาเปิดต้องน้อยกว่าเวลาปิด
                        </div>
                    </div>
                </div>

                <div class="day-time-input">
                    <div style="display: flex; ">
                        <div class="form-check form-switch mt-4" style="margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="switch_Thu" checked>
                            <label class="form-check-label" for="switch_Thu"></label>
                        </div>
                        <h5 class="mt-4" style="margin-right: 20px;">วันพฤหัสบดี :</h5>
                        <div class="mb-3" style="margin-right: 20px;">
                            <label for="ontime_Thu" class="form-label"></label>
                            <input type="time" class="form-control" id="ontime_Thu" name="ontime_Thu" required>
                        </div>
                        <div class="mb-3" style="margin-right: 20px;">
                            <h5 class="mt-4">ถึง</h5>
                        </div>
                        <div class="mb-3">
                            <label for="closetime_Thu" class="form-label"></label>
                            <input type="time" class="form-control" id="closetime_Thu" name="closetime_Thu" required>
                        </div>
                        <div id="error-message-Thu" class="alert " style="color: red; margin-left: 10px; display: none;">
                            เวลาเปิดต้องน้อยกว่าเวลาปิด
                        </div>
                    </div>
                </div>

                <div class="day-time-input">
                    <div style="display: flex; ">
                        <div class="form-check form-switch mt-4" style="margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="switch_Fri" checked>
                            <label class="form-check-label" for="switch_Fri"></label>
                        </div>
                        <h5 class="mt-4" style="margin-right: 73px;">วันศุกร์ :</h5>
                        <div class="mb-3" style="margin-right: 20px;">
                            <label for="ontime_Fri" class="form-label"></label>
                            <input type="time" class="form-control" id="ontime_Fri" name="ontime_Fri" required>
                        </div>
                        <div class="mb-3" style="margin-right: 20px;">
                            <h5 class="mt-4">ถึง</h5>
                        </div>
                        <div class="mb-3">
                            <label for="closetime_Fri" class="form-label"></label>
                            <input type="time" class="form-control" id="closetime_Fri" name="closetime_Fri" required>
                        </div>
                        <div id="error-message-Fri" class="alert " style="color: red; margin-left: 10px; display: none;">
                            เวลาเปิดต้องน้อยกว่าเวลาปิด
                        </div>
                    </div>
                </div>

                <div class="day-time-input">
                    <div style="display: flex; ">
                        <div class="form-check form-switch mt-4" style="margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="switch_Sat" checked>
                            <label class="form-check-label" for="switch_Sat"></label>
                        </div>
                        <h5 class="mt-4" style="margin-right: 70px;">วันเสาร์ :</h5>
                        <div class="mb-3" style="margin-right: 20px;">
                            <label for="ontime_Sat" class="form-label"></label>
                            <input type="time" class="form-control" id="ontime_Sat" name="ontime_Sat" required>
                        </div>
                        <div class="mb-3" style="margin-right: 20px;">
                            <h5 class="mt-4">ถึง</h5>
                        </div>
                        <div class="mb-3">
                            <label for="closetime_Sat" class="form-label"></label>
                            <input type="time" class="form-control" id="closetime_Sat" name="closetime_Sat" required>
                        </div>
                        <div id="error-message-Sat" class="alert " style="color: red; margin-left: 10px; display: none;">
                            เวลาเปิดต้องน้อยกว่าเวลาปิด
                        </div>
                    </div>
                </div>

                <div class="day-time-input">
                    <div style="display: flex; ">
                        <div class="form-check form-switch mt-4" style="margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="switch_Sun" checked>
                            <label class="form-check-label" for="switch_Sun"></label>
                        </div>
                        <h5 class="mt-4" style="margin-right: 40px;">วันอาทิตย์ :</h5>
                        <div class="mb-3" style="margin-right: 20px;">
                            <label for="ontime_Sun" class="form-label"></label>
                            <input type="time" class="form-control" id="ontime_Sun" name="ontime_Sun" required>
                        </div>
                        <div class="mb-3" style="margin-right: 20px;">
                            <h5 class="mt-4">ถึง</h5>
                        </div>
                        <div class="mb-3">
                            <label for="closetime_Sun" class="form-label"></label>
                            <input type="time" class="form-control" id="closetime_Sun" name="closetime_Sun" required>
                        </div>
                        <div id="error-message-Sun" class="alert " style="color: red; margin-left: 10px; display: none;">
                            เวลาเปิดต้องน้อยกว่าเวลาปิด
                        </div>
                    </div>
                </div>

                <hr>

                <div style="display: flex;">
                    <div class="mb-3" style="margin-right: 30px;">
                        <label class="form-label">การเรียกเก็บค่าเข้าใช้บริการ</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Access_Status" id="access_status_free" value="free" required onclick="showpaidInput()">
                            <label class="form-check-label" for="access_status_free">ฟรี</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Access_Status" id="access_status_paid" value="paid" required onclick="showpaidInput()">
                            <label class="form-check-label" for="access_status_paid">เสียค่าบริการ</label>
                        </div>
                    </div>
                    <script>
                        function showpaidInput() {
                            var selectBox = document.getElementById('access_status_paid');
                            var otherInput = document.getElementById('price_input'); // Change 'price_in' to 'price_input'
                            if (selectBox.checked) {
                                otherInput.style.display = 'block';
                            } else {
                                otherInput.style.display = 'none';
                            }
                        }
                    </script>

                    <div class="mb-3" style="display: none;" id="price_input">
                        <label for="price_in" class="form-label">ค่าเข้าใช้บริการ (ถ้ามี)</label>
                        <input type="text" class="form-control" id="price_in" name="price_in" aria-describedby="ค่าเข้าใช้บริการ">
                    </div>
                </div>


                <hr>
                <h2 class="mt-3"> อัพโหลดรูปภาพ </h2>




                <div class="container">
                    <div class="row mt-2">
                        <div class="col-12">
                            <form action="upload.php" method="POST" enctype="multipart/form-data">
                                <div class=" p-4 border-dashed round-3">
                                    <h6 class="my-2">เลือกไฟล์เพื่ออัพโหลด ภาพหน้าปก</h6>
                                    <input type="file" name="img_Area1" class="form-control streched-link" accept="image/gif, image/jpeg, image/png">
                                    <p class="small mb-0 mt-2"><b>หมายเหตุ : </b>เฉพาะ ไฟล์ JPG,JPEG,PNG เเละ GIF เท่านั้น</p>
                                </div>
                                <div class="d-sm-flex justify-content-end mt-2">
                                    <input type="submit" name="submit" value="Upload" class="btn btn-sm btn-primary mb-3">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <?php if (!empty($statusMsg)) { ?>
                            <div class="alert alert-secondary" role="alert">
                                <?php echo $statusMsg; ?>
                            </div>
                        <?php } ?>

                    </div>
                </div>

                <!-- <div class="mb-5">
                    <label for="image" class="form-label">รูปภาพสถานที่ หน้าปก</label>
                    <input type="file" class="form-control" id="img_Area1" name="img_Area1" accept="image/*">
                    <label for="image" class="form-label">รูปภาพสถานที่ เพิ่มเติม1</label>
                    <input type="file" class="form-control" id="img_Area2" name="img_Area2" accept="image/*">
                    <label for="image" class="form-label">รูปภาพสถานที่ เพิ่มเติม2</label>
                    <input type="file" class="form-control" id="img_Area3" name="img_Area3" accept="image/*">
                    <label for="image" class="form-label">รูปภาพสถานที่ เพิ่มเติม3</label>
                    <input type="file" class="form-control" id="img_Area4" name="img_Area4" accept="image/*">
                </div> -->

                <button type="submit" name="insert" id="insert" class="btn btn-warning">เพิ่มข้อมูลสถานที่หลักใหม่</button>

            </form>
        </div>


        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            function nameareacheck(val) {
                $.ajax({
                    type: 'POST',
                    url: 'checkarea_available.php',
                    data: 'name_Area=' + val,
                    success: function(data) {
                        $('#areanameavailable').html(data);
                    }
                });

            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    </body>

    </html>

<?php
}
?>