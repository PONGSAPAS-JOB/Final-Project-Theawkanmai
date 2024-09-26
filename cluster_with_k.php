<?php
// รวมไฟล์เชื่อมต่อฐานข้อมูล
include_once('functions.php');

// สร้างออบเจ็กต์ใหม่ของคลาส DB_con
$db = new DB_con();

// ดึงข้อมูล
$data = $db->fetchAllEvaluationData();

// เขียนข้อมูลลงไฟล์ CSV
$file = 'data.csv';
if ($fileHandle = fopen($file, 'w')) {
    // เขียนแถวหัวข้อ
    fputcsv($fileHandle, ['id_member', 'eva_p1_ans1', 'eva_p1_ans2', 'eva_p1_ans3', 'eva_p1_ans4', 'eva_p1_ans5', 'eva_p1_ans6', 'eva_p1_ans7', 'eva_p1_ans8', 'eva_p1_ans9', 'eva_p2_ans1', 'eva_p2_ans10', 'eva_p2_ans11', 'eva_p2_ans12', 'eva_p2_ans13', 'eva_p2_ans14', 'eva_p2_ans15', 'eva_p2_ans16', 'eva_p2_ans17', 'eva_p2_ans18', 'eva_p2_ans19']);

    // เขียนแถวข้อมูล
    while ($row = mysqli_fetch_assoc($data)) {
        fputcsv($fileHandle, $row);
    }

    fclose($fileHandle);
} else {
    die("Cannot open file for writing.");
}

$k = isset($_GET['k']) ? intval($_GET['k']) : 2;

// เรียกใช้สคริปต์ Python เพื่อคำนวณ K-means clustering
$output = shell_exec("python3 cluster_with_k.py $k");
$lines = explode("\n", trim($output));

// สร้างตารางข้อมูลใหม่จากผลลัพธ์ที่ได้
$clusterData = [];
foreach ($lines as $line) {
    if (!empty($line)) {
        $values = explode(',', $line);
        $id_cluster = array_shift($values);
        $clusterData[] = [
            'id_cluster' => $id_cluster,
            'values' => $values
        ];
    }
}

// ส่งผลลัพธ์กลับเป็น JSON
header('Content-Type: application/json');
echo json_encode(['cluster_data' => $clusterData]);
