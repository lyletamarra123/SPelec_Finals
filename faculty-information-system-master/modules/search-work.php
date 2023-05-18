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

$q = $_GET['q'];
$sql = "SELECT * FROM workHistory WHERE FacultyName LIKE :q LIMIT 4";
$stmt = $conn->prepare($sql);
$stmt->execute([':q' => '%' . $q . '%']);
$result = $stmt->fetchAll();
$rowCount = $stmt->rowCount();

if ($rowCount > 0) {
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['FacultyName'] . "</td>";
        echo "<td>" . $row['CompanyName'] . "</td>";
        echo "<td>" . $row['JobTitle'] . "</td>";
        echo "<td>" . $row['StartDate'] . "</td>";
        echo "<td>" . $row['EndDate'] . "</td>";
        echo "<td>" . $row['Description'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No faculty members found.</td></tr>";
}

$conn = null;
?>