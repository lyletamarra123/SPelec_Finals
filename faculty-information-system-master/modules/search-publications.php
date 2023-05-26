<tr>
    <th>Publication ID</th>
	<th>Title</th>
    <th>Publication Type</th>
	<th>Date Published</th>
	<th>Author</th>
</tr>

<?php
session_start();
include_once('../includes/info_db_connect.php');
require_once('../faculty/class/Publications.php');

$db = new DBConnectInfo();
$conn = $db->getConnection();

$publicationSearch = new Publications(null, null, null, null);
$q = $_GET['q'];
$publicationSearch->searchPublications($conn, $q);
?>
