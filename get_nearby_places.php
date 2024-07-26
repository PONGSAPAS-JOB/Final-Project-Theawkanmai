<?php
include 'functions.php'; // Ensure this path is correct

$db = new DB_con();
$dbcon = $db->dbcon;


if (isset($_POST['latitude_Places']) && isset($_POST['longitude_Places'])) {
    $latitude = $_POST['latitude_Places'];
    $longitude = $_POST['longitude_Places'];


    $sql = "SELECT name_Area, latitude_Area, longitude_Area,
                   (6371 * ACOS(COS(RADIANS($latitude)) * COS(RADIANS(latitude_Area)) * COS(RADIANS(longitude_Area) - RADIANS($longitude)) + SIN(RADIANS($latitude)) * SIN(RADIANS(latitude_Area)))) AS distance
            FROM area_info
            HAVING distance <= 5
            ORDER BY distance";

    $result = $conn->query($sql);

    $places = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $places[] = $row;
        }
    }
    $dbcon->close();

    echo json_encode($places);
}
