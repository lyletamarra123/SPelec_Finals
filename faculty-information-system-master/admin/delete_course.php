<?php

if (isset($_GET["course_id"])) {

    $course_id = $_GET["course_id"];
    require_once('../includes/info_db_connect.php');
    $sql = " DELETE FROM courses WHERE course_id = $course_id";
    $conn->query($sql);
 
  
}
header("Location: data_entry_management.php");
exit;

?>
