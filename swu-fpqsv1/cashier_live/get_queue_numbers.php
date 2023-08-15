<?php
require_once("./../DBConnection.php");
?>

<?php
$current_date = date('Y-m-d');

// Retrieve data from database
$sql = "SELECT * FROM queue_list_liv WHERE status = 2 AND DATE(date_created) = '$current_date' ORDER BY queue ASC LIMIT 9";
$result = $conn->query($sql);

echo '<div class="card col-md-10 shadow me-2">';
echo '<div class="card-header">';
echo '<h5 class="card-title text-center">NEXT QUEUE</h5>';
echo '</div>';
// Generate HTML code for cards
if ($result) {
    echo '<div class="card-group">';
    while ($row = $result->fetchArray()) {
        $card_html = '<div class="card shadow me-1">';
        $card_html .= '<div class="card-header">';
        $card_html .= '<h5 class="card-title text-center"></h5>';
        $card_html .= '</div>';
        $card_html .= '<div class="card-body">';
        $card_html .= '<div class="fw-bold text-center">' . $row["queue"] . '</div>';
        $card_html .= '</div>';
        $card_html .= '</div>';
        echo $card_html;
    }
    echo '</div>';
}
echo '</div>';
// Get the number of rows in the result set

$sql = "SELECT COUNT(*) as num_rows FROM queue_list_liv WHERE status = 2 AND DATE(date_created) = '$current_date'";
$result = $conn->query($sql);

$row = $result->fetchArray();
$num_rows = $row['num_rows'];

// Check if there are more than 9 rows
if ($num_rows > 9) {
    // Get the last queue number
    $sql = "SELECT * FROM queue_list_liv WHERE status = 2 AND DATE(date_created) = '$current_date' ORDER BY queue DESC LIMIT 1";
    $result = $conn->query($sql);

    echo '<div class="card col-md-1 shadow me-2">';
    echo '<div class="card-header">';
    echo '<h5 class="card-title text-center">LAST</h5>';
    echo '</div>';
    // Generate HTML code for cards
    if ($result) {
        echo '<div class="card-group">';
        while ($row = $result->fetchArray()) {
            $card_html = '<div class="card shadow me-1">';
            $card_html .= '<div class="card-header">';
            $card_html .= '<h5 class="card-title text-center"></h5>';
            $card_html .= '</div>';
            $card_html .= '<div class="card-body">';
            $card_html .= '<div class="fw-bold text-center">' . $row["queue"] . '</div>';
            $card_html .= '</div>';
            $card_html .= '</div>';
            echo $card_html;
        }
        echo '</div>';
    }
    echo '</div>';
}
echo '</div>';
?>


        