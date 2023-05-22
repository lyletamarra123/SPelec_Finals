
<?php

if (isset($_GET["office_id"])) {

    $office_id = $_GET["office_id"];
    require_once('../includes/info_db_connect.php');
    $sql = " DELETE FROM offices WHERE office_id = $office_id";
    $conn->query($sql);
}

header("Location:data_entry_management.php");
exit;
