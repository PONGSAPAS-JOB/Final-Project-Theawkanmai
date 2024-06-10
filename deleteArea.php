<?php

include_once('functions.php');


if (isset($_GET['del'])) {
    $id_Area = $_GET['del'];
    $deletedata = new DB_con();
    $sql = $deletedata->deleteArea($id_Area);

    if ($sql) {
        echo "<script>alert('ลบสถานที่เสร็จสิ้น');</script>";
        echo "<script>window.location.href='Areamanagement.php'</script>";
    } else {
        echo "<script>alert('ลบสถานที่ไม่สำเร็จ');</script>";
        echo "<script>window.location.href='Areamanagement.php'</script>";
    }
}
