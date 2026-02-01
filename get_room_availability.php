<?php
include_once "db.php";

// استرجاع جميع الحجوزات
$query = "SELECT checkin_date, checkout_date, rooms, customer_name, room_type
          FROM bookings";

$result = mysqli_query($connection, $query);

if ($result) {
    $room_availability = array();
    $bookings = array();
    $vuemer_availability = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $checkin_date = strtotime($row['checkin_date']);
        $checkout_date = strtotime($row['checkout_date']);

        for ($date = $checkin_date; $date <= $checkout_date; $date = strtotime('+1 day', $date)) {
            $date_key = date('Y-m-d', $date);

            if (!isset($room_availability[$date_key])) {
                $room_availability[$date_key] = 0;
            }

            $room_availability[$date_key] += $row['rooms'];
            
            if ($row['room_type'] == 'Vue Mer') {
                if (!isset($vuemer_availability[$date_key])) {
                    $vuemer_availability[$date_key] = 0;
                }
                $vuemer_availability[$date_key] += $row['rooms'];
            }

            if (!isset($bookings[$date_key])) {
                $bookings[$date_key] = array();
            }

            $bookings[$date_key][] = array(
                'customer_name' => $row['customer_name'],
                'checkin_date' => $row['checkin_date'],
                'checkout_date' => $row['checkout_date'],
                'rooms' => $row['rooms'],
                'room_type' => $row['room_type']
            );
        }
    }

    $events = array();
    foreach ($room_availability as $date => $total_rooms) {
        $vuemer_rooms = isset($vuemer_availability[$date]) ? $vuemer_availability[$date] : 0;
        $events[] = array(
            'title' => $total_rooms . ' Room(s) Booked - ' . $vuemer_rooms . ' Sea View',
            'start' => $date,
            'allDay' => true,
            'color' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
            'bookings' => isset($bookings[$date]) ? $bookings[$date] : array()
        );
    }

    echo json_encode($events);
} else {
    echo json_encode(array());
}

mysqli_close($connection);
?>
