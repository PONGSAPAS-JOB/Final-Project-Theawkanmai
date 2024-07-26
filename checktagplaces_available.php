<?php
include_once('functions.php');

$nametagplacescheck = new DB_con();

//รับค่า
$tag_description = $_POST['tag_description'];

$sql = $nametagplacescheck->tagplacesnameavailable($tag_description);

$num = mysqli_num_rows($sql);

if ($num > 0) {
    echo "<span style='color: red;'>มีชื่อประเภทอยู่ในระบบเเล้ว</span>";
    echo "<script>$('#insert').prop('disabled', true);</script>";
} else {
    echo "<span style='color: green;'>ชื่อประเภทยังไม่มีในระบบ</span>";
    echo "<script>$('#insert').prop('disabled', false);</script>";
}
