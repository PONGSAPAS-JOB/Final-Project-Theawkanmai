<?php
    include_once('functions.php');

    $usernamecheck = new DB_con();

    //รับค่า
    $username = $_POST['username'];

    $sql = $usernamecheck->usernameavailable($username);

    $num = mysqli_num_rows($sql);

    if ($num > 0) {
        echo "<span style='color: red;'>มีชื่อผู้ใช้งานนี้อยู่ในระบบเเล้ว</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    } else {
        echo "<span style='color: green;'>ชื่อผู้ใช้งานนี้สามารถใช้งานได้</span>";
        echo "<script>$('#submit').prop('disabled', false);</script>";
    }
    
?>