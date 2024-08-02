<?php

session_start();

if ($_SESSION['Id_manager'] == "") {
  header("location: signin.php");
} else {

?>
  <?php
  include_once('functions.php');
  $userdata = new DB_con();
  $updatedata = new DB_con();


  if (isset($_POST['update'])) {
    $id_places = $_GET['id'];
    $name_places = $_POST['name_places'];
    $details_places = $_POST['details_places'];
    $contact_places = $_POST['contact_places'];

    $sql = $updatedata->updateplaces($name_places, $details_places, $contact_places, $id_places);

    if ($sql) {
      echo "<script>alert('เเก้ไขสถานที่เสร็จสิ้น');</script>";
      echo "<script>window.location.href='myplaces.php'</script>";
    } else {
      echo "<script>alert('ไม่สามารถเเก้ไขสถานที่ได้ โปรดลองอีกครั้ง');</script>";
      echo "<script>window.location.href='updateplaces.php'</script>";
    }
  }


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
    <title>เเก้ไขสถานที่</title>
  </head>
  <style>
    body {
      margin-top: 0px;
      background-image: url('img/img3.png');
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
      .container {
        margin-top: 40px;
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
    </style>

    <div class="addplace "><a></a></div>


    <div class="container">
      <h1 class="mt-5"> เเก้ไขข้อมูลสถานที่ท่องเที่ยว </h1>
      <hr>
      <?php

      $id_places = $_GET['id'];
      $updateplaces = new DB_con();
      $sql = $updateplaces->fetchonerecord($id_places);
      while ($row = mysqli_fetch_array($sql)) {

      ?>

        <form method="post">
          <div class="mb-3">
            <label for="name_places" class="form-label">ชื่อสถานที่</label>
            <input type="text" class="form-control" id="name_places" name="name_places" value="<?php echo $row['name_places']; ?>" aria-describedby="ชื่อสถานที่" required>
          </div>
          <div class="mb-3">
            <label for="details_places" class="form-label">ข้อมูลทั่วไปของสถานที่</label>
            <textarea type="text" class="form-control" row="10" id="details_places" name="details_places" aria-describedby="ข้อมูลทั่วไปของสถานที่" required>
                <?php echo $row['details_places']; ?>
                </textarea>
          </div>
          <div class="mb-3">
            <label for="contact_places" class="form-label">ข้อมูลติดต่อ สถานที่</label>
            <input type="text" class="form-control" id="contact_places" name="contact_places" value="<?php echo $row['contact_places']; ?>" aria-describedby="ข้อมูลติดต่อ สถานที่" required>
          </div>

        <?php
      }
        ?>

        <button type="submit" name="update" id="update" class="btn btn-warning">เเก้ไขข้อมูลสถานที่ใหม่</button>

        </form>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  </body>

  </html>

<?php
}
?>