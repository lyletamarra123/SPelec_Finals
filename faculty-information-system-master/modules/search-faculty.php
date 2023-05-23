<tr>
    <th>Faculty ID</th>
    <th>Faculty Name</th>
    <th>Position</th>
    <th>Department</th>
	<th>Email</th>
	<th>PhoneNumber</th>
</tr>

<?php
    session_start();
    include_once('../includes/db_connect.php');
    require_once('../OOPClasses/Faculty.php');

    $db = new DBConnect();
    $conn = $db->getConnection();

    $faculty = new Faculty($conn);
    $q = $_GET['q'];
    $faculty->searchFaculty($q);
?>