<?php
// Include your database connection and necessary functions here
require 'functions.php';
$db = new DB_con();

header('Content-Type: application/json');

try {
    // Get the JSON input
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Call the function to save interests
    $responseMessage = $db->saveNewInterestValues($data['clusters']);

    // Return success response
    echo json_encode(['message' => $responseMessage]);
} catch (Exception $e) {
    // Return error response
    echo json_encode(['message' => 'Error: ' . $e->getMessage()]);
}
