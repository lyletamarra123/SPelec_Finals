<tr>
    <th>Course Code</th>
	<th>Course Name</th>
    <th>Taught By</th>
	<th>Department</th>
</tr>

<?php
session_start();
include_once('../includes/db_connect.php');

$q = $_GET['q'];
$sql = "SELECT * FROM courses WHERE FacultyName LIKE :q OR CourseCode LIKE :q OR CourseName LIKE :q LIMIT 4";
$stmt = $conn->prepare($sql);
$stmt->execute([':q' => '%' . $q . '%']);
$result = $stmt->fetchAll();
$rowCount = $stmt->rowCount();

if ($rowCount > 0) {
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['CourseCode'] . "</td>";
        echo "<td>" . $row['CourseName'] . "</td>";
        echo "<td>" . $row['FacultyName'] . "</td>";
        echo "<td>" . $row['Department'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No Course or faculty member found.</td></tr>";
}

$conn = null;
?>