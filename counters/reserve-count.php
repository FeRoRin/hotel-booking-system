<?php 
    include './db.php';
    $sql = "SELECT * FROM bookings 
    Where DATE(booking_date) = CURDATE()";
    $query = $connection->query($sql);

    echo "$query->num_rows";

?>