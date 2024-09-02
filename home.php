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
    <title>หน้าหลัก</title>
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


              <a class="btn btn-success" type="submit" href="logout.php">ออกจากระบบ</a>
            </form>
          </div>
        </div>
      </div>
    </nav>


    <style>
      .containerbg {

        width: 100%;
        /* Set the initial width */
        max-width: 1300px;
        /* Set the maximum width */
        height: 100vh;
        /* Allow the height to adjust proportionally */
        margin: 0 auto;
        /* Center the container */
        transition: transform 0.3s ease;
        /* Smooth transition when scaling */
        overflow: hidden;
        opacity: 1;

        background-color: #f0f0f0;
        padding: 20px;

      }
    </style>
    <div class="containerbg">
      <img src="img/ana.png" class="img-fluid" alt="...">
    </div>

  </body>

  </html>


<?php
}
?>