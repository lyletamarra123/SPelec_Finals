<?php
require('header.php');
require_once('../includes/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['stno'])) {
    header("Location: login.php");
    exit;
}

require_once('../OOPClasses/Department.php');
$db = new DBConnect();
$conn = $db->getConnection();
$departmentDelete = new DepartmentSearch($conn);

if (isset($_GET["DepartmentCode"])) {
    $DepartmentCode = $_GET["DepartmentCode"];
    $departmentDelete->deleteDepartment($DepartmentCode);
    header("Location: data_entry_management.php");
    exit;
}
?>