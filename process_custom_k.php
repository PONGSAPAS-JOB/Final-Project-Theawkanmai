<?php
if (isset($_POST['customK'])) {
    $customK = intval($_POST['customK']);

    // Here you would include your logic to process the custom K value
    // For example, you can call your K-means clustering function here

    // If the processing is successful
    echo json_encode(['success' => true]);
} else {
    // If the custom K value is not set
    echo json_encode(['success' => false]);
}
