<?php

include_once('functions.php');


if (isset($_GET['del'])) {
    $id_type_area = $_GET['del'];
    $deletedata = new DB_con();
    $sql = $deletedata->deleteareaType($id_type_area);

    if ($sql) {
        echo "<script>alert('ลบประเภทเสร็จสิ้น');</script>";
        echo "<script>window.location.href='typeareaMG.php'</script>";
    } else {
        echo "<script>alert('ลบประเภทไม่สำเร็จ');</script>";
        echo "<script>window.location.href='typeareaMG.php'</script>";
    }
}
