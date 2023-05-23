<?php
require('header.php');
require_once('../includes/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['stno'])) {
    header("Location: login.php");
    exit;
}

require_once('../OOPClasses/Course.php');
$db = new DBConnect();
$conn = $db->getConnection();
$courseDelete = new CourseSearch($conn);

if (isset($_GET["CourseCode"])) {
    $CourseCode = $_GET["CourseCode"];
    $courseDelete->deleteCourse($CourseCode);
    header("Location: data_entry_management.php");
    exit;
}
?>