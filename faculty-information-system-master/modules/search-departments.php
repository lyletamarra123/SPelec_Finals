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

$q = $_GET['q'];
$sql = "SELECT * FROM department WHERE DepartmentCode LIKE :q OR DepartmentName LIKE :q OR Location LIKE :q LIMIT 4";
$stmt = $conn->prepare($sql);
$stmt->execute([':q' => '%' . $q . '%']);
$result = $stmt->fetchAll();
$rowCount = $stmt->rowCount();

if ($rowCount > 0) {
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['DepartmentCode'] . "</td>";
        echo "<td>" . $row['DepartmentName'] . "</td>";
        echo "<td>" . $row['Email'] . "</td>";
        echo "<td>" . $row['Phone'] . "</td>";
        echo "<td>" . $row['Location'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No title or author found.</td></tr>";
}

$conn = null;
?>