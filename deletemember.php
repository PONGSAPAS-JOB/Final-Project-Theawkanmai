<?php

include_once('functions.php');


if (isset($_GET['del'])) {
    $id_member = $_GET['del'];
    $deletedata = new DB_con();
    $sql = $deletedata->deletemember($id_member);

    if ($sql) {
        echo "<script>alert('ลบผู้ใช้เสร็จสิ้น');</script>";
        echo "<script>window.location.href='MemberMG.php'</script>";
    } else {
        echo "<script>alert('ลบผู้ใช้ไม่สำเร็จ');</script>";
        echo "<script>window.location.href='MemberMG.php'</script>";
    }
}
