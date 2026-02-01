<?php 
    include './db.php';

   
    $current_month = date('m');
    $current_year = date('Y');

   
    $sql_rooms_this_month = "SELECT SUM(rooms) as total_rooms
                             FROM bookings
                             WHERE (MONTH(checkin_date) = '$current_month' AND YEAR(checkin_date) = '$current_year')
                             OR (MONTH(checkout_date) = '$current_month' AND YEAR(checkout_date) = '$current_year')";

    $result_rooms_this_month = $connection->query($sql_rooms_this_month);

    if ($result_rooms_this_month->num_rows > 0) {
        $row_rooms_this_month = $result_rooms_this_month->fetch_assoc();
        echo $row_rooms_this_month['total_rooms'] ? $row_rooms_this_month['total_rooms'] : 0;
    } else {
        echo "0";
    }
?>
