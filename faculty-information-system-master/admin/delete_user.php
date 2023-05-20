<?php
if (isset($_GET["userid"])) {
    $userid = $_GET["userid"];
    require_once('../includes/info_db_connect.php');
    $sql = "DELETE FROM User WHERE userid = $userid";
    $conn->query($sql);
}

header("Location: user_management.php");
exit;
?>