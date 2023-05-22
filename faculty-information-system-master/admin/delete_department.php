<?php

if (isset($_GET["DepartmentCode"])) {

    $DepartmentCode = $_GET["DepartmentCode"];
    require_once('../includes/db_connect.php');
    $sql = " DELETE FROM department WHERE DepartmentCode = '$DepartmentCode'";
    $conn->query($sql);
}

header("Location:data_entry_management.php");
exit;
