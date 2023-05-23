<?php
session_start();

class Authentication {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function authenticate($sno, $pwd) {
        if (empty($sno) || empty($pwd)) {
            header("Location: ../?error=empty");
            exit();
        } else {
            $sql = "SELECT * FROM student WHERE StudentNo=:sno";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':sno', $sno);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $resulCheck = $stmt->rowCount();

            if ($resulCheck == 0) {
                header("Location: ../?error=missing");
                exit();
            } else {
                if ($row) {
                    $pwdCheck = $row['Password'];
                    if ($pwdCheck != $pwd) {
                        header("Location: ../?error=wrong");
                        exit();
                    } else {
                        $_SESSION['sno'] = $row['StudentNo'];
                        header("Location: ../home.php");
                    }
                }
            }
        }
    }
}

if (isset($_POST['submit'])) {
    include_once 'db_connect.php';
    $db = new DBConnect();
    $conn = $db->getConnection();

    $sno = $_POST['sno'];
    $pwd = $_POST['pwd'];

    $authentication = new Authentication($conn);
    $authentication->authenticate($sno, $pwd);
} else {
    header("Location: ../index.php");
    exit();
}
?>
