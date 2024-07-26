<?php

include_once('functions.php');


if (isset($_GET['del'])) {
    $id_category = $_GET['del'];
    $deletedata = new DB_con();
    $sql = $deletedata->deleteareacategory($id_category);

    if ($sql) {
        echo "<script>alert('ลบกลุ่มเสร็จสิ้น');</script>";
        echo "<script>window.location.href='areacategoryMG.php'</script>";
    } else {
        echo "<script>alert('ลบกลุ่มไม่สำเร็จ');</script>";
        echo "<script>window.location.href='areacategoryMG.php'</script>";
    }
}
