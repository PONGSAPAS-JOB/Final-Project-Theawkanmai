<?php

session_start();

if ($_SESSION['id_admin'] == "") {
  header("location: signin.php");
} else {

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
    <title>หน้าหลัก admin</title>
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
    </style>
    <div class="addplace "><a></a></div>
    <div class="container">
      <?php
      include 'test.php';

      // Create an instance of the DB_con class
      $userdata = new DB_con();

      // Fetch the latest id_update_cluster
      $sql = "SELECT MAX(id_update_cluster) as latest_id_update_cluster FROM cluster_value";
      $result = $userdata->query($sql);
      $row = $result->fetch_assoc();
      $latest_id_update_cluster = $row['latest_id_update_cluster'];

      // Display the id_update_cluster value
      echo "<h3>id_update_cluster ที่ใช้: $latest_id_update_cluster</h3>";

      // Fetch cluster data for the latest id_update_cluster
      $sql = "SELECT * FROM cluster_value WHERE id_update_cluster = $latest_id_update_cluster";
      $result = $userdata->query($sql);

      $clusters = [];
      while ($row = $result->fetch_assoc()) {
        $id_cluster = $row['id_cluster'];
        $clusters[$id_cluster] = [
          $row['value1'],
          $row['value2'],
          $row['value3'],
          $row['value4'],
          $row['value5'],
          $row['value6'],
          $row['value7'],
          $row['value8'],
          $row['value9'],
          $row['value10'],
          $row['value11'],
          $row['value12'],
          $row['value13'],
          $row['value14'],
          $row['value15'],
          $row['value16'],
          $row['value17'],
          $row['value18'],
          $row['value19'],
          $row['value20']
        ];
      }

      // User ID for analysis
      $id_member = 1805; // Example user ID

      // Fetch data from eva_form1
      $sql = "SELECT * FROM eva_form1 WHERE id_member = $id_member";
      $result1 = $userdata->query($sql);
      $row1 = $result1->fetch_assoc();

      // Fetch data from eva_form2
      $sql = "SELECT * FROM eva_form2 WHERE id_member = $id_member";
      $result2 = $userdata->query($sql);
      $row2 = $result2->fetch_assoc();

      // User's answers
      $newAnswers = [
        $row1["eva_p1_ans1"],
        $row1["eva_p1_ans2"],
        $row1["eva_p1_ans3"],
        $row1["eva_p1_ans4"],
        $row1["eva_p1_ans5"],
        $row1["eva_p1_ans6"],
        $row1["eva_p1_ans7"],
        $row1["eva_p1_ans8"],
        $row1["eva_p1_ans9"],
        $row2["eva_p2_ans1"],
        $row2["eva_p2_ans10"],
        $row2["eva_p2_ans11"],
        $row2["eva_p2_ans12"],
        $row2["eva_p2_ans13"],
        $row2["eva_p2_ans14"],
        $row2["eva_p2_ans15"],
        $row2["eva_p2_ans16"],
        $row2["eva_p2_ans17"],
        $row2["eva_p2_ans18"],
        $row2["eva_p2_ans19"]
      ];

      // Find the nearest cluster
      $nearestCluster = findNearestCluster($newAnswers, $clusters);

      // Define recommendations based on clusters
      $recommendations = [
        1 => [
          "กิจกรรม" => [
            "เดินป่าในเส้นทางธรรมชาติ",
            "ปิกนิกในสวนสาธารณะ",
            "เข้าร่วมกิจกรรมเชิงอนุรักษ์",
            "นั่งเรือชมวิว"
          ],
          "แหล่งท่องเที่ยว" => [
            "แหล่งท่องเที่ยวเชิงนิเวศ/ธรรมชาติ",
            "แหล่งท่องเที่ยวเชิงเกษตร",
            "แหล่งท่องเที่ยวเชิงสุขภาพ",
            "แหล่งท่องเที่ยวเชิงศาสนา"
          ]
        ],
        2 => [
          "กิจกรรม" => [
            "เวิร์กช็อปสร้างแรงบันดาลใจ",
            "การเดินป่าเชิงผจญภัย",
            "กิจกรรมเรียนรู้วัฒนธรรมท้องถิ่น",
            "การเข้าร่วมค่ายฝึกอบรมหรือสัมมนา"
          ],
          "แหล่งท่องเที่ยว" => [
            "แหล่งท่องเที่ยวเชิงนิเวศ/ธรรมชาติ",
            "แหล่งท่องเที่ยวเชิงอาหาร",
            "แหล่งท่องเที่ยวเชิงเทศกาล/งานประเพณี",
            "แหล่งท่องเที่ยววัฒนธรรม/วิถีชีวิต",
            "แหล่งท่องเที่ยวเชิงผจญภัย",
            "แหล่งท่องเที่ยวเชิงสุขภาพ"
          ]
        ],
        3 => [
          "กิจกรรม" => [
            "การนวดผ่อนคลายหรือสปา",
            "การชมวิวและถ่ายภาพ",
            "การพักผ่อนในรีสอร์ทหรือบ้านพักตากอากาศ",
            "การเที่ยวชมพิพิธภัณฑ์หรือแกลเลอรี"
          ],
          "แหล่งท่องเที่ยว" => [
            "แหล่งท่องเที่ยวเชิงอาหาร",
            "แหล่งท่องเที่ยวเชิงเกษตร",
            "แหล่งท่องเที่ยวเชิงสุขภาพ",
            "แหล่งท่องเที่ยวเชิงศาสนา"
          ]
        ]
      ];

      // Display the results
      echo "<h2>คำตอบของผู้ใช้ ID: $id_member</h2>";
      echo "<h3>ผู้ทำแบบสอบถามนี้ถูกจัดอยู่ในคลัสเตอร์ที่: $nearestCluster</h3>";

      echo "<h4>กิจกรรมแนะนำ:</h4>";
      echo "<ul>";
      foreach ($recommendations[$nearestCluster]["กิจกรรม"] as $activity) {
        echo "<li>$activity</li>";
      }
      echo "</ul>";

      echo "<h4>แหล่งท่องเที่ยวแนะนำ:</h4>";
      echo "<ul>";
      foreach ($recommendations[$nearestCluster]["แหล่งท่องเที่ยว"] as $attraction) {
        echo "<li>$attraction</li>";
      }
      echo "</ul>";

      // Fetch id_category based on recommended attractions
      $recommended_attractions = $recommendations[$nearestCluster]["แหล่งท่องเที่ยว"];
      $id_categories = [];

      foreach ($recommended_attractions as $attraction) {
        $category_sql = "SELECT id_category FROM area_category WHERE name_category = '$attraction'";
        $category_result = $userdata->query($category_sql);

        if ($category_result && $category_result->num_rows > 0) {
          while ($category_row = $category_result->fetch_assoc()) {
            $id_categories[] = $category_row['id_category'];
          }
        }
      }

      // Fetch id_category based on recommended attractions
      $recommended_attractions = $recommendations[$nearestCluster]["แหล่งท่องเที่ยว"];
      $id_categories = [];

      foreach ($recommended_attractions as $attraction) {
        $category_sql = "SELECT id_category FROM area_category WHERE name_category = '$attraction'";
        $category_result = $userdata->query($category_sql);

        if ($category_result && $category_result->num_rows > 0) {
          while ($category_row = $category_result->fetch_assoc()) {
            $id_categories[] = $category_row['id_category'];
          }
        }
      }

      // Check if $id_categories is not empty before proceeding
      if (!empty($id_categories)) {
        // Proceed with the SQL query to get id_type_area
        $type_area_sql = "SELECT id_type_area FROM group_typearea WHERE id_category IN (" . implode(',', $id_categories) . ")";
        $type_area_result = $userdata->query($type_area_sql);

        if (!$type_area_result) {
          die("Error fetching type areas: " . $userdata->error);
        }

        $id_type_areas = [];
        while ($type_area_row = $type_area_result->fetch_assoc()) {
          $id_type_areas[] = $type_area_row['id_type_area'];
        }

        // Proceed with fetching the name_Area if $id_type_areas is not empty
        if (!empty($id_type_areas)) {
          $areas_sql = "SELECT name_Area FROM area_info WHERE id_type_area IN (" . implode(',', $id_type_areas) . ")";
          $areas_result = $userdata->query($areas_sql);

          if (!$areas_result) {
            die("Error fetching areas: " . $userdata->error);
          }

          // Fetch all results into an array
          $areas = [];
          while ($area_row = $areas_result->fetch_assoc()) {
            $areas[] = $area_row['name_Area'];
          }

          // Shuffle the array to randomize the order
          shuffle($areas);

          // Display the results
          echo "<h4>สถานที่ท่องเที่ยวแนะนำ:</h4>";
          echo "<ul>";
          foreach ($areas as $area) {
            echo "<li>" . $area . "</li>";
          }
          echo "</ul>";
        } else {
          // Handle the case where there are no id_type_areas
          echo "<p>No recommended areas found.</p>";
        }
      } else {
        // Handle the case where there are no id_categories
        echo "<p>No recommended areas found.</p>";
      }
      ?>
    </div>









    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>




    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


  </body>

  </html>


<?php
}
?>