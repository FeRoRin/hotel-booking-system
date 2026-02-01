<?php
/**
 * Created by firdaouss.
 * User: fero
 * Date: 2024/6/30
 * Time: 09:07 PM
 


*/


session_start();
session_unset(); 
session_destroy(); 
header('Location: login.php');
exit();
?>