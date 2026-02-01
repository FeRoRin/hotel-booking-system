<?php 
    include './db.php';
    $sql = "SELECT * FROM bookings 
    WHERE YEAR(booking_date) = YEAR(CURDATE()) 
    AND MONTH(booking_date) = MONTH(CURDATE())";
    $query = $connection->query($sql);

    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        echo $row['room_count'] ? $row['room_count'] : 0;
    } else {
        echo "0";
    }

?>