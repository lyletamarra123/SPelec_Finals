<?php

if (isset($_GET["publication_id"])) {
    
    $publication_id = $_GET["publication_id"];
    require_once('../includes/info_db_connect.php');
    $sql = " DELETE FROM publications WHERE publication_id = $publication_id";
    $conn->query($sql);
}
header("Location: data_entry_management.php");
exit;

?>
