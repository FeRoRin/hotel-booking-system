<?php 
    include './db.php';
     
     $current_date = date('Y-m-d');

     // 
     $sql_checkins_today = "SELECT COUNT(*) as checkins_today
                            FROM bookings
                            WHERE checkin_date = '$current_date'";
 
     $result_checkins_today = $connection->query($sql_checkins_today);
 
     if ($result_checkins_today->num_rows > 0) {
         $row_checkins_today = $result_checkins_today->fetch_assoc();
         echo $row_checkins_today['checkins_today'];
     } else {
         echo "0";
     }

?>