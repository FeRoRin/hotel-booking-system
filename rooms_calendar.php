<?php
include_once "db.php";


session_start();
if (isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $userQuery = "SELECT * FROM user WHERE id = '$user_id'";
    $result = mysqli_query($connection, $userQuery);
    $user = mysqli_fetch_assoc($result);
}else{
    header('Location:login.php');
}
include_once "header.php";
include_once "sidebar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Calendar</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
        .fc-event {
            font-size: 14px;
            padding: 5px;
        }
        .fc-day-grid-event .fc-content {
            white-space: normal !important;
        }
    </style>
</head>
<body>



<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
        <li><a href="index.php"><em class="fa fa-home"></em></a></li>
            <li class="active">Booking Calendar</li>
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
                <div class="panel-heading">Booking Calendar</div>
                <div class="panel-body">
                    <div class="container mt-5">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <p class="back-link">Developed By Firdaouss</p>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#calendar').fullCalendar({
        events: 'get_room_availability.php',
        eventClick: function(event) {
            var bookingDetails = '';
            var mikunum = 1;
           // $('#customerModal').modal('show'); 
            event.bookings.forEach(function(booking) {
                bookingDetails += ' BOOKING '+ mikunum + ' = \n Customer Name:  ' + booking.customer_name + ' ';
                bookingDetails += ', Check-in Date:  ' + booking.checkin_date + ' ';
                bookingDetails += ', Check-out Date:  ' + booking.checkout_date + ' ';
                bookingDetails += ', Rooms:  ' + booking.rooms + ', Room Type : ' +booking.room_type + '\n';
                mikunum++;
            });
            alert(bookingDetails);
        },
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: false,
        eventLimit: true,
        eventRender: function(event, element) {
            element.qtip({
                content: event.title,
                position: {
                    my: 'bottom center',
                    at: 'top center'
                },
                style: {
                    classes: 'qtip-bootstrap'
                }
            });
        }
    });
});
</script>





<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/jquery.qtip.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/jquery.qtip.min.js"></script>

</body>
</html>
