<?php
require_once('../includes/db_connect.php');
if (isset($_GET["FacultyID"])) {

    
    $FacultyID = $_GET["FacultyID"];
    $sql = " DELETE FROM faculty WHERE FacultyID = '$FacultyID'";
    $conn->query($sql);
 
  
}
header("Location: faculty_management.php");
exit;

?>
