<?php
session_start();

if ($_SESSION['Id_manager'] == "") {
  header("location: signin.php");
  exit();
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
    <style>
      body {
        margin-top: 0;
        background-image: url('img/img4.png');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
      }

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

      .addplace {
        margin-top: 100px;
        width: 1000px;
        margin-left: 150px;
        margin-bottom: 10px;
        text-align: center;
      }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
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
              <a class="nav-link active" aria-current="page" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="chooseAdd.php">Add Places</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="myplaces.php">My Places</a>
            </li>
          </ul>
          <div>
            <form class="d-flex justify-content-end">
              <a class="navbar-brand">Welcome, </a>
              <a class="navbar-brand" href="ProfileManager.php">
                <span class="app-name"><?php echo $_SESSION['username']; ?></span>
                <span class="app-desc">ผู้ที่เกี่ยวข้องกับสถานที่</span>
              </a>
              <img src="img/pro.jpg" class="rounded-circle" alt="Profile Image">
              <a class="btn btn-danger" href="logout.php">ออกจากระบบ</a>
            </form>
          </div>
        </div>
      </div>
    </nav>

    <div class="addplace">
      <div style="width: 1000px; padding: 20px; white-space: nowrap; margin-left: 120px;">
        <h1><b>รายการสถานที่</b></h1>
      </div>
    </div>

    <?php
    include_once('functions.php');

    $fetchdataplaces = new DB_con();
    $sqlPlaces = $fetchdataplaces->fetchdataAreaByManager($_SESSION['Id_manager']);
    $rowsPlaces = [];

    $indexPlaces = 1;
    while ($rowPlaces = mysqli_fetch_array($sqlPlaces)) {
      $rowsPlaces[] = $rowPlaces;
    }

    $fetchdataowner = new DB_con();
    $sqlOwner = $fetchdataowner->fetchdataowner($_SESSION['Id_manager']);
    $rowsOwner = [];

    $indexOwner = 1;
    while ($rowOwner = mysqli_fetch_array($sqlOwner)) {
      $rowsOwner[] = $rowOwner;
    }
    ?>

    <div style="display: flex; justify-content: center; gap: 10px;">
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
              <?php foreach ($rowsPlaces as $rowPlaces) { ?>
                <tr>
                  <td><?php echo $indexPlaces++; ?></td>
                  <td><img src="<?php echo $rowPlaces['img_Area1']; ?>" alt="Image" width="100" height="100" style="border-radius: 10px; object-fit: cover;"></td>
                  <td><?php echo $rowPlaces['name_Area']; ?></td>
                  <td><a href="updateAreaByManager.php?id=<?php echo $rowPlaces['id_Area']; ?>"><img src="img/edit.png" alt="แก้ไข" width="30" height="30"></a></td>
                  <td><a href="deleteArea.php?del=<?php echo $rowPlaces['id_Area']; ?>"><img src="img/recycle-bin.png" alt="ลบ" width="30" height="30"></a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ร้านค้า และ ที่พัก Section -->
      <div class="container" style="font-size: 25px; background-color: #ffffff; width: 600px; padding: 20px; box-shadow: 0px 4px 10px rgba(0, 0, 10, 0.15); text-align: center; margin-left: -150px">
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
              <?php foreach ($rowsOwner as $rowOwner) { ?>
                <tr>
                  <td><?php echo $indexOwner++; ?></td>
                  <td><img src="<?php echo $rowOwner['img_Places1']; ?>" alt="Image" width="100" height="100" style="border-radius: 10px; "></td>
                  <td><?php echo $rowOwner['name_places']; ?></td>
                  <td style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $rowOwner['details_places']; ?></td>
                  <?php
                  $getAreaName = new DB_con();
                  $areaInfo = $getAreaName->getAreaName($rowOwner['id_Area']);
                  $areaName = $areaInfo ? mysqli_fetch_assoc($areaInfo)['name_Area'] : '';
                  ?>
                  <td><?php echo $areaName; ?></td>
                  <td><a href="updateplaces.php?id=<?php echo $rowOwner['id_places']; ?>"><img src="img/edit.png" alt="แก้ไข" width="30" height="30"></a></td>
                  <td><a href="deleteplaces.php?del=<?php echo $rowOwner['id_places']; ?>"><img src="img/recycle-bin.png" alt="ลบ" width="30" height="30"></a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </body>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  </html>
<?php
}
?>