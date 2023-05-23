<tr>
    <th>Title</th>
	<th>Publication Type</th>
    <th>Published Date</th>
	<th>Author/s</th>
	<th>Author Type</th>
</tr>

<?php
session_start();
include_once('../includes/db_connect.php');
require_once('../OOPClasses/Publications.php');

$db = new DBConnect();
$conn = $db->getConnection();

$publicationSearch = new Publication($conn);
$q = $_GET['q'];
$publicationSearch->searchPublications($q);
?>