<tr>
    <th>Department Code</th>
	<th>Department Name</th>
    <th>Email</th>
	<th>Phone</th>
	<th>Location</th>
</tr>

<?php
session_start();
include_once('../includes/db_connect.php');
require_once('../OOPClasses/Department.php');

$db = new DBConnect();
$conn = $db->getConnection();

$department = new DepartmentSearch($conn);
$q = $_GET['q'];
$department->searchDepartments($q);
?>