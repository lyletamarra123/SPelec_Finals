<tr>
    <th>Faculty Name</th>
	<th>GrantsAwards</th>
    <th>Date Attained</th>
</tr>

<?php
session_start();
include_once('../includes/db_connect.php');
require_once('../OOPClasses/Awards.php');

$db = new DBConnect();
$conn = $db->getConnection();

$awardSearch = new GrantsAwards($conn);
$q = $_GET['q'];
$awardSearch->searchGrantsAwards($q);
?>