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


if (isset($_GET['dashboard'])){
    include_once "dashboard.php";
}
elseif (isset($_GET['room_mang'])){
    include_once "room_mang.php";
}
elseif (isset($_GET['reservation'])){
    include_once "reservation.php";
}
elseif (isset($_GET['booking_calendar'])){
    include_once "booking_calendar.php";
}
elseif (isset($_GET['add_emp'])){
    include_once "add_emp.php";
}
elseif (isset($_GET['complain'])){
    include_once "complain.php";
}
elseif (isset($_GET['statistics'])){
    include_once "statistics.php";
}
elseif (isset($_GET['rooms_calendar'])){
    include_once "rooms_calendar.php";

}elseif(isset($_GET['reservationlist'])){
    include_once "reservationlist.php";
}
elseif(isset($_GET['edit_reservation'])){
    include_once "edit_reservation.php";
}
elseif(isset($_GET['canceled_reservations_list'])){
    include_once "canceled_reservations_list.php";
}
elseif(isset($_GET['history_reservation'])){
    include_once "history_reservation.php";
}
elseif(isset($_GET['tools'])){
    include_once "tools.php";
}
else{
    include_once "dashboard.php";
}

include_once "footer.php";