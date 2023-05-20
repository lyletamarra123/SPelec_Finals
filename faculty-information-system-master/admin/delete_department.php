<?php

if (isset($_GET["department_id"])) {

    $department_id = $_GET["department_id"];
    require_once('../includes/info_db_connect.php');
    $sql = " DELETE FROM departments WHERE department_id = $department_id";
    $conn->query($sql);
}

header("Location:data_entry_management.php");
exit;
