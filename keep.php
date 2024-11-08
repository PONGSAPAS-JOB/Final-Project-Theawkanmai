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
            </div>
            <div class="table-container">
                <table class="table table-bordered" style="font-size: 10px;" id="placesTable">
                    <thead>
                        <tr style='background-color: #ffcc00;'>
                            <th>ID Cluster</th>
                            <th>Count</th>
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
                            echo "<td>{$row['Count']}</td>";
                            for ($i = 1; $i <= 20; $i++) {
                                echo "<td>{$row["value$i"]}</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <style>
                .container {
                    /* margin-left: 20px;
                    margin-right: 20px;
                    padding: 20px;
                    border: 1px solid #ddd; */
                    border-radius: 8px;
                }

                img {
                    max-width: 100%;
                }

                .table-container {
                    margin-top: 20px;
                }

                .hidden {
                    display: none;
                }

                #clusterTable {
                    font-size: 10px;
                    margin-top: 20px;
                }

                #clusterTable th {
                    background-color: #ffcc00;
                }

                #interestTable {
                    font-size: 10px;
                    margin-top: 20px;
                }

                #interestTable th {
                    background-color: #ffcc00;
                }

                .highlight {
                    background-color: #ffeb3b;
                    /* Change to your desired highlight color */
                    font-weight: bold;
                }

                #progressBar {
                    width: 0;
                    height: 20px;
                    /* Adjust as needed */
                    background-color: #4caf50;
                    /* Green color */
                    text-align: center;
                    line-height: 20px;
                    /* Center text vertically */
                    color: white;
                    /* Text color */
                }
            </style>
            <div class="container">
                <button id="addtypeButton" style="margin-left:50px;" class="btn-warning rounded" type="button">
                    <img src="img/team.png" alt="..." width="30px" height="30px"> หาค่า K ที่เหมาะสมในการจัดกลุ่ม
                </button>

                <div id="elbowGraph" style="width: 800px; margin-top:50px; margin-left: 200px;"></div>

                <button id="customKButton" style="margin-left: 450px; margin-top:20px; display: none;" class="btn-warning rounded" type="button">
                    กรอกจำนวนกลุ่มที่ต้องการจัด
                </button>

                <div id="customKForm" style="display: none; margin-left:10px; margin-top: 20px;">
                    <input type="number" id="customKInput" placeholder="จำนวนกลุ่ม" style="font-size: 16px; padding: 5px;">
                    <button id="submitCustomK" class="btn-warning rounded" type="button">ตกลง</button>
                </div>

                <div id="clusterResult" class="table-container">
                    <h2>ผลการจัดกลุ่ม K</h2>
                    <div style="overflow-x:auto;">
                        <table class="table table-bordered" style="font-size: 10px;" id="clusterTable">
                            <thead>
                                <tr style="background-color: #ffcc00;">
                                    <th>ID Cluster</th>
                                    <th>Count</th>
                                    <th>Value1</th>
                                    <th>Value2</th>
                                    <th>Value3</th>
                                    <th>Value4</th>
                                    <th>Value5</th>
                                    <th>Value6</th>
                                    <th>Value7</th>
                                    <th>Value8</th>
                                    <th>Value9</th>
                                    <th>Value10</th>
                                    <th>Value11</th>
                                    <th>Value12</th>
                                    <th>Value13</th>
                                    <th>Value14</th>
                                    <th>Value15</th>
                                    <th>Value16</th>
                                    <th>Value17</th>
                                    <th>Value18</th>
                                    <th>Value19</th>
                                    <th>Value20</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be inserted here via JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="interestResults" class="table-container">
                    <h2>ผลลัพธ์ ความสนใจ</h2>
                    <table class="table table-bordered" style="font-size: 15px;" id="interestTable">
                        <thead>
                            <tr style="background-color: #ffcc00;">
                                <th>ID Cluster</th>
                                <th>จำนวน คนในกลุ่ม</th>
                                <th>แหล่งท่องเที่ยวเชิงนิเวศ/ธรรมชาติ</th>
                                <th>แหล่งท่องเที่ยวเชิงอาหาร</th>
                                <th>แหล่งท่องเที่ยวเชิงเทศกาล/งานประเพณี</th>
                                <th>แหล่งท่องเที่ยวเชิงเกษตร</th>
                                <th>แหล่งท่องเที่ยววัฒนธรรม/วิถีชีวิต</th>
                                <th>แหล่งท่องเที่ยวเชิงผจญภัย</th>
                                <th>แหล่งท่องเที่ยวเชิงสุขภาพ</th>
                                <th>แหล่งท่องเที่ยวเชิงศาสนา</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be inserted here via JavaScript -->
                        </tbody>
                    </table>
                </div>

                <div id="summaryResults" class="table-container">
                    <h2>สรุปผลการจัดกลุ่ม</h2>
                    <table class="table table-bordered" style="font-size: 15px;" id="summaryTable">
                        <thead>
                            <tr style="background-color: #ffcc00;">
                                <th>ID Cluster</th>
                                <th>ค่าเฉลี่ยสูงสุด 3 ค่า</th>
                                <th>ผลการสนใจสูงสุด 3 ค่า</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be inserted here via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <script>
                document.getElementById('addtypeButton').addEventListener('click', function() {
                    console.log('Finding optimal K values...');
                    fetch('calculate_kmeans.php')
                        .then(response => response.json())
                        .then(data => {
                            console.log('Data:', data);
                            const optimalKs = data.optimal_k;
                            const imageUrl = data.graph_path;

                            const graphContainer = document.getElementById('elbowGraph');
                            graphContainer.innerHTML = `
                        <h2>Optimal K Values: ${optimalKs.join(', ')}</h2>
                        <img src="${imageUrl}" alt="Elbow Method Graph">
                    `;

                            document.getElementById('customKButton').style.display = 'block';
                        })
                        .catch(error => console.error('Error:', error));
                });

                document.getElementById('customKButton').addEventListener('click', function() {
                    console.log('Displaying custom K input form');
                    document.getElementById('customKForm').style.display = 'block';
                });

                document.getElementById('submitCustomK').addEventListener('click', function() {
                    const customK = document.getElementById('customKInput').value;
                    if (customK <= 0 || !Number.isInteger(Number(customK))) {
                        alert('Please enter a valid positive integer for K.');
                        return;
                    }

                    // Disable buttons
                    this.disabled = true;
                    document.getElementById('customKButton').disabled = true;

                    fetch(`calculate_custom_kmeans.php?k=${customK}`)
                        .then(response => response.json())
                        .then(data => {
                            const clusters = data.clusters;
                            const clusterTableBody = document.querySelector('#clusterTable tbody');
                            const interestTableBody = document.querySelector('#interestTable tbody');
                            const summaryTableBody = document.querySelector('#summaryTable tbody');

                            // Clear previous data
                            clusterTableBody.innerHTML = '';
                            interestTableBody.innerHTML = '';
                            summaryTableBody.innerHTML = '';

                            // Define the descriptions for the types of tourism attractions
                            const interestDescriptions = [
                                'แหล่งท่องเที่ยวเชิงนิเวศ/ธรรมชาติ', // ans1
                                'แหล่งท่องเที่ยวเชิงอาหาร', // ans2
                                'แหล่งท่องเที่ยวเชิงเทศกาล/งานประเพณี', // ans3
                                'แหล่งท่องเที่ยวเชิงเกษตร', // ans4
                                'แหล่งท่องเที่ยววัฒนธรรม/วิถีชีวิต', // ans5
                                'แหล่งท่องเที่ยวเชิงผจญภัย', // ans6
                                'แหล่งท่องเที่ยวเชิงสุขภาพ', // ans7
                                'แหล่งท่องเที่ยวเชิงศาสนา' // ans8
                            ];

                            // Define the descriptions for the cluster values
                            const descriptions = {
                                value1: "ต้องการอยู่ในธรรมชาติที่สวยงามและอากาศบริสุทธิ์ มีน้ำตก พันธุ์ไม้สัตว์ป่า",
                                value2: "ต้องการหลีกหนีจากชีวิตประจำวัน",
                                value3: "ต้องการค้นหาตัวเอง/ ทบทวนความคิดของตนเอง",
                                value4: "ต้องการสร้างแรงบันดาลใจและความคิดสร้างสรรค์",
                                value5: "ต้องการได้รับความรู้และประสบการณ์แปลกใหม่",
                                value6: "ต้องการสร้างความสัมพันธ์กับคนใกล้ชิด/ครอบครัว",
                                value7: "ต้องการสร้างความสัมพันธ์กับผู้อื่น",
                                value8: "ต้องการแสวงหาความตื่นเต้น เร้าใจ และความเสี่ยง",
                                value9: "ต้องการแสวงหาความบันเทิง",
                                value10: "ต้องการแสวงหาความตื่นตัวทางสติปัญญาและอารมณ์",
                                value11: "มีสิ่งอำนวยความสะดวกในแหล่งท่องเที่ยว เช่น ที่พัก ร้านอาหาร",
                                value12: "มีความสะอาดและมีอนามัย",
                                value13: "มีความปลอดภัย",
                                value14: "การเดินทางสะดวก",
                                value15: "ผู้คนน่ารักเป็นมิตร",
                                value16: "มีการจัดการและการบริการที่ดี",
                                value17: "มีบรรยากาศการช้อปปิ้ง",
                                value18: "มีความทันสมัย",
                                value19: "มีชื่อเสียง เป็นที่นิยม",
                                value20: "ก่อให้เกิดประโยชน์ต่อสังคม"
                            };

                            clusters.forEach((cluster, clusterIndex) => {
                                const clusterRow = document.createElement('tr');
                                clusterRow.innerHTML = `
                            <td>${cluster.id_cluster}</td>
                            <td>${cluster.count}</td>
                            <td>${cluster.value1}</td>
                            <td>${cluster.value2}</td>
                            <td>${cluster.value3}</td>
                            <td>${cluster.value4}</td>
                            <td>${cluster.value5}</td>
                            <td>${cluster.value6}</td>
                            <td>${cluster.value7}</td>
                            <td>${cluster.value8}</td>
                            <td>${cluster.value9}</td>
                            <td>${cluster.value10}</td>
                            <td>${cluster.value11}</td>
                            <td>${cluster.value12}</td>
                            <td>${cluster.value13}</td>
                            <td>${cluster.value14}</td>
                            <td>${cluster.value15}</td>
                            <td>${cluster.value16}</td>
                            <td>${cluster.value17}</td>
                            <td>${cluster.value18}</td>
                            <td>${cluster.value19}</td>
                            <td>${cluster.value20}</td>
                        `;
                                clusterTableBody.appendChild(clusterRow);

                                const interestRow = document.createElement('tr');
                                interestRow.innerHTML = `
                            <td>${cluster.id_cluster}</td>
                            <td>${cluster.count}</td>
                            <td>${cluster.ans1}</td>
                            <td>${cluster.ans2}</td>
                            <td>${cluster.ans3}</td>
                            <td>${cluster.ans4}</td>
                            <td>${cluster.ans5}</td>
                            <td>${cluster.ans6}</td>
                            <td>${cluster.ans7}</td>
                            <td>${cluster.ans8}</td>
                        `;
                                interestTableBody.appendChild(interestRow);

                                const top3Values = Object.entries(descriptions)
                                    .sort(([, a], [, b]) => b - a)
                                    .slice(0, 3)
                                    .map(([key]) => descriptions[key])
                                    .join(', ');

                                const top3Interests = interestDescriptions
                                    .sort((a, b) => b - a)
                                    .slice(0, 3)
                                    .map((desc, index) => interestDescriptions[index])
                                    .join(', ');

                                const summaryRow = document.createElement('tr');
                                summaryRow.innerHTML = `
                            <td>${cluster.id_cluster}</td>
                            <td>${top3Values}</td>
                            <td>${top3Interests}</td>
                        `;
                                summaryTableBody.appendChild(summaryRow);
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });

                $(document).ready(function() {
                    $('#addtypeButton').click(function(event) {
                        event.preventDefault(); // Prevent the default button behavior

                        let timerInterval;
                        Swal.fire({
                            title: "กำลังคำนวณหาค่า K ที่เหมาะสม!",
                            html: "กำลังประมวลผล <b></b> %. <div style='width: 100%; height: 10px; background-color: #e0e0e0; margin-top: 10px;'><div id='progress-bar' style='width: 0%; height: 100%; background-color: #76c7c0;'></div></div>",
                            timer: 3000, // Set the timer for 3 seconds
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                const timer = Swal.getHtmlContainer().querySelector("b");
                                const progressBar = Swal.getHtmlContainer().querySelector("#progress-bar");

                                timerInterval = setInterval(() => {
                                    // Calculate the progress percentage
                                    const progress = Math.round((3000 - Swal.getTimerLeft()) / 30);
                                    timer.textContent = progress;

                                    // Update the width of the progress bar
                                    progressBar.style.width = progress + "%";
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log("I was closed by the timer");
                            }
                        });
                    });
                });
                $(document).ready(function() {
                    $('#submitCustomK').click(function(event) {
                        event.preventDefault(); // Prevent the default button behavior
                        let timerInterval;
                        Swal.fire({
                            title: "กำลังจัดกลุ่มจากค่า K ที่กำหนด!",
                            html: "กำลังประมวลผล <b></b> %. <div style='width: 100%; height: 10px; background-color: #e0e0e0; margin-top: 10px;'><div id='progress-bar' style='width: 0%; height: 100%; background-color: #76c7c0;'></div></div>",
                            timer: 3000, // Set the timer for 3 seconds
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                const timer = Swal.getHtmlContainer().querySelector("b");
                                const progressBar = Swal.getHtmlContainer().querySelector("#progress-bar");

                                timerInterval = setInterval(() => {
                                    // Calculate the progress percentage
                                    const progress = Math.round((3000 - Swal.getTimerLeft()) / 30);
                                    timer.textContent = progress;

                                    // Update the width of the progress bar
                                    progressBar.style.width = progress + "%";
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log("I was closed by the timer");
                            }
                        });
                    });
                });



                document.getElementById('submitCustomK').addEventListener('click', function() {
                    const customK = document.getElementById('customKInput').value;
                    if (customK <= 0 || !Number.isInteger(Number(customK))) {
                        alert('Please enter a valid positive integer for K.');
                        return;
                    }

                    // Disable buttons
                    this.disabled = true;
                    document.getElementById('customKButton').disabled = true;


                    fetch(`calculate_custom_kmeans.php?k=${customK}`)
                        .then(response => response.json())
                        .then(data => {
                            const clusters = data.clusters;
                            const clusterResult = document.getElementById('clusterResult');

                            // Define the descriptions for the types of tourism attractions
                            const interestDescriptions = [
                                'แหล่งท่องเที่ยวเชิงนิเวศ/ธรรมชาติ', // ans1
                                'แหล่งท่องเที่ยวเชิงอาหาร', // ans2
                                'แหล่งท่องเที่ยวเชิงเทศกาล/งานประเพณี', // ans3
                                'แหล่งท่องเที่ยวเชิงเกษตร', // ans4
                                'แหล่งท่องเที่ยววัฒนธรรม/วิถีชีวิต', // ans5
                                'แหล่งท่องเที่ยวเชิงผจญภัย', // ans6
                                'แหล่งท่องเที่ยวเชิงสุขภาพ', // ans7
                                'แหล่งท่องเที่ยวเชิงศาสนา' // ans8
                            ];

                            // Define the descriptions for the cluster values
                            const descriptions = {
                                value1: "ต้องการอยู่ในธรรมชาติที่สวยงามและอากาศบริสุทธิ์ มีน้ำตก พันธุ์ไม้สัตว์ป่า",
                                value2: "ต้องการหลีกหนีจากชีวิตประจำวัน",
                                value3: "ต้องการค้นหาตัวเอง/ ทบทวนความคิดของตนเอง",
                                value4: "ต้องการสร้างแรงบันดาลใจและความคิดสร้างสรรค์",
                                value5: "ต้องการได้รับความรู้และประสบการณ์แปลกใหม่",
                                value6: "ต้องการสร้างความสัมพันธ์กับคนใกล้ชิด/ครอบครัว",
                                value7: "ต้องการสร้างความสัมพันธ์กับผู้อื่น",
                                value8: "ต้องการแสวงหาความตื่นเต้น เร้าใจ และความเสี่ยง",
                                value9: "ต้องการเป็นที่ยอมรับนับถือจากผู้อื่น",
                                value10: "ความสวยงาม ของแหล่งท่องเที่ยว",
                                value11: "มีร้านอาหารสำหรับบริการที่หลากหลายและเพียงพอ",
                                value12: "มีสาธารณูปโภคขั้นพื้นฐาน เช่น น้ำสะอาด ไฟฟ้า สัญญาณโทรศัพท์ อย่างเหมาะสมกับมีจุดบริการ/ศูนย์บริการข้อมูลแก่นักท่องเที่ยว",
                                value13: "ประเภท ของที่พักมีความหลากหลายให้เลือกใช้บริการ",
                                value14: "ที่พักมีราคาที่เหมาะสม",
                                value15: "มีสิ่งอำนวยความสะดวกที่รับรองความต้องการ เช่น อินเตอร์เน็ต ห้องออกกำลังกาย สระว่ายน้ำ ฯลฯ",
                                value16: "กิจกรรมท่องเที่ยว มีความน่าสนใจ",
                                value17: "กิจกรรมท่องเที่ยวมีความหลากหลาย",
                                value18: "กิจกรรมท่องเที่ยวที่ส่งเสริมการเรียนรู้",
                                value19: "กิจกรรมท่องเที่ยวที่มีความปลอดภัย",
                                value20: "กิจกรรมท่องเที่ยวที่ก่อให้เกิดประโยชน์ต่อสังคม"
                            };

                            // Generate "ผลการจัดกลุ่ม K" table
                            let clusterHtml = '<h2>ผลการจัดกลุ่ม K = ' + customK + '</h2>';
                            clusterHtml += '<div style="overflow-x:auto;">'; // Add this line to enable horizontal scrolling
                            clusterHtml += '<table class="table table-bordered" style="font-size: 10px;" id="clusterTable">';
                            clusterHtml += '<thead><tr style="background-color: #ffcc00;"><th>ID Cluster</th>';
                            clusterHtml += '<th>Count</th>';
                            for (let i = 1; i <= 20; i++) {
                                clusterHtml += '<th>Value' + i + '</th>';
                            }
                            clusterHtml += '</tr></thead><tbody>';

                            for (const [clusterId, clusterData] of Object.entries(clusters)) {
                                clusterHtml += '<tr>';
                                clusterHtml += '<td>' + clusterId + '</td>';
                                clusterHtml += '<td>' + clusterData.count + '</td>';

                                // Find top 3 values
                                const topThreeIndices = clusterData.means
                                    .map((value, index) => ({
                                        value,
                                        index
                                    }))
                                    .sort((a, b) => b.value - a.value)
                                    .slice(0, 3)
                                    .map(item => item.index);

                                clusterData.means.slice(0, 20).forEach((value, index) => { // Only up to Value20
                                    if (topThreeIndices.includes(index)) {
                                        clusterHtml += `<td><span style="background-color: #66FF66; padding: 2px;">${value.toFixed(6)}</span></td>`; // Marker-like highlight
                                    } else {
                                        clusterHtml += `<td>${value.toFixed(6)}</td>`;
                                    }
                                });
                                clusterHtml += '</tr>';
                            }
                            clusterHtml += '</tbody></table>';

                            clusterHtml += '</div>'; // Add this line to close the div

                            // Generate "ผลลัพธ์ ความสนใจ" table
                            let interestHtml = '<h2>ผลลัพธ์ ความสนใจ</h2>';
                            interestHtml += '<table class="table table-bordered" style="font-size: 15px;" id="interestTable">';
                            interestHtml += '<thead><tr style="background-color: #ffcc00;"><th>ID Cluster</th>';
                            interestHtml += '<th>จำนวน คนในกลุ่ม</th>';
                            for (let i = 0; i <= 7; i++) {
                                interestHtml += '<th>' + interestDescriptions[i] + '</th>';
                            }
                            interestHtml += '</tr></thead><tbody>';

                            for (const [clusterId, clusterData] of Object.entries(clusters)) {
                                interestHtml += '<tr>';
                                interestHtml += '<td>' + clusterId + '</td>';
                                interestHtml += '<td>' + clusterData.count + ' คน</td>';

                                // Find top 3 interest counts
                                const interestTopThreeIndices = clusterData.interest_counts
                                    .map((count, index) => ({
                                        count,
                                        index
                                    }))
                                    .sort((a, b) => b.count - a.count)
                                    .slice(0, 3)
                                    .map(item => item.index);

                                clusterData.interest_counts.slice(0, 8).forEach((count, index) => { // Only up to Ans8
                                    if (interestTopThreeIndices.includes(index)) {
                                        interestHtml += `<td><span style="background-color: #66FF66; padding: 2px;">${count} %</span></td>`; // Marker-like highlight
                                    } else {
                                        interestHtml += `<td>${count} %</td>`;
                                    }
                                });
                                interestHtml += '</tr>';
                            }
                            interestHtml += '</tbody></table>';
                            // interestHtml += '<button id="saveinterestButton" style="margin-left:50px; margin-top:20px; display: none;" class="btn-warning rounded" type="button">บันทึกค่า Cluster interest ใหม่</button>';


                            // Generate "สรุปผลการจัดกลุ่ม" table
                            let summaryHtml = '<h2>สรุปผลการจัดกลุ่ม</h2>';
                            summaryHtml += '<table class="table table-bordered" style="font-size: 15px;" id="summaryTable">';
                            summaryHtml += '<thead><tr style="background-color: #ffcc00;"><th>ID Cluster</th><th>ค่าเฉลี่ยสูงสุด 3 ค่า</th><th>ผลการสนใจสูงสุด 3 ค่า</th></tr></thead><tbody>';

                            for (const [clusterId, clusterData] of Object.entries(clusters)) {
                                const topThree = clusterData.means
                                    .map((value, index) => ({
                                        value,
                                        key: 'value' + (index + 1)
                                    }))
                                    .sort((a, b) => b.value - a.value)
                                    .slice(0, 3);

                                const interestTopThree = clusterData.interest_counts
                                    .map((count, index) => ({
                                        count,
                                        key: interestDescriptions[index]
                                    }))
                                    .sort((a, b) => b.count - a.count)
                                    .slice(0, 3);

                                summaryHtml += `<tr><td>${clusterId}</td><td>`;
                                topThree.forEach(item => {
                                    summaryHtml += `${descriptions[item.key]} (${item.value.toFixed(6)})<br>`;
                                });
                                summaryHtml += `</td><td>`;
                                interestTopThree.forEach(item => {
                                    summaryHtml += `${item.key} (${item.count})<br>`;
                                });
                                summaryHtml += `</td></tr>`;
                            }
                            summaryHtml += '</tbody></table>';
                            // summaryHtml += '<button id="savesummaryButton" style="margin-left:50px; margin-top:20px; display: none;" class="btn-warning rounded" type="button">บันทึกค่า Cluster ใหม่</button>';

                            // Combine all HTML parts
                            clusterResult.innerHTML = clusterHtml + interestHtml + summaryHtml;
                            // document.getElementById('saveClustersButton').style.display = 'block';
                            // document.getElementById('saveinterestButton').style.display = 'block';
                            // document.getElementById('savesummaryButton').style.display = 'block';
                        })
                        .catch(error => console.error('Error:', error));
                });
            </script>
        </div>





        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    </body>

    </html>
<?php
}
?>