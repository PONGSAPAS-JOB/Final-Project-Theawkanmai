<?php

include_once('functions.php');

if (isset($_GET['del'])) {
    $id_manager = $_GET['del']; // Correct variable name
    $deletedata = new DB_con();
    $sql = $deletedata->deleteManager($id_manager); // Call the delete method with the correct parameter

    if ($sql) {
        echo "<script>alert('ลบผู้ใช้เสร็จสิ้น');</script>";
        echo "<script>window.location.href='ManagerMG.php'</script>";
    } else {
        echo "<script>alert('ลบผู้ใช้ไม่สำเร็จ');</script>";
        echo "<script>window.location.href='ManagerMG.php'</script>";
    }
}
