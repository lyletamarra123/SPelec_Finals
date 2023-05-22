<?php
    session_start();
    include_once('../includes/db_connect.php');
    $q = $_GET['q'];
    $sql="SELECT * FROM subject WHERE CourseId=:cid AND (SubjectName LIKE :q OR SubjectCode LIKE :q) ORDER BY SubjectCode LIMIT 5" ;
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':cid' => $_SESSION['cid'], ':q' => '%'.$q.'%'));
    $result = $stmt->fetchAll();
    $resulCheck = count($result);
    if($q == ''){
        $sql = "SELECT * FROM subject WHERE CourseId=:cid ORDER BY RAND() LIMIT 5";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':cid' => $_SESSION['cid']));
        $result = $stmt->fetchAll();
    }
    if(($resulCheck)>0){
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['SubjectCode'] . "</td>";
            echo "<td>" . $row['SubjectName'] . "<i class='fa fa-file-download'></i>";
            echo "</td></tr>";
        }
    }
    $conn = null;
?>