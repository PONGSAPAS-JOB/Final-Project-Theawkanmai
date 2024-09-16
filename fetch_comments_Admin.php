<?php
include_once('functions.php');

if (isset($_POST['id_Area'])) {
    $id_Area = $_POST['id_Area'];

    $fetchdata = new DB_con();

    // Fetch place details
    $placeDetails = $fetchdata->fetchdataareaonerecord($id_Area);
    if ($placeDetailsRow = mysqli_fetch_array($placeDetails)) {
        echo "<div style= 'margin-bottom: 15px; font-size: 23px;'><strong>ชื่อสถานที่:</strong> " . htmlspecialchars($placeDetailsRow['name_Area']) . "</div>";

        // Fetch comments related to the id_Area
        $commentsResult = $fetchdata->fetchCommentsByArea($id_Area);
        if ($commentsResult) {
            echo "<table style='width: 100%; border-collapse: collapse;'>";
            echo "<thead>";
            echo "<tr style='background-color: #ffcc00;'>";
            echo "<th style='border: 1px solid #ddd; padding: 8px; font-size: 14px;'>วันที่</th>";
            echo "<th style='border: 1px solid #ddd; padding: 8px; font-size: 14px;'>ชื่อผู้ใช้งาน</th>";
            echo "<th style='border: 1px solid #ddd; padding: 8px; font-size: 14px;'>คะเเนน</th>";
            echo "<th style='border: 1px solid #ddd; padding: 8px; font-size: 14px;'>ความคิดเห็น</th>";
            echo "<th style='border: 1px solid #ddd; padding: 8px; font-size: 14px;'>ลบ</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_array($commentsResult)) {
                echo "<tr style='background-color: #ffffff;'>";
                echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . htmlspecialchars($row['date']) . "</td>";
                echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . htmlspecialchars($row['star']) . " / 5</td>";
                echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . nl2br(htmlspecialchars($row['comment_details'])) . "</td>";
                echo "<td style='border: 1px solid #ddd; padding: 8px; text-align: center;'>
                        <a href='deletecomment_area.php?del=" . $row['id_comment'] . "'>
                            <img src='img/recycle-bin.png' alt='Delete' style='width: 30px; height: 30px;' />
                        </a>
                      </td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No comments found for this place.</p>";
        }
    } else {
        echo "<p>Error fetching place details: " . mysqli_error($fetchdata->dbcon) . "</p>";
    }
}
