<tr>
    <th>Faculty Name</th>
	<th>Degree/s</th>
    <th>Date Attained</th>
	<th>Institution</th>
</tr>

<?php
session_start();
include_once('../includes/db_connect.php');

$q = $_GET['q'];
$sql = "SELECT * FROM degrees WHERE FacultyName LIKE :q LIMIT 4";
$stmt = $conn->prepare($sql);
$stmt->execute([':q' => '%' . $q . '%']);
$result = $stmt->fetchAll();
$rowCount = $stmt->rowCount();

if ($rowCount > 0) {
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['FacultyName'] . "</td>";
        echo "<td>" . $row['Degree'] . "</td>";
        echo "<td>" . $row['DateAttained'] . "</td>";
		echo "<td>" . $row['Institution'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No faculty member found.</td></tr>";
}

$conn = null;
?>