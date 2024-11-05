<?php
require_once 'functions.php';

$DB_con = new DB_con();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $clusters = $data['clusters'] ?? [];

    try {
        // Fetch the category IDs mapping from the database
        $categoryIds = $DB_con->getCategoryIds(); // Assuming this method returns an associative array mapping category names to IDs

        // Prepare clusters data for saving
        foreach ($clusters as &$cluster) {
            $cluster['id_category_1'] = $categoryIds[$cluster['interest_1']] ?? null;
            $cluster['id_category_2'] = $categoryIds[$cluster['interest_2']] ?? null;
            $cluster['id_category_3'] = $categoryIds[$cluster['interest_3']] ?? null;
        }

        // Save clusters
        $message = $DB_con->saveSummaryClusterValues($clusters);

        echo json_encode(['message' => $message]);
    } catch (Exception $e) {
        echo json_encode(['message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['message' => 'Invalid request method.']);
}
