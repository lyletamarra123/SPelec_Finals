<tr>
    <th>Faculty Name</th>
	<th>Degree/s</th>
    <th>Date Attained</th>
	<th>Institution</th>
</tr>

<?php
require_once('../includes/db_connect.php');
require_once('../OOPClasses/Degree.php');

$db = new DBConnect();
$conn = $db->getConnection();
$q = $_GET['q'];

$degreeSearch = new Degree($conn);
$degreeSearch->searchDegrees($q);
?>