<?php 
    include './db.php';

   
    $current_date = date('Y-m-d');

    //room_count
    $sql_total_rooms = "SELECT room_count FROM room_count WHERE id = 1";
    $result_total_rooms = $connection->query($sql_total_rooms);

    if ($result_total_rooms->num_rows > 0) {
        $row_total_rooms = $result_total_rooms->fetch_assoc();
        $total_rooms = $row_total_rooms['room_count'];
    } else {
        echo "Error: Could not retrieve total rooms.";
        exit();
    }

    // bookings
    $sql_booked_rooms = "SELECT SUM(rooms) as booked_rooms
                         FROM bookings
                         WHERE checkin_date <= '$current_date'
                         AND checkout_date >= '$current_date'";
    $result_booked_rooms = $connection->query($sql_booked_rooms);

    if ($result_booked_rooms->num_rows > 0) {
        $row_booked_rooms = $result_booked_rooms->fetch_assoc();
        $booked_rooms = $row_booked_rooms['booked_rooms'] ? $row_booked_rooms['booked_rooms'] : 0;
    } else {
        $booked_rooms = 0;
    }

    // available_rooms
    $available_rooms = $total_rooms - $booked_rooms;
    echo $available_rooms;
?>
