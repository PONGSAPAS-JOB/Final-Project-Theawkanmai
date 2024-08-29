<?php

include_once('functions.php');

if (isset($_GET['del'])) {
    $id_member = $_GET['del'];
    $deletedata = new DB_con();
    $success1 = $deletedata->deleteFormMembers1($id_member);
    $success2 = $deletedata->deleteFormMembers2($id_member);
    $success3 = $deletedata->deleteFormMembers3($id_member);
    $success4 = $deletedata->deleteFormMembers4($id_member);

    if ($success1 && $success2 && $success3 && $success4) {
        echo "<script>alert('ลบเเบบฟอร์มเสร็จสิ้น');</script>";
    } else {
        echo "<script>alert('ลบเเบบฟอร์มไม่สำเร็จ');</script>";
    }

    echo "<script>window.location.href='FormAns_User_personality.php'</script>";
}
