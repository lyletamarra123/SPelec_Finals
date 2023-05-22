<?php

if (isset($_GET["Title"])) {
    
    $Title = $_GET["Title"];
    require_once('../includes/db_connect.php');
    $sql = " DELETE FROM publications WHERE Title = '$Title'";
    $conn->query($sql);
}
header("Location: data_entry_management.php");
exit;

?>
