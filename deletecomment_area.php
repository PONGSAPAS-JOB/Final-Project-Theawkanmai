<?php
include_once('functions.php');
$fetchdata = new DB_con();

if (isset($_GET['del'])) {
    $id_comment = $_GET['del'];

    // Delete comment
    $result = $fetchdata->deleteCommentArea($id_comment);

    if ($result) {
        echo "Comment deleted successfully.";
    } else {
        echo "Error deleting comment.";
    }

    // Redirect back to the previous page
    echo "<script>window.history.back();</script>";
    exit;
}
