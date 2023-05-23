<tr>
    <th>Faculty Name</th>
	<th>Company Name</th>
    <th>Job Title</th>
	<th>Start Date</th>
	<th>End Date</th>
	<th>Description</th>
</tr>

<?php
    session_start();
    include_once('../includes/db_connect.php');
    require_once('../OOPClasses/Work.php');

    $db = new DBConnect();
    $conn = $db->getConnection();

    $faculty = new WorkHistory($conn);
    $q = $_GET['q'];
    $faculty->searchFaculty($q);
?>