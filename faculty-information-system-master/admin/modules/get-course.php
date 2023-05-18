<?php
session_start();
include_once('../../includes/db_connect.php');
$q = $_GET['q'];
$sql = "SELECT * FROM course WHERE (CourseId LIKE :q OR CourseName LIKE :q) ORDER BY CourseId LIMIT 5";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':q', '%' . $q . '%');
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$resulCheck = count($result);

if($q == ''){
    $sql = "SELECT DISTINCT * FROM course ORDER BY RAND() LIMIT 5";
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if(($resulCheck)>0){
    foreach($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['CourseId'] . "</td>";
        echo "<td>" . $row['CourseName'] . "</td></tr>";
    }
}
?>