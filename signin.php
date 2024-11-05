<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<?php
session_start();
include_once('functions.php');

$userdata = new DB_con();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $userData = $userdata->signin($username, $password);

    if ($userData !== null) {
        if (isset($userData['Id_manager'])) {
            $_SESSION['Id_manager'] = $userData['Id_manager'];
            $_SESSION['username'] = $userData['username'];


            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Login Success!',
                    text: 'กำลังเข้าสู่ระบบ',
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'home.php';
                });
            });</script>";
        } elseif (isset($userData['id_admin'])) {
            $_SESSION['id_admin'] = $userData['id_admin'];
            $_SESSION['username'] = $userData['username'];

            echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Login Success!',
                        text: 'กำลังเข้าสู่ระบบ',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'homeadmin.php';
                    });
                });
            </script>";
        } elseif (isset($userData['id_spe'])) {
            $_SESSION['id_spe'] = $userData['id_spe'];
            $_SESSION['username'] = $userData['username'];

            echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Login Success!',
                        text: 'กำลังเข้าสู่ระบบ',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'homespe.php';
                    });
                });
            </script>";
        }
    } else {
        echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Login Failed!',
                    text: 'ชื่อผู้ใช้งานหรือรหัสผ่านผิด โปรดลองอีกครั้ง!',
                    icon: 'error',
                    timer: 3000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'signin.php';
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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link href="https://fonts.googleapis.com/css2?family=Lily+Script+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<style>
    body {
        margin-top: 45px;
        background-image: url('img/img1.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
    }
</style>
<style>
    @font-face {
        font-family: 'Lily Script One';
        src: url('path_to_font_files/linly-script.woff2') format('woff2'),
            url('path_to_font_files/linly-script.woff') format('woff');

    }

    h1 {
        opacity: 1;
        font-size: 34px;
        font-family: 'Lily Script One', cursive;
    }

    h2 {
        font-size: 40px;
        font-family: 'Lily Script One', cursive;
    }

    h6 {
        font-size: 20px;
        font-family: 'Lily Script One', cursive;
    }

    button {

        font-family: 'Lily Script One', cursive;
    }

    input {
        background-color: #FFFFFF;
    }

    @import url('https://fonts.googleapis.com/css2?family=Lily+Script+One&display=swap');

    .containerbg {

        width: 100%;
        /* Set the initial width */
        max-width: 450px;
        /* Set the maximum width */
        height: 80vh;
        /* Allow the height to adjust proportionally */
        margin: 0 auto;
        /* Center the container */
        transition: transform 0.3s ease;
        /* Smooth transition when scaling */
        overflow: hidden;
        margin-top: 5%;
        opacity: 1;
        border-radius: 20px;
        background-color: #f0f0f0;
        padding: 20px;

    }

    .logo {
        width: 20%;
        opacity: 0.7;

    }

    .title {
        margin-top: 3%;

        text-align: center;
    }

    .detail {
        text-align: center;
        font-size: 15px;
    }

    .subtitile {
        text-align: center;
        margin-top: 20%;


    }

    #login {
        /*css แบบId*/
        font-size: 20px;
    }

    .username {
        margin-top: 2rem;
        margin-left: auto;
        margin-right: auto;


    }

    .form-control {
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        margin-top: 1rem;
        background-color: #FFFFFF;
    }

    .btn {

        width: 80%;
        margin-left: 10%;
        margin-right: auto;
        margin-top: 3rem;
    }

    #createaccount {
        margin-left: 25%;

    }

    .create {
        margin-top: 5%;
    }

    .foget {
        margin-top: 3%;
        margin-left: 62%;
    }

    .back {

        margin-left: 3%;
    }
</style>

<body>

    <div class="containerbg">
        <div class="title">
            <h1>
                “ Theaw-kan-mai App ”
            </h1>
            <div class="detail">
                Location information management application
            </div>
            <div class="subtitile">
                <h2 id="login">
                    Login
                </h2>
            </div>

        </div>
        <form method="post">
            <div class="username">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">


                <input type="password" class="form-control" id="password" name="password" placeholder="Password">


                <button type="submit" id="login" name="login" class="btn btn-warning">Login</button>
        </form>
        <hr>
        <div class="create">
            <A id="createaccount" href="index.php">
                <h7>CREATE ACCOUNT MANAGER</h7>
            </A>
        </div>

    </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>