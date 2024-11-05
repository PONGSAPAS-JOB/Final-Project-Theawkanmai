<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data
    $data = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['message' => 'Invalid JSON received']);
        exit;
    }

    // Include database connection
    require 'functions.php';
    $db = new DB_con();

    // Call the saveNewClusterValues function
    $resultCluster = $db->saveNewClusterValues($data['clusters']);


    // Check if the result indicates success or an error message
    if ($resultCluster === "Clusters saved successfully") {
        echo json_encode(['message' => $resultCluster]);
    } else {
        echo json_encode(['message' => 'Error: ' . $resultCluster]);
    }
}
