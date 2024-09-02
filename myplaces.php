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
    <title>สถานที่ของฉัน</title>
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
        width: 8%;
        height: 8%;
        margin-right: 3%;
        margin-bottom: -10%;

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
              <a class="navbar-brand" href="#">
                <span class="app-name"><?php echo $_SESSION['username']; ?></span>
                <span class="app-desc">เจ้าของสถานที่</span>

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
        /* Adjusted margin-top to create space between button and cards */
        width: 1000px;
        /* Set button width */
        margin-left: 150px;
        margin-bottom: 10px;
        text-align: center;
        /* Center text within the button */
        display: flex;

      }
    </style>


    <div class="addplace ">
      <div style="width: 1000px; padding: 20px; white-space: nowrap; margin-left: 200px;">
        <h1><b>รายการสถานที่</b></h1>
      </div>


    </div>

    <style>
      .clicked {
        background-color: #ccc;
        /* Change to the desired gray color */
      }
    </style>




    <?php
    include_once('functions.php');

    // Fetch data for places associated with the logged-in manager
    $fetchdataplaces = new DB_con();
    $sql = $fetchdataplaces->fetchdataAreaByManager($_SESSION['Id_manager']);

    $index = 1;
    $index1 = 1;

    // Store the fetched data in an array
    $rows = [];
    while ($row = mysqli_fetch_array($sql)) {
      $rows[] = $row;
    }

    foreach ($rows as $row) {
    ?>
      <div style="display: flex; justify-content: center; gap: 30px;">

        <!-- สถานที่ท่องเที่ยว Section -->
        <div class="container" style="font-size: 25px; background-color: #ffffff; width: 600px; padding: 20px; box-shadow: 0px 4px 10px rgba(0, 0, 10, 0.15); text-align: center;">
          <b>สถานที่ท่องเที่ยว</b>
          <div style="margin-top: 20px;">
            <table class="table table-bordered" style="font-size: 15px;" id="placesTable">
              <thead>
                <tr>
                  <th scope="col">ลำดับสถานที่</th>
                  <th scope="col">รูปภาพหน้าปก</th>
                  <th scope="col">รายการสถานที่ท่องเที่ยวหลัก</th>
                  <th scope="col">แก้ไข</th>
                  <th scope="col">ลบ</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $index++; ?></td>
                  <td><img src="<?php echo $row['img_Area1']; ?>" alt="Image" width="100" height="100" style="border-radius: 10px;"></td>
                  <td><?php echo $row['name_Area']; ?></td>
                  <td><a href="updateAreaByMenager.php?id=<?php echo $row['id_Area']; ?>"><img src="img/edit.png" alt="แก้ไข" width="30" height="30"></a></td>
                  <td><a href="deleteArea.php?del=<?php echo $row['id_Area']; ?>"><img src="img/recycle-bin.png" alt="ลบ" width="30" height="30"></a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <?php
        include_once('functions.php');
        $fetchdataowner = new DB_con();
        $sql = $fetchdataowner->fetchdataowner($_SESSION['Id_manager']);

        ?>
        <!-- ร้านค้า เเละ ที่พัก Section -->
        <div class="container" style="font-size: 25px; background-color: #ffffff; margin-left: -150px; width: 600px; padding: 20px; box-shadow: 0px 4px 10px rgba(0, 0, 10, 0.15); text-align: center;">
          <b>ร้านค้า เเละ ที่พัก</b>
          <div style="margin-top: 20px;">
            <table class="table table-bordered" style="font-size: 15px;">
              <thead>
                <tr>
                  <th scope="col">ลำดับสถานที่</th>
                  <th scope="col">รูปภาพหน้าปก</th>
                  <th scope="col">รายการร้านค้า เเละ ที่พักใกล้เคียง</th>
                  <th scope="col">รายละเอียด</th>
                  <th scope="col">ใกล้กับสถานที่ท่องเที่ยว</th>
                  <th scope="col">เเก้ไข</th>
                  <th scope="col">ลบ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                  <tr>
                    <td><?php echo $index1 ?></td>
                    <?php $index1 = $index1 + 1; ?> <!-- Corrected line -->
                    <td><img src="<?php echo $row['img_Places1']; ?>" alt="Image" width="100" height="100" style="border-radius: 10px;"></td>
                    <td><?php echo $row['name_places']; ?></td>
                    <td style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $row['details_places']; ?></td>
                    <?php
                    // Fetch area name based on id_Area from area_info table
                    $getAreaName = new DB_con();
                    $areaInfo = $getAreaName->getAreaName($row['id_Area']);
                    if ($areaInfo) {
                      $areaData = mysqli_fetch_assoc($areaInfo);
                      $areaName = isset($areaData['name_Area']) ? $areaData['name_Area'] : '';
                    } else {
                      $areaName = '';
                    }
                    ?>
                    <td><?php echo $areaName; ?></td> <!-- Display area name -->
                    <td><a href="updateplaces.php?id=<?php echo $row['id_places']; ?>"><img src="img/edit.png" alt="แก้ไข" width="30" height="30"></a></td>
                    <td><a href="deleteplaces.php?del=<?php echo $row['id_places']; ?>"><img src="img/recycle-bin.png" alt="ลบ" width="30" height="30"></a></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    <?php
    }
    ?>


  </body>

  </html>
<?php
}
?>