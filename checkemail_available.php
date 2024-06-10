<?php
    include_once('functions.php');

    $emailcheck = new DB_con();

    //รับค่า
    $useremail = $_POST['email'];

    $sql = $emailcheck->emailavailable($useremail);

    $num = mysqli_num_rows($sql);

    if ($num > 0) {
        echo "<span style='color: red;'>มีอีเมลล์นี้ใช้งานอยู่ในระบบเเล้ว</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    } else {
        echo "<span style='color: green;'>อีเมลล์นี้สามารถใช้งานได้</span>";
        echo "<script>$('#submit').prop('disabled', false);</script>";
    }
    
?>