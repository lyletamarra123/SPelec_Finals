<?php
session_start();
include_once '../../includes/db_connect.php';

if(isset($_POST['submit'])){
	
	$stno = $_POST['stno'];
	$pwd = $_POST['pwd'];

	if(empty($stno) || empty($pwd)){
		header("Location: ../?error=empty");
		exit();
	}else{
		$sql = "SELECT * FROM staff WHERE StaffNo=:stno";
		$stmt = $conn->prepare($sql);
		$stmt->execute(array(':stno' => $stno));
		$resulCheck = $stmt->rowCount();

		if($resulCheck == 0){
			header("Location: ../?error=missing");
			exit();
		}else{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$pwdCheck = $row['Password'];
				if($pwdCheck != $pwd){
					header("Location: ../?error=wrong");
					exit();
				}else{
					$_SESSION['stno'] = $row['StaffNo'];
					$_SESSION['lvl'] = $row['Level'];
					header("Location: ../dashboard.php");
				}
			}
		}
	}

}else {
	header("Location: ../?error=access_denied");
	exit();
}
?>