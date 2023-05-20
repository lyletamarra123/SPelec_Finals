<?php

if (isset($_GET["user_id"])) {

    $user_id = $_GET["user_id"];
    require_once('../includes/info_db_connect.php');
    $sql = " DELETE FROM users WHERE user_id = $user_id";
    $conn->query($sql);
 
  
}
header("Location: user_management.php");
exit;

?>
