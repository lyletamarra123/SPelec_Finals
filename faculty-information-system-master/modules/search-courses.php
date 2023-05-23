<tr>
    <th>Course Code</th>
	<th>Course Name</th>
    <th>Taught By</th>
	<th>Department</th>
</tr>

<?php
session_start();
include_once('../includes/db_connect.php');
require_once('../OOPClasses/Course.php');

$db = new DBConnect();
$conn = $db->getConnection();

$courses = new CourseSearch($conn);
$q = $_GET['q'];
$courses->searchCourses($q);
?>