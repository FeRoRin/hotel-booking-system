<?php 
    include './db.php';

    $current_date = date('Y-m-d');

    $sql = "SELECT SUM(rooms) as total_rooms
            FROM bookings
            WHERE checkin_date <= '$current_date'
            AND checkout_date >= '$current_date'";

    $query = $connection->query($sql);

    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        echo $row['total_rooms'] ? $row['total_rooms'] : 0;
    } else {
        echo "0";
    }
?>

