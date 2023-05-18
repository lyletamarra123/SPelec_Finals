<?php
session_start();
include_once('../includes/db_connect.php');

$q = $_GET['q'];
$sql = "SELECT * FROM faculty WHERE FacultyName LIKE :q";
$stmt = $conn->prepare($sql);
$stmt->execute([':q' => '%' . $q . '%']);
$result = $stmt->fetchAll();
$rowCount = $stmt->rowCount();

if ($rowCount > 0) {
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['FacultyID'] . "</td>";
        echo "<td>" . $row['FacultyName'] . "</td>";
        echo "<td>" . $row['Position'] . "</td>";
        echo "<td>" . $row['Email'] . "</td>";
		echo "<td>" . $row['PhoneNumber'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No faculty members found.</td></tr>";
}

$conn = null;
?>