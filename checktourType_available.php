<?php
include_once('functions.php');

$tourType = new DB_con();

//รับค่า
$tour_type_descrip = $_POST['tour_type_descrip'];

$sql = $tourType->tourTypeavailable($tour_type_descrip);

$num = mysqli_num_rows($sql);

if ($num > 0) {
    echo "<span style='color: red;'>มีชื่อประเภทนี้อยู่ในระบบเเล้ว</span>";
    echo "<script>$('#insert').prop('disabled', true);</script>";
} else {
    echo "<span style='color: green;'>ชื่อประเภทยังไม่มีในระบบ</span>";
    echo "<script>$('#insert').prop('disabled', false);</script>";
}
