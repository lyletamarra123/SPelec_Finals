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

$q = $_GET['q'];
$sql = "SELECT * FROM publications WHERE Author LIKE :q OR Title LIKE :q OR PublicationType LIKE :q LIMIT 4";
$stmt = $conn->prepare($sql);
$stmt->execute([':q' => '%' . $q . '%']);
$result = $stmt->fetchAll();
$rowCount = $stmt->rowCount();

if ($rowCount > 0) {
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['Title'] . "</td>";
        echo "<td>" . $row['PublicationType'] . "</td>";
        echo "<td>" . $row['PublicationDate'] . "</td>";
		echo "<td>" . $row['Author'] . "</td>";
		echo "<td>" . $row['AuthorType'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No title or author found.</td></tr>";
}

$conn = null;
?>