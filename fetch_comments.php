<?php
include_once('functions.php');
$fetchdata = new DB_con();

if (isset($_POST['id_Area'])) {
    $id_Area = $_POST['id_Area'];

    // Fetch total views
    $total_views = $fetchdata->getTotalViews($id_Area);

    // Fetch number of likes
    $number_of_likes = $fetchdata->getNumberOfLikes($id_Area);

    // Fetch average rating
    $average_rating = $fetchdata->getAverageRating($id_Area);

    // Fetch comments related to the id_Area
    $result = $fetchdata->fetchCommentsByArea($id_Area);

    // Check if the query was successful
    if ($result) {
        // Display total views, number of likes, and average rating horizontally
        echo "<div style='display: flex; gap: 20px; margin-bottom: 70px; margin-left: 130px; font-size: 30px;'>";
        echo "<div style='margin-top: 20px;'><strong>🔎ยอดการเข้าชม :</strong> " . htmlspecialchars($total_views) . "</div>";
        echo "<div style='font-size: 50px;'><strong>|</strong> " . "</div>";
        echo "<div style='margin-top: 20px;'><strong>👍การกดถูกใจสถานที่ :</strong> " . htmlspecialchars($number_of_likes) . "</div>";
        echo "<div style='font-size: 50px;'><strong>|</strong> " . "</div>";
        echo "<div style='margin-top: 20px;'><strong>✨คะเเนน :</strong> " . number_format(htmlspecialchars($average_rating), 2) . " / 5</div>";
        echo "</div>";

        // Output the comments with styling
        while ($row = mysqli_fetch_array($result)) {
            echo "<div class='comment-box' style='background-color: #ffffff; border: 2px solid #ffcc00; border-radius: 10px; padding: 15px; margin-bottom: 15px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); font-size: 19px;'>";
            echo "<strong>🌻ชื่อผู้ใช้งาน : " . htmlspecialchars($row['username']) . "</strong><br>";
            echo "Date: " . htmlspecialchars($row['date']) . "<br>"; // Escape output for security
            echo "<hr>";
            echo "<strong>✨คะเเนน :</strong> " . htmlspecialchars($row['star']) . " / 5<br>";
            echo "<p> : " . nl2br(htmlspecialchars($row['comment_details'])) . "</p>"; // Convert newlines to <br> for better formatting
            echo '<div style="width: 60px; height: 60px;">
            <a href="deletecomment_area.php?del=' . $row['id_comment'] . '">
                <img src="img/recycle-bin.png" alt="Delete" style="width: 100%; height: 100%;" />
            </a>
        </div>';
            echo "</div>";
        }
    } else {
        echo "Error: " . mysqli_error($fetchdata->dbcon); // Show error if query failed
    }
}
