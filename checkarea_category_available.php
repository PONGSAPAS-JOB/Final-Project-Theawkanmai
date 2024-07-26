<?php
include_once('functions.php');

$areacategory = new DB_con();

//รับค่า
$name_category = $_POST['name_category'];

$sql = $areacategory->areacategoryavailable($name_category);

$num = mysqli_num_rows($sql);

if ($num > 0) {
    echo "<span style='color: red;'>มีชื่อของกลุ่มของสถานที่ท่องเที่ยวนี้อยู่ในระบบเเล้ว</span>";
    echo "<script>$('#insert').prop('disabled', true);</script>";
} else {
    echo "<span style='color: green;'>ชื่อของกลุ่มของสถานที่ท่องเที่ยวยังไม่มีในระบบ</span>";
    echo "<script>$('#insert').prop('disabled', false);</script>";
}
