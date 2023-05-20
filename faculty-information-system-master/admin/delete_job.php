<?php

if (isset($_GET["job_type_id"])) {

    $job_type_id = $_GET["job_type_id"];
    require_once('../includes/info_db_connect.php');
    $sql = " DELETE FROM job_types WHERE job_type_id = $job_type_id";
    $conn->query($sql);

}

header("Location:data_entry_management.php");
exit;
