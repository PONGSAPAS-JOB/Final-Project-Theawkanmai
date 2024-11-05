<?php
include_once('functions.php');

$db = new DB_con();
$data = $db->fetchAllEvaluationData();
$file = 'data.csv';

if ($fileHandle = fopen($file, 'w')) {
    fputcsv($fileHandle, [
        'ans_form1',
        'ans_form2',
        'ans_form3',
        'ans_form4',
        'ans_form5',
        'ans_form6',
        'ans_form7',
        'ans_form8',
        'eva_p1_ans1',
        'eva_p1_ans2',
        'eva_p1_ans3',
        'eva_p1_ans4',
        'eva_p1_ans5',
        'eva_p1_ans6',
        'eva_p1_ans7',
        'eva_p1_ans8',
        'eva_p1_ans9',
        'eva_p2_ans1',
        'eva_p2_ans2',
        'eva_p2_ans3',
        'eva_p2_ans4',
        'eva_p2_ans5',
        'eva_p2_ans6',
        'eva_p2_ans7',
        'eva_p2_ans8',
        'eva_p2_ans9',
        'eva_p2_ans10',
        'eva_p2_ans11',
        'eva_p2_ans12',
        'eva_p2_ans13',
        'eva_p2_ans14',
        'eva_p2_ans15',
        'eva_p2_ans16',
        'eva_p2_ans17',
        'eva_p2_ans18',
        'eva_p2_ans19',
        'ans1',
        'ans2',
        'ans3',
        'ans4',
        'ans5',
        'ans6',
        'ans7',
        'ans8'
    ]);

    while ($row = mysqli_fetch_assoc($data)) {
        fputcsv($fileHandle, $row);
    }
    fclose($fileHandle);
} else {
    die("Cannot open file for writing.");
}

if (isset($_GET['k'])) {
    $k = intval($_GET['k']);
    $command = escapeshellcmd("python3 calculate_custom_kmeans.py $k");
    $output = shell_exec($command);
    echo $output;
}
