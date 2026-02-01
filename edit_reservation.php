<?php
include_once 'db.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_GET['booking_id'])) {
    header('Location: index.php');
    exit();
}

$booking_id = $_GET['booking_id'];

$query = "SELECT * FROM bookings WHERE booking_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Booking not found.";
    exit();
}

$booking = $result->fetch_assoc();

// Fetch booking types for dropdown
$booking_types_query = "SELECT id, type_name FROM booking_types";
$booking_types_result = mysqli_query($connection, $booking_types_query);
$booking_types = [];
if (mysqli_num_rows($booking_types_result) > 0) {
    while ($row = mysqli_fetch_assoc($booking_types_result)) {
        $booking_types[] = $row;
    }
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission for updating booking
    $customer_name = !empty($_POST['customer_name']) ? $_POST['customer_name'] : 'null';
    $contact_no = !empty($_POST['contact_no']) ? $_POST['contact_no'] : '0000';
    $email = !empty($_POST['email']) ? $_POST['email'] : 'null@null.nullcom';
    $id_card = !empty($_POST['id_card']) ? $_POST['id_card'] : 'null';
    $address = !empty($_POST['address']) ? $_POST['address'] : 'null';
    $checkin_date = $_POST['checkin_date'];
    $checkout_date = $_POST['checkout_date'];
    $rooms = $_POST['room_s'];
    $guests = $_POST['guest_s'];
    $note = !empty($_POST['note']) ? $_POST['note'] : 'null';
    $room_type = $_POST['room_type'];
    $booking_type_id = $_POST['booking_type_id'];
    $booking_date = $booking['booking_date'];


    // check max rooms 150
$start = new DateTime($checkin_date);
$end = new DateTime($checkout_date);
$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($start, $interval, $end);

$value_rooms=true;
$total_rooms_booked = 0;
$allowed_rooms_per_day = 150;
foreach ($period as $date) {
    $check_date = $date->format('Y-m-d');

    $queryroom = "SELECT SUM(rooms) AS total_rooms
                  FROM bookings
                  WHERE checkin_date <= ? AND checkout_date >= ?";

    $stmty = $connection->prepare($queryroom);
    $stmty->bind_param("ss", $check_date, $check_date);
    $stmty->execute();
    $resulty = $stmty->get_result();
    $rowy = $resulty->fetch_assoc();
    $total_rooms_booked += $rowy['total_rooms'] ?? 0;
    if( $total_rooms_booked + $rooms >$allowed_rooms_per_day)
    {
        $value_rooms = false;
    }
    $total_rooms_booked = 0;
    $stmty->close();
}



// 
if ($value_rooms == false ) {
        $message = "The maximum number of rooms allowed on this day has been exceeded!!!";
        //echo '<script>alert("'.$message.'")</script>'; 
        echo '<script>alert("' .$message. '"); window.location.href = "index.php?edit_reservation&booking_id='.$booking_id.'";</script>';
        $stmty->close();
        $connection->close();
       
    } else {
    $query = "UPDATE bookings 
              SET customer_name = ?, contact_no = ?, email = ?, id_card = ?, address = ?, 
                  checkin_date = ?, checkout_date = ?, rooms = ?, guests = ?, 
                  note = ?, room_type = ?, booking_type_id = ?, booking_date = ?
              WHERE booking_id = ?";

    $stmt = $connection->prepare($query);
    $stmt->bind_param("sssssssiissisi", $customer_name, $contact_no, $email, $id_card, $address, 
                      $checkin_date, $checkout_date, $rooms, $guests, $note, $room_type, $booking_type_id, $booking_date, $booking_id);

    if ($stmt->execute()) {
        $message = 'Booking updated successfully!';
    } else {
        $message = 'Error updating booking: ' . $stmt->error;
    }

    $stmt->close();
    $connection->close();
    header('Location: index.php?reservationlist');
}
}
$connection->close();

?>


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><em class="fa fa-home"></em></a></li>
            <li class="active">Edit Reservation</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="container">
            <h2>Edit Booking</h2>
            <form id="bookingForm" method="post" action="edit_reservation.php?booking_id=<?php echo $booking_id; ?>">
                <div class="panel panel-default">
                <div class="panel-heading">Booking Information (ID: <?php echo $booking_id ?>)</div>
                    <div class="panel-body">
                        <?php if (!empty($message)): ?>
                            <div class="alert alert-info"><?php echo $message; ?></div>
                        <?php endif; ?>
                        
                        <!-- Customer Information Fields -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="customer_name">Customer Name *</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo htmlspecialchars($booking['customer_name']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_no">Contact Number</label>
                                <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?php echo htmlspecialchars($booking['contact_no']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($booking['email']); ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_card">ID Card Number</label>
                                <input type="text" class="form-control" id="id_card" name="id_card" value="<?php echo htmlspecialchars($booking['id_card']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="guest_s">Number of Guests *</label>
                                <input type="number" class="form-control" id="guest_s" name="guest_s" min="1" value="<?php echo htmlspecialchars($booking['guests']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="room_s">Number of Rooms *</label>
                                <input type="number" class="form-control" id="room_s" name="room_s" min="1" value="<?php echo htmlspecialchars($booking['rooms']); ?>" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="checkin_date">Check-in Date *</label>
                                <input type="date" class="form-control" id="checkin_date" name="checkin_date" value="<?php echo $booking['checkin_date']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="checkout_date">Check-out Date *</label>
                                <input type="date" class="form-control" id="checkout_date" name="checkout_date" value="<?php echo $booking['checkout_date']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Residential Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($booking['address']); ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="note">Note</label>
                                <input type="text" class="form-control" id="note" name="note" value="<?php echo htmlspecialchars($booking['note']); ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="room_type">Room Type *</label>
                                <select class="form-control" id="room_type" name="room_type" required>
                                    <option value="Standard" <?php echo ($booking['room_type'] == 'Standard') ? 'selected' : ''; ?>>Standard</option>
                                    <option value="Vue Mer" <?php echo ($booking['room_type'] == 'Vue Mer') ? 'selected' : ''; ?>>Vue Mer</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="booking_type_id">Booking Type *</label>
                                <select class="form-control" id="booking_type_id" name="booking_type_id" required>
                                    <?php foreach ($booking_types as $type): ?>
                                        <option value="<?php echo $type['id']; ?>" <?php echo ($type['id'] == $booking['booking_type_id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($type['type_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </div><!--/.panel-body-->
                </div><!--/.panel-->

                <button type="submit" class="btn btn-primary">Update Booking</button>
            </form>
        </div><!--/.container-->

   


<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const checkinDateInput = document.getElementById('checkin_date');
    const checkoutDateInput = document.getElementById('checkout_date');

    function validateDates() {
        const checkinDate = new Date(checkinDateInput.value);
        const checkoutDate = new Date(checkoutDateInput.value);

        if (checkoutDate < checkinDate) {
            checkoutDateInput.setCustomValidity('Check-out date must be after check-in date.');
        } else {
            checkoutDateInput.setCustomValidity('');
        }
    }

    checkinDateInput.addEventListener('change', validateDates);
    checkoutDateInput.addEventListener('change', validateDates);
});
</script>


    </div>

    <div class="row">
        <div class="col-sm-12">
            <p class="back-link">Developed By Firdaouss</p>
        </div>
    </div>

</div>   

             

     

  