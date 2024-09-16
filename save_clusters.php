<?php
// Include the database connection file
include_once('functions.php');

// Get the raw POST data
$postData = file_get_contents('php://input');
$clusters = json_decode($postData, true);

// Create a new instance of the DB_con class
$db = new DB_con();

// Save the new cluster values
$result = $db->saveNewClusterValues($clusters);

// Return a JSON response
if ($result === "Clusters saved successfully") {
    echo json_encode(['success' => true, 'message' => $result]);
} else {
    echo json_encode(['success' => false, 'message' => $result]);
}
