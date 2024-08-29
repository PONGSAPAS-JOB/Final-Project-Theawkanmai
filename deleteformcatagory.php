<?php

include_once('functions.php');

if (isset($_GET['del'])) {
    $id_member = $_GET['del'];
    $deletedata = new DB_con();
    $success = $deletedata->deleteFormMotivation($id_member);


    if ($success1) {
        echo "<script>alert('ลบเเบบฟอร์มเสร็จสิ้น');</script>";
    } else {
        echo "<script>alert('ลบเเบบฟอร์มไม่สำเร็จ');</script>";
    }

    echo "<script>window.location.href='FormAns_User_personality.php'</script>";
}
