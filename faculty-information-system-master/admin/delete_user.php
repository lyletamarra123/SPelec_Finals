<?php
session_start();

if (isset($_GET["user_id"])) {
    $user_id = $_GET["user_id"];
    require_once('../includes/db_connect.php');

    require_once('../OOPClasses/UserManager.php');
    $db = new DBConnect();
    $conn = $db->getConnection();
    $userListManager = new UserListManager($conn);
    $userListManager->deleteUser($user_id);
}

header("Location: user_management.php");
exit;
?>
