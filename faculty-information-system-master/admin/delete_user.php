<?php
session_start();

if (isset($_GET["user_id"])) {
    $user_id = $_GET["user_id"];
    require_once('../includes/db_connect.php');

    // Check if the user being deleted is currently logged in
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user_id) {
        session_unset();
        session_destroy();
    }

    // Retrieve the role_name and username for the user being deleted
    $sql = "SELECT role_name, username FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $role_name = $result['role_name'];
    $username = $result['username'];

    // Delete the user from the database
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]);

    // Delete the corresponding record from staff table if role_name is 'Admin'
    if ($role_name == 'Admin') {
        $sql = "DELETE FROM staff WHERE StaffNo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);
    }

    // Delete the corresponding record from student table if role_name is 'Students'
    if ($role_name == 'Students') {
        $sql = "DELETE FROM student WHERE StudentNo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);
    }
}

header("Location: user_management.php");
exit;
?>
