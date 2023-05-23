<?php
require('header.php');
require_once('../includes/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['stno'])) {
    header("Location: login.php");
    exit;
}

require_once('../OOPClasses/Faculty.php');
$db = new DBConnect();
$conn = $db->getConnection();
$facultyDelete = new Faculty($conn);

if (isset($_GET['FacultyID'])) {
    $facultyID = $_GET["FacultyID"];
    $facultyDelete->deleteFaculty($facultyID);
    header("Location: faculty_management.php");
    exit;
}
?>
