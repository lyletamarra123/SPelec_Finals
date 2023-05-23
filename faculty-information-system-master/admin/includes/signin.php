<?php
session_start();
class LoginManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function login($stno, $pwd)
    {
        if (empty($stno) || empty($pwd)) {
            header("Location: ../?error=empty");
            exit();
        } else {
            $sql = "SELECT * FROM staff WHERE StaffNo=:stno";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array(':stno' => $stno));
            $resulCheck = $stmt->rowCount();

            if ($resulCheck == 0) {
                header("Location: ../?error=missing");
                header("Location: ../index.php");
                exit();
            } else {
                if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $pwdCheck = $row['Password'];
                    if ($pwdCheck != $pwd) {
                        header("Location: ../?error=wrong");
                        exit();
                    } else {
                        $_SESSION['stno'] = $row['StaffNo'];
                        $_SESSION['lvl'] = $row['Level'];
                        header("Location: ../dashboard.php");
                    }
                }
            }
        }
    }
}

if (isset($_POST['submit'])) {
	include_once '../../includes/db_connect.php';
	$db = new DBConnect();
    $conn = $db->getConnection();
	
    $stno = $_POST['stno'];
    $pwd = $_POST['pwd'];

    $loginManager = new LoginManager($conn);
    $loginManager->login($stno, $pwd);
} else {
    header("Location: ../?error=access_denied");
    exit();
}