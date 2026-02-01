<?php
include_once 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$query = "SELECT cancelled_bookings.*, booking_types.type_name 
          FROM cancelled_bookings
          LEFT JOIN booking_types ON cancelled_bookings.booking_type_id = booking_types.id 
          
          ORDER BY booking_date DESC";


$result = mysqli_query($connection, $query);

$bookings = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bookings[] = $row;
    }
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
        <li><a href="index.php">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">List of canceled Bookings</li>
        </ol>
    </div><!--/.row-->

    <br>

    <div class="row">
        <div class="col-lg-12">
            <div id="success"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">List of canceled Bookings
                <form method="post" action="" style="display:inline;">
    <!--button type="submit" name="download_pdf" class="btn btn-secondary  pull-right">Download PDF</button-->
</form>
                <button class="btn btn-secondary pull-right clear-all-canceled-booking" style="border-radius:0%" data-toggle="modal" data-target="#addRoom">Clear All Items</button>
                </div>
                <div class="panel-body">
                
                <div class="container mt-5">
                    <table id="bookingsTable" class="table table-bordered">
                        <thead>
                        <tr>
                <th>Customer Name</th>
                <th>Booking Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Nbre Guests</th>
                <th>Nbre Rooms</th>
                <th>Room Type</th>
                <th>Booking Type</th>
                <th>Note</th>
                
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($bookings) > 0): ?>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                    <td><a href="#" class="booking-link" data-booking-id="<?php echo $booking['booking_id']; ?>"><?php echo $booking['customer_name']; ?></a></td>

                    <td><?php echo $booking['booking_date']; ?></td>
                        <td><?php echo $booking['checkin_date']; ?></td>
                        <td><?php echo $booking['checkout_date']; ?></td>
                        <td><?php echo $booking['guests']; ?></td>
                        <td><?php echo $booking['rooms']; ?></td>
                        <td><?php echo $booking['room_type']; ?></td>
                        <td><?php echo $booking['type_name']; ?></td>
                        <td><?php echo $booking['note']; ?></td>
                        <!--td><a href="index.php?edit_reservation&booking_id=<--?php echo $booking['booking_id']; ?>" class="btn btn-primary btn-sm">Edit</a></td-->

                        <td><button class="btn btn-danger btn-sm delete-booking" data-booking-id="<?php echo $booking['booking_id']; ?>">Delete</button></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No bookings found.</td>
                </tr>
            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


$(document).ready(function() {
    $('.booking-link').click(function(e) {
        e.preventDefault();

        var bookingId = $(this).data('booking-id');
        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            data: { canceledBookingDetails: true, booking_id: bookingId },
            dataType: 'json',
            success: function(response) {
                if (response.done) {
                    $('#customer-name').text('Name: ' + response.customer_name);
                    $('#customer-contact').text('Contact: ' + response.contact_no);
                    $('#customer-email').text('Email: ' + response.email);
                    $('#customer-id-card').text('ID Card: ' + response.id_card);
                    $('#customer-address').text('Address: ' + response.address);
                    $('#checkin-date').text('Check-in Date: ' + response.checkin_date);
                    $('#checkout-date').text('Check-out Date: ' + response.checkout_date);
                    $('#room_s').text('Number of Rooms: ' + response.rooms);
                    $('#guest_s').text('Number of Guests: ' + response.guests);
                    $('#booking-date').text('Booking Date: ' + response.booking_date);
                    $('#room_type').text('Room Type: ' + response.room_type);
                    $('#type_name').text('Booking Type: ' + response.type_name);
                    $('#note').text('Note: ' + response.note);
                    $('#customerModal').modal('show'); // Show Bootstrap Modal
                } else {
                    alert('Error fetching customer details.');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert('Error: ' + error);
            }
        });
    });
});
</script>

<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerModalLabel">Booking infomation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="customer-name"></p>
                <p id="customer-contact"></p>
                <p id="customer-email"></p>
                <p id="customer-id-card"></p>
                <p id="customer-address"></p>
                <p id="checkin-date"></p>
                <p id="checkout-date"></p>
                <p id="room_s"></p>
                <p id="guest_s"></p>
                <p id="room_type"></p>
                <p id="type_name"></p>
                <p id="booking-date"></p>
                <p id="note"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
   
   $(document).ready(function() {
 
    if (!$.fn.DataTable.isDataTable('#bookingsTable')) {
        $('#bookingsTable').DataTable({
            "order": []
        });
    }

   
    $(document).on('click', '.delete-booking', function(e) {
        e.preventDefault();
        var bookingId = $(this).data('booking-id');
        if (confirm('Are you sure you want to Delete this booking?')) {
            $.ajax({
                url: 'ajax.php',
                method: 'POST',
                data: { canceled_delete_booking: true, booking_id: bookingId },
                success: function(response) {
                    alert(response);
                    window.location.href = "index.php?canceled_reservations_list";
                    //header("Refresh:0");
                    //header("Location: index.php?reservationlist")
                    //row.remove();
                    //$('#bookingsTable').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error cancelling booking.');
                }
            });
        }
    });

//clear-all-canceled-booking
$(document).on('click', '.clear-all-canceled-booking', function(e) {
        e.preventDefault();
        var bookingId = $(this).data('booking-id');
        if (confirm('Are you sure you want to clear all this Booking list ?')) {
            $.ajax({
                url: 'ajax.php',
                method: 'POST',
                data: { clear_all_canceled_booking: true},
                success: function(response) {
                    alert(response);
                    window.location.href = "index.php?canceled_reservations_list";
                    //header("Refresh:0");
                    //header("Location: index.php?reservationlist")
                    //row.remove();
                    //$('#bookingsTable').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error cancelling booking.');
                }
            });
        }
    });


});




    </script>



    <div class="row">
        <div class="col-sm-12">
        <p class="back-link">Developed By Firdaouss</p>
        </div>
    </div>

</div>    



