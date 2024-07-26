<?php

include_once('functions.php');


if (isset($_GET['del'])) {
    $id_tag = $_GET['del'];
    $deletedata = new DB_con();
    $sql = $deletedata->deleteTagplaces($id_tag);

    if ($sql) {
        echo "<script>alert('ลบหมวดหมู่เสร็จสิ้น');</script>";
        echo "<script>window.location.href='tagplacesMG.php'</script>";
    } else {
        echo "<script>alert('ลบหมวดหมู่ไม่สำเร็จ');</script>";
        echo "<script>window.location.href='tagplacesMG.php'</script>";
    }
}
