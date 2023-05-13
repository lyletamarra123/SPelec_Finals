<?php 
    session_start();
    include_once('../includes/db_connect.php');

    $sem_gpa_sum = 0.0;
    $sem_credit_sum = 0;
    $q = $_GET['q'];  
    $sql = "SELECT * FROM marks INNER JOIN subject ON subject.SubjectCode=marks.SubjectId WHERE marks.CourseId=:cid AND marks.StudentNo=:sno AND marks.Year=:ayear AND marks.Semester=:semester ORDER BY marks.SubjectId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cid', $_SESSION['cid']);
    $stmt->bindParam(':sno', $_SESSION['sno']);
    $stmt->bindParam(':ayear', $_SESSION['ayear']);
    $stmt->bindParam(':semester', $q);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $resulCheck = count($result);
    if($resulCheck>0){
        
        echo "<tr><th>Code</th><th>Name</th><th>Credits</th><th>Results</th></tr>";
        foreach($result as $row)
        {
            $credit = substr($row['SubjectId'], -1);
            if($row['Marks'])$sem_credit_sum +=$credit;
            echo "<tr>";
            echo "<td>" . $row['SubjectId'] . "</td>";
            echo "<td>" . $row['SubjectName']."</td>";
            echo "<td>" . $credit ."</td>";
            echo "<td>". getGrade($row['Marks'],$credit) ."</td>";
            echo "</tr>";
        }
        echo "<tr><td colspan='3'><h3>GPA of the Semester</h3></td><td><h3>" . round($sem_gpa_sum/$sem_credit_sum,2). "</h3></td></tr>";
    }

    function getGrade($m,$c){
        global $sem_gpa_sum;
        if($m>84){
            $sem_gpa_sum += 4.0*$c;
            return 'A+';
        }elseif($m>69){
            $sem_gpa_sum += 4.0*$c;
            return 'A';
        }elseif($m>64){
            $sem_gpa_sum += 3.7*$c;
            return 'A-';
        }elseif($m>59){
            $sem_gpa_sum += 3.3*$c;
            return 'B+';
        }elseif($m>54){
            $sem_gpa_sum += 3.0*$c ;
            return 'B';
        }elseif($m>49){
            $sem_gpa_sum += 2.7*$c ;
            return 'B-';
        }elseif($m>44){
            $sem_gpa_sum += 2.3*$c ;
            return 'C+';
        }elseif($m>39){
            $sem_gpa_sum += 2.0*$c ;
            return 'C';
        }elseif($m>34){
            $sem_gpa_sum += 1.7*$c ;
            return 'C-';
        }elseif($m>29){
            $sem_gpa_sum += 1.3*$c ;
            return 'D+';
        }elseif($m>24){
            $sem_gpa_sum += 1.0*$c ;
            return 'D';
        }elseif($m>0){
            $sem_gpa_sum += 0.0*$c ;
            return 'E';
        }else{
            return '-';
        }     
    }
    $conn = null;



