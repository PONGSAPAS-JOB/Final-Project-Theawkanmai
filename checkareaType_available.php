<?php
include_once('functions.php');

$areaType = new DB_con();

//รับค่า
$name_typeArea = $_POST['name_typeArea'];

$sql = $areaType->areaTypeavailable($name_typeArea);

$num = mysqli_num_rows($sql);

if ($num > 0) {
    echo "<span style='color: red;'>มีชื่อประเภทนี้อยู่ในระบบเเล้ว</span>";
    echo "<script>$('#submit').prop('disabled', true);</script>";
} else {
    echo "<span style='color: green;'>ชื่อประเภทยังไม่มีในระบบ</span>";
    echo "<script>$('#submit').prop('disabled', false);</script>";
}
