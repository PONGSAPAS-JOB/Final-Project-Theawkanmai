<?php
include_once('functions.php');

$nameplacescheck = new DB_con();

//รับค่า
$name_places = $_POST['name_places'];

$sql = $nameplacescheck->placesnameavailable($name_places);

$num = mysqli_num_rows($sql);

if ($num > 0) {
    echo "<span style='color: red;'>มีชื่อสถานนี้อยู่ในระบบเเล้ว</span>";
    echo "<script>$('#insert').prop('disabled', true);</script>";
} else {
    echo "<span style='color: green;'>ชื่อสถานที่ยังไม่มีในระบบ</span>";
    echo "<script>$('#insert').prop('disabled', false);</script>";
}
