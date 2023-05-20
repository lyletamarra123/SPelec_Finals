<?php

if (isset($_GET["faculty_id"])) {

    $faculty_id = $_GET["faculty_id"];
    require_once('../includes/info_db_connect.php');
    $sql = " DELETE FROM faculty WHERE faculty_id = $faculty_id";
    $conn->query($sql);
 
  
}
header("Location: faculty_management.php");
exit;

?>
