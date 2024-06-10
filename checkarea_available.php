<?php
include_once('functions.php');

$areaplacescheck = new DB_con();

//รับค่า
$name_Area = $_POST['name_Area'];

$sql = $areaplacescheck->areanameavailable($name_Area);

$num = mysqli_num_rows($sql);

if ($num > 0) {
    echo "<span style='color: red;'>มีชื่อสถานที่นี้อยู่ในระบบเเล้ว</span>";
    echo "<script>$('#submit').prop('disabled', true);</script>";
} else {
    echo "<span style='color: green;'>ชื่อสถานที่ยังไม่มีในระบบ</span>";
    echo "<script>$('#submit').prop('disabled', false);</script>";
}
