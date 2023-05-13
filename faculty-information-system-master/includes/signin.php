<?php
session_start();

if(isset($_POST['submit'])){
    include_once 'db_connect.php';

    $sno = $_POST['sno'];
    $pwd = $_POST['pwd'];

    if(empty($sno) || empty($pwd)){
        header("Location: ../?error=empty");
        exit();
    }else{
        $sql = "SELECT * FROM student WHERE StudentNo=:sno";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':sno', $sno);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $resulCheck = $stmt->rowCount();

        if($resulCheck == 0){
            header("Location: ../?error=missing");
            exit();
        }else{
            if($row){
                $pwdCheck = $row['Password'];
                if($pwdCheck!=$pwd){
                    header("Location: ../?error=wrong");
                    exit();
                }else{
                    $_SESSION['sno'] = $row['StudentNo'];
                    $_SESSION['sname'] = $row['StudentName'];
                    $_SESSION['cid'] = $row['CourseId'];
                    $_SESSION['ayear'] = $row['AcYear'];
                    header("Location: ../home.php");
                }
            }
        }
    }

}else {
    header("Location: ../");
    exit();
}
?>
