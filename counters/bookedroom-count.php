<?php
include './db.php';

$current_date = date('Y-m-d');
$sql = "SELECT count(*) as count FROM cancelled_bookings 
        WHERE YEAR(booking_date) = YEAR(CURDATE()) 
        AND MONTH(booking_date) = MONTH(CURDATE())";

$query = $connection->query($sql);

if ($query) {
    $result = $query->fetch_assoc();
    echo $result['count'];
} else {
    echo "Error: " . $connection->error;
}
?>
