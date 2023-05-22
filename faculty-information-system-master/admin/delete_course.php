<?php

if (isset($_GET["CourseCode"])) {

    $CourseCode = $_GET["CourseCode"];
    require_once('../includes/db_connect.php');
    $sql = " DELETE FROM courses WHERE CourseCode = '$CourseCode'";
    $conn->query($sql);
 
  
}
header("Location: data_entry_management.php");
exit;

?>
