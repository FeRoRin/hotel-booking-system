<?php 
    include './db.php';
    $current_date = date('Y-m-d');

    $sql = "SELECT SUM(guests) as guests_num
            FROM bookings
            WHERE checkin_date <= '$current_date'
            AND checkout_date >= '$current_date'";

    $query = $connection->query($sql);

    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        echo $row['guests_num'] ? $row['guests_num'] : 0;
    } else {
        echo "0";
    }

?>