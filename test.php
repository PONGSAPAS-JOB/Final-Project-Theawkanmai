<?php

define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'theawkanmai');

class DB_con
{
    public $dbcon;
    public $error;

    public function __construct()
    {
        $this->dbcon = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        if ($this->dbcon->connect_error) {
            $this->error = "Connection failed: " . $this->dbcon->connect_error;
        }
    }

    public function query($sql)
    {
        $result = $this->dbcon->query($sql);
        if (!$result) {
            $this->error = "Query failed: " . $this->dbcon->error;
        }
        return $result;
    }

    public function close()
    {
        $this->dbcon->close();
    }
}

// Function to calculate the Euclidean distance between two points
function calculateDistance($answers, $cluster)
{
    $distance = 0;
    foreach ($answers as $i => $answer) {
        $distance += pow($answer - $cluster[$i], 2);
    }
    return sqrt($distance);
}

// Function to find the nearest cluster for a given set of answers
function findNearestCluster($newAnswers, $clusters)
{
    $minDistance = PHP_INT_MAX;
    $nearestCluster = -1;
    foreach ($clusters as $clusterId => $cluster) {
        $distance = calculateDistance($newAnswers, $cluster);
        if ($distance < $minDistance) {
            $minDistance = $distance;
            $nearestCluster = $clusterId;
        }
    }
    return $nearestCluster;
}
