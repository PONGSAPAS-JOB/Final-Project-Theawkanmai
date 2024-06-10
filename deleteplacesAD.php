<?php

include_once('functions.php');


if (isset($_GET['del'])) {
    $id_places = $_GET['del'];
    $deletedata = new DB_con();
    $sql = $deletedata->deleteplaces($id_places);

    if ($sql) {
        echo "<script>alert('ลบสถานที่เสร็จสิ้น');</script>";
        echo "<script>window.location.href='areaandplacesMG.php'</script>";
    } else {
        echo "<script>alert('ลบสถานที่ไม่สำเร็จ');</script>";
        echo "<script>window.location.href='areaandplacesMG.php'</script>";
    }
}
