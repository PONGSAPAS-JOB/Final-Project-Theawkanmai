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

        <div class="addplace">
            <div style="width: 500px; padding: 20px; white-space: nowrap;">
                <h1><b>🌻การคำนวณค่า Cluster ในระบบ Recommend System</b></h1>
            </div>
        </div>

        <div class="container" style="margin-left: 150px; font-size: 25px; background-color: #ffffff; width: 1230px; padding: 20px; box-shadow: 0px 4px 10px rgba(0, 0, 10, 0.15);">
            <button id="customKButton" class="btn btn-warning rounded" type="button">กรอกจำนวนกลุ่มที่ต้องการจัด</button>
            <div id="customKForm" style="display:none;">
                <input type="number" id="customKInput" placeholder="จำนวนกลุ่ม" style="font-size: 16px; padding: 5px; width: 150px;" min="1" max="11">
                <button id="submitCustomK" class="btn btn-warning rounded" type="button">ตกลง</button>
            </div>
            <h1>Cluster Analysis Result</h1>
            <div id="clusterResult" style="margin-top: 50px;"></div>
        </div>



        <script>
            let clusterData = {}; // Change 'const' to 'let' to allow reassignment
            const formHeaders = {
                ans1: 'แหล่งท่องเที่ยวเชิงนิเวศ/ธรรมชาติ', // ans1
                ans2: 'แหล่งท่องเที่ยวเชิงอาหาร',
                ans3: 'แหล่งท่องเที่ยวเชิงเทศกาล/งานประเพณี',
                ans4: 'แหล่งท่องเที่ยวเชิงเกษตร',
                ans5: 'แหล่งท่องเที่ยววัฒนธรรม/วิถีชีวิต',
                ans6: 'แหล่งท่องเที่ยวเชิงผจญภัย',
                ans7: 'แหล่งท่องเที่ยวเชิงสุขภาพ',
                ans8: 'แหล่งท่องเที่ยวเชิงศาสนา',
                ans_form1: 'เพศของท่าน',
                ans_form2: 'อายุของท่าน',
                ans_form3: 'อาชีพของท่าน',
                ans_form4: 'รายได้ต่อเดือน',
                ans_form5: 'ท่านมักเดินทางท่องเที่ยวกับใคร?',
                ans_form6: 'ส่วนใหญ่ท่านเดินทางท่องเที่ยวโดยยานพาหนะใด?',
                ans_form7: 'ในการท่องเที่ยว ท่านมักเลือกที่พักแบบใด?',
                ans_form8: 'งบประมาณที่ใช้ในการท่องเที่ยวต่อวัน',

                eva_p1_ans1: "ต้องการอยู่ในธรรมชาติที่สวยงามและอากาศบริสุทธิ์ มีน้ำตก พันธุ์ไม้สัตว์ป่า",
                eva_p1_ans2: "ต้องการหลีกหนีจากชีวิตประจำวัน",
                eva_p1_ans3: "ต้องการค้นหาตัวเอง/ ทบทวนความคิดของตนเอง",
                eva_p1_ans4: "ต้องการสร้างแรงบันดาลใจและความคิดสร้างสรรค์",
                eva_p1_ans5: "ต้องการได้รับความรู้และประสบการณ์แปลกใหม่",
                eva_p1_ans6: "ต้องการสร้างความสัมพันธ์กับคนใกล้ชิด/ครอบครัว",
                eva_p1_ans7: "ต้องการสร้างความสัมพันธ์กับผู้อื่น",
                eva_p1_ans8: "ต้องการแสวงหาความตื่นเต้น เร้าใจ และความเสี่ยง",
                eva_p1_ans9: "ต้องการเป็นที่ยอมรับนับถือจากผู้อื่น",

                eva_p2_ans1: "ความสวยงาม ของแหล่งท่องเที่ยว",
                eva_p2_ans2: "ความมีชื่อเสียงของแหล่งท่องเที่ยว",
                eva_p2_ans3: "ความหลากหลายของประเภทแหล่งท่องเที่ยว",
                eva_p2_ans4: "มีป้ายบอกทางเข้าถึงแหล่งท่องเที่ยว ",
                eva_p2_ans5: "เส้นทางคมนาคมที่ใช้เข้าถึงแหล่งท่องเที่ยว",
                eva_p2_ans6: "มีสถานที่ให้บริการทางคมนาคม เช่น ปั๊มน้ำมัน จุดพักรถ อย่างทั่วถึง",
                eva_p2_ans7: "มีความปลอดภัยในการเดินทาง",
                eva_p2_ans8: "มีสถานที่จอดรถอย่างเพียงพอ",
                eva_p2_ans9: "มีร้านค้า ตั้งใกล้อยู่แหล่งแหล่งท่องเที่ยวและชุมชน",
                eva_p2_ans10: "มีร้านอาหารสำหรับบริการที่ หลากหลายและเพียงพอ",
                eva_p2_ans11: "มีสาธารณูปโภคขั้นพื้นฐาน เช่น น้ำสะอาด ไฟฟ้า สัญญาณโทรศัพท์ อย่างเหมาะสมกับมีจุดบริการ/ศูนย์บริการข้อมูลแก่นักท่องเที่ยว",
                eva_p2_ans12: "ประเภท ของที่พักมีความหลากหลายให้เลือกใช้บริการ",
                eva_p2_ans13: "ที่พักมีราคาที่เหมาะสม",
                eva_p2_ans14: "มีสิ่งอำนวยความสะดวกที่รับรองความต้องการ เช่น อินเตอร์เน็ต ห้องออกกำลังกาย สระว่ายน้ำ ฯลฯ",
                eva_p2_ans15: "กิจกรรมท่องเที่ยว มีความน่าสนใจ",
                eva_p2_ans16: "กิจกรรมท่องเที่ยวมีความหลากหลาย",
                eva_p2_ans17: "กิจกรรมท่องเที่ยวที่ส่งเสริมการเรียนรู้",
                eva_p2_ans18: "กิจกรรมท่องเที่ยวที่มีความปลอดภัย",
                eva_p2_ans19: "กิจกรรมท่องเที่ยวที่ก่อให้เกิดประโยชน์ต่อสังคม"
            };

            const formOptions = {
                ans_form1: ['ชาย', 'หญิง', 'LGBTQ+', 'ไม่ต้องการระบุ'],
                ans_form2: ['12-18 ปี', '19-40 ปี', '41-60 ปี', 'มากกว่า 60 ปี'],
                ans_form3: ['เจ้าของกิจการ', 'ข้าราชการ', 'พนักงานบริษัท', 'พนักงานเอกชน', 'นักเรียน/นักศึกษา', 'อื่นๆ'],
                ans_form4: ['ต่ำกว่า 5,000 บาท', '5,001 - 10,000 บาท', '10,001 - 20,000 บาท', '20,001 - 30,000 บาท', '30,001 - 40,000 บาท', '40,001 บาทขึ้นไป'],
                ans_form5: ['คนเดียว', 'คนรัก', 'เพื่อน', 'ครอบครัว'],
                ans_form6: ['รถยนต์', 'รถสาธารณะ', 'รถจักยานยนต์', 'เช่ารถ', 'อื่นๆ'],
                ans_form7: ['โรงแรม', 'วนอุทยาน', 'รีสอร์ท', 'โฮมสเตย์', 'บ้านพักส่วนตัว', 'อื่นๆ'],
                ans_form8: ['น้อยกว่า 1,000 บาท', '1,001 - 2,000 บาท', '2,001 - 3,000 บาท', '3,001 - 4,000 บาท', '4,001 บาทขึ้นไป']
            };

            // Define the functions here
            function displayClusterTables() {
                const container = document.getElementById('clusterResult'); // Make sure this ID is correct
                container.innerHTML = ''; // Clear previous content

                Object.keys(clusterData).forEach(clusterId => {
                    const clusterInfo = clusterData[clusterId];
                    const table = createTable(clusterId, clusterInfo);
                    container.appendChild(table);
                });
            }

            function createTable(clusterId, clusterInfo) {
                const table = document.createElement('table');
                table.className = 'table table-bordered'; // Add classes for styling

                const thead = document.createElement('thead');
                const tbody = document.createElement('tbody');

                // Create table header
                const headerRow = document.createElement('tr');
                headerRow.style.backgroundColor = '#ffcc00'; // Set background color for header row
                const headers = ['คำถาม', ...formOptions.ans_form1.map((_, i) => `ตัวเลือก ${i + 1}`)];
                headers.forEach(header => {
                    const th = document.createElement('th');
                    th.textContent = header;
                    headerRow.appendChild(th);
                });
                thead.appendChild(headerRow);

                // Create table body
                Object.keys(clusterInfo.interest_percentages).forEach(key => {
                    // Check if the key is one of the specified answer keys (e.g., ans1 to ans8)
                    if (!['ans1', 'ans2', 'ans3', 'ans4', 'ans5', 'ans6', 'ans7', 'ans8'].includes(key)) {
                        // Create options row
                        const optionsRow = document.createElement('tr');
                        optionsRow.style.backgroundColor = '#ffcc00'; // Set background color for the entire options row
                        const optionsCell = document.createElement('td');
                        optionsCell.textContent = 'ตัวเลือก'; // Placeholder for the options label
                        optionsRow.appendChild(optionsCell);

                        // Determine which options to display based on the question key
                        let options = [];
                        if (key.startsWith('ans_form')) {
                            options = formOptions[key]; // Get the specific options based on the question key
                        }

                        // Add the options from formOptions for the current question
                        options.forEach(option => {
                            const cell = document.createElement('td');
                            cell.textContent = option; // Add each option in the cell
                            optionsRow.appendChild(cell);
                        });

                        tbody.appendChild(optionsRow); // Add the options row before the question row
                    }



                    // Create question row
                    const row = document.createElement('tr');
                    const percentages = clusterInfo.interest_percentages[key];

                    const questionCell = document.createElement('td');
                    questionCell.textContent = formHeaders[key] || key; // Use formHeaders to get the question text
                    row.appendChild(questionCell);

                    percentages.forEach(percentage => {
                        const cell = document.createElement('td');
                        cell.textContent = percentage.toFixed(2) + '%';
                        row.appendChild(cell);
                    });

                    tbody.appendChild(row);
                });


                table.appendChild(thead);
                table.appendChild(tbody);

                const clusterDiv = document.createElement('div');
                clusterDiv.innerHTML = `<h2>Cluster ${clusterId} (Count: ${clusterInfo.count})</h2>`;
                clusterDiv.appendChild(table);

                // Add average values table
                const avgTable = document.createElement('table');
                avgTable.className = 'table table-bordered'; // Add classes for styling
                const avgThead = document.createElement('thead');
                const avgTbody = document.createElement('tbody');

                const avgHeaderRow = document.createElement('tr');
                avgHeaderRow.style.backgroundColor = '#ffcc00'; // Set background color for average table header
                const avgHeaders = ['คำถามคำถาม 5A', 'ค่าเฉลี่ย'];
                avgHeaders.forEach(header => {
                    const th = document.createElement('th');
                    th.textContent = header;
                    avgHeaderRow.appendChild(th);
                });
                avgThead.appendChild(avgHeaderRow);

                Object.keys(clusterInfo.average_values).forEach(key => {
                    const row = document.createElement('tr');

                    const columnCell = document.createElement('td');
                    columnCell.textContent = formHeaders[key] || key; // Use formHeaders for average column names
                    row.appendChild(columnCell);

                    const valueCell = document.createElement('td');
                    valueCell.textContent = clusterInfo.average_values[key].toFixed(2);
                    row.appendChild(valueCell);

                    avgTbody.appendChild(row);
                });

                avgTable.appendChild(avgThead);
                avgTable.appendChild(avgTbody);

                clusterDiv.appendChild(document.createElement('br')); // Add space between tables
                clusterDiv.appendChild(avgTable);

                return clusterDiv;
            }

            function createSummaryTable(clusterId, clusterInfo) {
                const table = document.createElement('table');
                table.className = 'table table-bordered'; // Add classes for styling

                const thead = document.createElement('thead');
                const tbody = document.createElement('tbody');

                // Create table header
                const headerRow = document.createElement('tr');
                headerRow.style.backgroundColor = '#ffcc00'; // Set background color for header row
                const headers = ['คำถาม', ...formOptions.ans_form1.map((_, i) => `ตัวเลือก ${i + 1}`)];
                headers.forEach(header => {
                    const th = document.createElement('th');
                    th.textContent = header;
                    headerRow.appendChild(th);
                });
                thead.appendChild(headerRow);

                // Create table body
                Object.keys(clusterInfo.evaluation_averages).forEach(key => {
                    const row = document.createElement('tr');
                    const questionCell = document.createElement('td');
                    questionCell.textContent = formHeaders[key];
                    row.appendChild(questionCell);

                    // Create cells for each average value
                    clusterInfo.evaluation_averages[key].forEach(average => {
                        const cell = document.createElement('td');
                        cell.textContent = average.toFixed(2); // Format as average value
                        row.appendChild(cell);
                    });

                    tbody.appendChild(row);
                });

                // Add thead and tbody to the table
                table.appendChild(thead);
                table.appendChild(tbody);

                // Add a title for the table
                const title = document.createElement('h3');
                title.textContent = `Cluster ${parseInt(clusterId) + 1} - Evaluation Averages`; // Increment clusterId for display
                title.style.backgroundColor = '#ffcc00'; // Set background color for title

                // Create a container for the table and title
                const container = document.createElement('div');
                container.appendChild(title);
                container.appendChild(table);

                return container;
            }

            function init() {
                // Initialize event listeners and any setup logic here
                document.getElementById('customKButton').addEventListener('click', () => {
                    document.getElementById('customKForm').style.display = 'block';
                });

                document.getElementById('submitCustomK').addEventListener('click', () => {
                    const customK = document.getElementById('customKInput').value;
                    if (customK) {
                        fetch(`calculate_custom_kmeans.php?k=${customK}`)
                            .then(response => response.json())
                            .then(data => {
                                clusterData = data; // Update the clusterData variable
                                displayClusterTables(); // Call the function to display the tables
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            }
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