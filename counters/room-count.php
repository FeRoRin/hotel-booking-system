<?php 
include './db.php';


$sql = "SELECT room_count FROM room_count WHERE id = 1"; 

$query = $connection->query($sql);

if ($query->num_rows > 0) {
    $row = $query->fetch_assoc();
    echo $row['room_count'] ? $row['room_count'] : 0;
} else {
    echo "0";
}

?>