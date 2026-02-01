
<?php
include_once 'db.php';

// استرجاع جميع الحجوزات
$query = "SELECT * FROM bookings";
$result = mysqli_query($connection, $query);

$bookings = [];
$colors = ['#2E8B57', '#4682B4', '#6A5ACD', '#8B4513', '#556B2F', '#8B0000', '#00008B'];

$colorIndex = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $bookings[] = [
        'id' => $row['booking_id'],
        'rooms' => $row['rooms'],
        'room_type' => $row['room_type'],
        'title' => $row['customer_name'] . ' ==> ' . $row['rooms'] . ' Room(s) Booked - ' . $row['room_type'],
        'start' => $row['checkin_date'],
        'end' => date('Y-m-d', strtotime($row['checkout_date'] . ' +1 day')),
        'color' => $colors[$colorIndex % count($colors)]
    ];
    $colorIndex++;
}

echo json_encode($bookings);

mysqli_close($connection);
?>
