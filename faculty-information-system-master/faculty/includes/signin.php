<?php
session_start();
class LoginManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function login($username, $password)
    {
        if (empty($username) || empty($password)) {
            header("Location: ../?error=empty");
            exit();
        } else {
            $sql = "SELECT * FROM users WHERE username=:username";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array(':username' => $username));
            $resulCheck = $stmt->rowCount();

            if ($resulCheck == 0) {
                header("Location: ../?error=missing");
                header("Location: ../index.php");
                exit();
            } else {
                if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $pwdCheck = $row['password'];
                    if ($pwdCheck != $password) {
                        header("Location: ../?error=wrong");
                        exit();
                    } else {
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['lvl'] = $row['Level'];
                        header("Location: ../dashboard.php");
                    }
                }
            }
        }
    }
}

if (isset($_POST['submit'])) {
	include_once '../../includes/info_db_connect.php';
	$db = new DBConnectInfo();
    $conn = $db->getConnection();
	
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginManager = new LoginManager($conn);
    $loginManager->login($username, $password);
} else {
    header("Location: ../?error=access_denied");
    exit();
}