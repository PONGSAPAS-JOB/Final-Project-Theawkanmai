<?php

include_once('functions.php');


if (isset($_GET['del'])) {
    $tour_type_id = $_GET['del'];
    $deletedata = new DB_con();
    $sql = $deletedata->deletetourType($tour_type_id);

    if ($sql) {
        echo "<script>alert('ลบประเภทเสร็จสิ้น');</script>";
        echo "<script>window.location.href='tourtypeMG.php'</script>";
    } else {
        echo "<script>alert('ลบประเภทไม่สำเร็จ');</script>";
        echo "<script>window.location.href='tourtypeMG.php'</script>";
    }
}
