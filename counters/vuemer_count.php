<?php 
include './db.php';

$sql = "SELECT sum(rooms) as num_rooms FROM bookings WHERE room_type = 'Vue Mer' and checkout_date >= CURDATE() ";
$result = $connection->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $numRooms = $row['num_rooms'];
    echo  $numRooms? $numRooms : 0;
} else {
    echo "Error " . $connection->error;
}

$connection->close();
?>